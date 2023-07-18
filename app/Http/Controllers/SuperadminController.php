<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    function index()
    {
        return view('superadmin.index');
    }
}
