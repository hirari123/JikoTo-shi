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

// 認証関連
Auth::routes();

// 記事一覧へアクセス,ルーティングへの名前付け(name)
Route::get('/', 'ArticleController@index')->name('articles.index');

// リソースルートからの特定のルーティングの除外(except)
// 未ログインユーザーに記事投稿画面を非表示
Route::resource('/articles', 'ArticleController')->except(['index', 'show'])->middleware('auth');

// 未ログインユーザーでも記事詳細画面を見れるようにする
Route::resource('/articles', 'ArticleController')->only(['show']);

// ゲストログイン機能
Route::get('login/guest', 'Auth\LoginController@guestLogin')->name('login.guest');

// 「いいね」機能
Route::prefix('articles')->name('articles.')->group(function() {
  Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
  Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
});

// タグ別記事一覧画面のルーティングを定義する
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

// ユーザーページ
Route::prefix('users')->name('users.')->group(function() {
  Route::get('/{name}', 'UserController@show')->name('show');

  // いいねタブが押された場合のユーザーページ表示
  Route::get('/{name}/likes', 'UserController@likes')->name('likes');

  Route::get('/{name}/followings', 'UserController@followings')->name('followings');
  Route::get('/{name}/followers', 'UserController@followers')->name('followers');

  // フォロー機能のルーティングを追加
  Route::middleware('auth')->group(function() {
    Route::put('/{name}/follow', 'UserController@follow')->name('follow');
    Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
  });
});
