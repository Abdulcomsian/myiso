<div class="am-msg-list">
    @forelse ($users as $item)
        <a href="{{ route('individualMessage', ['id' => $item->user_id]) }}" class="am-msg-item">
            <span class="am-avatar">
                {{ strtoupper(substr($item->name ?? 'U', 0, 1)) }}
            </span>
            <div class="am-msg-item__body">
                <p class="am-msg-name">{{ $item->name ?? 'Unknown' }}</p>
                <p class="am-msg-preview">{{ $item->company_name ?? '' }}</p>
            </div>
            <div class="am-msg-meta">
                <span class="am-msg-time">
                    {{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}
                </span>
                <i class="fa fa-chevron-right am-msg-chevron"></i>
            </div>
        </a>
    @empty
        <div class="am-empty" style="padding:60px 20px;">
            <i class="fa fa-paper-plane"></i>
            <p>No conversations found.</p>
        </div>
    @endforelse
</div>

@if($users->hasPages() || $users->total() > 0)
<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }}</strong> of <strong>{{ number_format($users->total()) }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($users->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $users->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif

        @php
            $current = $users->currentPage();
            $last = $users->lastPage();
            $start = max(1, $current - 2);
            $end = min($last, $start + 4);
            $start = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor

        @if ($users->hasMorePages())
            <button data-page="{{ $users->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
@endif
