<?php

namespace inspiration\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     *　トップページ表示メソッド
     * 
     * @return Response トップページの表示
     */
    public function index()
    {
        return view('layouts.top');
    }
}
