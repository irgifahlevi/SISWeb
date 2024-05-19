<?php

namespace App\Http\Controllers\Admin;
use Exception;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SejarahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_sejarah = $request->query('search_sejarah');

        // mulai dengan kueri dasar untuk mendapatkan semua akun siswa
        $query = Sejarah::where('row_status','0')->orderBy('id', 'desc');

        // // jika ada penacrian, tambahkan filter ke kueri
        // if(!empty($search_sejarah)){
        //     $query->where('title', 'like', '%' . $search_sejarah . '%');
        // }
        // ambil data dengan paginasi
        $sejarah = $query->paginate(5)->onEachSide(2)->fragment('sejarah');

        return view('AdminView.sejarah.index', compact('sejarah', 'search_sejarah'));

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
                'title'=> 'required|string|max:255|min:4',
                'deskripsi'=> 'nullable|max:500',
                'gambar'=> 'required|image|mimes:jpeg,png|max:1000',
            ]
            );

            if($validator->fails()){
                return ResponseHelpers::ErrorResponse($validator->messages(), 400);
            }

            try{
                $image = $request->file('gambar');
                $imageName = time(). '.'.
                $image->getClientOriginalExtension();
                $path = $image->storeAs('public/sejarah', $imageName);
                $imagePath =  basename($path);

                $sejarah = new Sejarah();
                $sejarah -> title = $request->title;
                $sejarah -> deskripsi = $request->deskripsi;
                $sejarah -> gambar = $imagePath;

                GeneralHelpers::setCreatedAt($sejarah);
                GeneralHelpers::setCreatedBy($sejarah);
                GeneralHelpers::setUpdatedAtNull($sejarah);
                GeneralHelpers::setRowStatusActive($sejarah);

                $sejarah->save();

                return ResponseHelpers::SuccessResponse('Data berhasil ditambahkan', ' ' , 200);
            } catch(Exception $e){
                return ResponseHelpers::ErrorResponse('Internal serve error, try again later', 500);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $sejarah = Sejarah::where('id', $id)->where('row_status', '0')->firstOrFail();
            return ResponseHelpers::SuccessResponse('', $sejarah, 200);
        }catch(Exception $th){
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
                'title'=> 'required|string|max:255|min:4',
                'deskripsi'=> 'nullable|max:500',
                'gambar'=> 'required|image|mimes:jpeg,png|max:1000',
            ]
            );

            if($validator->fails()){
                return ResponseHElpers::ErrorResponse($validator->messages(), 400);
            }

            try{
                if($id == $request->id){
                    $sejarah = Sejarah::where('id', $id)->where('row_status', '0')->firstOrFail();

                    if($request->hasFile('gambar')){
                        Storage::delete('public/sejarah/'.$sejarah->gambar);
                        $file = $request->file('gambar');
                        $fileName = time(). '.' .
                        $file->getClientOriginalExtension();
                        $path = $file->storeAs('public/sejarah', $fileName);
                        $fileImage = basename($path);
                        $sejarah->gambar = $fileImage;
                    }

                    $sejarah->title = $request->title;
                    $sejarah->deskripsi = $request->deskripsi;
                    GeneralHelpers::setUpdatedAt($sejarah);

                    $sejarah->save();

                    return ResponseHelpers::SuccessResponse('Your record has bee Updated', '', 200);
                } else{
                    return ResponseHelpers::ErrorResponse('Internal Server error, try again later', 500);
                }
            } catch (Exception $th){
                return ResponseHelpers::ErrorResponse('Internal server Error, try again later', 500);
            }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $sejarah = Sejarah::where('id', $id)->where('row_status', '0')->firstOrFail();
            $image_exists = Storage::exists('public/sejarah/' . $sejarah->gambar);
            if($image_exists){
                Storage::deleted('public/sejarah'. $sejarah->gambar);
            }
            GeneralHelpers::setRowStatusInActive($sejarah);
            $sejarah->save();
            return ResponseHelpers::SuccessResponse('Your record has been deleted', '', 200);
        } catch(Exception $th){
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }
}
