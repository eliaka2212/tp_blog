<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:255',
            'article_id' => 'required|exists:articles,id',
        ]);

        Comment::create([
            'content' => $validatedData['content'],
            'article_id' => $validatedData['article_id'],
            'user_id' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Commentaire ajouté avec succès !');
    }
}
