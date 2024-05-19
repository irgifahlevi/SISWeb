<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Kelas;
use App\Rules\MinimumDate;
use App\Models\TagihanSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Helpers\GeneralHelpers;
use App\Helpers\PaymentHelpers;
use App\Helpers\ResponseHelpers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TagihanSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_tagihan = $request->query('search_tagihan');

        $query = TagihanSiswa::with(['TagihanKelas' => function ($query) {
            $query->where('row_status', 0);
        }])
            ->where('row_status', 0)
            ->whereHas('TagihanKelas', function ($query) use ($search_tagihan) {
                if (!empty($search_tagihan)) {
                    $query->where('kelas', 'like', '%' . $search_tagihan . '%');
                }
            })
            ->orderBy('id', 'desc');

        $data = $query->paginate(10)->onEachSide(2)->fragment('tagihan');
        return view('AdminView.DaftarTagihanSiswa.index', compact('data', 'search_tagihan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['nominal_tagihan' => str_replace('.', '', $request->nominal_tagihan)]);

        // Validasi input
        $validator = Validator::make(
            $request->all(),
            [
                'nama_tagihan' => 'required|max:100',
                'jatuh_tempo' => ['required', 'date', new MinimumDate(15)],
                'kategori_tagihan' => 'required|in:spp,iuran,uts,uas,kursus,buku',
                'nominal_tagihan' => 'required|numeric',
                'kelas_id' => 'required|exists:kelas,id',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        $kelas_siswa = Kelas::with('Siswa')->where('id', $request->kelas_id)->get();

        DB::beginTransaction();
        try {
            foreach ($kelas_siswa as $kelas) {
                foreach ($kelas->Siswa as $siswa) {

                    $tanggal = Carbon::now()->format('dmy');
                    $last_record = TagihanSiswa::select('no_tagihan')
                        ->whereDate('created_at', Carbon::today())->latest('no_tagihan')->first();
                    if ($last_record) {
                        $last_number = intval(substr($last_record->no_tagihan, -4));
                        $count = $last_number + 1;
                        $nomor_urut = str_pad($count, 4, '0', STR_PAD_LEFT);
                    } else {
                        $nomor_urut = '0001';
                    }

                    $no_tagihan  = $tanggal . $nomor_urut;

                    $random = GeneralHelpers::generateRandomNumber(8);

                    $kode_tagihan = "BILL" . "-" . $random . "-" . $tanggal;

                    $tagihan = new TagihanSiswa();
                    $tagihan->no_tagihan = $no_tagihan;
                    $tagihan->kode_tagihan = $kode_tagihan;
                    $tagihan->kelas_id = $kelas->id;
                    $tagihan->siswa_id = $siswa->id;
                    $tagihan->nama_tagihan = $request->nama_tagihan;
                    $tagihan->tanggal_dibuat = PaymentHelpers::dateNow();
                    $tagihan->jatuh_tempo = $request->jatuh_tempo;
                    $tagihan->kategori_tagihan = $request->kategori_tagihan;
                    $tagihan->nominal_tagihan = $request->nominal_tagihan;
                    PaymentHelpers::setBelumDibayar($tagihan);
                    PaymentHelpers::setOnline($tagihan);

                    GeneralHelpers::setCreatedAt($tagihan);
                    GeneralHelpers::setCreatedBy($tagihan);
                    GeneralHelpers::setUpdatedAtNull($tagihan);
                    GeneralHelpers::setRowStatusActive($tagihan);

                    $tagihan->save();

                    $data = TagihanSiswa::where('id', $tagihan->id)
                        ->firstOrFail();

                    $users = User::select('email')
                        ->where('id', $siswa->user_id)
                        ->first();

                    $detailBiaya[] = [
                        'id' => $data->no_tagihan,
                        'name' => $data->nama_tagihan,
                        'price' => $data->nominal_tagihan,
                        'quantity' => 1
                    ];


                    // Process generate snap token
                    \Midtrans\Config::$serverKey = config('midtrans.midtrans_server_key');
                    \Midtrans\Config::$isProduction = config('midtrans.midtrans_production');
                    \Midtrans\Config::$isSanitized = config('midtrans.midtrans_sanitized');
                    \Midtrans\Config::$is3ds = config('midtrans.midtrans_3ds');

                    $params = array(
                        'transaction_details' => array(
                            'order_id' => $data->kode_tagihan,
                            'gross_amount' => $data->nominal_tagihan

                        ),
                        'item_details' => $detailBiaya,
                        'customer_details' => array(
                            'first_name' => $siswa->nama_lengkap,
                            'last_name' => '',
                            'email' => $users->email,
                            'phone' => $siswa->no_telepon,
                        ),
                    );

                    $snap_token = \Midtrans\Snap::getSnapToken($params);
                    $data->token_tagihan = $snap_token;
                    GeneralHelpers::setUpdatedAtNull($data);
                    $data->save();
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return ResponseHelpers::ErrorResponse($e->getMessage(), 400);
        }

        return ResponseHelpers::SuccessResponse('Data berhasil ditambahkan', '', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }

    public function tagihanUpdate(string $kode_tagihan)
    {
        try {
            $tagihan = TagihanSiswa::with('TagihanSiswas', 'TagihanKelas')
                ->where('kode_tagihan', $kode_tagihan)
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
                        'phone' => $tagihan->TagihanSiswas->no_telepon,
                    ),
                );


                $snap_token = \Midtrans\Snap::getSnapToken($params);
                $tagihan->token_tagihan = $snap_token;
                PaymentHelpers::setBelumDibayar($tagihan);
                GeneralHelpers::setUpdatedAtNull($tagihan);
                $tagihan->save();

                return ResponseHelpers::SuccessResponse('Tagihan berhasil di perbarui', '', 200);
            }
            return ResponseHelpers::ErrorResponse('Billing status is still valid, cannot be regenerated', 500);
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later ' . $th, 500);
        }
    }
}
