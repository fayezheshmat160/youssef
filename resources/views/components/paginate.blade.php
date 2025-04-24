
@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">{!! trans('pagination.previous') !!}</a></li>
        @endif


        <li class="pages">
            {{ trans('pagination.page') . ' ' . $paginator->currentPage() . ' ' . trans('pagination.of') . ' ' . $paginator->lastPage() }}
        </li>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">{!! trans('pagination.next') !!}</a></li>
        @endif
    </ul>
@endif
