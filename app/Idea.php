<?php

namespace inspiration;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    /**
     * 削除済みユーザー以外を表示する
     */
    use SoftDeletes;

    protected $table = 'ideas';
    protected $dates = ['deleted_at'];
}
