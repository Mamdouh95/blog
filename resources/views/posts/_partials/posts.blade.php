@foreach($posts as $post)
    @include('posts._partials.post', compact('post'))
@endforeach
{{ $posts->links('posts.paginator', ['container' => 'posts-container']) }}