<div id="post{{ $post->id }}">
    <div class="card mb-3 post-card" id="post-card{{ $post->id }}">
        <div class="card-header">
            <h5 class="float-left">{{ $post->title }}</h5>
            @if($post->user->id == Auth::id())
                @if(Route::currentRouteName() != 'posts.show')
                    <div class="float-right">
                        <a href="#" title="Edit post" class="editPost mr-1" data-form="#editForm{{ $post->id }}"><i class="fa fa-edit"></i></a>
                        <a href="#" title="Delete this post" class="deletePost" data-url="{{ route('posts.destroy', ['post' => $post]) }}"><i class="fa fa-trash"></i></a>
                    </div>
                @endif
            @endif
        </div>
        <div class="card-body">
            {{ $post->body }}
            <hr>
            <div>
                Written by : {{ $post->user->name }}
                @if(Route::currentRouteName() != 'posts.show')
                    <div class="float-right">
                        <a href="{{ route('posts.show', ['post' => $post]) }}"><i class="fa fa-chevron-right"></i></a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{-- Edit form --}}
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