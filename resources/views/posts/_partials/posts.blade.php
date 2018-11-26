@foreach($posts as $post)
    @include('posts._partials.post', compact('post'))
@endforeach
{{ $posts->links('vendor.paginator', ['container' => 'posts-container']) }}