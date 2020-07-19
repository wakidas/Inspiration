<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Auth::routes();
// =================================================
//ログインユーザーのみ
// =================================================
Route::group(['middleware' => 'auth'], function () {

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/{id}/edit', 'UserController@edit')->name('edit');
        Route::post('/{id}/edit', 'UserController@update')->name('update');
        Route::post('/delete/{id}', 'UserController@delete')->name('delete');
        Route::get('/delete/confirm', 'UserController@deleteConfirm')->name('delete.confirm');
    });

    //プレフィックス：ideas
    Route::prefix('ideas')->name('ideas.')->group(function () {
        Route::get('/create', 'IdeasController@create')->name('create');
        Route::post('/create', 'IdeasController@store')->name('store');
        Route::get('/{id}/edit', 'IdeasController@edit')->name('edit');
        Route::post('/{id}/edit', 'IdeasController@update')->name('update');
        Route::put('/{id}/like', 'IdeasController@like')->name('like');
        Route::delete('/{id}/like', 'IdeasController@unlike')->name('unlike');
        Route::post('/{id}/buy', 'IdeasController@buy')->name('buy');
        Route::post('/{id}/delete', 'IdeasController@delete')->name('delete');
    });

    //プレフィックス：comments
    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::post('/create', 'ReviewsController@store')->name('store');
    });

    //プレフィックス：mypage
    Route::prefix('mypage')->name('mypage.')->group(function () {
        Route::get('/', 'MypageController@index')->name('index');
        Route::get('/settings', 'MypageController@settings')->name('settings');
        Route::get('/boughts', 'MypageController@boughts')->name('boughts');
        Route::get('/likes', 'MypageController@likes')->name('likes');
        Route::get('/myIdeas', 'MypageController@myIdeas')->name('myIdeas');
        Route::get('/reviews', 'MypageController@reviews')->name('reviews');
    });

    //パスワード変更
    Route::get('changepassword', 'ChangePasswordController@index');
    Route::post('changepassword', 'ChangePasswordController@changePassword')->name('changepassword');

    // メールアドレス確認メールを送信
    Route::get('/changeEmail', 'ChangeEmailController@index')->name('changeEmail');
    Route::get('/reset/{token}', 'ChangeEmailController@reset');
    Route::post('/email', 'ChangeEmailController@sendChangeEmailLink');
});

// =================================================
//未ログインユーザー閲覧可
// =================================================
Route::prefix('ideas')->name('ideas.')->group(function () {
    Route::get('/', 'IdeasController@index')->name('index');
    Route::post('/', 'IdeasController@index')->name('index');
    Route::get('/{id}', 'IdeasController@show')->name('show');
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{id}', 'UserController@show')->name('show');
    Route::get('/delete/complete', 'UserController@deleteComplete')->name('delete.complete');
});
