<?php

namespace inspiration;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function ideas()
    {
        return $this->belongsToMany('inspiration\Idea');
    }
}
