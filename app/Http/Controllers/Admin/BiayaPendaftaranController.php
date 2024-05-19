<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelpers;
use App\Models\InfoPendaftaran;
use App\Helpers\ResponseHelpers;
use App\Models\BiayaPendaftaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BiayaPendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search_biaya = $request->query('search_biaya');

        $query = BiayaPendaftaran::where('row_status', 0)
            ->whereHas('InfoPendaftarans', function ($query) {
                $query->where('row_status', 0);
            });

        if (!empty($search_biaya)) {
            $query->where('nama_biaya', 'like', '%' . $search_biaya . '%');
        }

        $biaya_pendaftaran = $query->paginate(5)->onEachSide(2)->fragment('list_biaya_content');

        return view('AdminView.InfoBiaya.index', compact('biaya_pendaftaran', 'search_biaya'));
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
        $request->merge(['nominal_biaya' => str_replace('.', '', $request->nominal_biaya)]);

        // Validasi input
        $validator = Validator::make(
            $request->all(),
            [
                'nama_biaya' => 'required|max:100',
                'nominal_biaya' => 'required|numeric',
                'info_pendaftaran_id' => 'required|exists:info_pendaftarans,id',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {

            $data = new BiayaPendaftaran();

            $kode_random = GeneralHelpers::generateRandomText(20);
            $data->kode_biaya = $kode_random;
            $data->nama_biaya = $request->nama_biaya;
            $data->nominal_biaya = $request->nominal_biaya;
            $data->info_pendaftaran_id = $request->info_pendaftaran_id;

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
            $data = BiayaPendaftaran::where('id', $id)
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
        $request->merge(['nominal_biaya' => str_replace('.', '', $request->nominal_biaya)]);
        $validator = Validator::make(
            $request->all(),
            [
                'nama_biaya' => 'required|max:100',
                'nominal_biaya' => 'required|numeric',
                'info_pendaftaran_id' => 'required|exists:info_pendaftarans,id',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            if ($id == $request->id) {
                $data = BiayaPendaftaran::where('id', $id)
                    ->where('row_status', '0')
                    ->firstOrFail();

                $data->nama_biaya = $request->nama_biaya;
                $data->nominal_biaya = $request->nominal_biaya;
                $data->info_pendaftaran_id = $request->info_pendaftaran_id;
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
            $ekskul = BiayaPendaftaran::where('id', $id)
                ->where('row_status', '0')
                ->firstOrFail();
            GeneralHelpers::setRowStatusInActive($ekskul);
            $ekskul->save();
            return ResponseHelpers::SuccessResponse('Your record has been deleted', '', 200);
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }
}
