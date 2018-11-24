@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Profile</div>
                    <div class="card-body">
                        You are logged in as {{ Auth::user()->name }}
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                {{-- Form --}}
                <div class="p-2 mb-3 bg-whitesmoke card">
                    <form method="POST" id="addPost">
                        @csrf
                        <div class="form-group">
                            <input id="title" type="text" class="form-control" placeholder="Write Post Title" name="title" required>
                        </div>
                        <div class="form-group">
                            <textarea id="body" type="text" class="form-control" placeholder="Write Post Body" name="body" required></textarea>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-outline-dark post">Post</button>
                        </div>
                    </form>
                </div>
                {{-- Posts --}}
                <div id="posts-container">
                    @include('posts._partials.posts', compact('posts'))
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            // Add Post
            $(document).on('submit', '#addPost', function (e) {
                e.preventDefault();
                const form = $('#addPost');
                const formData = form.serialize();
                $.ajax({
                    url: '{{ route('posts.store') }}',
                    type: 'POST',
                    data: formData,
                    success: function (data) {
                        if (data.status === 'success'){
                            $('#posts-container').prepend(data.post);
                            form.trigger("reset");
                        }
                    },
                    error: function(data, exception){
                        swalError(data, exception);
                    }
                })
            });
            // Edit Post
            // Delete Post
            $(document).on('click', '.deletePost', function (e) {
                e.preventDefault();
                const elem = $(this);
                const path = elem.attr('data-url');
                const post = elem.closest('.post-card');
                $.ajax({
                    url: path,
                    type: 'DELETE',
                    success: function (data) {
                        if (data.status === 'success'){
                            post.slideUp("normal", function(){ $(this).remove(); });
                        }
                    },
                    error: function (data, exception) {
                        swalError(data, exception);
                    }
                });
            })
            // Comment
        });
    </script>
@endsection
