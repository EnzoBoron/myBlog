<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = ['user_id', 'comment_id', 'type'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comment() {
        return $this->belongsTo(Comment::class);
    }
}
