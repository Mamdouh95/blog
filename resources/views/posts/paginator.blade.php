@if ($paginator->hasPages() and $paginator->hasMorePages())
    <div class="justify-content-center" align="center">
        <img src="{{ asset('images/loader.gif') }}" class="loader" style="display: none">
        <button data-container-id="{{ $container }}" data-url="{{ $paginator->nextPageUrl() }}" class="btn btn-dark paginate">Load more</button>
    </div>
@endif