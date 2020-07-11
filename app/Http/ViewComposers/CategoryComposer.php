<?php

namespace inspiration\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Auth\Guard;
use inspiration\Category;

class CategoryComposer
{
    public function __construct()
    {
        //
    }

    /**
     * カテゴリー情報の取得メソッド
     * 
     * @param object $view viewファイルデータ
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', Category::all());
    }
}
