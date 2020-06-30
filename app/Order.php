<?php

namespace inspiration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use Notifiable;

    public function ideas()
    {
        return $this->belongsTo('inspiration\Idea', 'idea_id', 'id');
    }
    public function users()
    {
        return $this->belongsTo('inspiration\User', 'user_id', 'id');
    }
}
