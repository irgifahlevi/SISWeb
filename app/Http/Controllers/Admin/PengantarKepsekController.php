<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengantarKepsek;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;

class PengantarKepsekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_data = $request->query('search_data');

        $query = PengantarKepsek::where('row_status', '0')->orderBy('id', 'desc');

        if (!empty($search_data)) {
            $query->where('title', 'like', '%' . $search_data . '%');
        }

        $pengantarKepsek = $query->paginate(5)->onEachSide(2)->fragment('PengantarKepsek');

        return view('AdminView.PengantarKepsek.index', compact('pengantarKepsek', 'search_data'));
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
                'title' => 'required|string|max:255|min:4',
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
            $path = $image->storeAs('public/pengantarKepsek', $imageName);
            $imagePath =  basename($path);

            $pengantarKepsek = new PengantarKepsek();
            $pengantarKepsek->title = $request->title;
            $pengantarKepsek->deskripsi = $request->deskripsi;
            $pengantarKepsek->gambar = $imagePath;

            GeneralHelpers::setCreatedAt($pengantarKepsek);
            GeneralHelpers::setCreatedBy($pengantarKepsek);
            GeneralHelpers::setUpdatedAtNull($pengantarKepsek);
            GeneralHelpers::setRowStatusActive($pengantarKepsek);

            $pengantarKepsek->save();

            return ResponseHelpers::SuccessResponse('Data berhasil ditambahkan', ' ', 200);
        } catch (Exception $e) {
            return ResponseHelpers::ErrorResponse('Internal serve error, try again later', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $pengantarKepsek = PengantarKepsek::where('id', $id)->where('row_status', '0')->firstOrFail();
            return ResponseHelpers::SuccessResponse('', $pengantarKepsek, 200);
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal Server Error, try again later', 500);
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
        $validator = validator::make(
            $request->all(),
            [
                'title' => 'required|string|max:255|min:4',
                'deskripsi' => 'nullable|max:2000',
                'gambar' => 'nullable|image|mimes:jpeg,png|max:1000',
            ]
        );

        if ($validator->fails()) {
            return ResponseHElpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            if ($id == $request->id) {
                $pengantarKepsek = PengantarKepsek::where('id', $id)->where('row_status', '0')->firstOrFail();

                if ($request->hasFile('gambar')) {
                    Storage::delete('public/pengantarKepsek/' . $pengantarKepsek->gambar);
                    $file = $request->file('gambar');
                    $fileName = time() . '.' .
                        $file->getClientOriginalExtension();
                    $path = $file->storeAs('public/pengantarKepsek', $fileName);
                    $fileImage = basename($path);
                    $pengantarKepsek->gambar = $fileImage;
                }

                $pengantarKepsek->title = $request->title;
                $pengantarKepsek->deskripsi = $request->deskripsi;
                GeneralHelpers::setUpdatedAt($pengantarKepsek);

                $pengantarKepsek->save();

                return ResponseHelpers::SuccessResponse('Your record has bee Updated', '', 200);
            } else {
                return ResponseHelpers::ErrorResponse('Internal Server error, try again later', 500);
            }
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server Error, try again later', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $pengantarKepsek = PengantarKepsek::where('id', $id)->where('row_status', '0')->firstOrFail();
            $image_exists = Storage::exists('public/pengantarKepsek/' . $pengantarKepsek->gambar);
            if ($image_exists) {
                Storage::delete('public/pengantarKepsek' . $pengantarKepsek->gambar);
            }
            GeneralHelpers::setRowStatusInActive($pengantarKepsek);
            $pengantarKepsek->save();
            return ResponseHelpers::SuccessResponse('Your record has been deleted', '', 200);
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }
}
