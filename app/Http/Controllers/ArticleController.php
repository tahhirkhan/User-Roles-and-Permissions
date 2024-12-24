<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware(): array {
        return [
            new Middleware('permission:view-articles', only: ['index']),
            new Middleware('permission:create-articles', only: ['create']),
            new Middleware('permission:edit-articles', only: ['edit']),
            new Middleware('permission:delete-articles', only: ['destroy']),
        ];
    }

    public function index()
    {
        $articles = Article::all();
        return view('article.index', [
            'articles' => $articles
        ]);
    }

    
    public function create()
    {
        return view('article.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'min:5'],
            'body' => ['required'],
        ]);

        $author = Auth::user()->name;
        // dd($author);

        Article::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'author' => $author,
        ]);

        return redirect()->route('all-articles');
    }

    
    public function show(string $id)
    {
        $article = Article::find($id);
        return view('article.show', [
            'article' => $article,
        ]);
    }

    
    public function edit(string $id)
    {
        $article = Article::find($id);
        return view('article.edit', [
            'article' => $article,
        ]);
    }

    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'min:5'],
            'body' => ['required'],
        ]);

        $article = Article::find($id); 

        $article->Update([
            'title' => $validated['title'],
            'body' => $validated['body'],
        ]);

        return redirect()->route('show-article', $id);
    }

    
    public function destroy(string $id)
    {
        $article = Article::find($id);
        $article->delete();

        session()->flash('success', 'Article Deleted!');
        return redirect()->route('all-articles');
    }
}
