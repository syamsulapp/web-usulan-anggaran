<?php

namespace App\Http\Controllers;

use App\Models\ProfileModels;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function profile()
    {
        return view('layouts.view.profile.profile');
    }
    public function profileSubmit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:4|max:120',
            'username' => 'required|string|min:4|max:120',
            'password' => 'required|min:8|max:128',
            'password-confirmation' => 'required|min:8|max:128|same:password',
        ], [
            'required' => ':attribute jangan dikosongkan',
            'same' => 'password tidak sama'
        ]);
        $this->user->whereId($this->user->user()->id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile')->with('alert', 'Berhasil Ubah Profile');
    }
}
