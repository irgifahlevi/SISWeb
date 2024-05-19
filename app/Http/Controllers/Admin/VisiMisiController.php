<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use App\Http\Controllers\Controller;
use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VisiMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_visimisi = $request->query('search_visimisi');

        // Mulai dengan kueri dasar untuk mendapatkan semua akun siswa
        $query = VisiMisi::where('row_status', '0')->orderBy('id', 'desc');

        // Jika ada pencarian, tambahkan filter pencarian ke kueri
        if (!empty($search_visimisi)) {
            $query->where('nama_visimisi', 'like', '%' . $search_visimisi . '%');
        }

        // Ambil data dengan paginasi
        $visimisi = $query->paginate(5)->onEachSide(2)->fragment('visimisi_content');

        return view('AdminView.VisiMisi.index', compact('visimisi', 'search_visimisi'));
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
                'visi' => 'required|max:500|min:4',
                'misi' => 'required|max:500|min:4',
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
            $path = $image->storeAs('public/visimisi', $imageName);
            $imagePath = basename($path);

            $visimisi = new  VisiMisi();
            $visimisi->visi = $request->visi;
            $visimisi->misi = $request->misi;
            $visimisi->title = $request->title;
            $visimisi->deskripsi = $request->deskripsi;
            $visimisi->gambar = $imagePath;

            GeneralHelpers::setCreatedAt($visimisi);
            GeneralHelpers::setCreatedBy($visimisi);
            GeneralHelpers::setUpdatedAtNull($visimisi);
            GeneralHelpers::setRowStatusActive($visimisi);

            $visimisi->save();

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
            $visimisi = VisiMisi::where('id', $id)->where('row_status', '0')->firstOrFail();
            return ResponseHelpers::SuccessResponse('', $visimisi, 200);
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
                'visi' => 'required|max:500|min:4',
                'misi' => 'required|max:500|min:4',
                'title' => 'required|string|max:255|min:4',
                'deskripsi' => 'nullable|max:500',
                'gambar' => 'required|image|mimes:jpeg,png|max:500',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            if ($id == $request->id) {
                $visimisi = VisiMisi::where('id', $id)
                    ->where('row_status', '0')
                    ->firstOrFail();

                if ($request->hasFile('gambar')) {
                    Storage::delete('public/visimisi/' . $visimisi->gambar);
                    $file = $request->file('gambar');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('public/visimisi/', $fileName);
                    $fileImage = basename($path);
                    $visimisi->gambar = $fileImage;
                }

                $visimisi->visi = $request->visi;
                $visimisi->misi = $request->misi;
                $visimisi->title = $request->title;
                $visimisi->deskripsi = $request->deskripsi;
                GeneralHelpers::setUpdatedAt($visimisi);

                $visimisi->save();

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
            $visimisi =  VisiMisi::where('id', $id)->where('row_Status', '0')->firstOrFail();
            $image_exists = Storage::exists('public/visimisi/' .$visimisi->gambar);
            if ($image_exists){
                Storage::delete('public/visimisi/'.$visimisi->gambar);
            }
            GeneralHelpers::setRowStatusInActive($visimisi);
            $visimisi->save();
            return ResponseHelpers::SuccessResponse('Your Record has been deleted', '', 200);
        } catch(Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }
}
