<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{


    // function index()
    // {
    //     return view('admin.index');
    // }
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

    public function create()
    {
        return 'tambah users';
    }

    public function store(Request $request)
    {
    }

    public function edit(User $id)
    {
    }

    public function update(User $id, Request $request)
    {
    }

    public function delete($id)
    {
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
