<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;

class PublicController extends Controller
{
    public function index(User $user)
    {
        // On récupère les articles publiés de l'utilisateur
        $articles = Article::where('user_id', $user->id)->where('draft', 0)->get();

        // On retourne la vue
        return view('public.index', [
            'articles' => $articles,
            'user' => $user
        ]);
    }

    public function show(User $user, Article $article)
    {
        // On vérifie que l'article appartient à l'utilisateur et qu'il est publié
        if ($article->user_id !== $user->id || $article->draft) {
            abort(404);
        }

        // On retourne la vue
        return view('public.show', [
            'article' => $article,
            'user' => $user
        ]);
    }
}
