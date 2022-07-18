<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    function home(Request $request)
    {
        if ($request->has('q')) {
            $q = $request->q;
            $posts = Post::where('title', 'like', '%' . $q . '%')->orderBy('id', 'desc')->paginate(2);
        } else {
            $posts = Post::orderBy('id', 'desc')->paginate(2);
        }
        return view('home', ['posts' => $posts]);
    }
}
