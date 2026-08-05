<div class="am-table-wrap">
    <table class="am-table" id="amReqTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>Requirement</th>
                <th>Date Completed</th>
                <th>Periodicity</th>
                <th>Due Date</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($requirement as $index => $data)
                @php
                    $due = strtotime("+$data->periods months", strtotime($data->completion_date));
                    $daysToDue = intval(($due - time()) / 86400);
                @endphp
                <tr>
                    <td><span class="am-cell-sub">#{{ $requirement->firstItem() + $index }}</span></td>
                    <td>
                        <span class="am-cell-primary">{{ $data->requirment_title }}</span>
                    </td>
                    <td>
                        <span class="am-chip info">{{ date('d M Y', strtotime($data->completion_date)) }}</span>
                    </td>
                    <td>
                        <span class="am-cell-sub">Every</span>
                        <span class="am-cell-primary">{{ $data->periods }} months</span>
                    </td>
                    <td>
                        @if ($daysToDue < 0)
                            <span class="am-chip danger">Overdue</span>
                        @elseif ($daysToDue < 30)
                            <span class="am-chip warning">{{ date('d M Y', $due) }}</span>
                        @else
                            <span class="am-chip success">{{ date('d M Y', $due) }}</span>
                        @endif
                    </td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View"
                                    onclick='amReqView(@json($data))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit"
                                    onclick='amReqEdit(@json($data))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ url('deleteRequirement/' . $data->id) }}"
                                    data-id="{{ $data->id }}"
                                    data-label="{{ $data->requirment_title }}"
                                    data-type="Requirement">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <div class="am-empty">
                            <i class="fa fa-database"></i>
                            <p>No requirements found.</p>
                        </div>
                    </td>
                </tr>
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
