<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Models\TenagaPendidik;
use App\Helpers\GeneralHelpers;
use App\Models\ProfilePendidik;
use App\Helpers\ResponseHelpers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TenagaPendidikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_data = $request->query('search_data');

        // Mulai dengan kueri dasar untuk mendapatkan semua akun siswa
        $query = ProfilePendidik::with(
            'JenisKelaminPendidik',
            'ProfilePendidik'
        )->whereHas('ProfilePendidik', function ($query) use ($search_data) {
            if (!empty($search_data)) {
                $query->where('nama_lengkap', 'like', '%' . $search_data . '%');
            }
        })->where('row_status', '0')->orderBy('id', 'desc');



        // Ambil data dengan paginasi
        $data = $query->paginate(5)->onEachSide(2)->fragment('tenaga_pendidik');

        return view('AdminView.TenagaPendidik.index', compact('data', 'search_data'));
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
                'nip' => 'nullable|numeric|digits:18',
                'no_nuptk' => 'nullable|numeric|digits:18',
                'mapel' => 'nullable|string',
                'jabatan' => 'nullable|string',
                'nik' => 'required|numeric|digits:16',
                'no_telepon' => 'nullable|numeric',
                'jenis_kelamin_id' => 'required|exists:jenis_kelamins,id',
                'pendidikan' => 'required|in:Tidak sekolah,SD,SLTP,SLTA,S1,S2',
                'tempat_lahir' => 'required|max:100',
                'tanggal_lahir' => 'required|date',
                'agama' => 'required|in:Islam',
                'alamat' => 'required|max:500',
                'kelurahan' => 'nullable|max:20',
                'kecamatan' => 'nullable|max:20',
                'kota' => 'nullable|max:20',
                'kode_pos' => 'nullable|numeric|digits:5',
                'email' => 'nullable|email|max:255|unique:profile_pendidiks',
                'foto' => 'required|image|mimes:jpeg,png|max:1000',

            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        DB::beginTransaction();
        try {
            $pendidik = new TenagaPendidik();
            $pendidik->nama_lengkap = $request->nama_lengkap;
            $pendidik->nip = $request->nip;
            $pendidik->no_nuptk = $request->no_nuptk;
            $pendidik->mapel = $request->mapel;
            $pendidik->jabatan = $request->jabatan;
            GeneralHelpers::setCreatedAt($pendidik);
            GeneralHelpers::setCreatedBy($pendidik);
            GeneralHelpers::setUpdatedAtNull($pendidik);
            GeneralHelpers::setRowStatusActive($pendidik);
            $pendidik->save();

            $profile = new ProfilePendidik();
            $profile->nik = $request->nik;
            $profile->tenaga_pendidik_id = $pendidik->id;
            $profile->no_telepon = $request->no_telepon;
            $profile->jenis_kelamin_id = $request->jenis_kelamin_id;
            $profile->pendidikan = $request->pendidikan;
            $profile->tempat_lahir = $request->tempat_lahir;
            $profile->tanggal_lahir = $request->tanggal_lahir;
            $profile->agama = $request->agama;
            $profile->alamat = $request->alamat;
            $profile->kelurahan = $request->kelurahan;
            $profile->kecamatan = $request->kecamatan;
            $profile->kota = $request->kota;
            $profile->kode_pos = $request->kode_pos;
            $profile->email = $request->email;

            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/pendidik', $imageName);
            $imagePath = basename($path);

            $profile->foto = $imagePath;

            GeneralHelpers::setCreatedAt($profile);
            GeneralHelpers::setCreatedBy($profile);
            GeneralHelpers::setUpdatedAtNull($profile);
            GeneralHelpers::setRowStatusActive($profile);

            $profile->save();

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
        try {
            $data = ProfilePendidik::with(
                'JenisKelaminPendidik',
                'ProfilePendidik'
            )->where('id', $id)
                ->where('row_status', 0)
                ->whereHas('ProfilePendidik', function ($query) {
                    $query->where('row_status', 0);
                })
                ->whereHas('JenisKelaminPendidik', function ($query) {
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
    public function showPendidik(string $id)
    {
        $profile_pendidik = ProfilePendidik::with('JenisKelaminPendidik', 'ProfilePendidik')
        ->whereHas('ProfilePendidik', function ($query) {
            $query->where('row_status', 0);
        })
        ->where('id', $id)
        ->where('row_status', 0)
        ->firstOrFail();
        // dd($profile_pendidik);
    return view('ClientView.ProfilePendidikContent.index', compact('profile_pendidik'));
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
                'nip' => 'nullable|numeric|digits:18',
                'no_nuptk' => 'nullable|numeric|digits:18',
                'mapel' => 'nullable|string',
                'jabatan' => 'nullable|string',
                'nik' => 'required|numeric|digits:16',
                'no_telepon' => 'nullable|numeric',
                'jenis_kelamin_id' => 'required|exists:jenis_kelamins,id',
                'pendidikan' => 'required|in:Tidak sekolah,SD,SLTP,SLTA,S1,S2',
                'tempat_lahir' => 'required|max:100',
                'tanggal_lahir' => 'required|date',
                'agama' => 'required|in:Islam',
                'alamat' => 'required|max:500',
                'kelurahan' => 'nullable|max:20',
                'kecamatan' => 'nullable|max:20',
                'kota' => 'nullable|max:20',
                'kode_pos' => 'nullable|numeric|digits:5',
                'email' => 'nullable|email:rfc,dns|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png|max:1000',

            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            if ($id == $request->id) {

                $pendidik = TenagaPendidik::where('id', $request->tenaga_pendidik_id)
                    ->where('row_status', '0')
                    ->firstOrFail();

                $pendidik->nama_lengkap = $request->nama_lengkap;
                $pendidik->nip = $request->nip;
                $pendidik->no_nuptk = $request->no_nuptk;
                $pendidik->jabatan = $request->jabatan;
                $pendidik->mapel = $request->mapel;
                GeneralHelpers::setUpdatedAt($pendidik);
                $pendidik->save();

                $profile = ProfilePendidik::where('id', $id)
                    ->where('row_status', '0')
                    ->firstOrFail();

                $profile->nik = $request->nik;
                $profile->no_telepon = $request->no_telepon;
                $profile->jenis_kelamin_id = $request->jenis_kelamin_id;
                $profile->pendidikan = $request->pendidikan;
                $profile->tempat_lahir = $request->tempat_lahir;
                $profile->tanggal_lahir = $request->tanggal_lahir;
                $profile->agama = $request->agama;
                $profile->alamat = $request->alamat;
                $profile->kelurahan = $request->kelurahan;
                $profile->kecamatan = $request->kecamatan;
                $profile->kota = $request->kota;
                $profile->kode_pos = $request->kode_pos;
                $profile->email = $request->email;

                if ($request->hasFile('foto')) {
                    Storage::delete('public/pendidik/' . $profile->foto);
                    $file = $request->file('foto');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('public/pendidik/', $fileName);
                    $fileImage = basename($path);
                    $profile->foto = $fileImage;
                }

                GeneralHelpers::setUpdatedAt($profile);
                $profile->save();

                return ResponseHelpers::SuccessResponse('Your record has been updated', '', 200);
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
            $profile = ProfilePendidik::with('ProfilePendidik')->where('id', $id)
                ->where('row_status', 0)
                ->whereHas('ProfilePendidik', function ($query) {
                    $query->where('row_status', 0);
                })->firstOrFail();

            $image_exists = Storage::exists('public/pendidik/' . $profile->foto);
            if ($image_exists) {
                Storage::delete('public/pendidik/' . $profile->foto);
            }
            GeneralHelpers::setRowStatusInActive($profile);
            $profile->save();

            $pendidik = TenagaPendidik::where('id', $profile->ProfilePendidik->id)
                ->firstOrFail();
            GeneralHelpers::setRowStatusInActive($pendidik);
            $pendidik->save();

            return ResponseHelpers::SuccessResponse('Your record has been deleted', '', 200);
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }

    public function getDetail($id)
    {
        try {
            $data = ProfilePendidik::with(
                'JenisKelaminPendidik',
                'ProfilePendidik'
            )->where('id', $id)
                ->where('row_status', 0)
                ->whereHas('ProfilePendidik', function ($query) {
                    $query->where('row_status', 0);
                })
                ->whereHas('JenisKelaminPendidik', function ($query) {
                    $query->where('row_status', 0);
                })
                ->first();
            return view('AdminView.TenagaPendidik.detail_pendidik', compact('data', 'id'));
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }
}
