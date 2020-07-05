<?php

namespace inspiration;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use inspiration\Notifications\PasswordResetNotification;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany('inspiration\User', 'orders')->withTimestamps();
    }
    public function hasOrders() //: BelongsTo
    {
        return $this->hasMany('inspiration\Order');
    }

    public function hasLikes(): hasMany
    {
        return $this->hasMany('inspiration\Like');
    }
    public function hasReviews(): HasMany
    {
        return $this->hasMany('inspiration\Review');
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
        $order = Order::with('users')->where('id', $options->id)->first()->users;

        $order->notify(new \inspiration\Notifications\BuyIdea());
    }

    public function saleEmail($options)
    {
        Log::debug('<<<<<<<< User.php  saleEmail  >>>>>>>>>');
        Log::debug('$options');
        Log::debug($options);

        $order = Order::with('users')->where('id', $options->id)->first()->users;
        Log::debug('$order');
        Log::debug($order);
        $order->notify(new \inspiration\Notifications\SaleIdea());
    }

    public function postReview($options)
    {
        Log::debug('<<<<<<<< User.php  postReview  >>>>>>>>>');
        Log::debug('$options');
        Log::debug($options);

        $review = Review::with('users')->where('id', $options->id)->first()->users;
        Log::debug('$review');
        Log::debug($review);
        $review->notify(new \inspiration\Notifications\PostReview());
    }
}
