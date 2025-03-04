<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function store(Request $request, Comment $comment) {
        $request->validate(['type' => 'required']);

        $existingReaction = Reaction::where('user_id', auth()->id())
            ->where('comment_id', $comment->id)
            ->first();

        if ($existingReaction) {
            $existingReaction->update(['type' => $request->type]);
        } else {
            Reaction::create([
                'user_id' => auth()->id(),
                'comment_id' => $comment->id,
                'type' => $request->type,
            ]);
        }
        return back();
    }
}
