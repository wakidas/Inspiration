<?php

namespace inspiration\Http\Controllers;

use inspiration\Review;
use inspiration\User;
use inspiration\Http\Requests\CreateReviewRequest;

/**
 * レビュー用コントローラー
 * 
 * レビューのCRUDに関連するメソッド群を記載
 */
class ReviewsController extends Controller
{
    /**
     * レビューの新規登録メソッド
     *
     * @param array $request バリデーション通過したリクエストデータ
     * @var object $review 新規登録するレビュー
     * @return Response アイデア詳細ページの表示
     */
    public function store(CreateReviewRequest $request)
    {
        $review = new Review();
        $review->fill($request->all());
        $review->idea_id = $request->idea_id;
        $review->user_id = $request->user_id;
        $review->save();

        User::find($review->idea->user_id)->postReview($review);

        return redirect()->back()->with('flash_message', 'レビューを投稿しました！');
    }
}
