<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

// タグ別記事一覧画面のアクションメソッド
class TagController extends Controller
{
    public function show(string $name)
    {
        $tag = Tag::where('name', $name)->first();

        return view('tags.show', ['tag' => $tag]);
    }

}
