<?php

namespace inspiration;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Support\Facades\Log;

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

    public function user(): BelongsTo
    {
        //記事と記事を書いたユーザ＝は多対1の関係なのでその場合は「belongsTo」メソッドを使用する。
        return $this->belongsTo('inspiration\User');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('inspiration\User', 'likes')->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo('inspiration\Category');
    }

    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool) $this->likes->where('id', $user->id)->count()
            : false;
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany('inspiration\User', 'orders')->withTimestamps();
    }

    public function isOrderedBy(?User $user): bool
    {
        return $user
            ? (bool) $this->orders->where('id', $user->id)->count()
            : false;
    }

    public function reviews(): HasMany
    {
        return $this->hasMany('inspiration\Review');
    }


    public function categories()
    {
        return $this->belongsTo('inspiration\Category', 'category_id', 'id', 'category_id');
    }

    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

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
