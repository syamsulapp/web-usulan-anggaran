<?php

namespace App\Http\Controllers;

use App\Models\Pagu;
use App\Models\ProfileModels;
use App\Models\Rincian;
use App\Models\Uraian;
use App\Models\User;
use App\Models\UsulanModels;
use Illuminate\Http\Request;

class UsulanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $usulanModels, $profileModels, $user, $pagu, $uraian, $rincian;

    public function __construct(UsulanModels $usulanModels, ProfileModels $profileModels, User $user, Pagu $pagu, Uraian $uraian, Rincian $rincian)
    {
        $this->usulanModels = $usulanModels;
        $this->profileModels = $profileModels;
        $this->user = $user;
        $this->pagu = $pagu;
        $this->uraian = $uraian;
        $this->rincian = $rincian;
    }

    /**
     * list usulan anggaran
     */

    public static function currency($uang)
    {
        $value = floatval($uang);
        return "Rp. " . number_format($value, 0, ',', '.');
    }
    public function index()
    {
        $countUsulan = $this->rincian
            ->whereuser_id($this->user->user()->id)
            ->sum('total'); //count total item anggaran
        $pagu = $this->pagu->all(); //query lembaga
        $uraian = $this->uraian->all(); //query uraian
        $photos = $this->profileModels
            ->whereid_users($this->user->user()->id)
            ->first(); // detail photos and username by session users

        $hasilCurrency = $this->currency($countUsulan);
        if (is_null($photos)) {
            $photos = [
                'photos' => 'photo belum ada',
                'nama_lengkap' => 'nama lengkap belum ada'
            ];
        }
        $usulanList = $this->usulanModels->all();

        return view('layouts.view.users.usulan', compact('usulanList', 'photos', 'pagu', 'uraian', 'hasilCurrency'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama_barang' => 'required',
            'volume' => 'required',
            'harga_satuan' => 'required',
            'satuan' => 'required',
        ], [
            'required' => ':attribute jangan di kosongkan'
        ]);

        try {
            $data = $request->all();
            $data['user_id'] = $this->user->user()->id;
            $data['total'] = $request->harga_satuan * $request->satuan; //logic total
            $this->rincian->create($data);

            return redirect()->route('users.buat_usulan')->with('success', 'Success add anggaran');
        } catch (\Exception $error) {
            return redirect()->route('users.buat_usulan')->with('error', $error);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($usulanModels)
    {
        try {
            $this->usulanModels->destroy($usulanModels);
            return redirect()->route('users.buat_usulan')->with('success', 'Berhasil Delete Usulan');
        } catch (\Exception $error) {
            return redirect()->route('users.buat_usulan')->with('error', $error);
        }
    }
}
