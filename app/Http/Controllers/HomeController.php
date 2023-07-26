<?php

namespace App\Http\Controllers;

use App\Models\ProfileModels;
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

    public function __construct(User $user, ProfileModels $profileModels)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->profileModels = $profileModels;
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
        return view('home', compact('photos'));
    }
}
