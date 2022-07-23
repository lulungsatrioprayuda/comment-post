<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class HomeController extends Controller
{
    function index(Request $request)
    {
        if ($request->has('q')) {
            $q = $request->q;
            $posts = Post::where('title', 'like', '%' . $q . '%')->orderBy('id', 'desc')->paginate(2);
        } else {
            $posts = Post::orderBy('id', 'desc')->paginate(2);
        }
        return view('home', ['posts' => $posts]);
    }

    function detail(Request $request, $slug, $postId)
    {
        Post::find($postId)->increment('views');
        $detail = Post::find($postId);
        return view(
            'detail',
            ['detail' => $detail]
        );
    }

    function save_comment(Request $request, $slug, $id)
    {
        $request->validate([
            'comment' => 'required'
        ]);
        $data = new Comment;
        $data->user_id =  $request->user()->id;
        $data->post_id = $id;
        $data->comment =  $request->comment;
        $data->save();

        return redirect('detail/' . $slug . '/' . $id)->with('success', 'Comment has ben submited!!');
    }
}
