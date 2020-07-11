<?php

namespace inspiration;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use inspiration\Notifications\PasswordResetNotification;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Support\Facades\Log;

/**
 * ユーザーテーブルのモデルクラス
 */
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

    /**
     * ユーザーに紐づくアイデア情報
     *
     * @return array
     */
    public function ideas(): HasMany
    {
        return $this->hasMany('inspiration\Idea');
    }

    /**
     * ユーザーに紐づく注文情報
     *
     * @return array
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany('inspiration\User', 'orders')->withTimestamps();
    }

    /**
     * ユーザーに紐づく注文情報
     *
     * @return array
     */
    public function hasOrders(): hasMany
    {
        return $this->hasMany('inspiration\Order');
    }

    /**
     * ユーザーに紐づく気になるリスト情報
     *
     * @return array
     */
    public function hasLikes(): hasMany
    {
        return $this->hasMany('inspiration\Like');
    }

    /**
     * ユーザーに紐づくレビュー情報
     *
     * @return array
     */
    public function hasReviews(): HasMany
    {
        return $this->hasMany('inspiration\Review');
    }

    /**
     * パスワードリセット通知の送信をオーバーライド
     *
     * @param  string  $token トークン
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }

    /**
     * アイデア購入者へメール送信するメソッド
     *
     * @param int $option 購入ユーザーid
     * @var object $order 購入された対象の注文データ
     * 
     * @return void
     */
    public function buyEmail($options)
    {
        $order = Order::with('users')->where('id', $options->id)->first()->users;
        $order->notify(new \inspiration\Notifications\BuyIdea());
    }

    /**
     * アイデア販売者へメール送信するメソッド
     *
     * @param int $option 販売ユーザーid
     * @var object $order 購入された対象の注文データ
     * 
     * @return void
     */
    public function saleEmail($options)
    {
        $order = Order::with('users')->where('id', $options->id)->first()->users;
        $order->notify(new \inspiration\Notifications\SaleIdea());
    }

    /**
     * レビュー投稿時アイデア販売者へメール送信するメソッド
     *
     * @param int $option 販売ユーザーid
     * @var object $order 投稿されたレビューデータ
     * 
     * @return void
     */
    public function postReview($options)
    {
        $review = Review::with('users')->where('id', $options->id)->first()->users;
        $review->notify(new \inspiration\Notifications\PostReview());
    }
}
