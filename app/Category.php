<?php

namespace inspiration;

use Illuminate\Database\Eloquent\Model;

/**
 * カテゴリーテーブルのモデルクラス
 */
class Category extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * カテゴリーに紐づくアイデア情報
     */
    public function ideas()
    {
        return $this->belongsToMany('inspiration\Idea');
    }
}
