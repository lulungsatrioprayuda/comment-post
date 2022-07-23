<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

    function all_category()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(5);
        return view(
            'categories',
            [
                'categories' => $categories,
            ]
        );
    }

    function category(Request $request, $cat_slug, $cat_id)
    {
        $category = Category::find($cat_id);
        $posts =  Post::where('cat_id', $cat_id)->orderBy('id', 'desc')->paginate(2);
        return view(
            'category',
            [
                'posts' => $posts,
                'category' => $category
            ]
        );
    }

    function category_post(Request $request,  $cat_slug, $cat_id)
    {
        $posts =  Post::where('cat_id', $cat_id)->orderBy('cat_id', $cat_id)->orderBy('id', 'desc')->paginate(1);
        return view(
            'category',
            ['posts' => $posts]
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

    function save_post_form()
    {
        $cats = Category::all();
        return view('save-post-form', [
            'cats' => $cats
        ]);
    }

    function save_post_data(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'detail' => 'required'
        ]);

        // thumbnail
        if ($request->hasFile('post_thumbnail')) {
            $image1 = $request->file('post_thumbnail');
            $reThumbImage = time() . '.' . $image1->getClientOriginalExtension();
            $dest1 = public_path('/imgs/thumb');
            $image1->move($dest1, $reThumbImage);
        } else {
            $reThumbImage = $request->post_thumbnail;
        }


        // full image
        if ($request->hasFile('post_image')) {
            $image2 = $request->file('post_image');
            $reFullImage = time() . '.' . $image2->getClientOriginalExtension();
            $dest2 = public_path('/imgs/full');
            $image2->move($dest2, $reFullImage);
        } else {
            $reFullImage = $request->post_image;
        }

        $post = new Post;
        $post->user_id = $request->user()->id;
        $post->cat_id = $request->category;
        $post->title = $request->title;
        $post->detail = $request->detail;
        $post->tags = $request->tags;
        $post->status = 1;
        $post->thumb = $reThumbImage;
        $post->full_img = $reFullImage;
        $post->save();

        return redirect('save-post-form')->with('success', 'Post has been updated');
    }
}
