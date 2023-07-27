<?php

namespace App\Http\Controllers;

use App\Models\ProfileModels;
use App\Models\User;
use App\Models\UsulanModels;
use Illuminate\Http\Request;

class UsulanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $usulanModels, $profileModels, $user;

    public function __construct(UsulanModels $usulanModels, ProfileModels $profileModels, User $user)
    {
        $this->usulanModels = $usulanModels;
        $this->profileModels = $profileModels;
        $this->user = $user;
    }

    /**
     * list usulan anggaran
     */
    public function index()
    {
        $photos = $this->profileModels->whereid_users($this->user->user()->id)->first();
        $usulanList = $this->usulanModels->all();

        return view('layouts.view.users.usulan', compact('usulanList', 'photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UsulanModels $usulanModels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UsulanModels $usulanModels)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UsulanModels $usulanModels)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UsulanModels $usulanModels)
    {
        //
    }
}
