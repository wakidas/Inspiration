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
}
