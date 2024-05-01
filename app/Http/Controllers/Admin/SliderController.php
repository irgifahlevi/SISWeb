<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\SliderKonten;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_slider = $request->query('search_slider');

        // Mulai dengan kueri dasar untuk mendapatkan semua akun siswa
        $query = SliderKonten::where('row_status', '0')->orderBy('id', 'desc');

        // Jika ada pencarian, tambahkan filter pencarian ke kueri
        if (!empty($search_slider)) {
            $query->where('title', 'like', '%' . $search_slider . '%');
        }

        // Ambil data dengan paginasi
        $slider = $query->paginate(5)->onEachSide(2)->fragment('slider_content');

        return view('AdminView.SliderContent.index', compact('slider', 'search_slider'));
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
                'deskripsi' => 'nullable|max:500',
                'gambar' => 'required|image|mimes:jpeg,png|max:500',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {

            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/slider', $imageName);
            $imagePath = basename($path);

            $slider = new SliderKonten();
            $slider->title = $request->title;
            $slider->deskripsi = $request->deskripsi;
            $slider->gambar = $imagePath;

            GeneralHelpers::setCreatedAt($slider);
            GeneralHelpers::setCreatedBy($slider);
            GeneralHelpers::setUpdatedAtNull($slider);
            GeneralHelpers::setRowStatusActive($slider);

            $slider->save();

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
            $slider = SliderKonten::where('id', $id)
                ->where('row_status', '0')
                ->firstOrFail();
            return ResponseHelpers::SuccessResponse('', $slider, 200);
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
                $slider = SliderKonten::where('id', $id)
                    ->where('row_status', '0')
                    ->firstOrFail();

                if ($request->hasFile('gambar')) {
                    Storage::delete('public/slider/' . $slider->gambar);
                    $file = $request->file('gambar');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('public/slider/', $fileName);
                    $fileImage = basename($path);
                    $slider->gambar = $fileImage;
                }

                $slider->title = $request->title;
                $slider->deskripsi = $request->deskripsi;
                GeneralHelpers::setUpdatedAt($slider);

                $slider->save();

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
            $slider = SliderKonten::where('id', $id)
                ->where('row_status', '0')
                ->firstOrFail();
            $image_exists = Storage::exists('public/slider/' . $slider->gambar);
            if ($image_exists) {
                Storage::delete('public/slider/' . $slider->gambar);
            }
            GeneralHelpers::setRowStatusInActive($slider);
            $slider->save();
            return ResponseHelpers::SuccessResponse('Your record has been deleted', '', 200);
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }
}
