<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Anggaran;
use App\Models\Pagu;
use Illuminate\Support\Facades\DB;

class PaguController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {



        $anggarans = Anggaran::all();

        $listpagu = Pagu::with('anggaran')->get();
        $limit = 10;
        if ($limit >= $request->limit) {
            $limit = $request->limit;
        }
        $users = $this->user
            ->orderByDesc('id')
            ->when($request->name, function ($query) use ($request) {
                return $query->where('jenis_alokasi_anggaran', 'LIKE', "%{$request->jenis_alokasi_anggaran}%");
            })
            ->paginate($limit);
        return view('layouts.view.admin.pagu', compact('users', 'listpagu', 'anggarans'));
    }

    public function tambah_pagu(Request $request)
    {
        $request->validate([
            'jenis_alokasi_anggaran' => 'required',
            'anggaran_kodeakun' => 'required',
        ]);

        $pagu = new Pagu();
        $pagu->jenis_alokasi_anggaran = $request->input('jenis_alokasi_anggaran');
        $pagu->anggaran_kodeakun = $request->input('anggaran_kodeakun');
        $pagu->save();

        return redirect()->route('pagu.index')->with('success', 'Data berhasil disimpan.');
    }

    public function tambah_anggaran(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
        ]);

        $anggaran = new Anggaran();
        $anggaran->keterangan = $request->input('keterangan');
        $anggaran->save();

        return redirect()->route('pagu.index')->with('success', 'Data berhasil disimpan.');
    }
}
