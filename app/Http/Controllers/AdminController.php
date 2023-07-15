<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $limit = 10;
        if ($limit >= $request->limit) {
            $limit = $request->limit;
        }
        $users = $this->user
            ->orderByDesc('id')
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
        return view('layouts.view.admin.users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'tipe' => 'required',
            'bagian' => 'required',
            'role' => 'required',
            'is_active' => 'required',
            'skfile' => 'required|file|mimes:pdf|max:2048',
        ], [
            'required' => ':attribute jangan di kosongkan',
            'unique' => 'username sudah ada'
        ]);

        $file = $request->file('skfile');

        $nama_file = time() . '-' . $file->getClientOriginalName();

        $tujuan_upload = 'surat_keterangan';

        $file->move($tujuan_upload, $nama_file);

        $submit = $request->all();
        $submit['skfile'] = $nama_file;
        $submit['password'] = Hash::make($request->password);
        $this->user->create($submit);

        return redirect()->route('admin.users')->with('alert', 'berhasil tambah users');
    }

    public function edit(User $id)
    {
        return view('layouts.view.admin.users-edit', compact('id'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'tipe' => 'required',
            'bagian' => 'required',
            'role' => 'required',
            'is_active' => 'required',
            'skfile' => 'required|file|mimes:pdf|max:2048',
        ], [
            'required' => ':attribute jangan di kosongkan',
            'unique' => 'username sudah ada'
        ]);

        $file = $request->file('skfile');

        $nama_file = time() . '-' . $file->getClientOriginalName();

        $tujuan_upload = 'surat_keterangan';

        $file->move($tujuan_upload, $nama_file);

        $updateData = $request->all();
        $updateData['skfile'] = $nama_file;
        $updateData['password'] = Hash::make($request->password);
        $this->user->whereId($id)->update($updateData);

        return redirect()->route('admin.users')->with('alert', 'berhasil update data');
    }

    public function delete($id)
    {
        try {
            $this->user->whereId($id)->delete();
            return redirect()->route('admin.users')->with('alert', 'berhasil delete data');
        } catch (\Exception $error) {
            return $error;
        }
    }

    public function activate($id)
    {
        try {
            $this->user->whereId($id)->update(['is_active' => 'Y']);
            return redirect()->route('admin.users')->with('alert', 'Berhasil Mengaktifkan Akun Users');
        } catch (\Exception $error) {
            return $error;
        }
    }
    public function inactive($id)
    {
        try {
            $this->user->whereId($id)->update(['is_active' => 'N']);
            return redirect()->route('admin.users')->with('alert', 'Berhasil Menonaktifkan Akun Users');
        } catch (\Exception $error) {
            return $error;
        }
    }
}
