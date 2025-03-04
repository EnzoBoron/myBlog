<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index() {
        $user = auth()->user();
        $articles = Article::with('comments.user')->cursorPaginate(6);
        return view('index', ['articles' => $articles, 'user' => $user]);
    }

    public function look() {
        return view('addBlog');
    }

    public function create(Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        Article::create([
            'user_id' => Auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Article ajouté avec succès !');
    }

    
}
