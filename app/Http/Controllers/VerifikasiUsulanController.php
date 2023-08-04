<?php

namespace App\Http\Controllers;

use App\Models\detail_rincian;
use App\Models\Lembaga;
use App\Models\ProfileModels;
use App\Models\Rincian;
use App\Models\Role;
use App\Models\StatusUsulanModels;
use App\Models\User;
use App\Models\UsulanModels;
use App\Models\VerifikasiUsulanModels;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF as PDF;


class VerifikasiUsulanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $verifikasiUsulanModels,
        $user, $profileModels,
        $usulanModels, $detail_rincian,
        $statusUsulanModels, $lembaga,
        $role, $rincian;

    public function __construct(
        VerifikasiUsulanModels $verifikasiUsulanModels,
        User $user,
        ProfileModels
        $profileModels,
        UsulanModels $usulanModels,
        detail_rincian $detail_rincian,
        StatusUsulanModels $statusUsulanModels,
        Lembaga $lembaga,
        Rincian $rincian,
        Role $role,
    ) {
        $this->verifikasiUsulanModels = $verifikasiUsulanModels;
        $this->user = $user;
        $this->profileModels = $profileModels;
        $this->usulanModels = $usulanModels;
        $this->detail_rincian = $detail_rincian;
        $this->statusUsulanModels = $statusUsulanModels;
        $this->lembaga = $lembaga;
        $this->role = $role;
        $this->rincian = $rincian;
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
        $foto = $this->profileModels
            ->whereid_users($this->user->user()->id)
            ->first(); // detail photos and username by session users

        if (is_null($foto)) {
            $photos = [
                'photos' => 'photo belum ada',
                'nama_lengkap' => 'nama lengkap belum ada'
            ];
        } else {
            $photos = $foto;
        }

        $listUsulanByUsers = $this->usulanModels->whereuser_id($verifikasiUsulanModels)->get(); //query list usulan by users yang mengusul

        $totalRincianUsulan = $this->detail_rincian->whereuser_id($verifikasiUsulanModels)->first(); //get total dari list rincian

        $queryProfle = $this->profileModels->whereid_users($verifikasiUsulanModels)->first();

        if (is_null($totalRincianUsulan)) { // kalo usersnya belum buat usulan maka redirect kembali ke halaman verifikasi usulan kasih flash message
            return redirect()->route('superadmin.verifikasi_usulan')->with('error', 'belum ada usulan yang dibuat');
        } else {
            $totalRincianUsulan = $totalRincianUsulan; // akan tetapi jika sudah buat usulan maka query data usulannya
        }

        return view('layouts.view.superadmin.list_usulan_users', compact('photos', 'listUsulanByUsers', 'totalRincianUsulan', 'queryProfle'));
    }

    public function verifyUsulanAnggaran(Request $request)
    {
        //pengajuan di terima dan memberikan alasan
        try {
            $this->statusUsulanModels->create([
                'user_id' => $request->user_id,
                'status' => $request->status,
                'keterangan' => 'pengajuan' . ' ' . $request->nama_users . ' ' . 'diterima oleh pihak ' . ' ' . $request->nama_approve . ' ',
                'nama' => $request->nama_approve,
                'photo' => $request->photo,
            ]);
            return redirect()->route('superadmin.verifikasi_usulan')->with('success', 'pengajuan telah di verifikasi');
        } catch (\Exception $error) {
            return redirect()->route('superadmin.verifikasi_usulan')->with('error', $error);
        }
    }

    public function notVerifyUsulanAnggaran(Request $request)
    {
        //pengajuan di reject dan memberikan alasan
        try {
            $this->statusUsulanModels->create([
                'user_id' => $request->user_id,
                'status' => $request->status,
                'keterangan' => 'pengajuan' . ' ' . $request->nama_users . ' ' . 'ditolak oleh ' . ' ' . $request->nama_approve . ' ' . 'karena:' . $request->keterangan,
                'nama' => $request->nama_approve,
                'photo' => $request->photo,
            ]);
            return redirect()->route('superadmin.verifikasi_usulan')->with('success', 'pengajuan telah di verifikasi');
        } catch (\Exception $error) {
            return redirect()->route('superadmin.verifikasi_usulan')->with('error', $error);
        }
    }

    //minjem method yang ada di controller superadmin buat cetak usulan by role admin
    public function cetakUsulan(Request $request)
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
        $lembaga = $this->lembaga->all();
        $role = $this->role->all();


        $limit = 10;
        if ($limit >= $request->limit) {
            $limit = $request->limit;
        }
        $users = $this->user
            ->orderByDesc('id')
            ->whereid_role(3)
            ->when($request->name, function ($query) use ($request) {
                return $query->where('name', 'LIKE', "%{$request->name}%");
            })
            ->when($request->username, function ($query) use ($request) {
                return $query->where('username', 'LIKE', "%{$request->username}%");
            })
            ->when($request->is_active, function ($query) use ($request) {
                return $query->where('is_active', 'LIKE', "%{$request->is_active}%");
            })
            ->paginate($limit);

        return view('layouts.view.admin.cetakUsulan', compact('users', 'photos', 'lembaga', 'role'));
    }

    public function printUsulan($id)
    {
        try {
            $namaFile = 'usulan.pdf';

            $data = [
                'coba' => 'data usulan saya ini loh',
            ];

            $cetakListRincian = $this->usulanModels
                ->whereuser_id($id)
                ->get();

            $sumRincian = $this->rincian
                ->whereuser_id($id)
                ->sum('total');

            $html = view()->make('layouts.view.users.cetak-usulan', compact('cetakListRincian', 'sumRincian'))->render();

            PDF::SetTitle('Cetak Usulan');
            PDF::AddPage();
            PDF::writeHTML($html, true, false, true);

            PDF::Output(public_path($namaFile), 'I');
        } catch (\Exception $error) {
            return redirect()->route('users.buat_usulan')->with('error', $error);
        }
    }
}
