@foreach($comments as $comment)
    @include('comment.comment', compact('comment'))
@endforeach

{{ $comments->links('vendor.paginator', ['container' => 'comments']) }}