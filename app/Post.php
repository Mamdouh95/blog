<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'target'];
    // <--- Accessors and Mutators -->

    // <--- Relations --->
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
