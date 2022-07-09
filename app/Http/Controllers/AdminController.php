<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    function login()
    {
        return view('backend.login');
    }

    function submit_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $userCheck = Admin::where([
            'username' => $request->username,
            'password' => $request->password
        ])->count();
        if ($userCheck) {
            return redirect('admin/dashboard');
        } else {
            return redirect('admin/login')->with('error', 'invalid username or password');
        }
    }

    function dashboard()
    {
        return view('backend.dashboard');
    }
}
