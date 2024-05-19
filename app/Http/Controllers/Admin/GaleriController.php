<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use App\Http\Controllers\Controller;
use App\Models\Galleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_galeri = $request->query('search_galeri');

        // Mulai dengan kueri dasar untuk mendapatkan semua akun siswa
        $query = Galleri::where('row_status', '0')->orderBy('id', 'desc');

        // Jika ada pencarian, tambahkan filter pencarian ke kueri
        if (!empty($search_galeri)) {
            $query->where('title', 'like', '%' . $search_galeri . '%');
        }

        // Ambil data dengan paginasi
        $galeri = $query->paginate(5)->onEachSide(2)->fragment('galeri_content');

        return view('AdminView.GaleriContent.index', compact('galeri', 'search_galeri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_kegiatan' => 'required|string|max:255|min:4',
                'title' => 'required|string|max:255|min:4',
                'deskripsi' => 'nullable|max:500',
                'gambar' => 'required|image|mimes:jpeg,png|max:500',
            ]
            );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(),400);
        }

        try {
            $image = $request->file('gambar');
            $imageName = time() . '.' .
            $image->getClientOriginalExtension();
            $path = $image->storeAs('public/galeri', $imageName);
            $imagePath = basename($path);

            $galeri = new  Galleri();
            $galeri->nama_kegiatan = $request->nama_kegiatan;
            $galeri->title = $request->title;
            $galeri->deskripsi = $request->deskripsi;
            $galeri->gambar = $imagePath;

            GeneralHelpers::setCreatedAt($galeri);
            GeneralHelpers::setCreatedBy($galeri);
            GeneralHelpers::setUpdatedAtNull($galeri);
            GeneralHelpers::setRowStatusActive($galeri);

            $galeri->save();

            return ResponseHelpers::SuccessResponse('Data berhasil ditambahkan', '' , 200);
        } catch(Exception $e){
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $galeri = Galleri::where('id', $id)->where('row_status', '0')->firstOrFail();
            return ResponseHelpers::SuccessResponse('', $galeri, 200);
        } catch(Exception $th){
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
                'nama_kegiatan' => 'required|string|max:255|min:4',
                'title' => 'required|string|max:255|min:4',
                'deskripsi' => 'nullable|max:500',
                'gambar' => 'nullable|image|mimes:jpeg,png|max:500',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            if ($id == $request->id) {
                $galeri = Galleri::where('id', $id)
                    ->where('row_status', '0')
                    ->firstOrFail();

                if ($request->hasFile('gambar')) {
                    Storage::delete('public/galeri/' . $galeri->gambar);
                    $file = $request->file('gambar');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('public/galeri/', $fileName);
                    $fileImage = basename($path);
                    $galeri->gambar = $fileImage;
                }

                $galeri->title = $request->title;
                $galeri->deskripsi = $request->deskripsi;
                GeneralHelpers::setUpdatedAt($galeri);

                $galeri->save();

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
        try{
            $galeri =  Galleri::where('id', $id)->where('row_Status', '0')->firstOrFail();
            $image_exists = Storage::exists('public/galeri/' .$galeri->gambar);
            if ($image_exists){
                Storage::delete('public/galeri/'.$galeri->gambar);
            }
            GeneralHelpers::setRowStatusInActive($galeri);
            $galeri->save();
            return ResponseHelpers::SuccessResponse('Your Record has been deleted', '', 200);
        } catch(Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }
}
