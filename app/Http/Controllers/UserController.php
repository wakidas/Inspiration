<?php

namespace inspiration\Http\Controllers;

use Illuminate\Http\Request;
use inspiration\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    
    /**
     * ユーザー詳細ページへアクセスする
     *
     * @var array $ideas ユーザーが投稿したアイデア一覧
     * @return Response ユーザー詳細ページの表示
     */
    public function show($id)
    {
        $user = User::find($id);
        $ideas = $user->ideas;
        $isAuthCheck = Auth::id() === $user->id;
        
        return view('users.show', [
            'user' => $user,
            'ideas' => $ideas,
            'isAuthCheck' => $isAuthCheck,
        ]);
    }

    public function delete($id)
    {
        User::find($id)->delete(); // softDelete

        return redirect()->route('/');
    }
}
