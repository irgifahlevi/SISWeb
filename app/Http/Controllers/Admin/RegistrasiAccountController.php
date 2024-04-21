<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\RegisterUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;
use PhpParser\Node\Stmt\TryCatch;

class RegistrasiAccountController extends Controller
{
    public function index(Request $request)
    {
        $query = RegisterUser::orderBy('id', 'desc');

        $search_pendaftar_account = $request->query('search_pendaftar_account');
        if (!empty($search_pendaftar_account)) {
            $query->where('username', 'like', '%' . $search_pendaftar_account . '%');
        }

        $pendaftar_account = $query->paginate(5)->onEachSide(2)->fragment('pendaftar_account');

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

    public function accountSiswa(Request $request)
    {
        $search_pendaftar_account = $request->query('search_pendaftar_account');

        // Mulai dengan kueri dasar untuk mendapatkan semua akun siswa
        $query = User::where('role', 'siswa')->orderBy('id', 'desc');

        // Jika ada pencarian, tambahkan filter pencarian ke kueri
        if (!empty($search_pendaftar_account)) {
            $query->where('username', 'like', '%' . $search_pendaftar_account . '%');
        }

        // Ambil data dengan paginasi
        $account_siswa = $query->paginate(5)->onEachSide(2)->fragment('siswa_account');

        return view('AdminView.AccountSiswa.index', compact('account_siswa', 'search_pendaftar_account'));
    }

    public function saveRegister(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required|string|max:255|min:3',
                'email' => 'required|email:rfc,dns|max:255|unique:users',
                'password' => 'required|min:8|string'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ], 400);
        }

        try {
            $user = new User();
            $active = 0;
            $siswa = 'siswa';
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->created_by = Auth::user()->username;
            $user->row_status = $active;
            $user->role = $siswa;

            $user->save();
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e
            ], 500);
        }


        return response()->json([
            'status' => 200,
            'message' => 'Your record has been created'
        ], 201);
    }

    public function accountShow($id)
    {
        try {
            $user = User::where('id', $id)
                ->where('role', 'siswa')
                ->firstOrFail();

            return response()->json([
                'status' => 200,
                'data' => $user
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
            ], 500);
        }
    }

    public function updateAccount(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required|string|max:255',
                'password' => 'nullable|min:8|string'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ], 400);
        }

        try {
            $user = User::where('id', $request->id)
                ->where('role', 'siswa')
                ->firstOrFail();
            if ($user->row_status == '0') {
                if ($request->password != null) {
                    $user->password = Hash::make($request->password);
                }
                $user->username = $request->username;
                $user->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Your record has been updated'
                ], 201);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Invalid status or no changes made'
                ], 500);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
            ], 500);
        }
    }

    public function updateStatusAccount($id, $status)
    {
        try {
            $user = User::where('id', $id)
                ->where('role', 'siswa')
                ->firstOrFail();
            if (($status == '0' || $status == '-1') && $user->row_status != $status) {
                $user->row_status = $status;
                $user->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Your record has been updated'
                ], 201);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Invalid status or no changes made'
                ], 500);
            }
        } catch (Exception $ex) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error!'
            ], 500);
        }
    }
}
