<?php

namespace inspiration\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function index()
    {
        return view('mypage.index');
    }

    public function settings()
    {
        return view('mypage.settings');
    }
}
