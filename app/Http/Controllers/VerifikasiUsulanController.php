<?php

namespace App\Http\Controllers;

use App\Models\detail_rincian;
use App\Models\ProfileModels;
use App\Models\StatusUsulanModels;
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
        $usulanModels, $detail_rincian,
        $statusUsulanModels;

    public function __construct(
        VerifikasiUsulanModels $verifikasiUsulanModels,
        User $user,
        ProfileModels
        $profileModels,
        UsulanModels $usulanModels,
        detail_rincian $detail_rincian,
        StatusUsulanModels $statusUsulanModels
    ) {
        $this->verifikasiUsulanModels = $verifikasiUsulanModels;
        $this->user = $user;
        $this->profileModels = $profileModels;
        $this->usulanModels = $usulanModels;
        $this->detail_rincian = $detail_rincian;
        $this->statusUsulanModels = $statusUsulanModels;
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

        $queryProfle = $this->profileModels->whereid_users($verifikasiUsulanModels)->first();

        if (is_null($totalRincianUsulan)) { // kalo usersnya belum buat usulan maka redirect kembali ke halaman verifikasi usulan kasih flash message
            return redirect()->route('superadmin.verifikasi_usulan')->with('alertWarning', 'belum ada usulan yang dibuat');
        } else {
            $totalRincianUsulan = $totalRincianUsulan; // akan tetapi jika sudah buat usulan maka query data usulannya
        }

        return view('layouts.view.superadmin.list_usulan_users', compact('photos', 'listUsulanByUsers', 'totalRincianUsulan', 'queryProfle'));
    }

    public function verifyUsulanAnggaran($verifikasiUsulanModels, $nama_approve, $nama_users, $foto, Request $request)
    {
        //pengajuan di terima dan memberikan alasan
        try {
            $this->statusUsulanModels->create([
                'user_id' => $verifikasiUsulanModels,
                'status' => $request->status,
                'keterangan' => 'pengajuan' . ' ' . $nama_users . ' ' . 'diterima oleh pihak ' . ' ' . $nama_approve . ' ',
                'nama' => $nama_approve,
                'photo' => $foto,
            ]);
            return redirect()->route('superadmin.verifikasi_usulan')->with('success', 'pengajuan telah di verifikasi');
        } catch (\Exception $error) {
            return redirect()->route('superadmin.verifikasi_usulan')->with('error', $error);
        }
    }

    public function notVerifyUsulanAnggaran($verifikasiUsulanModels, $nama_approve, $nama_users, $foto, Request $request)
    {
        //pengajuan di reject dan memberikan alasan
        try {
            $this->statusUsulanModels->create([
                'user_id' => $verifikasiUsulanModels,
                'status' => $request->status,
                'keterangan' => 'pengajuan' . ' ' . $nama_users . ' ' . 'ditolak oleh ' . ' ' . $nama_approve . ' ' . 'karena:' . $request->keterangan,
                'nama' => $nama_approve,
                'photo' => $foto,
            ]);
            return redirect()->route('superadmin.verifikasi_usulan')->with('success', 'pengajuan telah di verifikasi');
        } catch (\Exception $error) {
            return redirect()->route('superadmin.verifikasi_usulan')->with('error', $error);
        }
    }

    public function cetakUsulan()
    {
        return 'cetak usulan';
    }
}
