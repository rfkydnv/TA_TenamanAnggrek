<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Mahasiswa;
use AppCoreHelper;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.m_login');
    }

    public function username(){
        $username = request()->get('karyawan_username');
        $fieldName = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'karyawan_email' : 'karyawan_username';
        request()->merge([$fieldName => $username]);
        return $fieldName;
    }

    protected function authenticated(Request $request, $user)
    {
        // Add Logic After Login Success
        // $request->session()->put('mahasiswa', Mahasiswa::All());
        $request->session()->put(AppCoreHelper::granted($user->karyawan_role_id));        
    }

    protected function credentials(Request $request)
    {

        $credentials = $request->only($this->username(), 'password');
        $credentials['karyawan_is_active'] = '1';

        return $credentials;
    }
}
