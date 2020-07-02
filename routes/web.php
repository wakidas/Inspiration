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
    Route::get('/mypage', 'MypageController@index')->name('mypage');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/{id}/edit', 'UserController@edit')->name('edit');
        Route::post('/{id}/edit', 'UserController@update')->name('update');
        Route::get('/delete/{id}', 'UserController@delete')->name('delete');
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
    });
    
    //プレフィックス：comments
    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::post('/create', 'ReviewsController@store')->name('store');
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
});