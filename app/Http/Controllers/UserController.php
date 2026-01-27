<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
{
    $categories = Category::all();
    return view('articles.create', ['categories' => $categories]);
}
public function store(Request $request)
{
    
    $data = $request->only(['title', 'content', 'draft']);

    
    $data['user_id'] = Auth::user()->id;

    
    $data['draft'] = isset($data['draft']) ? 1 : 0;

    
    $article = Article::create($data);
    $article->categories()->sync($request->input('categories'));
 
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
        'article' => $article,
        'categories' => Category::all()
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
    $article->categories()->sync($request->input('categories'));

   
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