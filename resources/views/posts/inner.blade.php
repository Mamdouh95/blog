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
                @include('posts._partials.post', compact('post'))
                <div>
                    <h5>Comments</h5>
                    <ul class="list-unstyled" id="comments">
                        @include('comment.comments', compact('comments', 'post'))
                    </ul>
                </div>
                <div class="p-2 mb-3 bg-whitesmoke card">
                <form method="POST" action="{{ route('comment.store', ['post' => $post]) }}" id="commentPost">
                    @csrf
                    <div class="form-group">
                        <textarea id="body" type="text" class="form-control" placeholder="Type your comment here.." name="body"></textarea>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-outline-dark post">Comment</button>
                    </div>
                </form>
            </div>

        </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/posts.js') }}"></script>
@endsection
