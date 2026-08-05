<div class="am-table-wrap">
    <table class="am-table" id="amWiTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>Title</th>
                <th>Reference</th>
                <th>Scope</th>
                <th>Compiled By</th>
                <th>Issue Date</th>
                <th>Revision</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($work as $index => $data)
                <tr>
                    <td><span class="am-cell-sub">#{{ $work->firstItem() + $index }}</span></td>
                    <td><span class="am-cell-primary">{{ $data->workinstruction }}</span></td>
                    <td>{{ $data->instructionref }}</td>
                    <td>{{ Str::limit($data->scop, 60) }}</td>
                    <td>{{ $data->CompiledBy ?? '—' }}</td>
                    <td><span class="am-chip info">{{ date('d M Y', strtotime($data->issueDate)) }}</span></td>
                    <td>{{ $data->revisionstatus }}</td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='amWiView(@json($data))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='amWiEdit(@json($data))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ route('deleteWork') }}"
                                    data-id="{{ $data->id }}"
                                    data-label="{{ $data->workinstruction }}"
                                    data-type="Work Instruction">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8"><div class="am-empty"><i class="fa fa-file-alt"></i><p>No work instructions added yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $work->firstItem() ?? 0 }}–{{ $work->lastItem() ?? 0 }}</strong> of <strong>{{ $work->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($work->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $work->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $work->currentPage();
            $last    = $work->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($work->hasMorePages())
            <button data-page="{{ $work->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
