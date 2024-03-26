<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function list()
    {
        $articles = Article::latest()->paginate(4);
        return view('main.article.list', compact('articles'));
    }

    public function detail(Article $article)
    {
        $articles = Article::latest()->whereNot('id', $article->id)->take(4)->get();
        $articleBefore = Article::where('id', '<', $article->id)->orderBy('id', 'desc')->first();
        $articleAfter = Article::where('id', '>', $article->id)->orderBy('id')->first();

        return view('main.article.detail', compact('articles', 'article', 'articleBefore', 'articleAfter'));
    }
}
