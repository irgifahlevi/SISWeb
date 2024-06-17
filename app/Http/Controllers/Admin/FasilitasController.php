<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_fasilitas = $request->query('search_fasilitas');

        // Mulai dengan kueri dasar untuk mendapatkan semua akun siswa
        $query = Fasilitas::where('row_status', '0')->orderBy('id', 'desc');

        // Jika ada pencarian, tambahkan filter pencarian ke kueri
        if (!empty($search_fasilitas)) {
            $query->where('nama_fasilitas', 'like', '%' . $search_fasilitas . '%');
        }

        // Ambil data dengan paginasi
        $fasilitas = $query->paginate(5)->onEachSide(2)->fragment('fasilitas_content');

        return view('AdminView.Fasilitas.index', compact('fasilitas', 'search_fasilitas'));
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
                'nama_fasilitas' => 'required|string|max:255|min:4',
                'deskripsi' => 'nullable|max:2000',
                'gambar' => 'required|image|mimes:jpeg,png|max:1000',
            ]
        );
        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            $image = $request->file('gambar');
            $imageName = time() . '.' .
                $image->getClientOriginalExtension();
            $path = $image->storeAs('public/fasilitas', $imageName);
            $imagePath = basename($path);

            $fasilitas = new  Fasilitas();
            $fasilitas->nama_fasilitas = $request->nama_fasilitas;
            $fasilitas->deskripsi = $request->deskripsi;
            $fasilitas->gambar = $imagePath;

            GeneralHelpers::setCreatedAt($fasilitas);
            GeneralHelpers::setCreatedBy($fasilitas);
            GeneralHelpers::setUpdatedAtNull($fasilitas);
            GeneralHelpers::setRowStatusActive($fasilitas);

            $fasilitas->save();

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
            $fasilitas = Fasilitas::where('id', $id)->where('row_status', '0')->firstOrFail();
            return ResponseHelpers::SuccessResponse('', $fasilitas, 200);
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
                'nama_fasilitas' => 'required|string|max:255|min:4',
                'deskripsi' => 'nullable|max:2000',
                'gambar' => 'nullable|image|mimes:jpeg,png|max:1000',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            if ($id == $request->id) {
                $fasilitas = Fasilitas::where('id', $id)
                    ->where('row_status', '0')
                    ->firstOrFail();

                if ($request->hasFile('gambar')) {
                    Storage::delete('public/fasilitas/' . $fasilitas->gambar);
                    $file = $request->file('gambar');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('public/fasilitas/', $fileName);
                    $fileImage = basename($path);
                    $fasilitas->gambar = $fileImage;
                }

                $fasilitas->nama_fasilitas = $request->nama_fasilitas;
                $fasilitas->deskripsi = $request->deskripsi;
                GeneralHelpers::setUpdatedAt($fasilitas);

                $fasilitas->save();

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
            $fasilitas =  Fasilitas::where('id', $id)->where('row_Status', '0')->firstOrFail();
            $image_exists = Storage::exists('public/fasilitas/' . $fasilitas->gambar);
            if ($image_exists) {
                Storage::delete('public/fasilitas/' . $fasilitas->gambar);
            }
            GeneralHelpers::setRowStatusInActive($fasilitas);
            $fasilitas->save();
            return ResponseHelpers::SuccessResponse('Your Record has been deleted', '', 200);
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }
}
