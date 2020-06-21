<?php

namespace inspiration\Http\Controllers;

use Illuminate\Http\Request;

class IdeasController extends Controller
{
    public function index(Request $request)
    {
        return view('ideas.index', [
            //
        ]);
    }
}
