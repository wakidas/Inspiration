<?php

namespace inspiration;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use inspiration\Notifications\PasswordResetNotification;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 削除済みユーザー以外を表示する
     */
    use SoftDeletes;

    protected $table = 'users';
    protected $dates = ['deleted_at'];


    public function ideas(): HasMany
    {
        return $this->hasMany('inspiration\Idea');
    }
    public function reviews(): HasOne
    {
        return $this->hasOne('inspiration\Review');
    }
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany('inspiration\User', 'orders')->withTimestamps();
    }

    /**
     * パスワードリセット通知の送信をオーバーライド
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }


    public function buyEmail($options)
    {
        Log::debug('<<<<<<<<  buyEmail  >>>>>>>>>');
        Log::debug('$options');
        Log::debug($options);

        $thisOrder = Order::join('users', 'orders.user_id', 'users.id')
            ->where('orders.id', $options->id)
            ->select('orders.id as o_id', 'name', 'email')
            ->first();
        $order = Order::with('ideas')->where('orders.id', $options->id)->first();
        Log::debug('$thisOrder');
        Log::debug($thisOrder);
        Log::debug('$order');
        Log::debug($order);
        $thisOrder->notify(new \inspiration\Notifications\BuyIdea());
    }
}
