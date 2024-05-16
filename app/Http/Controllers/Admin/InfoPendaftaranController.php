<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\ConfigTable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelpers;
use App\Models\InfoPendaftaran;
use App\Helpers\ResponseHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class InfoPendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_info = $request->query('search_info');

        $query = InfoPendaftaran::where('row_status', '0')->orderBy('id', 'desc');

        if (!empty($search_info)) {
            $query->where('deskripsi', 'like', '%' . $search_info . '%');
        }

        $info_pendaftaran = $query->paginate(5)->onEachSide(2)->fragment('info_pendaftaran');

        $key_id = ConfigTable::where('key', 'gelombang')
            ->where('row_status', 0)->first();

        return view('AdminView.InfoPendaftaran.index', compact('info_pendaftaran', 'search_info', 'key_id'));
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
                'gelombang' => ['required', 'in:I,II,III,IV,V', function ($attribute, $value, $fail) use ($request) {
                    $existingGelombang = InfoPendaftaran::where('gelombang', $value)->exists();
                    if ($existingGelombang) {
                        $fail('The ' . $attribute . ' has already been taken.');
                    }
                }],
                'status' => 'required|in:active,inactive',
                'deskripsi' => 'nullable|max:100',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {

            $data = new InfoPendaftaran();

            $kode_random = GeneralHelpers::generateRandomText(20);
            $data->kode_gelombang = $kode_random;
            $data->gelombang = $request->gelombang;
            $data->status = $request->status;
            $data->deskripsi = $request->deskripsi;

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
            $data = InfoPendaftaran::where('id', $id)
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
                'status' => 'required|in:active,inactive',
                'deskripsi' => 'nullable|max:100',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            if ($id == $request->id) {
                $data = InfoPendaftaran::where('id', $id)
                    ->where('row_status', '0')
                    ->firstOrFail();

                $data->status = $request->status;
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
        //
    }

    public function getInfo()
    {
        $data = InfoPendaftaran::where('row_status', '0')
            ->where('status', 'active')
            ->orderBy('id', 'desc')
            ->get();
        return ResponseHelpers::SuccessResponse('', $data, 200);
    }
}
