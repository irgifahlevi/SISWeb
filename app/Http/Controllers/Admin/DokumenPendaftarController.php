<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Mail\TestSeleksiEmail;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\DokumenPendaftaranCalonSiswa;

class DokumenPendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_dokumen = $request->query('search_dokumen');

        $query = Pendaftaran::with('CalonWaliPendaftaran.Users', 'CalonSiswaPendaftaran')
            ->where('row_status', 0)
            ->where('status_seleksi', 'review_document')
            ->orderBy('id', 'desc');

        if (!empty($search_dokumen)) {
            $query->where('kode_pendaftaran', 'like', '%' . $search_dokumen . '%');
        }

        $data = $query->paginate(10)->onEachSide(2)->fragment('transaksi');
        return view('AdminView.DokumenPendaftaranSiswa.index', compact('data', 'search_dokumen'));
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
        $validator = Validator::make(
            $request->all(),
            [
                'status' => 'required|in:valid,invalid',
                'catatan' => 'required|max:500'
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        DB::beginTransaction();
        try {

            $data = DokumenPendaftaranCalonSiswa::with('PendaftarCalonSiswa')
                ->where('id', $request->dokumen_id)
                ->where('row_status', 0)
                ->first();

            if ($data != null) {

                $data->status = $request->status;
                $data->catatan = $request->catatan;

                GeneralHelpers::setCreatedAt($data);
                GeneralHelpers::setCreatedBy($data);
                GeneralHelpers::setUpdatedAtNull($data);
                GeneralHelpers::setRowStatusActive($data);

                $data->save();

                $pendaftaran =  Pendaftaran::with('CalonWaliPendaftaran.Users')->where('id', $request->pendaftaran_id)
                    ->where('row_status', 0)
                    ->where('status_seleksi', 'review_document')
                    ->whereHas('DokumenCalonSiswa', function ($q) {
                        $q->where('status', 'valid')
                            ->havingRaw('COUNT(*) = 3');
                    })->first();

                if ($pendaftaran != null) {
                    $email_user = $pendaftaran->CalonWaliPendaftaran->Users->email;
                    $wali_siswa = $pendaftaran->CalonWaliPendaftaran->Users->username;

                    $mail_data = [
                        'to' => $email_user,
                        'wali_siswa' => $wali_siswa,
                    ];

                    Mail::to($email_user)->send(new TestSeleksiEmail($mail_data));
                    GeneralHelpers::setTrueDocument($pendaftaran);
                    $pendaftaran->status_seleksi = GeneralHelpers::setStatusSeleksi(2); // belum dinilai
                    $pendaftaran->save();
                }

                DB::commit();
                return ResponseHelpers::SuccessResponse('Data berhasil ditambahkan', '', 200);
            } else {
                return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
            }
        } catch (Exception $th) {
            DB::rollBack();
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode)
    {
        try {
            $data = Pendaftaran::with(
                'CalonWaliPendaftaran.Users',
                'CalonWaliPendaftaran.JenisKelamin',
                'CalonSiswaPendaftaran.JenisKelaminCalonSiswa',
                'InfoBiayaPendaftaran.BiayaPendaftaran',
                'DokumenCalonSiswa',
            )
                ->where('kode_pendaftaran', $kode)
                ->where('row_status', 0)->first();
            return view('AdminView.DokumenPendaftaranSiswa.detail_dokumen_pendaftar', compact('data', 'kode'));
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
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


    public function detailDokumen($code, $id)
    {
        try {
            $data = DokumenPendaftaranCalonSiswa::where('id', $id)
                ->where('row_status', '0')
                ->first();
            return ResponseHelpers::SuccessResponse('', $data, 200);
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }

    public function updateStatus($id, $code, $stattus)
    {
        try {
            $data = DokumenPendaftaranCalonSiswa::where('id', $id)
                ->where('row_status', '0')
                ->firstOrFail();
            return ResponseHelpers::SuccessResponse('', $data, 200);
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }
}
