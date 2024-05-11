<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_kelas = $request->query('search_kelas');

        // Mulai dengan kueri dasar untuk mendapatkan semua akun siswa
        $query = Kelas::where('row_status', '0')->orderBy('id', 'desc');

        // Jika ada pencarian, tambahkan filter pencarian ke kueri
        if (!empty($search_kelas)) {
            $query->where('kelas', 'like', '%' . $search_kelas . '%');
        }

        // Ambil data dengan paginasi
        $kelas_siswa = $query->withCount('Siswa')->paginate(5)->onEachSide(2)->fragment('kelas_siswa');

        return view('AdminView.KelasSiswa.index', compact('kelas_siswa', 'search_kelas'));
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
                'kelas' => ['required', 'string', 'max:10', function ($attribute, $value, $fail) use ($request) {
                    $existingKelas = Kelas::where('kelas', $value)->exists();
                    if ($existingKelas) {
                        $fail('The ' . $attribute . ' has already been taken.');
                    }
                }],
                'ruangan' => 'required|string|max:10',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {

            $kelas = new Kelas();
            $kelas->kelas = $request->kelas;
            $kelas->ruangan = $request->ruangan;

            GeneralHelpers::setCreatedAt($kelas);
            GeneralHelpers::setCreatedBy($kelas);
            GeneralHelpers::setUpdatedAtNull($kelas);
            GeneralHelpers::setRowStatusActive($kelas);

            $kelas->save();

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
            $kelas = Kelas::where('id', $id)
                ->where('row_status', '0')
                ->firstOrFail();
            return ResponseHelpers::SuccessResponse('', $kelas, 200);
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
        $validator = Validator::make(
            $request->all(),
            [
                'kelas' => 'required|string|max:10',
                'ruangan' => 'required|string|max:10',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            if ($id == $request->id) {
                $kelas = Kelas::where('id', $id)
                    ->where('row_status', '0')
                    ->firstOrFail();

                $kelas->kelas = $request->kelas;
                $kelas->ruangan = $request->ruangan;
                GeneralHelpers::setUpdatedAt($kelas);

                $kelas->save();

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
            $kelas = Kelas::where('id', $id)
                ->where('row_status', '0')
                ->firstOrFail();
            GeneralHelpers::setRowStatusInActive($kelas);
            $kelas->save();
            return ResponseHelpers::SuccessResponse('Your record has been deleted', '', 200);
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }
}
