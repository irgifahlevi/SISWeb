<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\RegisterEmail;
use Illuminate\Support\Str;
use App\Models\RegisterUser;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelpers;
use App\Helpers\ResponseHelpers;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
        try {
            $data = RegisterUser::findOrFail($id);
            if ($data->status == 'pending') {
                DB::transaction(function () use ($data, $status) {
                    $data->status = $status;
                    $data->updated_at = Carbon::now();
                    $data->save();

                    // generate random password
                    $random_pass = Str::random(8);
                    $user = new User();

                    $user->username = $data->username;
                    $user->email = $data->email;
                    $user->password = Hash::make($random_pass);
                    GeneralHelpers::setCreatedBy($user);
                    GeneralHelpers::setCreatedAt($user);
                    GeneralHelpers::setUpdatedAtNull($user);
                    GeneralHelpers::setRowStatusActive($user);
                    GeneralHelpers::setRoleWali($user);

                    $user->save();

                    $mail_data = [
                        'to' => $user->username,
                        'email' => $user->email,
                        'password' => $random_pass,
                    ];

                    Mail::to($user->email)->send(new RegisterEmail($mail_data));
                });

                // method 3 parameter
                $response = ResponseHelpers::SuccessResponse('Your record has been updated', '', 200);
                return $response;
            } else {
                $errorMessage = $data->status == $status ? 'Confirmation has been done, it cannot be updated again!' : 'The status has been updated, it cannot be updated again!';
                return ResponseHelpers::ErrorResponse($errorMessage, 500);
            }
        } catch (Exception $th) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later!', 500);
        }
    }

    public function accountSiswa(Request $request)
    {
        $search_account_siswa = $request->query('search_account_siswa');

        // Mulai dengan kueri dasar untuk mendapatkan semua akun siswa
        $query = User::where('role', 'siswa')->orderBy('id', 'desc');

        // Jika ada pencarian, tambahkan filter pencarian ke kueri
        if (!empty($search_account_siswa)) {
            $query->where('username', 'like', '%' . $search_account_siswa . '%');
        }

        // Ambil data dengan paginasi
        $account_siswa = $query->with('SiswaUser')->paginate(10)->onEachSide(2)->fragment('siswa_account');

        return view('AdminView.AccountSiswa.index', compact('account_siswa', 'search_account_siswa'));
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
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
        }

        try {
            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            GeneralHelpers::setCreatedBy($user);
            GeneralHelpers::setCreatedAt($user);
            GeneralHelpers::setUpdatedAtNull($user);
            GeneralHelpers::setRowStatusActive($user);
            GeneralHelpers::setRoleSiswa($user);

            $user->save();

            return ResponseHelpers::SuccessResponse('Your record has been created', '', 200);
        } catch (Exception $e) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }

    public function accountShow($id)
    {
        try {
            $user = User::where('id', $id)
                ->where('role', 'siswa')
                ->firstOrFail();
            return ResponseHelpers::SuccessResponse('', $user, 200);
        } catch (Exception $e) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
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
            return ResponseHelpers::ErrorResponse($validator->messages(), 400);
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

                return ResponseHelpers::SuccessResponse('Your record has been updated', '', 200);
            } else {
                return ResponseHelpers::ErrorResponse('Invalid status or no changes made', 500);
            }
        } catch (\Exception $ex) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
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

                return ResponseHelpers::SuccessResponse('Your record has been updated', '', 200);
            } else {
                return ResponseHelpers::ErrorResponse('The status has been updated, it cannot be updated again!', 500);
            }
        } catch (Exception $ex) {
            return ResponseHelpers::ErrorResponse('Internal server error, try again later', 500);
        }
    }
}
