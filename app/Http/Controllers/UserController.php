<?php

namespace inspiration\Http\Controllers;

use inspiration\Http\Requests\CreateUserRequest;
use inspiration\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * ユーザー用コントローラー
 * 
 * ユーザーのCRUDに関連するメソッド群を記載
 */
class UserController extends Controller
{
    /**
     * ユーザー詳細ページへアクセスする
     *
     * @param int $id リクエストデータ
     * @var object $this_user ユーザーデータ
     * @var array $ideas ユーザーが投稿したアイデア一覧
     * @var boolean $isAuthCheck ユーザーが自分かどうかのチェック
     * @return Response ユーザー詳細ページの表示
     */
    public function show($id)
    {
        $this_user = User::find($id);

        //ユーザーが存在しないURLにアクセスした場合、404エラーを返す
        if ($this_user === null) {
            abort(404);
        }

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
     * @param int $id リクエストデータ
     * @var array $user ユーザーデータ
     * @return Response アイデア編集ページの表示
     */
    public function edit($id)
    {
        //自分以外のユーザーがアクセスした場合は元の画面へ遷移
        if (Auth::id() !== (int) $id) {
            return redirect()->back()->with('flash_message', __('権限がありません'));
        }

        //数値以外が渡された場合は元の画面へ遷移
        if (!ctype_digit($id)) {
            return redirect()->back()->with('flash_message', __('もう一度やり直してください'));
        }

        $user = User::find($id);

        return view('users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * ユーザーの更新メソッド
     * 
     * @param array $request リクエストデータ
     * @param int $id ユーザーid
     * @var array $user ユーザーデータ
     * @var array $postImg リクエストデータ（画像）
     * @var boolean $deleteFlg 画像削除フラグ
     * @return Response ユーザー詳細ページの表示
     */
    public function update(CreateUserRequest $request, $id)
    {
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

    /**
     * ユーザーの削除メソッド（確認画面）
     * 
     * @return Response ユーザー削除確認ページの表示
     */
    public function deleteConfirm()
    {
        return view('users.deleteConfirm');
    }

    /**
     * ユーザーの削除メソッド
     * 
     * @return Response ユーザー削除完了ページの表示
     */
    public function delete($id)
    {
        //自分以外のユーザーがアクセスした場合は元の画面へ遷移
        if (Auth::id() !== (int) $id) {
            return redirect()->back()->with('flash_message', __('権限がありません'));
        }

        //数値以外がpostされた場合は元の画面へ遷移
        if (!ctype_digit($id)) {
            return redirect()->back()->with('flash_message', __('もう一度やり直してください'));
        }

        User::find($id)->delete();

        return redirect()->route('users.delete.complete');
    }

    /**
     * ユーザーの削除メソッド（完了）
     * 
     * @return Response ユーザー削除完了ページの表示
     */
    public function deleteComplete()
    {
        return view('users.deleteComplete');
    }
}
