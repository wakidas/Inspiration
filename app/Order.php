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
        return $this->belongsToMany('inspiration\Ideas');
    }
    public function users()
    {
        return $this->belongsToMany('inspiration\User');
    }
}
