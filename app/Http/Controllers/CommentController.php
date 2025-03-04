<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManager;

use Intervention\Image\Drivers\Gd\Driver;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;

class CommentController extends Controller
{
    public function store(Request $request, Article $article) {       
        $request->validate([
            'content' => 'nullable|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (!$request->filled('content') && !$request->hasFile('image')) {
            return back()->with(['error' => 'Vous devez envoyer soit un texte, soit une image, soit les deux.']);
        }

        $image_path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Redimensionner l'image
            $manager = new ImageManager(new Driver());
            $imageResized = $manager->read($image->getPathname())->scale(width: 150);

            $destinationPath = public_path('storage/app/public/messages');

            // Créer le dossier s'il n'existe pas
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            // Sauvegarder l'image redimensionnée
            $imageResized->save($destinationPath . '/' . $imageName);

            // Définir le chemin à stocker en BDD
            $image_path = 'app/public/messages/' . $imageName;
        }

        Comment::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'article_id' => $article->id,
            'image_path' => $image_path,
        ]);

        return back()->with('success', 'Commentaire ajouté avec succès');
    }

    public function destroy(Comment $comment) {
        $comment->delete();

        return back()->with('success', 'Commentaire supprimé avec succes');
    }
}
