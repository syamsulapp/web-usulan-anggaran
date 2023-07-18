<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use Illuminate\Http\Request;

class LembagaController extends Controller
{
    //
    public function index()
    {
        $listlembaga = Lembaga::all();
        return view('layouts.view.admin.lembaga', compact('listlembaga'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lembaga' => 'required|max:255',
        ]);

        $lembaga = new Lembaga;
        $lembaga->nama_lembaga = $validatedData['nama_lembaga'];
        $lembaga->save();

        return redirect()->route('lembaga.index')->with('success', 'Data lembaga berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_lembaga' => 'required|max:255',
        ]);

        $lembaga = Lembaga::findOrFail($id);
        $lembaga->nama_lembaga = $validatedData['nama_lembaga'];
        $lembaga->save();

        return redirect()->route('lembaga.index')->with('success', 'Data lembaga berhasil diperbarui.');
    }

    public function destroy($id)
    {

        $lembaga = Lembaga::find($id);

        if (!$lembaga) {
            return redirect()->back()->with('error', 'Lembaga tidak ditemukan.');
        }

        $lembaga->delete();

        return redirect()->back()->with('success', 'Lembaga berhasil dihapus.');
    }
}
