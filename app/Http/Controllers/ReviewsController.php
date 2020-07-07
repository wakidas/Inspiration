<?php

namespace inspiration\Http\Controllers;

use Illuminate\Http\Request;
use inspiration\Review;
use inspiration\User;
use inspiration\Http\Requests\CreateReviewRequest;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

class ReviewsController extends Controller
{
    /**
     * レビューの新規登録メソッド
     *
     * @param array $request バリデーション通過したpostの内容
     * @var object $user ログインユーザー情報
     * @var object $postImg postされた画像の情報
     * @var object $idea  newされた新規アイデアのインスタンス
     * @return Response アイデア詳細ページの表示
     */
    public function store(CreateReviewRequest $request)
    {
        Log::debug('$request');
        Log::debug($request);

        $review = new Review();
        $review->fill($request->all());
        $review->idea_id = $request->idea_id;
        $review->user_id = $request->user_id;
        $review->save();

        User::find($review->idea->user_id)->postReview($review);

        return redirect()->back()->with('flash_message', 'レビューを投稿しました！');
    }
}
