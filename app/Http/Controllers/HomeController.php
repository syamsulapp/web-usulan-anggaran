<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\ProfileModels;
use App\Models\StatusUsulanModels;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $user;

    protected $profileModels;

    protected $statusUsulanModels;

    protected $lembaga;

    public function __construct(User $user, ProfileModels $profileModels, StatusUsulanModels $statusUsulanModels, Lembaga $lembaga)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->profileModels = $profileModels;
        $this->statusUsulanModels = $statusUsulanModels;
        $this->lembaga = $lembaga;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if ($photo = $this->profileModels->whereid_users($this->user->user()->id)->first()) {
            $photos = $photo;
        } else {
            $photos = [
                'photos' => 'no_image',
                'nama_lengkap' => 'belum ada nama lengkap'
            ];
        }

        $usersCount = $this->user->get()->count(); //count users 

        $statusUsulanCount = $this->statusUsulanModels->get()->count(); //count status usulan

        $usersCountVerify = $this->user->whereis_active('Y')->count();

        $lembaga = $this->lembaga->get()->count();

        return view('home', compact('photos', 'usersCount', 'statusUsulanCount', 'usersCountVerify', 'lembaga'));
    }
}
