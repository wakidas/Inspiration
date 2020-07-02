<?php

namespace inspiration;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'categories';

    public function ideas()
    {
        return $this->belongsToMany('inspiration\Idea');
    }
}
