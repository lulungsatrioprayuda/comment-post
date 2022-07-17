<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    function index()
    {
        return view('backend.setting.index', [
            'title' => 'Post',
            'meta_desc' => 'Post Page',
        ]);
    }
}
