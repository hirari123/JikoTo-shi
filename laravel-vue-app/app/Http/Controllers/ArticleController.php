<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // ポリシーの使用を設定
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }


    // 記事モデルから記事情報を取得
    public function index()
    {
        $articles = Article::all()->sortByDesc('created_at');

        return view('articles.index', ['articles' => $articles]);
    }

    // 記事投稿画面
    public function create()
    {
        return view('articles.create');
    }

    // 記事登録処理
    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = $request->user()->id;
        $article->save();
        return redirect()->route('articles.index');
    }

    // 記事更新処理
    public function edit(Article $article)
    {
        return view('articles.edit', ['article'=>$article]);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all())->save();
        return redirect()->route('articles.index');
    }

    // 記事削除処理
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }

    // 記事詳細表示
    public function show(Article $article)
    {
        return view('articles.show', ['article'=>$article]);
    }

    // いいね機能
    public function like(Request $request, Article $article)
    {
        // likesテーブルのレコードを削除
        $article->likes()->detach($request->user()->id);
        // likesテーブルのレコードを新規作成
        $article->likes()->attach($request->user()->id);

        return [
            'id'=>$article->id,
            'countLikes'=>$article->count_likes,
        ];
    }

    public function unlink(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id'=>$article->id,
            'countLikes'=>$article->count_likes,
        ];
    }
}
