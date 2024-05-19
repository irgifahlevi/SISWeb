<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\WaliSiswa;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WaliSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_wali_siswa = $request->query('search_wali_siswa');

        $query = WaliSiswa::where('row_status', 0)
            ->orderBy('id', 'desc')
            ->whereHas('JenisKelaminWali', function ($query) {
                $query->where('row_status', 0);
            })
            ->whereHas('Siswa', function ($query) {
                $query->where('row_status', 0);
            });

        if (!empty($search_wali_siswa)) {
            $query->where('nama_lengkap', 'like', '%' . $search_wali_siswa . '%');
        }

        $wali_siswa = $query->paginate(10)->onEachSide(2)->fragment('profile_siswa');

        return view('AdminView.WaliSiswa.index', compact('wali_siswa', 'search_wali_siswa'));
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
                'nama_lengkap' => 'required|string|min:3',
                'nik' => 'required|digits:16',
                'no_telepon' => 'nullable|numeric',
                'alamat' => 'nullable|max:500',
                'hubungan_status' => 'required|in:Ayah,Ibu,Kaka,Kakek,Nenek',
                'pekerjaan' => 'required|max:255',
                'penghasilan' => 'required|numeric',
                'pendidikan' => 'required|in:Tidak sekolah,SD,SLTP,SLTA,S1,S2',
                'jenis_kelamin_id' => 'required|exists:jenis_kelamins,id',
                'siswa_id' => 'required|exists:siswas,id',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            $data = new WaliSiswa();
            $data->nama_lengkap = $request->nama_lengkap;
            $data->nik = $request->nik;
            $data->no_telepon = $request->no_telepon;
            $data->alamat = $request->alamat;
            $data->hubungan_status = $request->hubungan_status;
            $data->pekerjaan = $request->pekerjaan;
            $data->penghasilan = $request->penghasilan;
            $data->pendidikan = $request->pendidikan;
            $data->jenis_kelamin_id = $request->jenis_kelamin_id;
            $data->siswa_id = $request->siswa_id;

            GeneralHelpers::setCreatedAt($data);
            GeneralHelpers::setCreatedBy($data);
            GeneralHelpers::setUpdatedAtNull($data);
            GeneralHelpers::setRowStatusActive($data);

            $data->save();

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
            $data = WaliSiswa::where('id', $id)
                ->where('row_status', 0)
                ->whereHas('JenisKelaminWali', function ($query) {
                    $query->where('row_status', 0);
                })
                ->whereHas('Siswa', function ($query) {
                    $query->where('row_status', 0);
                })
                ->firstOrFail();
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
                'nama_lengkap' => 'required|string|min:3',
                'nik' => 'required|digits:16',
                'no_telepon' => 'nullable|numeric',
                'alamat' => 'nullable|max:500',
                'hubungan_status' => 'required|in:Ayah,Ibu,Kaka,Kakek,Nenek',
                'pekerjaan' => 'required|max:255',
                'penghasilan' => 'required|numeric',
                'pendidikan' => 'required|in:Tidak sekolah,SD,SLTP,SLTA,S1,S2',
                'jenis_kelamin_id' => 'required|exists:jenis_kelamins,id',
                'siswa_id' => 'required|exists:siswas,id',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            if ($id == $request->id) {
                $data = WaliSiswa::where('id', $id)
                    ->where('row_status', '0')
                    ->firstOrFail();
                $data->nama_lengkap = $request->nama_lengkap;
                $data->nik = $request->nik;
                $data->no_telepon = $request->no_telepon;
                $data->alamat = $request->alamat;
                $data->hubungan_status = $request->hubungan_status;
                $data->pekerjaan = $request->pekerjaan;
                $data->penghasilan = $request->penghasilan;
                $data->pendidikan = $request->pendidikan;
                $data->jenis_kelamin_id = $request->jenis_kelamin_id;
                $data->siswa_id = $request->siswa_id;

                GeneralHelpers::setUpdatedAt($data);
                $data->save();

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
        try {
            $data = WaliSiswa::where('id', $id)
                ->where('row_status', '0')
                ->firstOrFail();
            GeneralHelpers::setRowStatusInActive($data);
            $data->save();
            return ResponseHelpers::SuccessResponse('Your record has been deleted', '', 200);
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }
}
