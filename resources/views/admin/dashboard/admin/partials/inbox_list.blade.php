<div class="am-msg-list">
    @forelse ($message_info as $item)
        @php
            $lastMessageDate = App\SendNotifications::where('send_to', $item->send_to)->where('send_by', $item->send_by)->orderBy('created_at', 'desc')->first();
            $when = $lastMessageDate ? \Carbon\Carbon::parse($lastMessageDate->created_at) : null;
        @endphp
        <a href="{{ route('individualMessage', ['id' => $item->user_id]) }}"
           class="am-msg-item {{ $item->status == 0 ? 'unread' : '' }}">
            <span class="am-avatar">
                {{ strtoupper(substr($item->name ?? 'U', 0, 1)) }}
            </span>
            <div class="am-msg-item__body">
                <p class="am-msg-name">{{ $item->name ?? 'Unknown user' }}</p>
                <p class="am-msg-preview">{{ $item->company_name ?? '' }}</p>
            </div>
            <div class="am-msg-meta">
                <span class="am-msg-time">
                    @if($when) {{ $when->diffForHumans() }} @endif
                </span>
                <i class="fa fa-chevron-right am-msg-chevron"></i>
            </div>
        </a>
    @empty
        <div class="am-empty" style="padding:60px 20px;">
            <i class="fa fa-inbox"></i>
            <p>No conversations found.</p>
        </div>
    @endforelse
</div>

@if($message_info->hasPages() || $message_info->total() > 0)
<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $message_info->firstItem() ?? 0 }}–{{ $message_info->lastItem() ?? 0 }}</strong> of <strong>{{ number_format($message_info->total()) }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($message_info->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $message_info->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif

        @php
            $current = $message_info->currentPage();
            $last = $message_info->lastPage();
            $start = max(1, $current - 2);
            $end = min($last, $start + 4);
            $start = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor

        @if ($message_info->hasMorePages())
            <button data-page="{{ $message_info->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
@endif
