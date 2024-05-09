<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\RegisterUser;
use Illuminate\Http\Request;
use App\Events\NewNotification;
use App\Helpers\GeneralHelpers;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->where(function ($query) use ($data) {
                    return $query->where('username', $data['username']);
                }),
                Rule::unique('register_users')->where(function ($query) use ($data) {
                    return $query->where('username', $data['username']);
                })
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->where(function ($query) use ($data) {
                    return $query->where('email', $data['email']);
                }),
                Rule::unique('register_users')->where(function ($query) use ($data) {
                    return $query->where('email', $data['email']);
                })
            ]
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\RegisterUser
     */

    protected function create(array $data)
    {
        return RegisterUser::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'created_by' => $data['username'],
            'created_at' => Carbon::now(),
            'status' => 'pending',
            'login' => 'no',
            'row_status' => 0
        ]);
    }

    public function register(Request $request)
    {
        try {
            $validator = $this->validator($request->all());
            $this->validator($request->all())->validate();
            $user = $this->create($request->all());
            $title = 'New User Waiting';
            $username = $user->username;
            $email = $user->email;
            GeneralHelpers::sendNewNotification($title, $username, $email);
            return redirect()->route('login')->with('message', 'Registrasi account berhasil diajukan, mohon tunggu beberapa menit');
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
}
