<?php

namespace inspiration\Http\Controllers;

use Illuminate\Http\Request;
use inspiration\Category;
use inspiration\Idea;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * アイデアのCRUD用コントローラー
 * 
 * アイデアのCRUDに関連するメソッド群を記載
 */
class IdeasController extends Controller
{
    /**
     * アイデア一覧ページへアクセスする
     *
     * @var array $ideas アイデア一覧データ
     * @return Response アイデア一覧ページの表示
     */
    public function index()
    {
        $ideas = Idea::all();
        return view('ideas.index', [
            'ideas' => $ideas,
        ]);
    }

    /**
     * アイデアの新規投稿画面へアクセス
     *
     * @var array $ideas アイデア一覧データ
     * @return Response アイデア投稿ページの表示
     */
    public function create()
    {
        $ideas = Idea::all();
        return view('ideas.create', [
            'ideas' => $ideas,
        ]);
    }

    /**
     * DBへの新規登録メソッド
     *
     * @param array $request バリデーション通過したpostの内容
     * @var object $user ログインユーザー情報
     * @var object $postImg postされた画像の情報
     * @var object $idea  newされた新規アイデアのインスタンス
     * @return Response アイデア一覧ページの表示
     */
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
            $idea->img = str_replace('public/', 'storage/', $path);
        }

        $idea->save();

        return redirect()->route('ideas.index')->with('flash_message', 'アイデアを投稿しました！');
    }
}
