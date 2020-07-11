<?php

namespace inspiration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 注文テーブルのモデルクラス
 */
class Order extends Model
{
    use Notifiable;

    /**
     * 注文データに紐づくアイデア情報
     *
     * @return object
     */
    public function ideas(): BelongsTo
    {
        return $this->belongsTo('inspiration\Idea', 'idea_id', 'id');
    }

    /**
     * 注文データに紐づくユーザー情報
     *
     * @return object
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo('inspiration\User', 'user_id', 'id');
    }
}
