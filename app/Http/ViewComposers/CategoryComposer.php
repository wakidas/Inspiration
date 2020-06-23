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

    public function compose(View $view)
    {
        $view->with('categories', Category::all());
    }
}
