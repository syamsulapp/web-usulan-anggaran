<?php

namespace App\Http\Controllers;

use App\Models\detail_rincian;
use App\Models\ProfileModels;
use App\Models\User;
use App\Models\UsulanModels;
use App\Models\VerifikasiUsulanModels;
use Illuminate\Http\Request;

class VerifikasiUsulanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $verifikasiUsulanModels,
        $user, $profileModels,
        $usulanModels, $detail_rincian;

    public function __construct(
        VerifikasiUsulanModels $verifikasiUsulanModels,
        User $user,
        ProfileModels
        $profileModels,
        UsulanModels $usulanModels,
        detail_rincian $detail_rincian
    ) {
        $this->verifikasiUsulanModels = $verifikasiUsulanModels;
        $this->user = $user;
        $this->profileModels = $profileModels;
        $this->usulanModels = $usulanModels;
        $this->detail_rincian = $detail_rincian;
    }

    public function index()
    {
        $photos = $this->profileModels
            ->whereid_users($this->user->user()->id)
            ->first(); // detail photos and username by session users

        if (is_null($photos)) {
            $photos = [
                'photos' => 'photo belum ada',
                'nama_lengkap' => 'nama lengkap belum ada'
            ];
        }
        $verifikasiUsulan = $this->user->all();
        //list usulan by users
        return view('layouts.view.superadmin.verifikasi_usulan', compact('verifikasiUsulan', 'photos'));
    }

    public function show($verifikasiUsulanModels)
    {
        $photos = $this->profileModels
            ->whereid_users($this->user->user()->id)
            ->first(); // detail photos and username by session users

        if (is_null($photos)) {
            $photos = [
                'photos' => 'photo belum ada',
                'nama_lengkap' => 'nama lengkap belum ada'
            ];
        }

        $listUsulanByUsers = $this->usulanModels->whereuser_id($verifikasiUsulanModels)->get(); //query list usulan by users yang mengusul

        $totalRincianUsulan = $this->detail_rincian->whereuser_id($verifikasiUsulanModels)->first(); //get total dari list rincian

        return view('layouts.view.superadmin.list_usulan_users', compact('photos', 'listUsulanByUsers', 'totalRincianUsulan'));
    }

    public function verifyUsulanAnggaran($verifikasiUsulanModels, Request $request)
    {
        dd([
            'id' => $verifikasiUsulanModels,
            'request' => $request->status
        ]);
    }

    public function notVerifyUsulanAnggaran($verifikasiUsulanModels, Request $request)
    {
        dd([
            'id' => $verifikasiUsulanModels,
            'request' => $request->status
        ]);
    }
}
