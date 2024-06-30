<?php

namespace App\Http\Controllers\Siswa;

use Exception;
use App\Models\RequestToken;
use App\Models\TagihanSiswa;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RequestTokenTagihanController extends Controller
{
    public function store(string $id, string $type)
    {
        DB::beginTransaction();
        try {
            $data = TagihanSiswa::findOrFail($id);
            if (($data->status = 'dibatalkan' || $data->status = 'Failed' || $data->status = 'Expired') && $type = 'tagihan_siswa') {
                $new_request = new RequestToken();
                $new_request->tagihan_siswa_id = $data->id;
                $new_request->type = $type;
                $new_request->deskripsi = "Pembayaran tagihan siswa";

                $data->status = 'waiting';

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
