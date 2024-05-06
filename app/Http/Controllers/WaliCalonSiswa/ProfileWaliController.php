<?php

namespace App\Http\Controllers\WaliCalonSiswa;

use Exception;
use Illuminate\Http\Request;
use App\Models\WaliCalonSiswa;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileWaliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Mengambil satu data wali calon siswa berdasarkan ID pengguna yang sedang login
        $data = WaliCalonSiswa::with('JenisKelamin')
            ->whereHas('Users', function ($query) use ($userId) {
                $query->where('id', $userId);
            })->first();

        return view('WaliCalonView.ProfileWaliCalon.index', compact('data'));
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
        $request->merge(['penghasilan' => str_replace('.', '', $request->penghasilan)]);

        // Validasi input
        $validator = Validator::make(
            $request->all(),
            [
                'nik' => 'required|digits:16',
                'no_telepon' => 'required|numeric',
                'alamat' => 'nullable|max:500',
                'hubungan_status' => 'required|in:Ayah,Ibu,Kaka',
                'pekerjaan' => 'required|max:255',
                'penghasilan' => 'required|numeric',
                'pendidikan' => 'required|in:Tidak sekolah,SD,SLTP,SLTA,S1,S2',
                'jenis_kelamin_id' => 'required|exists:jenis_kelamins,id',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {

            $userId = Auth::user()->id;

            $profile_wali = new WaliCalonSiswa();
            $profile_wali->user_id = $userId;
            $profile_wali->nik = $request->nik;
            $profile_wali->no_telepon = $request->no_telepon;
            $profile_wali->alamat = $request->alamat;
            $profile_wali->hubungan_status = $request->hubungan_status;
            $profile_wali->pekerjaan = $request->pekerjaan;
            $profile_wali->penghasilan = $request->penghasilan;
            $profile_wali->pendidikan = $request->pendidikan;
            $profile_wali->jenis_kelamin_id = $request->jenis_kelamin_id;

            GeneralHelpers::setCreatedAt($profile_wali);
            GeneralHelpers::setCreatedBy($profile_wali);
            GeneralHelpers::setUpdatedAtNull($profile_wali);
            GeneralHelpers::setRowStatusActive($profile_wali);

            $profile_wali->save();

            return ResponseHelpers::SuccessResponse('Data berhasil ditambahkan', '', 200);
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Mendapatkan ID pengguna yang sedang login
            $userId = Auth::id();

            $data = WaliCalonSiswa::where('id', $id)
                ->where('row_status', '0')
                ->whereHas('Users', function ($query) use ($userId) {
                    $query->where('id', $userId);
                })
                ->with('JenisKelamin')
                ->first();
            if (!$data) {
                return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
            }
            return ResponseHelpers::SuccessResponse('', $data, 200);
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
        // Menghapus tanda hubung ("-") dari nomor telepon
        $request->merge(['no_telepon' => str_replace('-', '', $request->no_telepon)]);
        $request->merge(['penghasilan' => str_replace('.', '', $request->penghasilan)]);

        // Validasi input
        $validator = Validator::make(
            $request->all(),
            [
                'nik' => 'required|digits:16',
                'no_telepon' => 'required|numeric',
                'alamat' => 'nullable|max:500',
                'hubungan_status' => 'required|in:Ayah,Ibu,Kaka',
                'pekerjaan' => 'required|max:255',
                'penghasilan' => 'required|numeric',
                'pendidikan' => 'required|in:Tidak sekolah,SD,SLTP,SLTA,S1,S2',
                'jenis_kelamin_id' => 'required|exists:jenis_kelamins,id',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            if ($id == $request->id) {

                $profile_wali = WaliCalonSiswa::where('id', $id)
                    ->where('row_status', '0')
                    ->firstOrFail();

                $profile_wali->nik = $request->nik;
                $profile_wali->no_telepon = $request->no_telepon;
                $profile_wali->alamat = $request->alamat;
                $profile_wali->hubungan_status = $request->hubungan_status;
                $profile_wali->pekerjaan = $request->pekerjaan;
                $profile_wali->penghasilan = $request->penghasilan;
                $profile_wali->pendidikan = $request->pendidikan;
                $profile_wali->jenis_kelamin_id = $request->jenis_kelamin_id;
                GeneralHelpers::setUpdatedAt($profile_wali);
                $profile_wali->save();

                return ResponseHelpers::SuccessResponse('Data berhasil ditambahkan', '', 200);
            } else {
                return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
            }
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
