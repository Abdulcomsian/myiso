<div class="am-table-wrap">
    <table class="am-table" id="amIpTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>Interested Party</th>
                <th>Needs &amp; Expectations</th>
                <th>Created</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($interested as $index => $data)
                <tr>
                    <td><span class="am-cell-sub">#{{ $interested->firstItem() + $index }}</span></td>
                    <td><span class="am-cell-primary">{{ $data->interested_party }}</span></td>
                    <td>{{ $data->needs }}</td>
                    <td><span class="am-chip info">{{ date('d M Y', strtotime($data->created_at)) }}</span></td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='amIpView(@json($data))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='amIpEdit(@json($data))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ route('deleteInterested') }}"
                                    data-id="{{ $data->id }}"
                                    data-label="{{ $data->interested_party }}"
                                    data-type="Interested Party">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5"><div class="am-empty"><i class="fa fa-users"></i><p>No interested parties added yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $interested->firstItem() ?? 0 }}–{{ $interested->lastItem() ?? 0 }}</strong> of <strong>{{ $interested->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($interested->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $interested->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif

        @php
            $current = $interested->currentPage();
            $last    = $interested->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor

        @if ($interested->hasMorePages())
            <button data-page="{{ $interested->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
