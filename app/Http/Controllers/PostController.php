<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::all();
        return view('backend.post.index', [
            'data' => $data,
            'title' => 'Post Page',
            'meta_desc' => 'Page for update the posting some content'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Category::all();
        return view('backend.post.add', [
            'cats' => $cate
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'detail' => 'required'
        ]);

        // thumbnail
        if ($request->hasFile('post_thumb')) {
            $image = $request->file('post_thumb');
            $reThumbImage = time() . '.' . $image->getClientOriginalExtension();
            $dest = public_path('/imgs');
            $image->move($dest, $reThumbImage);
        } else {
            $reThumbImage = 'na';
        }


        // full image
        if ($request->hasFile('post_image')) {
            $image = $request->file('post_image');
            $reFullImage = time() . '.' . $image->getClientOriginalExtension();
            $dest = public_path('/imgs');
            $image->move($dest, $reFullImage);
        } else {
            $reFullImage = 'na';
        }

        $post = new Post;
        $post->title = $request->title;
        $post->detail = $request->detail;
        $post->tags = $request->tags;
        $post->thumb = $reThumbImage;
        $post->full_img = $reFullImage;
        $post->save();

        return redirect('admin/post/create')->with('success', 'Data success to added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
