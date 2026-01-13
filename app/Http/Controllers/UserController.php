<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
{
    return view('articles.create');
}
public function store(Request $request)
{
    
    $data = $request->only(['title', 'content', 'draft']);

    
    $data['user_id'] = Auth::user()->id;

    
    $data['draft'] = isset($data['draft']) ? 1 : 0;

    
    $article = Article::create($data); 
    return redirect()->route('dashboard');
}
public function index()
{
    
    $user = Auth::user();
    $articles = Article::where('user_id', $user->id)->get();
    return view('dashboard', ['articles' => $articles]);
}
public function edit(Article $article)
{
    
    if ($article->user_id !== Auth::user()->id) {
        abort(403);
    }

    
    return view('articles.edit', [
        'article' => $article
    ]);
}
public function update(Request $request, Article $article)
{
    
    if ($article->user_id !== Auth::user()->id) {
        abort(403);
    }


    $data = $request->only(['title', 'content', 'draft']);

   
    $data['draft'] = isset($data['draft']) ? 1 : 0;

    
    $article->update($data);

   
    return redirect()->route('dashboard')->with('success', 'Article mis à jour !');
}
public function remove(Article $article)
{
    
    if ($article->user_id !== Auth::user()->id) {
        abort(403);
    }

    
    $article->delete();

    
    return redirect()->route('dashboard')->with('success', 'Article supprimé !');
}
}