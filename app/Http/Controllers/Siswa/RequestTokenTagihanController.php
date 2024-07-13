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
            if ($type !== 'tagihan_siswa') {
                return ResponseHelpers::ErrorResponse('Invalid request type', 500);
            }

            $data = TagihanSiswa::select('id', 'no_tagihan', 'kode_tagihan', 'status', 'nominal_tagihan', 'created_at')
                ->findOrFail($id);

            // check data
            foreach ($data->getAttributes() as $key => $value) {
                if (is_null($value) || empty($value)) {
                    return ResponseHelpers::ErrorResponse('Invalid request generate token, data has been not valid!', 500);
                }
            }

            if ($this->isCancellableStatus($data->status)) {
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

    // private function
    private function isCancellableStatus($status)
    {
        return in_array($status, ['belum_dibayar', 'dibatalkan', 'Failed', 'Expired']);
    }
}
