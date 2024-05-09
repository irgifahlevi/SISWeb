<?php

namespace App\Http\Controllers\WaliCalonSiswa;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\WaliCalonSiswa;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use App\Models\BiayaPendaftaran;
use App\Http\Controllers\Controller;
use App\Models\ConfigTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class WaliCalonSiswaController extends Controller
{
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Mendapatkan config pendaftaran
        $config = ConfigTable::where('key', 'gelombang')
            ->where('row_status', 0)->first();

        // Mengambil satu data wali calon siswa berdasarkan ID pengguna yang sedang login
        $data = WaliCalonSiswa::whereHas('Users', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->first();

        $list_biaya = BiayaPendaftaran::where('row_status', 0)
            ->whereHas('InfoPendaftarans', function ($query) use ($config) {
                $query->where('gelombang', $config->query_code);
                $query->where('row_status', 0);
            })->get();

        // Cek apakah ada data yang dimuat
        if ($list_biaya->isNotEmpty() && $list_biaya->first()->InfoPendaftarans) {
            // Mengambil ID dari InfoPendaftarans pada data pertama
            $info_pendaftaran_id = $list_biaya->first()->InfoPendaftarans->id;
        } else {
            // Jika tidak ada data yang sesuai, atur $info_pendaftaran_id menjadi null
            $info_pendaftaran_id = null;
        }
        return view('WaliCalonView.index', compact('data', 'list_biaya', 'info_pendaftaran_id'));
    }

    public function updatePassword(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'password' => 'required|string|min:8|confirmed',
            ]
        );

        if ($validator->fails()) {
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            if ($id == $request->id && $request->id == Auth::id()) {

                $user = User::where('id', $request->id)
                    ->where('row_status', '0')
                    ->firstOrFail();

                $user->password = Hash::make($request->password);
                GeneralHelpers::setUpdatedAt($user);
                $user->save();

                return ResponseHelpers::SuccessResponse('Data berhasil ditambahkan', '', 200);
            } else {
                return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
            }
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }
}
