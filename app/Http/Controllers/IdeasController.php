<?php

namespace inspiration\Http\Controllers;

use Illuminate\Http\Request;
use inspiration\Http\Requests\CreateIdeaRequest;

use inspiration\Idea;
use inspiration\User;
use inspiration\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * アイデア用コントローラー
 * 
 * アイデアのCRUDに関連するメソッド群を記載
 */
class IdeasController extends Controller
{
    /**
     * アイデア一覧ページへアクセスする
     *
     * @param array $request リクエストデータ
     * @var object $post_category リクエストデータ（カテゴリー）
     * @var object $post_price リクエストデータ（価格）
     * @var object $post_date リクエストデータ（登録日）
     * @var array $postData リクエストデータ（カテゴリー・価格・登録日のデータ配列）
     * @var array $ideas アイデア一覧データ
     * @return Response アイデア一覧ページの表示
     */
    public function index(Request $request)
    {
        // 検索機能
        $post_category = $request->get('category') ? $request->get('category') : "";
        $post_price = $request->get('price') ? $request->get('price') : "";
        $post_date = $request->get('date') ? $request->get('date') : "";

        $postData = [];
        $postData['category'] = $post_category;
        $postData['price'] = $post_price;
        $postData['date'] = $post_date;

        if (!empty($post_category) || !empty($post_price) || !empty($post_date)) {
            $ideas = Idea::getSearchData($request)->paginate(10);
        } else {
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
     * 
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
     * @param array $request バリデーション通過したリクエストデータ
     * @var object $user ログインユーザー情報
     * @var object $postImg リクエストデータ（画像）
     * @var object $idea  newされた新規アイデアのインスタンス
     * @return Response アイデア一覧ページの表示
     */
    public function store(CreateIdeaRequest $request)
    {
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

        return redirect()->route('ideas.show', $idea->id)->with('flash_message', 'アイデアを投稿しました！');
    }

    /**
     * アイデアの編集メソッド
     * 
     * @param array $request バリデーション通過したリクエストデータ
     * @var object $ideas 対象アイデアデータ
     * @return Response アイデア編集ページの表示
     */
    public function edit($id)
    {
        $idea = Idea::find($id);

        //自分以外のユーザーがアクセスした場合は元の画面へ遷移
        if (Auth::id() !== Idea::find($id)->user->id) {
            return redirect()->back()->with('flash_message', __('権限がありません'));
        }

        //一人以上のユーザーが購入している場合は編集できない
        if ($idea->orders->count() > 0) {
            return redirect()->back()->with('flash_message', __('一人以上のユーザーに購入されています。編集はできません。'));
        }

        //数値以外が渡された場合は元の画面へ遷移
        if (!ctype_digit($id)) {
            return redirect()->back()->with('flash_message', __('もう一度やり直してください'));
        }


        return view('ideas.edit', [
            'idea' => $idea,
        ]);
    }

    /**
     * アイデアの更新メソッド
     *
     * @param array $request バリデーション通過したリクエストデータ
     * @var object $user ログインユーザー情報
     * @var object $postImg リクエストデータ
     * @var boolean $deleteFlg リクエストデータ（削除フラグ）
     * @var object $idea  newされた新規アイデアのインスタンス
     * @return Response アイデア一覧ページの表示
     */
    public function update(CreateIdeaRequest $request, $id)
    {
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

        return redirect()->route('ideas.show', $id)->with('flash_message', 'アイデアを投稿しました！');
    }

    /**
     * アイデア詳細ページへアクセスする
     *
     * @param int $id アイデアid
     * @var object $idea アイデアデータ
     * @var array $reviews アイデアのレビュー
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
     * @param int $id アイデアid
     * @var object $idea アイデアデータ
     * @return int アイデアのいいね数
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

    /**
     * いいね削除
     *
     * @param int $id アイデアid
     * @var object $idea アイデアデータ
     * @return int アイデアのいいね数
     */
    public function unlike(Request $request, $id)
    {
        $idea = Idea::find($id);
        $idea->likes()->detach($request->user()->id);

        return [
            'countLikes' => $idea->count_likes,
        ];
    }

    /**
     * アイデア購入
     *
     * @param int $id アイデアid
     * @var object $idea アイデアデータ
     * @var object $order 注文データ
     * @return Response アイデア詳細ページの表示
     */
    public function buy(Request $request, $id)
    {
        //数値以外が渡された場合は元の画面へ遷移
        if (!ctype_digit($id)) {
            return redirect()->back()->with('flash_message', __('もう一度やり直してください'));
        }

        //自分以外のユーザーがアクセスした場合は元の画面へ遷移
        $idea = Idea::find($id);
        if ($idea->user->id === Auth::user()->id) {
            return redirect()->route('ideas.show', $id)->with('flash_message', '自分のアイデアは購入できません。');
        }

        $idea->orders()->attach($request->user()->id);

        //購入者にメール送信する
        $order = Order::latest()->first();
        User::find($order->user_id)->buyEmail($order);
        User::find($order->ideas->user_id)->saleEmail($order);

        return redirect()->route('ideas.show', $id)->with('flash_message', 'アイデアを購入しました！');
    }

    /**
     * アイデア削除
     *
     * @param int $id アイデアid
     * @var object $idea アイデアデータ
     * @return Response アイデア一覧ページの表示
     */
    public function delete($id)
    {
        $idea = Idea::find($id);

        //自分以外のユーザーがアクセスした場合は元の画面へ遷移
        if (Auth::id() !== Idea::find($id)->user->id) {
            return redirect()->back()->with('flash_message', __('権限がありません'));
        }

        //一人以上のユーザーが購入している場合は編集できない
        if ($idea->orders->count() > 0) {
            return redirect()->back()->with('flash_message', __('一人以上のユーザーに購入されています。編集はできません。'));
        }

        //数値以外がpostされた場合は元の画面へ遷移
        if (!ctype_digit($id)) {
            return redirect()->back()->with('flash_message', __('もう一度やり直してください'));
        }

        $idea->delete(); // softDelete

        return redirect()->route('ideas.index')->with('flash_message', 'アイデアを削除しました！');
    }
}
