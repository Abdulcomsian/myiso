<div class="am-table-wrap">
    <table class="am-table" id="amMgtTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>Date</th>
                <th>Attendees</th>
                <th>Planned Objectives</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($userData as $index => $item)
                <tr>
                    <td><span class="am-cell-sub">#{{ $userData->firstItem() + $index }}</span></td>
                    <td><span class="am-chip info">{{ date('d M Y', strtotime($item->reviewdate)) }}</span></td>
                    <td>{{ Str::limit($item->meetingatt, 80) }}</td>
                    <td>{{ Str::limit($item->newquality, 80) }}</td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='amMgtView(@json($item))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='amMgtEdit(@json($item))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ route('deletemgtreview') }}"
                                    data-id="{{ $item->id }}"
                                    data-label="Review from {{ date('d M Y', strtotime($item->reviewdate)) }}"
                                    data-type="Management Review">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5"><div class="am-empty"><i class="fa fa-chart-line"></i><p>No management reviews recorded yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $userData->firstItem() ?? 0 }}–{{ $userData->lastItem() ?? 0 }}</strong> of <strong>{{ $userData->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($userData->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $userData->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $userData->currentPage();
            $last    = $userData->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($userData->hasMorePages())
            <button data-page="{{ $userData->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
