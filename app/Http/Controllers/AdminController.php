<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

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
            $adminData =
                Admin::where([
                    'username' => $request->username,
                    'password' => $request->password
                ])->first();
            session(['adminData' => $adminData]);
            return redirect('admin/dashboard');
        } else {
            return redirect('admin/login')->with('error', 'invalid username or password');
        }
    }

    function dashboard()
    {
        $posts =  Post::orderBy('id', 'desc')->get();
        return view(
            'backend.dashboard',
            [
                'posts' => $posts
            ]
        );
    }

    function comments()
    {
        $data =  Comment::orderBy('id', 'desc')->get();
        return view(
            'backend.comment.index',
            [
                'data' => $data
            ]
        );
    }

    public function delete_comment($id)
    {
        Comment::where('id', $id)->delete();
        return redirect('admin/comment');
    }

    function users()
    {
        $data =  User::orderBy('id', 'desc')->get();
        return view(
            'backend.user.index',
            [
                'data' => $data
            ]
        );
    }

    public function delete_user($id)
    {
        User::where('id', $id)->delete();
        return redirect('admin/user');
    }

    function logout()
    {
        session()->forget(['adminData']);
        return redirect('admin/login');
    }
}
