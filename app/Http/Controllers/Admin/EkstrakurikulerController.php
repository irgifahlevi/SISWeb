<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelpers;
use App\Models\Ekstrakurikuler;
use App\Helpers\ResponseHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EkstrakurikulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_ekskul = $request->query('search_ekskul');

        // Mulai dengan kueri dasar untuk mendapatkan semua akun siswa
        $query = Ekstrakurikuler::where('row_status', '0')->orderBy('id', 'desc');

        // Jika ada pencarian, tambahkan filter pencarian ke kueri
        if (!empty($search_ekskul)) {
            $query->where('nama_kegiatan', 'like', '%' . $search_ekskul . '%');
        }

        // Ambil data dengan paginasi
        $ekskul = $query->paginate(5)->onEachSide(2)->fragment('ekskul_content');

        return view('AdminView.EkstrakurikulerContent.index', compact('ekskul', 'search_ekskul'));
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
                'nama_kegiatan' => 'required|string|max:255|min:4',
                'title' => 'required|string|max:255|min:4',
                'jenis' => 'required|in:Wajib,Pilihan sekolah,Mandiri',
                'deskripsi' => 'nullable|max:2000',
                'gambar' => 'nullable|image|mimes:jpeg,png|max:500',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {

            $ekskul = new Ekstrakurikuler();

            if ($request->hasFile('gambar')) {
                $image = $request->file('gambar');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/ekskul', $imageName);
                $imagePath = basename($path);
                $ekskul->gambar = $imagePath;
            }

            $ekskul->nama_kegiatan = $request->nama_kegiatan;
            $ekskul->title = $request->title;
            $ekskul->jenis = $request->jenis;
            $ekskul->deskripsi = $request->deskripsi;

            GeneralHelpers::setCreatedAt($ekskul);
            GeneralHelpers::setCreatedBy($ekskul);
            GeneralHelpers::setUpdatedAtNull($ekskul);
            GeneralHelpers::setRowStatusActive($ekskul);

            $ekskul->save();

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
            $ekskul = Ekstrakurikuler::where('id', $id)
                ->where('row_status', '0')
                ->firstOrFail();
            return ResponseHelpers::SuccessResponse('', $ekskul, 200);
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
                'nama_kegiatan' => 'required|string|max:255|min:4',
                'title' => 'required|string|max:255|min:4',
                'jenis' => 'required|in:Wajib,Pilihan sekolah,Mandiri',
                'deskripsi' => 'nullable|max:2000',
                'gambar' => 'nullable|image|mimes:jpeg,png|max:500',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            if ($id == $request->id) {
                $ekskul = Ekstrakurikuler::where('id', $id)
                    ->where('row_status', '0')
                    ->firstOrFail();

                if ($request->hasFile('gambar')) {
                    Storage::delete('public/ekskul/' . $ekskul->gambar);
                    $file = $request->file('gambar');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('public/ekskul/', $fileName);
                    $fileImage = basename($path);
                    $ekskul->gambar = $fileImage;
                }

                $ekskul->nama_kegiatan = $request->nama_kegiatan;
                $ekskul->title = $request->title;
                $ekskul->jenis = $request->jenis;
                $ekskul->deskripsi = $request->deskripsi;
                GeneralHelpers::setUpdatedAt($ekskul);

                $ekskul->save();

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
            $ekskul = Ekstrakurikuler::where('id', $id)
                ->where('row_status', '0')
                ->firstOrFail();
            $image_exists = Storage::exists('public/ekskul/' . $ekskul->gambar);
            if ($image_exists) {
                Storage::delete('public/ekskul/' . $ekskul->gambar);
            }
            GeneralHelpers::setRowStatusInActive($ekskul);
            $ekskul->save();
            return ResponseHelpers::SuccessResponse('Your record has been deleted', '', 200);
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }
}
