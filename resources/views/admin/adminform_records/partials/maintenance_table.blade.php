<div class="am-table-wrap">
    <table class="am-table" id="amMrTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>Date</th>
                <th>Item</th>
                <th>Activity</th>
                <th>Location</th>
                <th>Performed By</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mainrecord as $index => $data)
                <tr>
                    <td><span class="am-cell-sub">#{{ $mainrecord->firstItem() + $index }}</span></td>
                    <td><span class="am-chip info">{{ date('d M Y', strtotime($data->mrdate)) }}</span></td>
                    <td><span class="am-cell-primary">{{ $data->mritem }}</span></td>
                    <td>{{ $data->mractivity }}</td>
                    <td>{{ $data->mlocation }}</td>
                    <td>{{ $data->mractivityperofrmby }}</td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='amMrView(@json($data))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='amMrEdit(@json($data))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ route('deletemaintanceRecAdmin') }}"
                                    data-id="{{ $data->id }}"
                                    data-label="Record on {{ date('d M Y', strtotime($data->mrdate)) }}"
                                    data-type="Maintenance Record">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7"><div class="am-empty"><i class="fa fa-wrench"></i><p>No maintenance records added yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $mainrecord->firstItem() ?? 0 }}–{{ $mainrecord->lastItem() ?? 0 }}</strong> of <strong>{{ $mainrecord->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($mainrecord->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $mainrecord->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $mainrecord->currentPage();
            $last    = $mainrecord->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($mainrecord->hasMorePages())
            <button data-page="{{ $mainrecord->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
