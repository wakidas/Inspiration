<?php

namespace inspiration\Http\Controllers;

use Illuminate\Http\Request;
use inspiration\Http\Requests\CreateUserRequest;
use inspiration\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $this_user = User::find($id);
        $ideas = $this_user->ideas;
        $isAuthCheck = Auth::id() === $this_user->id;

        return view('users.show', [
            'this_user' => $this_user,
            'ideas' => $ideas,
            'isAuthCheck' => $isAuthCheck,
        ]);
    }

    /**
     * ユーザーの編集メソッド
     * 
     * @var array $user ユーザー
     * @return Response アイデア編集ページの表示
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * ユーザーの更新メソッド
     * 
     * @var array $user ユーザー
     * @return Response ユーザー詳細ページの表示
     */
    public function update(CreateUserRequest $request, $id)
    {
        Log::debug('$request');
        Log::debug($request);

        $user = User::find($id);
        $user->name = $request->name;
        $user->comment = $request->comment;
        $postImg = $request->img;
        $deleteFlg = $request->deleteFlg;

        if ($postImg) {
            Storage::delete('public/' . $user->img);
            $path = $postImg->store('public/user_images');
            $user->img = str_replace('public/', '', $path);
        }
        if ($deleteFlg) {
            Storage::delete('public/' . $user->img);
            $user->img = null;
        }

        $user->save();
        return redirect()->route('users.show', $id)->with('flash_message', 'プロフィールを更新しました！');
    }


    public function deleteConfirm()
    {
        return view('users.deleteConfirm');
    }

    public function delete($id)
    {
        User::find($id)->delete(); // softDelete

        return redirect()->route('users.delete.complete');
    }

    public function deleteComplete()
    {
        return view('users.deleteComplete');
    }
}
