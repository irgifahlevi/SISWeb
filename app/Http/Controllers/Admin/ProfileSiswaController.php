<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProfileSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_profile_siswa = $request->query('search_profile_siswa');

        $query = Siswa::where('row_status', 0)
            ->whereHas('KelasSiswa', function ($query) {
                $query->where('row_status', 0);
            })
            ->whereHas('JenisKelaminSiswa', function ($query) {
                $query->where('row_status', 0);
            })
            ->whereHas('UserSiswa', function ($query) {
                $query->where('row_status', 0);
            })->orderBy('id', 'desc');

        if (!empty($search_profile_siswa)) {
            $query->where('nama_lengkap', 'like', '%' . $search_profile_siswa . '%');
        }

        $profile_siswa = $query->paginate(10)->onEachSide(2)->fragment('profile_siswa');

        return view('AdminView.ProfileSiswa.index', compact('profile_siswa', 'search_profile_siswa'));
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
                'user_id' => 'required|exists:users,id',
                'nama_lengkap' => 'required|string|min:4',
                'nik' => 'required|numeric|digits:16',
                'no_kk' => 'required|numeric|digits:16',
                'no_nisn' => 'nullable|numeric|digits:10',
                'no_telepon' => 'nullable|numeric',
                'jenis_kelamin_id' => 'required|exists:jenis_kelamins,id',
                'kelas_id' => 'required|exists:kelas,id',
                'tempat_lahir' => 'required|max:100',
                'tanggal_lahir' => 'required|date',
                'agama' => 'required|in:Islam',
                'alamat' => 'required|max:500',
                'kelurahan' => 'nullable|max:20',
                'kecamatan' => 'nullable|max:20',
                'kota' => 'nullable|max:20',
                'kode_pos' => 'nullable|numeric|digits:5',
                'tempat_tinggal' => 'nullable|max:20',
                'tahun_masuk' => 'required|numeric|digits:4',
                'nis_lokal' => 'required|numeric|digits:4',
                'anak_ke' => 'required|numeric|max:10',
                'jumlah_saudara' => 'required|numeric|max:10',

            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {

            $userId = User::where('id', $request->user_id)->value('id');

            $data = new Siswa();
            $data->user_id = $userId;
            $data->nama_lengkap = $request->nama_lengkap;
            $data->nik = $request->nik;
            $data->no_kk = $request->no_kk;
            $data->no_nisn = $request->no_nisn;
            $data->no_telepon = $request->no_telepon;
            $data->jenis_kelamin_id = $request->jenis_kelamin_id;
            $data->kelas_id = $request->kelas_id;
            $data->tempat_lahir = $request->tempat_lahir;
            $data->tanggal_lahir = $request->tanggal_lahir;
            $data->agama = $request->agama;
            $data->alamat = $request->alamat;
            $data->kelurahan = $request->kelurahan;
            $data->kecamatan = $request->kecamatan;
            $data->kota = $request->kota;
            $data->kode_pos = $request->kode_pos;
            $data->tempat_tinggal = $request->tempat_tinggal;
            $data->tahun_masuk = $request->tahun_masuk;
            $data->nis_lokal = $request->nis_lokal;
            $data->anak_ke = $request->anak_ke;
            $data->jumlah_saudara = $request->jumlah_saudara;

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
            $data = Siswa::where('id', $id)
                ->where('row_status', 0)
                ->whereHas('KelasSiswa', function ($query) {
                    $query->where('row_status', 0);
                })
                ->whereHas('JenisKelaminSiswa', function ($query) {
                    $query->where('row_status', 0);
                })
                ->whereHas('UserSiswa', function ($query) {
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
                'kelas_id' => 'required|exists:kelas,id',
                'tempat_lahir' => 'required|max:100',
                'tanggal_lahir' => 'required|date',
                'agama' => 'required|in:Islam',
                'alamat' => 'required|max:500',
                'kelurahan' => 'nullable|max:20',
                'kecamatan' => 'nullable|max:20',
                'kota' => 'nullable|max:20',
                'kode_pos' => 'nullable|numeric|digits:5',
                'tempat_tinggal' => 'nullable|max:20',
                'tahun_masuk' => 'required|numeric|digits:4',
                'nis_lokal' => 'required|numeric|digits:4',
                'anak_ke' => 'required|numeric|max:10',
                'jumlah_saudara' => 'required|numeric|max:10',

            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            if ($id == $request->id) {

                $data = Siswa::where('id', $id)
                    ->where('row_status', '0')
                    ->firstOrFail();

                $data->nama_lengkap = $request->nama_lengkap;
                $data->nik = $request->nik;
                $data->no_kk = $request->no_kk;
                $data->no_nisn = $request->no_nisn;
                $data->no_telepon = $request->no_telepon;
                $data->jenis_kelamin_id = $request->jenis_kelamin_id;
                $data->kelas_id = $request->kelas_id;
                $data->tempat_lahir = $request->tempat_lahir;
                $data->tanggal_lahir = $request->tanggal_lahir;
                $data->agama = $request->agama;
                $data->alamat = $request->alamat;
                $data->kelurahan = $request->kelurahan;
                $data->kecamatan = $request->kecamatan;
                $data->kota = $request->kota;
                $data->kode_pos = $request->kode_pos;
                $data->tempat_tinggal = $request->tempat_tinggal;
                $data->tahun_masuk = $request->tahun_masuk;
                $data->nis_lokal = $request->nis_lokal;
                $data->anak_ke = $request->anak_ke;
                $data->jumlah_saudara = $request->jumlah_saudara;
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
            $data = Siswa::where('id', $id)
                ->where('row_status', '0')
                ->firstOrFail();
            GeneralHelpers::setRowStatusInActive($data);
            $data->save();
            return ResponseHelpers::SuccessResponse('Your record has been deleted', '', 200);
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }

    public function dataSiswa()
    {
        $data = Siswa::select('id', 'nama_lengkap')
            ->where('row_status', '0')
            ->orderBy('id', 'desc')
            ->get();
        return ResponseHelpers::SuccessResponse('', $data, 200);
    }
}
