<?php

namespace inspiration;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 注文テーブルのモデルクラス
 */
class Idea extends Model
{
    /**
     * 削除済みユーザー以外を表示する
     */
    use SoftDeletes;

    protected $table = 'ideas';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title', 'category_id', 'description', 'body', 'price'
    ];

    /**
     * アイデアに紐づくユーザー情報
     *
     * @return object
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('inspiration\User');
    }

    /**
     * アイデアと気になるに多対多で紐づくユーザー情報
     *
     * @return object
     */
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('inspiration\User', 'likes')->withTimestamps();
    }

    /**
     * アイデアに紐づくカテゴリー情報
     *
     * @return object
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo('inspiration\Category');
    }

    /**
     * アイデアに紐づくカテゴリー情報
     *
     * @return array
     */
    public function categories()
    {
        return $this->belongsTo('inspiration\Category', 'category_id', 'id', 'category_id');
    }

    /**
     * アイデアが特定のユーザーの気になるリストに入っているかどうかの判定
     *
     * @return boolean
     */
    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool) $this->likes->where('id', $user->id)->count()
            : false;
    }

    /**
     * アイデアと注文に多対多で紐づくユーザー情報
     *
     * @return object
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany('inspiration\User', 'orders')->withTimestamps();
    }

    /**
     * アイデアを特定のユーザーが購入済みかどうかの判定
     *
     * @return boolean
     */
    public function isOrderedBy(?User $user): bool
    {
        return $user
            ? (bool) $this->orders->where('id', $user->id)->count()
            : false;
    }

    /**
     * アイデアに紐づくレビュー情報
     *
     * @return object
     */
    public function reviews(): HasMany
    {
        return $this->hasMany('inspiration\Review');
    }

    /**
     * アイデアに特定のユーザーがレビュー済みかどうかの判定
     *
     * @return boolean
     */
    public function isReviewedBy(?User $user): bool
    {
        return $user
            ? (bool) $this->reviews->where('user_id', $user->id)->count()
            : false;
    }


    /**
     * アイデアに気になるリスト登録数取得メソッド
     *
     * @return int
     */
    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

    /**
     * アイデア一覧ページでの検索結果取得メソッド
     *
     * @param object $request アイデアモデル
     * @var object $ideas アイデアモデルのクエリ
     * @var object $categorieIds リクエストデータ（カテゴリー）
     * @var object $price_from リクエストデータ（最低金額）
     * @var object $price_untill リクエストデータ（最高金額）
     * @var object $date_from リクエストデータ（開始日）
     * @var object $date_untill リクエストデータ（終了日）
     * @return object
     */
    public static function getSearchData($request)
    {
        $ideas = Idea::query();

        if (!empty($request->get('category'))) {
            $categorieIds = $request->get('category');
            $ideas->whereHas('categories', function ($query) use ($categorieIds) {
                $query->whereIn('category_id', $categorieIds);
            });
        }

        if (!empty($request->get('price'))) {
            $price_from = $request->price['from'] ? $request->price['from'] : "";
            $price_untill = $request->price['untill'] ? $request->price['untill'] : "";

            if (!empty($price_from) && !empty($price_untill)) {
                $ideas->whereBetween("price", [$price_from, $price_untill]);
            } else if (!empty($price_from)) {
                $ideas->where("price", '>=', $price_from);
            } else if (!empty($price_untill)) {
                $ideas->where("price", '<=', $price_untill);
            }
        }

        if (!empty($request->get('date'))) {
            $date_from = $request->date['from'] ? $request->date['from'] : "";
            $date_untill = $request->date['untill'] ? $request->date['untill'] : "";

            if (!empty($date_from) && !empty($date_untill)) {
                $ideas->whereBetween("created_at", [$date_from, $date_untill]);
            } else if (!empty($date_from)) {
                $ideas->where("created_at", '>=', $date_from);
            } else if (!empty($date_untill)) {
                $ideas->where("created_at", '<=', $date_untill);
            }
        }

        return $ideas;
    }
}
