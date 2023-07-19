<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\ProfileModels;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MasterDataUsers extends Controller
{
    protected $user;

    protected $lembaga;

    protected $profileModels;

    protected $role;

    public function __construct(User $user, Lembaga $lembaga, ProfileModels $profileModels, Role $role)
    {
        $this->lembaga = $lembaga;
        $this->user = $user;
        $this->profileModels = $profileModels;
        $this->role = $role;
    }

    public function index(Request $request)
    {
        $photos = $this->profileModels->whereid_users($this->user->user()->id)->first();
        $lembaga = $this->lembaga->all();
        $role = $this->role->all();

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
        return view('layouts.view.admin.users', compact('users', 'photos', 'lembaga', 'role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'surat_keterangan' => 'required|file|mimes:pdf|max:2048',
        ], [
            'required' => ':attribute jangan di kosongkan',
            'unique' => 'username sudah ada'
        ]);

        $file = $request->file('surat_keterangan');

        $nama_file = time() . '-' . $file->getClientOriginalName();

        $tujuan_upload = 'surat_keterangan';

        $file->move($tujuan_upload, $nama_file);

        $submit = $request->all();
        $submit['surat_keterangan'] = $nama_file;
        $submit['password'] = Hash::make($request->password);
        $this->user->create($submit);
        return redirect()->route('admin.users')->with('alert', 'berhasil tambah users');
    }

    public function edit(User $id)
    {
        return view('layouts.view.admin.users-edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'id_lembaga' => 'required',
            'role' => 'required',
            'is_active' => 'required',
            'surat_keterangan' => 'required|file|mimes:pdf|max:2048',
        ], [
            'required' => ':attribute jangan di kosongkan',
            'unique' => 'username sudah ada'
        ]);

        $file = $request->file('surat_keterangan');

        $nama_file = time() . '-' . $file->getClientOriginalName();

        $tujuan_upload = 'surat_keterangan';

        $file->move($tujuan_upload, $nama_file);

        $this->user->whereId($id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'id_lembaga' => $request->id_lembaga,
            'role' => $request->role,
            'is_active' => $request->is_active,
            'surat_keterangan' => $nama_file
        ]);

        return redirect()->route('admin.users')->with('alert', 'berhasil update data');
    }

    public function delete($id)
    {
        try {
            $this->user->destroy('id', $id);
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
