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