<?php

namespace App\Http\Controllers\Auth;

use App\MasterUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/home';

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
            'karyawan_fullname' => ['required', 'string', 'max:255'],
            'karyawan_username' => ['required', 'string', 'max:255', 'unique:master_karyawan'],
            'karyawan_email'    => ['required', 'string', 'email', 'max:255', 'unique:master_karyawan'],
            'karyawan_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return MasterUser::create([
            'karyawan_fullname' => $data['karyawan_fullname'],
            'karyawan_username' => $data['karyawan_username'],
            'karyawan_email'    => $data['karyawan_email'],
            'karyawan_password' => Hash::make($data['karyawan_password']),
        ]);
    }
}
