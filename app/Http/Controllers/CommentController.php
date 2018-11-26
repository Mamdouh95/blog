<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        if ($post->target != Auth::user()->gender) {
            return response()->json(['status' => 'error'], 403);
        }
        $comment = Comment::create(array_merge($request->only('body'), ['post_id' => $post->id, 'user_id' => Auth::id()]));
        $commentCard = View::make('comment.comment')->with('comment', $comment)->render();
        return response()->json(['status' => 'success', 'comment' => $commentCard], 200);
    }
}
