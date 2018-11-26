<div id="post{{ $post->id }}">
    <div class="card mb-3 post-card" id="post-card{{ $post->id }}">
        <div class="card-header">
            {{ $post->title }} - {{ $post->user->name }}
            @if($post->user->id == Auth::id())
                <a href="#" class="editPost" data-form="#editForm{{ $post->id }}">edit</a>
                <a href="#" data-url="{{ route('posts.destroy', ['post' => $post]) }}" class="float-right deletePost"><span>&times;</span></a>
            @endif
        </div>
        <div class="card-body">
            {{ $post->body }}
        </div>
    </div>

    @if($post->user->id == Auth::id())
        <div class="p-2 mb-3 bg-whitesmoke card editForm" id="editForm{{$post->id}}" style="display: none">
            <form method="POST" class="updatePost" action="{{ route('posts.update', ['post' => $post]) }}">
                @csrf
                @method('put')
                <div class="form-group">
                    <input id="title" type="text" class="form-control" value="{{ $post->title }}" placeholder="Write Post Title" name="title" required>
                </div>
                <div class="form-group">
                    <textarea id="body" type="text" class="form-control" placeholder="Write Post Body" name="body" required>{{ $post->body }}</textarea>
                </div>
                <div class="float-right">
                    <button type="button" class="btn btn-outline-danger editCancel" data-card="#post-card{{ $post->id }}">Cancel</button>
                    <button type="submit" class="btn btn-outline-dark">Save Changes</button>
                </div>
            </form>
        </div>
    @endif
</div>