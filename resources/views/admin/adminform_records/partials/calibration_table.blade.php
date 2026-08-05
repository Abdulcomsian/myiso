<div class="am-table-wrap">
    <table class="am-table" id="amCalTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>Equipment</th>
                <th>Serial</th>
                <th>Calibrated</th>
                <th>Due</th>
                <th>Sentence</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($caliber as $index => $data)
                @php
                    $dueTs = strtotime("+".((int)$data->freq)." months", strtotime($data->calibratedDate));
                    $daysToDue = intval(($dueTs - time()) / 86400);
                    $dueClass = $daysToDue < 0 ? 'danger' : ($daysToDue < 30 ? 'warning' : 'success');
                    $sentenceClass = strtolower($data->sentence ?? '') === 'pass' ? 'success' : 'danger';
                @endphp
                <tr>
                    <td><span class="am-cell-sub">#{{ $caliber->firstItem() + $index }}</span></td>
                    <td>
                        <span class="am-cell-primary">{{ $data->equipment }}</span>
                        <span class="am-cell-sub">Cert: {{ $data->certificatenumber }}</span>
                    </td>
                    <td>{{ $data->serialNum }}</td>
                    <td><span class="am-chip info">{{ date('d M Y', strtotime($data->calibratedDate)) }}</span></td>
                    <td>
                        @if ($daysToDue < 0)
                            <span class="am-chip danger">Overdue</span>
                        @else
                            <span class="am-chip {{ $dueClass }}">{{ date('d M Y', $dueTs) }}</span>
                        @endif
                    </td>
                    <td><span class="am-chip {{ $sentenceClass }}">{{ $data->sentence }}</span></td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='amCalView(@json($data))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='amCalEdit(@json($data))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ route('deletecaliberinfo') }}"
                                    data-id="{{ $data->id }}"
                                    data-label="{{ $data->equipment }}"
                                    data-type="Calibration Record">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7"><div class="am-empty"><i class="fa fa-tachometer-alt"></i><p>No calibration records added yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $caliber->firstItem() ?? 0 }}–{{ $caliber->lastItem() ?? 0 }}</strong> of <strong>{{ $caliber->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($caliber->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $caliber->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $caliber->currentPage();
            $last    = $caliber->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($caliber->hasMorePages())
            <button data-page="{{ $caliber->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
