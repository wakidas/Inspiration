<?php

namespace inspiration\Http\Controllers;

use Illuminate\Http\Request;
use inspiration\Category;
use inspiration\Idea;

class IdeasController extends Controller
{
    public function index(Request $request)
    {
        $ideas = Idea::all();
        return view('ideas.index', [
            'ideas' => $ideas,
        ]);
    }
}
