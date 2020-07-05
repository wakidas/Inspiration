<?php

namespace inspiration;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function ideas()
    {
        return $this->belongsTo('inspiration\Idea', 'idea_id', 'id');
    }
    public function idea()
    {
        return $this->belongsTo('inspiration\Idea');
    }
}
