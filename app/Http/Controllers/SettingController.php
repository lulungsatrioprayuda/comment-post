<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Setting;

class SettingController extends Controller
{
    function index()
    {
        return view('backend.setting.index', [
            'title' => 'Post',
            'meta_desc' => 'Post Page',
        ]);
    }

    function save_setting(Request $request)
    {
        $data = new Setting;
        $data->comment_auto = $request->comment_auto;
        $data->user_auto = $request->user_auto;
        $data->recent_limit = $request->recent_limit;
        $data->popular_limit = $request->popular_limit;
        $data->recent_comment_limit = $request->recent_comment_limit;
        $data->save();
        return redirect('admin/setting')->with('success', 'Data success to edit');
    }
}
