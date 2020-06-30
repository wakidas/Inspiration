<?php

namespace inspiration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'rate', 'comment'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('inspiration\User');
    }
    public function idea(): BelongsTo
    {
        return $this->belongsTo('inspiration\Idea');
    }
    public function ideas()
    {
        return $this->belongsTo('inspiration\Idea', 'idea_id', 'id');
    }
    public function users()
    {
        return $this->belongsTo('inspiration\User', 'user_id', 'id');
    }
}
