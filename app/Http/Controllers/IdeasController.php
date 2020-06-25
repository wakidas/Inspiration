<?php

namespace inspiration\Http\Controllers;

use Illuminate\Http\Request;
use inspiration\Category;
use inspiration\Idea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IdeasController extends Controller
{
    public function index()
    {
        $ideas = Idea::all();
        return view('ideas.index', [
            'ideas' => $ideas,
        ]);
    }
    public function create()
    {
        $ideas = Idea::all();
        return view('ideas.create', [
            'ideas' => $ideas,
        ]);
    }

    public function store(Request $request)
    {
        Log::debug('$request');
        Log::debug($request);
        $user = Auth::user();
        $postImg = $request->img;

        $idea = new Idea();
        $idea->fill($request->all());
        $idea->user_id = $user->id;

        if ($postImg) {
            $path = $postImg->store('public/idea_images');
            $idea->img = str_replace('public/', '', $path);
        }

        $idea->save();
    }
}
