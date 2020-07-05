<?php

namespace inspiration\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isAuthCheck = $user->count > 0;
        $boughts = $user->hasOrders()->with(['ideas', 'users'])->take(5)->get();
        $likes = $user->hasLikes()->with('ideas')->take(5)->get();
        $myIdeas = $user->ideas()->take(5)->get();
        $reviews = $user->hasReviews()->with('ideas')->take(5)->get();

        return view('mypage.index', [
            'isAuthCheck' => $isAuthCheck,
            'boughts' => $boughts,
            'likes' => $likes,
            'myIdeas' => $myIdeas,
            'reviews' => $reviews,
        ]);
    }

    public function settings()
    {
        return view('mypage.settings');
    }

    public function boughts()
    {
        $user = Auth::user();
        $boughts = $user->hasOrders()->with(['ideas', 'users'])->get();
        return view('mypage.boughts', [
            'user' => $user,
            'boughts' => $boughts,
        ]);
    }
    public function likes()
    {
        $user = Auth::user();
        $likes = $user->hasLikes()->with('ideas')->get();
        return view('mypage.likes', [
            'user' => $user,
            'likes' => $likes,
        ]);
    }
    public function myIdeas()
    {
        $user = Auth::user();
        $myIdeas = $user->ideas()->take(5)->get();

        return view('mypage.myIdeas', [
            'user' => $user,
            'myIdeas' => $myIdeas,
        ]);
    }

    public function reviews()
    {
        $user = Auth::user();
        $reviews = $user->hasReviews()->with('ideas')->get();

        return view('mypage.reviews', [
            'user' => $user,
            'reviews' => $reviews,
        ]);
    }
}
