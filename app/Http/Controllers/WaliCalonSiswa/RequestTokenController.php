<?php

namespace App\Http\Controllers\WaliCalonSiswa;

use Exception;
use App\Models\Pendaftaran;
use App\Models\RequestToken;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RequestTokenController extends Controller
{
    public function store(string $id, string $type)
    {
        DB::beginTransaction();
        try {
            $data = Pendaftaran::findOrFail($id);
            if (($data->status = 'Failed' || $data->status = 'Expired') && $type = 'pendaftaran_siswa' && $data->status_seleksi != "tidak_lolos") {
                $new_request = new RequestToken();
                $new_request->pendaftaran_id = $data->id;
                $new_request->type = $type;
                $new_request->deskripsi = "Pembayaran pendaftaran calon siswa";

                $data->status = 'Waiting';

                GeneralHelpers::setCreatedAt($new_request);
                GeneralHelpers::setCreatedBy($new_request);
                GeneralHelpers::setUpdatedAtNull($new_request);
                GeneralHelpers::setRowStatusActive($new_request);

                $new_request->save();
                $data->save();

                DB::commit();
                return ResponseHelpers::SuccessResponse('Request has created', '', 200);
            } else {
                return ResponseHelpers::ErrorResponse('Internal server error, try again later!', 500);
            }
        } catch (Exception $th) {
            DB::rollBack();
            return ResponseHelpers::ErrorResponse('Internal server error, try again later!' . $th, 500);
        }
    }
}
