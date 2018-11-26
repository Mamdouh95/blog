<li class="media bg-white p-2 border rounded my-2">
    <img class="mr-3 my-2" width="80" src="{{ asset('images/avatar.png') }}" alt="Generic placeholder image">
    <div class="media-body">
        <h5 class="mt-0 mb-1">{{ $comment->user->name }}</h5>
        <p class="text-secondary">{{ $comment->body }}</p>
    </div>
</li>