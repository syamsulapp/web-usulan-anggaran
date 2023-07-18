<?php

namespace App\Http\Controllers;

use App\Models\Uraian;
use Illuminate\Http\Request;

class UraianController extends Controller
{
    public function index()
    {
        $listuraian = Uraian::all();
        return view('layouts.view.admin.uraian', compact('listuraian'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kegiatan' => 'required|max:255',
        ]);

        $uraian = new Uraian();
        $uraian->nama_kegiatan = $validatedData['nama_kegiatan'];
        $uraian->save();

        return redirect()->route('uraian.index')->with('success', 'Data lembaga berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kegiatan' => 'required|max:255',
        ]);

        $uraian = Uraian::findOrFail($id);
        $uraian->nama_kegiatan = $validatedData['nama_kegiatan'];
        $uraian->save();

        return redirect()->route('uraian.index')->with('success', 'Data lembaga berhasil diperbarui.');
    }

    public function destroy($id)
    {

        $uraian = Uraian::find($id);

        if (!$uraian) {
            return redirect()->back()->with('error', 'Lembaga tidak ditemukan.');
        }

        $uraian->delete();

        return redirect()->back()->with('success', 'Lembaga berhasil dihapus.');
    }
}
