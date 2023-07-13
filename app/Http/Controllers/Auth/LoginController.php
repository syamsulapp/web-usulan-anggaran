<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        $role = auth()->user()->role;

        if ($role == 'superadmin') {
            return '/guest/dashboard'; // Ganti dengan rute yang sesuai untuk admin
        } elseif ($role == 'admin') {
            return '/admin/dashboard'; // Ganti dengan rute yang sesuai untuk pengguna
        } else {
            return '/user/dashboard'; // Ganti dengan rute yang sesuai untuk tamu
        }
    }

    public function username()
    {
        return 'username'; // Ubah 'username' sesuai dengan kolom yang ingin Anda gunakan sebagai username
    }
}
