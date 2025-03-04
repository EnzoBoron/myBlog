<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index($id) {
        $user = auth()->user();
        $article = Article::with('comments.user')->findOrFail($id);
        return view('article', compact('article', 'user'));
    }

    public function destroy(Article $article) {
        $article->delete();

        return redirect("/dashboard")->with("success", "Article supprimer avec succes");
    }
}
