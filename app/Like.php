<?php

namespace inspiration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 気になるリストテーブルのモデルクラス
 */
class Like extends Model
{
    /**
     * 気になるリストデータに紐づくアイデア情報
     *
     * @return array
     */
    public function ideas(): BelongsTo
    {
        return $this->belongsTo('inspiration\Idea', 'idea_id', 'id');
    }

    /**
     * 気になるリストデータに紐づくアイデア情報
     *
     * @return object
     */
    public function idea(): BelongsTo
    {
        return $this->belongsTo('inspiration\Idea');
    }
}
