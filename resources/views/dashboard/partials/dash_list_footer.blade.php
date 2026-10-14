{{-- The line under a dashboard card's list: how much of it you are looking at,
     the way through to the full page, and the pager.

     $paginator   the rows on show
     $viewAllUrl  the page this card is a window onto

     Same markup as the lists on the pages themselves, so the two read alike. --}}
<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $paginator->firstItem() ?? 0 }}–{{ $paginator->lastItem() ?? 0 }}</strong> of <strong>{{ $paginator->total() }}</strong>
        <a href="{{ $viewAllUrl }}" class="am-view-all">View all <i class="fa fa-arrow-right"></i></a>
    </div>
    <div class="am-pagination__nav">
        @if ($paginator->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $paginator->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $paginator->currentPage();
            $last    = $paginator->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($paginator->hasMorePages())
            <button data-page="{{ $paginator->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
