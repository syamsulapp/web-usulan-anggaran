<?php

namespace App\Http\Controllers;

use App\Models\detail_rincian;
use App\Models\Pagu;
use App\Models\ProfileModels;
use App\Models\Rincian;
use App\Models\StatusUsulanModels;
use App\Models\Uraian;
use App\Models\User;
use App\Models\UsulanModels;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF as PDF;

class UsulanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $usulanModels,
        $profileModels, $user, $pagu,
        $uraian, $rincian,
        $detail_rincian,
        $statusUsulanModels;

    public function __construct(
        UsulanModels $usulanModels,
        ProfileModels $profileModels,
        User $user,
        Pagu $pagu,
        Uraian $uraian,
        Rincian $rincian,
        detail_rincian $detail_rincian,
        StatusUsulanModels $statusUsulanModels

    ) {
        $this->usulanModels = $usulanModels;
        $this->profileModels = $profileModels;
        $this->user = $user;
        $this->pagu = $pagu;
        $this->uraian = $uraian;
        $this->rincian = $rincian;
        $this->detail_rincian = $detail_rincian;
        $this->statusUsulanModels = $statusUsulanModels;
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

        $hasilCurrency = $this->currency($countUsulan); //format currency Rp.
        if (is_null($photos)) {
            $photos = [
                'photos' => 'photo belum ada',
                'nama_lengkap' => 'nama lengkap belum ada'
            ];
        }
        $usulanList = $this->usulanModels->all(); // query list usulan
        $statusUsulan = $this->statusUsulanModels
            ->orderByDesc('id')
            ->whereuser_id($this->user->user()->id)
            ->first();

        if (is_null($statusUsulan)) {
            $statusUsulan = [
                'status' => 'sedang dibuat',
            ];
        } else {
            $statusUsulan = [
                'status' => $statusUsulan->status
            ];
        }
        return view('layouts.view.users.usulan', compact('usulanList', 'photos', 'pagu', 'uraian', 'hasilCurrency', 'countUsulan', 'statusUsulan'));
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
            //kalo ada delete rincian maka hasil submit anggaran dan status usulan dihapus dan digantikan dengan yang baru
            $this->detail_rincian->whereuser_id($this->user->user()->id)->delete();
            $this->statusUsulanModels->whereuser_id($this->user->user()->id)->delete();
            return redirect()->route('users.buat_usulan')->with('success', 'Berhasil Delete Usulan');
        } catch (\Exception $error) {
            return redirect()->route('users.buat_usulan')->with('error', $error);
        }
    }


    public function submitAnggaran($anggaran, $nama, $photo)
    {
        $formatCurrency = $this->currency((int)$anggaran);
        try {
            if (is_null($editAnggaran = $this->detail_rincian->whereuser_id($this->user->user()->id)->first())) {
                if ((int)$anggaran != 0) {
                    $this->detail_rincian->create(
                        ['user_id' => $this->user->user()->id, 'total' => (int)$anggaran]
                    );
                    $this->statusUsulanModels->create(['status' => ' diajukan', 'keterangan' => 'anggaran' . ' ' . $formatCurrency, 'user_id' => $this->user->user()->id, 'nama' => $nama, 'photo' => $photo]);
                    return redirect()->route('users.buat_usulan')->with('success', 'Berhasil Submit Usulan');
                } else {
                    return redirect()->route('users.buat_usulan')->with('error', 'anggaran belum di buat');
                }
            } else {
                if ((int)$anggaran != 0) {
                    $editAnggaran->update(['total' => (int)$anggaran]);
                    $this->statusUsulanModels->create(['status' => 'diajukan', 'keterangan' => 'anggaran telah diubah menjadi' . ' ' . $formatCurrency, 'user_id' => $this->user->user()->id, 'nama' => $nama, 'photo' => $photo]);
                    return redirect()->route('users.buat_usulan')->with('success', 'Berhasil Merubah Usulan');
                } else {
                    return redirect()->route('users.buat_usulan')->with('error', 'anggaran belum di buat');
                }
            }
        } catch (\Exception $error) {
            return redirect()->route('users.buat_usulan')->with('error', $error);
        }
    }

    public function cetakUsulan()
    {
        try {
            $namaFile = 'usulan.pdf';

            $data = [
                'coba' => 'data usulan saya ini loh',
            ];

            $cetakListRincian = $this->usulanModels
                ->whereuser_id($this->user->user()->id)
                ->get();

            $sumRincian = $this->rincian
                ->whereuser_id($this->user->user()->id)
                ->sum('total');

            $header = $this->usulanModels
                ->whereuser_id($this->user->user()->id)
                ->first();

            $namaKegiatan = $this->uraian->whereId($header->uraian_id)->first();

            $html = view()->make('layouts.view.users.cetak-usulan', compact('cetakListRincian', 'sumRincian', 'header', 'namaKegiatan'))->render();

            PDF::SetTitle('Cetak Usulan');
            PDF::AddPage();
            PDF::writeHTML($html, true, false, true);

            PDF::Output(public_path($namaFile), 'I');
        } catch (\Exception $error) {
            return redirect()->route('users.buat_usulan')->with('error', $error);
        }
    }
}
