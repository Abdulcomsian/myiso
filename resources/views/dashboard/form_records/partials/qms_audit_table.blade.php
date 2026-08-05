<div class="am-table-wrap">
    <table class="am-table" id="amQmsTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>QMS Audit</th>
                <th>Auditor</th>
                <th>Completed Date</th>
                <th>Comments</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($requirement as $index => $item)
                <tr>
                    <td><span class="am-cell-sub">#{{ $requirement->firstItem() + $index }}</span></td>
                    <td>
                        <span class="am-cell-primary">QMS Audit #{{ $item->QmsauditNumber ?? ($requirement->firstItem() + $index) }}</span>
                        <span class="am-cell-sub">{{ Str::limit($item->any_issues, 40) }}</span>
                    </td>
                    <td>{{ $item->auditrName ?? '—' }}</td>
                    <td><span class="am-chip info">{{ $item->competedDate ? date('d M Y', strtotime($item->competedDate)) : '—' }}</span></td>
                    <td>{{ Str::limit($item->audit_comments_actions, 60) }}</td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='amQmsView(@json($item))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='amQmsEdit(@json($item))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn" title="Download PDF" onclick="qmsfun({{ $item->id }})"><i class="fa fa-download"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ route('deleteqmsAudit') }}"
                                    data-id="{{ $item->id }}"
                                    data-label="QMS Audit #{{ $item->QmsauditNumber }}"
                                    data-type="QMS Audit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6"><div class="am-empty"><i class="fa fa-shield-alt"></i><p>No QMS audits recorded yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $requirement->firstItem() ?? 0 }}–{{ $requirement->lastItem() ?? 0 }}</strong> of <strong>{{ $requirement->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($requirement->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $requirement->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $requirement->currentPage();
            $last    = $requirement->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($requirement->hasMorePages())
            <button data-page="{{ $requirement->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
