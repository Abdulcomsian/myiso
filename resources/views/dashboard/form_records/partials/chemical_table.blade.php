<div class="am-table-wrap">
    <table class="am-table" id="amChTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>Chemical</th>
                <th>Location</th>
                <th>Activity</th>
                <th>Status</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($chemical as $index => $data)
                <tr>
                    <td><span class="am-cell-sub">#{{ $chemical->firstItem() + $index }}</span></td>
                    <td>
                        <span class="am-cell-primary">{{ $data->chemical_name }}</span>
                        <span class="am-cell-sub">{{ Str::limit($data->chemical_desc, 50) }}</span>
                    </td>
                    <td>{{ $data->location_used }}</td>
                    <td>{{ Str::limit($data->activity_hazard, 60) }}</td>
                    <td>
                        @if ($data->still_used == 'Yes')
                            <span class="am-chip warning">In use</span>
                        @else
                            <span class="am-chip success">Legacy</span>
                        @endif
                    </td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='amChView(@json($data))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='amChEdit(@json($data))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ url('/chemical_control_delete') }}"
                                    data-id="{{ $data->id }}"
                                    data-label="{{ $data->chemical_name }}"
                                    data-type="Chemical Record">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6"><div class="am-empty"><i class="fa fa-flask"></i><p>No chemical records added yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $chemical->firstItem() ?? 0 }}–{{ $chemical->lastItem() ?? 0 }}</strong> of <strong>{{ $chemical->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($chemical->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $chemical->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $chemical->currentPage();
            $last    = $chemical->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($chemical->hasMorePages())
            <button data-page="{{ $chemical->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
