<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function login()
    {
        return view('backend.login');
    }

    function submit_login(Request $request)
    {
        $request->validate();
    }
}
