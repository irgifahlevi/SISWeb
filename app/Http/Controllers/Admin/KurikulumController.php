<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use App\Models\KurikulumPrestasi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_kurikulum = $request->query('search_kurikulum');

        // Mulai dengan kueri dasar untuk mendapatkan semua akun siswa
        $query = KurikulumPrestasi::where('jenis_info', 'kurikulum')
            ->where('row_status', '0')
            ->orderBy('id', 'desc');

        // Jika ada pencarian, tambahkan filter pencarian ke kueri
        if (!empty($search_kurikulum)) {
            $query->where('nama', 'like', '%' . $search_kurikulum . '%');
        }

        // Ambil data dengan paginasi
        $kurikulum = $query->paginate(5)->onEachSide(2)->fragment('kurikulum_sekolah');

        return view('AdminView.Kurikulum.index', compact('kurikulum', 'search_kurikulum'));
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
                'nama' => 'required|string|max:255|min:4',
                'title' => 'nullable|string|max:255|min:4',
                'deskripsi' => 'required|max:2000',
                'tahun' => 'nullable|numeric|digits:4',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:1000',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {

            $record = new  KurikulumPrestasi();
            $record->title = $request->title;
            $record->jenis_info = "kurikulum";
            $record->nama = $request->nama;
            $record->tahun = $request->tahun;
            $record->deskripsi = $request->deskripsi;

            if ($request->gambar) {
                $image = $request->file('gambar');
                $imageName = time() . '.' .
                    $image->getClientOriginalExtension();
                $path = $image->storeAs('public/kurikulum_prestasi', $imageName);
                $imagePath = basename($path);
                $record->gambar = $imagePath;
            }

            GeneralHelpers::setCreatedAt($record);
            GeneralHelpers::setCreatedBy($record);
            GeneralHelpers::setUpdatedAtNull($record);
            GeneralHelpers::setRowStatusActive($record);

            $record->save();

            return ResponseHelpers::SuccessResponse('Data berhasil ditambahkan', '', 200);
        } catch (Exception $e) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $galeri = KurikulumPrestasi::where('id', $id)
                ->where('jenis_info', 'kurikulum')->where('row_status', '0')->firstOrFail();
            return ResponseHelpers::SuccessResponse('', $galeri, 200);
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
                'nama' => 'required|string|max:255|min:4',
                'title' => 'nullable|string|max:255|min:4',
                'deskripsi' => 'required|max:2000',
                'tahun' => 'nullable|numeric|digits:4',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:1000',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            if ($id == $request->id) {
                $record = KurikulumPrestasi::where('id', $id)
                    ->where('jenis_info', 'kurikulum')
                    ->where('row_status', '0')
                    ->firstOrFail();

                if ($request->hasFile('gambar')) {
                    Storage::delete('public/kurikulum_prestasi/' . $record->gambar);
                    $file = $request->file('gambar');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('public/kurikulum_prestasi/', $fileName);
                    $fileImage = basename($path);
                    $record->gambar = $fileImage;
                }

                $record->title = $request->title;
                $record->nama = $request->nama;
                $record->tahun = $request->tahun;
                $record->deskripsi = $request->deskripsi;

                GeneralHelpers::setUpdatedAt($record);

                $record->save();

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
            $record = KurikulumPrestasi::where('id', $id)
                ->where('jenis_info', 'kurikulum')
                ->where('row_status', '0')
                ->firstOrFail();
            $image_exists = Storage::exists('public/kurikulum_prestasi/' . $record->gambar);
            if ($image_exists) {
                Storage::delete('public/kurikulum_prestasi/' . $record->gambar);
            }
            GeneralHelpers::setRowStatusInActive($record);
            $record->save();
            return ResponseHelpers::SuccessResponse('Your Record has been deleted', '', 200);
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }
}
