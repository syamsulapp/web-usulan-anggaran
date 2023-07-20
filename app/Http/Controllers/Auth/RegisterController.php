<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    protected $uploadFile;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $uploadFile)
    {
        $this->middleware('guest');
        $this->uploadFile = $uploadFile;
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
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'surat_keterangan' => ['required', 'file', 'mimes:pdf', 'max:2048'],
        ], [
            'required' => ':attribute jangan di kosongkan',
            'min' => 'minimal 8 karakter',
            'confirmed' => 'password tidak sama',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    protected function create(array $data)
    {

        $file = $this->uploadFile->file('surat_keterangan');

        $nama_file = time() . '-' . $file->getClientOriginalName();

        $tujuan_upload = 'surat_keterangan';

        $file->move($tujuan_upload, $nama_file);

        return User::create([
            'username' => $data['username'],
            'id_lembaga' => $data['lembaga'],
            'password' => Hash::make($data['password']),
            'surat_keterangan' => $nama_file,
            'id_role' => 3 // default users after registrasi
        ]);
    }
}
