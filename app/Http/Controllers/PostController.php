<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::with('user')->whereTarget(Auth::user()->gender)->orderBy('created_at', 'DESC')->paginate(10);
        if ($request->ajax()){
            return view('posts._partials.posts', compact('posts'));
        }
        return view('posts.index', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create(array_merge($request->only('title', 'body'), ['user_id' => Auth::id(), 'target' => User::$gender[Auth::user()->gender]]));
        $postCard = View::make('posts._partials.post')->with('post', $post)->render();
        return response()->json(['status' => 'success', 'post' => $postCard], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Post $post)
    {
        if($post->target != Auth::user()->gender) {
            abort(403);
        }
        $comments = $post->comments()->with('user')->paginate(5);
        if ($request->ajax()) {
            return view('comment.comments', compact('post', 'comments'));
        }
        return view('posts.inner', compact('post', 'comments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        if ($post->user_id != Auth::id()) {
            return response()->json(['status' => 'error'], 403);
        }
        $post->update($request->only('title', 'body'));
        $postCard = View::make('posts._partials.post')->with('post', $post)->render();
        return response()->json(['status' => 'success', 'postId' => $post->id, 'post' => $postCard], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            return response()->json(['status' => 'error'], 403);
        }
        $post->delete();
        return response()->json(['status' => 'success'], 200);
    }
}
