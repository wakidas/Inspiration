<?php

namespace inspiration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * レビューテーブルのモデルクラス
 */
class Review extends Model
{
    protected $fillable = [
        'rate', 'comment'
    ];

    /**
     * レビュー投稿者のユーザー情報
     *
     * @return object
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('inspiration\User');
    }

    /**
     * レビューに紐づくアイデア情報
     *
     * @return object
     */
    public function idea(): BelongsTo
    {
        return $this->belongsTo('inspiration\Idea');
    }

    /**
     * レビューに紐づくアイデア情報
     *
     * @return array
     */
    public function ideas(): BelongsTo
    {
        return $this->belongsTo('inspiration\Idea', 'idea_id', 'id');
    }

    /**
     * レビューに紐づくユーザー情報
     *
     * @return array
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo('inspiration\User', 'user_id', 'id');
    }
}
