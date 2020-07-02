<?php

namespace inspiration\Http\Controllers;

use Illuminate\Http\Request;
use inspiration\Category;
use inspiration\Idea;
use inspiration\User;
use inspiration\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
    public function index(Request $request)
    {
        Log::debug('「「「「「「「「「「「　　index   」」」」」」」」」」」」」」');
        Log::debug('$request');
        Log::debug($request);

        
        // 検索機能
        
        $post_category = $request->get('category') ? $request->get('category') : "";
        $post_price = $request->get('price') ? $request->get('price') : "";
        $post_date = $request->get('date') ? $request->get('date') : "";
        
        $postData = [];
        $postData['category'] = $post_category;
        $postData['price'] = $post_price;
        $postData['date'] = $post_date;
        
        if (!empty($post_category) || !empty($post_price) || !empty($post_date)){
            $ideas = Idea::getSearchData($request)->paginate(10);
        }else{
            $ideas = Idea::paginate(10);
        }

        return view('ideas.index', [
            'ideas' => $ideas,
            'postData' => $postData,
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
     * アイデアの新規登録メソッド
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
            $idea->img = str_replace('public/', '', $path);
        }

        $idea->save();

        return redirect()->route('ideas.index')->with('flash_message', 'アイデアを投稿しました！');
    }

    /**
     * アイデアの編集メソッド
     * 
     * @return Response アイデア編集ページの表示
     */
    public function edit($id)
    {
        $idea = Idea::find($id);

        return view('ideas.edit', [
            'idea' => $idea,
        ]);
    }

    /**
     * アイデアの更新メソッド
     *
     * @param array $request バリデーション通過したpostの内容
     * @var object $user ログインユーザー情報
     * @var object $postImg postされた画像の情報
     * @var object $idea  newされた新規アイデアのインスタンス
     * @return Response アイデア一覧ページの表示
     */
    public function update(Request $request, $id)
    {
        Log::debug('$request');
        Log::debug($request);
        $user = Auth::user();
        $postImg = $request->img;
        $deleteFlg = $request->deleteFlg;

        $idea = Idea::find($id);
        $idea->fill($request->all());
        $idea->user_id = $user->id;

        if ($postImg) {
            Storage::delete('public/' . $idea->img);
            $path = $postImg->store('public/idea_images');
            $idea->img = str_replace('public/', '', $path);
        }
        if ($deleteFlg) {
            Storage::delete('public/' . $idea->img);
            $idea->img = null;
        }

        $idea->save();

        return redirect()->route('ideas.index')->with('flash_message', 'アイデアを投稿しました！');
    }

    /**
     * アイデア詳細ページへアクセスする
     *
     * @var array $idea アイデアデータ
     * @return Response アイデア詳細ページの表示
     */
    public function show($id)
    {
        $idea = Idea::find($id);
        $reviews = Idea::with('reviews', 'reviews.user')->where('ideas.id', $id)->get();

        return view('ideas.show', [
            'idea' => $idea,
            'reviews' => $reviews,
        ]);
    }

    /**
     * いいね登録
     *
     * 
     * 
     */
    public function like(Request $request, $id)
    {
        $idea = Idea::find($id);
        $idea->likes()->detach($request->user()->id);
        $idea->likes()->attach($request->user()->id);

        return [
            'countLikes' => $idea->count_likes,
        ];
    }

    public function unlike(Request $request, $id)
    {
        $idea = Idea::find($id);
        $idea->likes()->detach($request->user()->id);

        return [
            'countLikes' => $idea->count_likes,
        ];
    }

    public function buy(Request $request, $id)
    {
        Log::debug('buy!!! $request');
        Log::debug($request);

        $idea = Idea::find($id);
        $idea->orders()->attach($request->user()->id);

        //購入者にメール送信する
        Log::debug('buyメール送るよ');
        $order = Order::latest()->first();
        // $order->with('ideas','users')->get();
        Log::debug('$order');
        Log::debug($order);
        User::find($order->user_id)->buyEmail($order);
        User::find($order->ideas->user_id)->saleEmail($order);

        return redirect()->route('ideas.show', $id)->with('flash_message', 'アイデアを購入しました！');
    }
}
