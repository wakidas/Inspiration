<?php

namespace inspiration\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Auth\Guard;

class UserComposer
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * ログインユーザー 情報の取得メソッド
     * 
     * @param object $view viewファイルデータ
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('user', $this->auth->user());
    }
}
