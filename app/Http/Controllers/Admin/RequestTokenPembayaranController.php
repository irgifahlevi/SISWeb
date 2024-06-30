<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use App\Models\RequestToken;
use App\Models\TagihanSiswa;
use Illuminate\Http\Request;
use App\Models\WaliCalonSiswa;
use App\Helpers\GeneralHelpers;
use App\Helpers\PaymentHelpers;
use App\Models\InfoPendaftaran;
use App\Helpers\ResponseHelpers;
use App\Models\BiayaPendaftaran;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class RequestTokenPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $search_data = $request->query('search_data');

        $query = RequestToken::with([
            'RequestTokenTagihan'  => function ($query) {
                $query->where('row_status', 0)
                    ->select('id', 'kode_tagihan', 'status', 'nominal_tagihan', 'created_at'); // Pilih kolom yang dibutuhkan
            },
            'RequestTokenPendaftaran' => function ($query) {
                $query->where('row_status', 0); // Pilih kolom yang dibutuhkan
            }
        ])
            ->where('row_status', 0);

        if (!empty($search_data)) {
            $query->where(function ($q) use ($search_data) {
                $q->where('deskripsi', 'like', '%' . $search_data . '%');
            });
        }

        $query->orderBy('id', 'desc');

        $data = $query->paginate(10)->fragment('tagihan');
        return view('AdminView.RequestToken.index', compact('data', 'search_data'));
    }

    public function updateToken(string $kode_pembayaran, string $id)
    {
        $trans = substr($kode_pembayaran, 0, strpos($kode_pembayaran, '-'));
        $detailBiaya = [];
        $params = [];
        DB::beginTransaction();
        try {
            if ($trans == "REG") {
                $pendaftaran = Pendaftaran::with('InfoBiayaPendaftaran')
                    ->where('kode_pendaftaran', $kode_pembayaran)
                    ->where('row_status', 0)
                    ->firstOrFail();

                $wali_calon = WaliCalonSiswa::with('Users')
                    ->where('row_status', 0)
                    ->where('id', $pendaftaran->wali_calon_siswa_id)
                    ->first();

                $siswa = CalonSiswa::where('row_status', 0)
                    ->where('id', $pendaftaran->calon_siswa_id)
                    ->first();

                $gel_kode = $pendaftaran->InfoBiayaPendaftaran->kode_gelombang;
                $pendaftaran_info = InfoPendaftaran::select('id', 'kode_gelombang')
                    ->where('kode_gelombang', $gel_kode)
                    ->where('row_status', 0)
                    ->firstOrFail();

                $biaya = BiayaPendaftaran::with('InfoPendaftarans:id')
                    ->where('row_status', 0)
                    ->whereHas('InfoPendaftarans', function ($query) use ($pendaftaran_info) {
                        $query->where('id', $pendaftaran_info->id);
                        $query->where('row_status', 0);
                    })->get();

                $item_total = $biaya->count();
                $total = $biaya->sum('nominal_biaya');

                foreach ($biaya as $item) {
                    $detailBiaya[] = [
                        'id' => $item->id,
                        'name' => $item->nama_biaya,
                        'price' => $item->nominal_biaya,
                        'quantity' => 1
                    ];
                }

                // Process generate snap token
                \Midtrans\Config::$serverKey = config('midtrans.midtrans_server_key');
                \Midtrans\Config::$isProduction = config('midtrans.midtrans_production');
                \Midtrans\Config::$isSanitized = config('midtrans.midtrans_sanitized');
                \Midtrans\Config::$is3ds = config('midtrans.midtrans_3ds');
                $no_telp = formatNoTelpon($wali_calon->no_telepon);
                $params = array(
                    'transaction_details' => array(
                        'order_id' => $pendaftaran->kode_pendaftaran,
                        'gross_amount' => $total,
                        'total_item' => $item_total,
                        'siswa_name' => $siswa->nama_lengkap,
                        'register_number' => $pendaftaran->no_pendaftaran

                    ),
                    'item_details' => $detailBiaya,
                    'customer_details' => array(
                        'first_name' => $wali_calon->Users->username,
                        'last_name' => '',
                        'email' => $wali_calon->Users->email,
                        'phone' => $no_telp,
                    ),
                );

                $snap_token = \Midtrans\Snap::getSnapToken($params);
                $pendaftaran->token_pembayaran = $snap_token;
                GeneralHelpers::setUpdatedAt($pendaftaran);
                PaymentHelpers::setPending($pendaftaran);
                $pendaftaran->save();

                $request_data = RequestToken::where('id', $id)
                    ->where('row_Status', '0')
                    ->firstOrFail();
                $request_data->delete();

                DB::commit();
                return ResponseHelpers::SuccessResponse('Tagihan berhasil di perbarui', '', 200);
            } else if ($trans == "BILL") {
                $tagihan = TagihanSiswa::with('TagihanSiswas', 'TagihanKelas')
                    ->where('kode_tagihan', $kode_pembayaran)
                    ->where('row_status', 0)
                    ->firstOrFail();
                if ($tagihan->status != "dibayar" && $tagihan->status != "belum_dibayar") {
                    $detailBiaya[] = [
                        'id' => $tagihan->no_tagihan,
                        'name' => $tagihan->nama_tagihan,
                        'price' => $tagihan->nominal_tagihan,
                        'quantity' => 1
                    ];

                    $users = User::select('email')
                        ->where('id', $tagihan->TagihanSiswas->user_id)->firstOrFail();
                    $no_telp = formatNoTelpon($tagihan->TagihanSiswas->no_telepon);
                    // Process generate snap token
                    \Midtrans\Config::$serverKey = config('midtrans.midtrans_server_key');
                    \Midtrans\Config::$isProduction = config('midtrans.midtrans_production');
                    \Midtrans\Config::$isSanitized = config('midtrans.midtrans_sanitized');
                    \Midtrans\Config::$is3ds = config('midtrans.midtrans_3ds');

                    $params = array(
                        'transaction_details' => array(
                            'order_id' => $tagihan->kode_tagihan,
                            'gross_amount' => $tagihan->nominal_tagihan

                        ),
                        'item_details' => $detailBiaya,
                        'customer_details' => array(
                            'first_name' => $tagihan->TagihanSiswas->nama_lengkap,
                            'last_name' => '',
                            'email' => $users->email,
                            'phone' => $no_telp,
                        ),
                    );


                    $snap_token = \Midtrans\Snap::getSnapToken($params);
                    $tagihan->token_tagihan = $snap_token;
                    PaymentHelpers::setBelumDibayar($tagihan);
                    GeneralHelpers::setUpdatedAt($tagihan);
                    $tagihan->save();

                    $request_data = RequestToken::where('id', $id)
                        ->where('row_Status', '0')
                        ->firstOrFail();
                    $request_data->delete();

                    DB::commit();
                    return ResponseHelpers::SuccessResponse('Tagihan berhasil di perbarui', '', 200);
                }
            }
            return ResponseHelpers::ErrorResponse('Billing status is still valid, cannot be regenerated', 500);
        } catch (Exception $th) {
            DB::rollBack();
            return ResponseHelpers::ErrorResponse('Internal server error, try again later ' . $th, 500);
        }
    }
}
