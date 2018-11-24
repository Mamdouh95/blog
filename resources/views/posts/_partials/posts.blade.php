@foreach($posts as $post)
    <div class="card mb-3">
        <div class="card-header">{{ $post->title }} - {{ $post->user->name }}</div>
        <div class="card-body">
            {{ $post->body }}
        </div>
    </div>
@endforeach
{{ $posts->links('posts.paginator', ['container' => 'posts-container']) }}