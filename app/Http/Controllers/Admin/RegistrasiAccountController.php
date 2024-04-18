<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegisterUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegistrasiAccountController extends Controller
{
    public function index(Request $request)
    {
        $search_pendaftar_account = $request->query('search_pendaftar_account');

        if (!empty($search_pendaftar_account)) {
            $pendaftar_account = RegisterUser::orderBy('id', 'desc')
                ->where('register_users.username', 'like', '%' . $search_pendaftar_account . '%')
                ->paginate(5)->onEachSide(2)->fragment('pendaftar_account');
        } else {
            $pendaftar_account = RegisterUser::orderBy('id', 'desc')
                ->paginate(5)
                ->onEachSide(2)->fragment('pendaftar_account');
        }
        return view('AdminView.RegistrasiAccount.index', compact('search_pendaftar_account', 'pendaftar_account'));
    }

    public function updateStatus($id, $status)
    {
        $data = RegisterUser::findOrFail($id);
        if ($data->status == 'pending') {
            $data->status = $status;
            $data->updated_at = Carbon::now();
            $data->save();
            return response()->json([
                'status' => 200,
                'message' => 'Status berhasil diupdate'
            ], 200);
        }

        if ($data->status == $status) {
            return response()->json([
                'status' => 500,
                'message' => 'Konfirmasi sudah dilakukan, tidak dapat di update kembali!'
            ], 500);
        }

        return response()->json([
            'status' => 500,
            'message' => 'Status sudah di update, tidak dapat di update kembali!'
        ], 500);
    }
}
