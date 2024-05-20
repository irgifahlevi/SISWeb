<?php

namespace App\Http\Controllers\WaliCalonSiswa;

use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Models\WaliCalonSiswa;
use Illuminate\Support\Carbon;
use App\Helpers\GeneralHelpers;
use App\Helpers\PaymentHelpers;
use App\Models\InfoPendaftaran;
use App\Helpers\ResponseHelpers;
use App\Models\BiayaPendaftaran;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PendaftaranSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Menghapus tanda hubung ("-") dari nomor telepon
        $request->merge(['no_telepon' => str_replace('-', '', $request->no_telepon)]);

        // Validasi input
        $validator = Validator::make(
            $request->all(),
            [
                'nama_lengkap' => 'required|string|min:4',
                'nik' => 'required|numeric|digits:16',
                'no_kk' => 'required|numeric|digits:16',
                'no_nisn' => 'nullable|numeric|digits:10',
                'no_telepon' => 'nullable|numeric',
                'jenis_kelamin_id' => 'required|exists:jenis_kelamins,id',
                'tempat_lahir' => 'required|max:100',
                'tanggal_lahir' => 'required|date',
                'agama' => 'required|in:Islam',
                'alamat' => 'required|max:500',
                'kelurahan' => 'required|max:20',
                'kecamatan' => 'required|max:20',
                'kota' => 'required|max:20',
                'kode_pos' => 'required|numeric|digits:5',
                'email' => ['nullable', 'email', function ($attribute, $value, $fail) use ($request) {
                    $existingEmail = CalonSiswa::where('email', $value)->exists();
                    if ($existingEmail) {
                        $fail('The ' . $attribute . ' has already been taken.');
                    }
                }],
                'tempat_tinggal' => 'nullable|max:20',
                'nama_sekolah_asal' => 'required|max:100',
                'alamat_sekolah_asal' => 'required|max:500',
                'kota_sekolah_asal' => 'required|max:20',
                'tahun_lulus' => 'required|numeric|digits:4',
                'anak_ke' => 'required|numeric|max:10',
                'jumlah_saudara' => 'required|numeric|max:10',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            DB::transaction(function () use ($request) {

                $user = Auth::user();
                $wali_calon_id = WaliCalonSiswa::whereHas('users', function ($query) use ($user) {
                    $query->where('id', $user->id);
                })->first();

                // save data siswa
                $siswa = new CalonSiswa();
                $siswa->nama_lengkap = $request->nama_lengkap;
                $siswa->nik = $request->nik;
                $siswa->no_kk = $request->no_kk;
                $siswa->no_nisn = $request->no_nisn;
                $siswa->no_telepon = $request->no_telepon;
                $siswa->jenis_kelamin_id = $request->jenis_kelamin_id;
                $siswa->wali_calon_siswa_id = $wali_calon_id->id;
                $siswa->tempat_lahir = $request->tempat_lahir;
                $siswa->tanggal_lahir = $request->tanggal_lahir;
                $siswa->agama = $request->agama;
                $siswa->alamat = $request->alamat;
                $siswa->kelurahan = $request->kelurahan;
                $siswa->kecamatan = $request->kecamatan;
                $siswa->kota = $request->kota;
                $siswa->kode_pos = $request->kode_pos;
                $siswa->email = $request->email;
                $siswa->tempat_tinggal = $request->tempat_tinggal;
                $siswa->nama_sekolah_asal = $request->nama_sekolah_asal;
                $siswa->alamat_sekolah_asal = $request->alamat_sekolah_asal;
                $siswa->kota_sekolah_asal = $request->kota_sekolah_asal;
                $siswa->tahun_lulus = $request->tahun_lulus;
                $siswa->anak_ke = $request->anak_ke;
                $siswa->jumlah_saudara = $request->jumlah_saudara;


                GeneralHelpers::setCreatedAt($siswa);
                GeneralHelpers::setCreatedBy($siswa);
                GeneralHelpers::setUpdatedAtNull($siswa);
                GeneralHelpers::setRowStatusActive($siswa);

                $siswa->save();

                // buat create data pendaftaran
                $daftar = new Pendaftaran();

                $tanggal = Carbon::now()->format('dmy');
                $last_record = Pendaftaran::select('no_pendaftaran')
                    ->whereDate('created_at', Carbon::today())->latest('no_pendaftaran')->first();
                if ($last_record) {
                    // Mengambil 4 digit terakhir
                    $last_number = intval(substr($last_record->no_pendaftaran, -4));
                    $count = $last_number + 1;
                    // Memastikan panjang nomor urut tetap 4 digit
                    $nomor_urut = str_pad($count, 4, '0', STR_PAD_LEFT);
                } else {
                    $nomor_urut = '0001';
                }
                // Menggabungkan tanggal dan nomor urut
                $no_pendaftaran = $tanggal . $nomor_urut;

                // mengambil data biaya pendaftaran
                $gel_kode = $request->gelombang_id;
                $pendaftaran = InfoPendaftaran::select('id', 'kode_gelombang')
                    ->where('kode_gelombang', $gel_kode)
                    ->where('row_status', 0)
                    ->firstOrFail();
                $biaya = BiayaPendaftaran::with('InfoPendaftarans:id')
                    ->where('row_status', 0)
                    ->whereHas('InfoPendaftarans', function ($query) use ($pendaftaran) {
                        $query->where('id', $pendaftaran->id);
                        $query->where('row_status', 0);
                    })->get();

                $item_total = $biaya->count();
                $total = $biaya->sum('nominal_biaya');

                $rand_code = GeneralHelpers::generateRandomNumber(8);

                $kode_pendaftaran = "REG" . "-" . $rand_code . "-" . $tanggal;

                $detailBiaya = [];

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
                $no_telp = formatNoTelpon($wali_calon_id->no_telepon);
                $params = array(
                    'transaction_details' => array(
                        'order_id' => $kode_pendaftaran,
                        'gross_amount' => $total,
                        'total_item' => $item_total,
                        'siswa_name' => $siswa->nama_lengkap,
                        'register_number' => $no_pendaftaran

                    ),
                    'item_details' => $detailBiaya,
                    'customer_details' => array(
                        'first_name' => $user->username,
                        'last_name' => '',
                        'email' => $user->email,
                        'phone' => $no_telp,
                    ),
                );

                $snap_token = \Midtrans\Snap::getSnapToken($params);
                $daftar->token_pembayaran = $snap_token;

                $daftar->no_pendaftaran = $no_pendaftaran;
                $daftar->kode_pendaftaran = $kode_pendaftaran;
                $daftar->is_bayar = PaymentHelpers::setFalse();
                $daftar->jumlah_item = $item_total;
                $daftar->total_bayar = $total;
                $daftar->tanggal_pendaftaran = PaymentHelpers::dateNow();
                $daftar->info_pendaftaran_id = $pendaftaran->id;
                $daftar->calon_siswa_id = $siswa->id;
                $daftar->wali_calon_siswa_id = $wali_calon_id->id;
                PaymentHelpers::setOnline($daftar);
                PaymentHelpers::setPending($daftar);

                GeneralHelpers::setCreatedAt($daftar);
                GeneralHelpers::setCreatedBy($daftar);
                GeneralHelpers::setUpdatedAtNull($daftar);
                GeneralHelpers::setRowStatusActive($daftar);

                $daftar->save();
            });
        } catch (Exception $e) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
        return ResponseHelpers::SuccessResponse('Data berhasil ditambahkan', '', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode)
    {

        $user_id = Auth::id();

        $wali_calon_siswa = WaliCalonSiswa::select('id')->where('user_id', $user_id)->first();
        $data = Pendaftaran::with('CalonWaliPendaftaran', 'CalonSiswaPendaftaran', 'InfoBiayaPendaftaran.BiayaPendaftaran')
            ->where('kode_pendaftaran', $kode)
            ->where('wali_calon_siswa_id', $wali_calon_siswa->id)
            ->where('status', 'success')
            ->first();

        return view('WaliCalonView.PendaftaranSiswa.view_invoice_pendaftaran', compact('data', 'kode'));
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
        //
    }

    public function updateStatus(Request $request)
    {
    }
}
