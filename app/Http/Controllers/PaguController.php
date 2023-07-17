<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PaguController extends Controller
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
                return $query->where('jenis_alokasi_anggaran', 'LIKE', "%{$request->jenis_alokasi_anggaran}%");
            })
            ->paginate($limit);
        return view('layouts.view.admin.pagu', compact('users'));
    }
}
