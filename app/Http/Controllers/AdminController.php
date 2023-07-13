<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;



class AdminController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('layouts.view.admin.users');
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function edit($id)
    {
    }

    public function update(User $id, Request $request)
    {
    }

    public function delete($id)
    {
    }
}
