<?php

namespace App\Http\Controllers;

use App\Models\ProfileModels;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $user;

    protected $profileModels;

    protected $role;

    public function __construct(User $user, ProfileModels $profileModels, Role $role)
    {
        $this->user = $user;
        $this->profileModels = $profileModels;
        $this->role = $role;
    }
    public function profile()
    {
        try {
            //query data profile and role sesuai dari session usersnya jika profilenya sudah ada
            if ($profile  = $this->profileModels->whereid_users($this->user->user()->id)->first()) {
                $data_profile = $profile;
            } else {
                // jika pertama kali register dan belum update profile maka kirim data ini
                $data_profile = [
                    'photos' => 'no_image',
                    'nama_lengkap' => 'nama lengkap belum ada',
                    'education' => 'no content edu',
                    'location' => 'no content location',
                    'skill' => 'no content skill',
                    'about_me' => 'no content about me',
                ];
            }
            $data_role = $this->role->whereId($this->user->user()->id_role)->first();
            return view('layouts.view.profile.profile', compact('data_profile', 'data_role'));
        } catch (\Exception $error) {
            return view('layouts.view.profile.profile')->with('alertError', $error);
        }

        return view('layouts.view.profile.profile', compact('data_profile'));
    }
    public function profileSubmit(Request $request)
    {
        $this->validate($request, [
            'password-confirmation' => 'same:password',
            'photos' => 'mimes:jpg,png,jpeg|max:2048|file|image',
        ], [
            'same' => 'password tidak sama'
        ]);

        if ($this->profileModels->whereid_users($this->user->user()->id)->first()) {
            //jika photos di kosongkan/tidak di isi maka tidak di upload fotonya
            if ($file = $request->file('photos')) {

                $nama_file = time() . '-' . $file->getClientOriginalName();

                $tujuan_upload = 'photo_profile';

                $file->move($tujuan_upload, $nama_file);

                if (
                    empty($request->password) &&
                    empty($request->username)
                ) {
                    // jika username dan password di kosongkan maka update username and password
                    // di table users tidak di jalankan atau fun update tidak di eksekusi
                    $this->profileModels->whereid_users($this->user->user()->id)->update([
                        'nama_lengkap' => $request->nama_lengkap,
                        'education' => $request->education,
                        'location' => $request->location,
                        'skill' => $request->skill,
                        'about_me' => $request->about_me,
                        'photos' => $nama_file,
                    ]);
                } else {
                    $this->user->whereId($this->user->user()->id)->update([
                        'username' => $request->username,
                        'password' => Hash::make($request->password),
                    ]);
                    $this->profileModels->whereid_users($this->user->user()->id)->update([
                        'nama_lengkap' => $request->nama_lengkap,
                        'education' => $request->education,
                        'location' => $request->location,
                        'skill' => $request->skill,
                        'about_me' => $request->about_me,
                        'photos' => $nama_file,
                    ]);
                }
            } else {
                $this->profileModels->whereid_users($this->user->user()->id)->update([
                    'nama_lengkap' => $request->nama_lengkap,
                    'education' => $request->education,
                    'location' => $request->location,
                    'skill' => $request->skill,
                    'about_me' => $request->about_me,
                ]);
            }
        } else {
            if ($file = $request->file('photos')) {

                $nama_file = time() . '-' . $file->getClientOriginalName();

                $tujuan_upload = 'photo_profile';

                $file->move($tujuan_upload, $nama_file);

                if (
                    empty($request->password) && //jika ingin mengubah username maka harus mengisi dengan passwordnya jg
                    empty($request->username)
                ) {
                    // jika username dan password di kosongkan maka update username and password
                    // di table users tidak di jalankan atau fun update tidak di eksekusi
                    $this->profileModels->create([
                        'nama_lengkap' => $request->nama_lengkap,
                        'education' => $request->education,
                        'location' => $request->location,
                        'skill' => $request->skill,
                        'about_me' => $request->about_me,
                        'photos' => $nama_file,
                        'id_users' => $this->user->user()->id,
                    ]);
                } else {
                    $this->user->whereId($this->user->user()->id)->update([
                        'username' => $request->username,
                        'password' => Hash::make($request->password),
                    ]);
                    $this->create([
                        'nama_lengkap' => $request->nama_lengkap,
                        'education' => $request->education,
                        'location' => $request->location,
                        'skill' => $request->skill,
                        'about_me' => $request->about_me,
                        'photos' => $nama_file,
                        'id_users' => $this->user->user()->id,
                    ]);
                }
            } else {
                $this->create([
                    'nama_lengkap' => $request->nama_lengkap,
                    'education' => $request->education,
                    'location' => $request->location,
                    'skill' => $request->skill,
                    'about_me' => $request->about_me,
                    'id_users' => $this->user->user()->id,
                ]);
            }
        }

        return redirect()->route('profile')->with('alert', 'Berhasil Ubah Profile');
    }
}
