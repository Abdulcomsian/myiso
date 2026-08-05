<div class="am-table-wrap">
    <table class="am-table" id="amNcTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>Type</th>
                <th>Supplier</th>
                <th>Reported By</th>
                <th>Description</th>
                <th>Category</th>
                <th>Processed</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers_nonconform as $index => $data)
                <tr>
                    <td><span class="am-cell-sub">#{{ $customers_nonconform->firstItem() + $index }}</span></td>
                    <td>
                        @if ($data->non_confirm_status === 'Major')
                            <span class="am-chip danger">Major</span>
                        @elseif ($data->non_confirm_status === 'Minor')
                            <span class="am-chip warning">Minor</span>
                        @else
                            <span class="am-cell-sub">—</span>
                        @endif
                    </td>
                    <td>
                        <span class="am-cell-primary">{{ $data->supplier_data ?? '—' }}</span>
                        <span class="am-cell-sub">ID: {{ $data->customerID }}</span>
                    </td>
                    <td>
                        <span class="am-cell-primary">{{ $data->employee_name }}</span>
                        <span class="am-cell-sub">EMP: {{ $data->employee_id }}</span>
                    </td>
                    <td>{{ Str::limit($data->description, 50) }}</td>
                    <td><span class="am-chip info">{{ $data->root_cause_category }}</span></td>
                    <td>{{ $data->dateNcR ? date('d M Y', strtotime($data->dateNcR)) : '—' }}</td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='amNcView(@json($data))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='amNcEdit(@json($data))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ route('deleteNonConfrm') }}"
                                    data-id="{{ $data->noid }}"
                                    data-label="NCR #{{ $customers_nonconform->firstItem() + $index }}"
                                    data-type="Non-Conformity">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8"><div class="am-empty"><i class="fa fa-exclamation-triangle"></i><p>No non-conformities recorded yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $customers_nonconform->firstItem() ?? 0 }}–{{ $customers_nonconform->lastItem() ?? 0 }}</strong> of <strong>{{ $customers_nonconform->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($customers_nonconform->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $customers_nonconform->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $customers_nonconform->currentPage();
            $last    = $customers_nonconform->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($customers_nonconform->hasMorePages())
            <button data-page="{{ $customers_nonconform->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
