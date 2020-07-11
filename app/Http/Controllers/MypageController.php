<?php

namespace inspiration\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use inspiration\Review;

/**
 * マイページ用コントローラー
 * 
 * マイページ 表示に関連するメソッド群を記載
 */
class MypageController extends Controller
{
    /**
     * マイページの一覧表示メソッド
     *
     * @var object $user ユーザーデータ
     * @var boolean $isAuthCheck ログインしているかどうかのチェック
     * @var array $boughts 購入した商品データ
     * @var array $likes 気になるリストの商品データ
     * @var array $myIdeas 投稿した商品データ
     * @var array $reviews 投稿されたレビーデータ
     * 
     * @return Response マイページ一覧表示の表示
     */
    public function index()
    {
        $user = Auth::user();
        $isAuthCheck = $user->count > 0;
        $boughts = $user->hasOrders()->with(['ideas', 'users'])->take(5)->get();
        $likes = $user->hasLikes()->with('ideas')->take(5)->get();
        $myIdeas = $user->ideas()->take(5)->get();
        $reviews = Review::with('ideas', 'users')->get()->where('ideas.user_id', $user->id)->take(5);

        return view('mypage.index', [
            'isAuthCheck' => $isAuthCheck,
            'boughts' => $boughts,
            'likes' => $likes,
            'myIdeas' => $myIdeas,
            'reviews' => $reviews,
        ]);
    }

    /**
     * アカウント設定メソッド
     * 
     * @return Response マイページ一覧表示の表示
     */
    public function settings()
    {
        return view('mypage.settings');
    }

    /**
     *　購入商品一覧メソッド
     * 
     * @var object $user ユーザーデータ
     * @var array $boughts 購入商品データ
     * @return Response 購入商品一覧ページの表示
     */
    public function boughts()
    {
        $user = Auth::user();
        $boughts = $user->hasOrders()->with(['ideas', 'users'])->paginate(10);
        return view('mypage.boughts', [
            'user' => $user,
            'boughts' => $boughts,
        ]);
    }

    /**
     *　気になるリストの商品一覧メソッド
     * 
     * @var object $user ユーザーデータ
     * @var array $likes 気になるリストの商品データ
     * @return Response 気になるリストの商品一覧ページの表示
     */
    public function likes()
    {
        $user = Auth::user();
        $likes = $user->hasLikes()->with('ideas')->paginate(10);
        return view('mypage.likes', [
            'user' => $user,
            'likes' => $likes,
        ]);
    }

    /**
     *　投稿した商品一覧メソッド
     * 
     * @var object $user ユーザーデータ
     * @var array $myIdeas 気になるリストの商品データ
     * @return Response 気になるリストの商品一覧ページの表示
     */
    public function myIdeas()
    {
        $user = Auth::user();
        $myIdeas = $user->ideas()->take(5)->paginate(10);

        return view('mypage.myIdeas', [
            'user' => $user,
            'myIdeas' => $myIdeas,
        ]);
    }

    /**
     *　レビュー一覧メソッド
     * 
     * @var object $user ユーザーデータ
     * @var array $reviews レビューデータ
     * @return Response レビューデータ一覧ページの表示
     */
    public function reviews()
    {
        $user = Auth::user();
        $reviews = Review::with('ideas', 'users')->get()->where('ideas.user_id', $user->id);


        return view('mypage.reviews', [
            'user' => $user,
            'reviews' => $reviews,
        ]);
    }
}
