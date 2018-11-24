<div class="card mb-3 post-card">
    <div class="card-header">
        {{ $post->title }} - {{ $post->user->name }}
        @if($post->user->id == Auth::id())
            <a href="#" data-url="{{ route('posts.destroy', ['post' => $post]) }}" class="float-right deletePost"><span>&times;</span></a>
        @endif
    </div>
    <div class="card-body">
        {{ $post->body }}
    </div>
</div>