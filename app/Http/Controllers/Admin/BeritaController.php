<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Berita;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_berita = $request->query('search_berita');

        // Mulai dengan kueri dasar untuk mendapatkan semua akun siswa
        $query = Berita::where('row_status', '0')->orderBy('id', 'desc');

        // Jika ada pencarian, tambahkan filter pencarian ke kueri
        if (!empty($search_berita)) {
            $query->where('title', 'like', '%' . $search_berita . '%');
        }

        // Ambil data dengan paginasi
        $berita = $query->paginate(5)->onEachSide(2)->fragment('berita_content');

        return view('AdminView.BeritaContent.index', compact('berita', 'search_berita'));
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
                'judul' => 'required|string|max:255|min:4',
                'title' => 'required|string|max:255|min:4',
                'kategori' => 'required|in:Kegiatan sekolah,Lomba,Event Workshop,Pensi',
                'deskripsi' => 'required|max:2000',
                'gambar' => 'required|image|mimes:jpeg,png|max:500',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {

            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/berita', $imageName);
            $imagePath = basename($path);

            $data = new Berita();
            $data->judul = $request->judul;
            $data->title = $request->title;
            $data->kategori = $request->kategori;
            $data->deskripsi = $request->deskripsi;
            $data->gambar = $imagePath;

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
            $data = Berita::where('id', $id)
                ->where('row_status', '0')
                ->firstOrFail();
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
        $validator = Validator::make(
            $request->all(),
            [
                'judul' => 'required|string|max:255|min:4',
                'title' => 'required|string|max:255|min:4',
                'kategori' => 'required|in:Kegiatan sekolah,Lomba,Event Workshop,Pensi',
                'deskripsi' => 'required|max:2000',
                'gambar' => 'nullable|image|mimes:jpeg,png|max:500',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            if ($id == $request->id) {
                $data = Berita::where('id', $id)
                    ->where('row_status', '0')
                    ->firstOrFail();

                if ($request->hasFile('gambar')) {
                    Storage::delete('public/berita/' . $data->gambar);
                    $file = $request->file('gambar');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('public/berita/', $fileName);
                    $fileImage = basename($path);
                    $data->gambar = $fileImage;
                }

                $data->judul = $request->judul;
                $data->title = $request->title;
                $data->kategori = $request->kategori;
                $data->deskripsi = $request->deskripsi;
                GeneralHelpers::setUpdatedAt($data);

                $data->save();

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
            $data = Berita::where('id', $id)
                ->where('row_status', '0')
                ->firstOrFail();
            $image_exists = Storage::exists('public/berita/' . $data->gambar);
            if ($image_exists) {
                Storage::delete('public/berita/' . $data->gambar);
            }
            GeneralHelpers::setRowStatusInActive($data);
            $data->save();
            return ResponseHelpers::SuccessResponse('Your record has been deleted', '', 200);
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }
}
