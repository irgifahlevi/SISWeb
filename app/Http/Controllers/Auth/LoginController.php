<?php

namespace App\Http\Controllers\Auth;

use App\Models\RegisterUser;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
        Auth::logoutOtherDevices($request->password);

        if ($user->role == 'admin') {
            return redirect()->route('admin.index'); // redirect ke halaman beranda admin
        } elseif ($user->role == 'wali_calon' && $user->row_status == '0') {
            // Mencari user berdasarkan email
            $userData = RegisterUser::where('email', $request->email)->firstOrFail();
            if ($userData->login != 'yes') {
                $userData->login = 'yes';
                $userData->login_date = Carbon::now();
                $userData->save();
            }
            return redirect()->route('wali.index'); // redirect ke halaman beranda staff
        } elseif ($user->role == 'siswa' && $user->row_status == '0') {
            return redirect()->route('siswa.index');
        } else {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Invalid user, please try again later.');
        }
    }
}
