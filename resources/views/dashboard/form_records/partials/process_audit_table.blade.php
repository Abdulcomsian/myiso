<div class="am-table-wrap">
    <table class="am-table" id="amPaTable">
        <thead>
            <tr>
                <th style="width:50px;">#</th>
                <th>Process</th>
                <th>Auditor</th>
                <th>Audit Date</th>
                <th>NCRs</th>
                <th>Observations</th>
                <th>Frequency</th>
                <th>NC Report Ref</th>
                <th>Audit Actions</th>
                <th>Attachment</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($audit as $index => $data)
                @php $ncrClass = ((int)$data->nonConformities) > 0 ? 'warning' : 'success'; @endphp
                <tr>
                    <td><span class="am-cell-sub">#{{ $audit->firstItem() + $index }}</span></td>
                    <td><span class="am-cell-primary">{{ Str::limit($data->processAudit, 35) }}</span></td>
                    <td>{{ $data->auditor }}</td>
                    <td><span class="am-chip info">{{ date('d M Y', strtotime($data->auditDate)) }}</span></td>
                    <td><span class="am-chip {{ $ncrClass }}">{{ $data->nonConformities }}</span></td>
                    <td>{{ $data->Observations }}</td>
                    <td>Every {{ $data->dateFrequency }} months</td>
                    <td><span class="am-cell-sub">{{ $data->nonConfReport ?: '—' }}</span></td>
                    <td><span class="am-cell-sub">{{ Str::limit($data->AdutiActions, 40) ?: '—' }}</span></td>
                    <td>
                        @if(!empty($data->attach_evidence))
                            <a href="{{ asset($data->attach_evidence) }}" target="_blank" style="color:var(--am-primary);font-size:13px;"><i class="fa fa-external-link-alt"></i> View</a>
                        @else
                            <span class="am-cell-sub">—</span>
                        @endif
                    </td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='amPaView(@json($data))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='amPaEdit(@json($data))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn" title="Download PDF"
                                    data-processid="{{ $data->id }}"
                                    onclick="downloadAuditPdf(this)"><i class="fa fa-download"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ route('deleteProcess') }}"
                                    data-id="{{ $data->id }}"
                                    data-label="Audit of {{ Str::limit($data->processAudit, 30) }}"
                                    data-type="Process Audit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="11"><div class="am-empty"><i class="fa fa-clipboard-list"></i><p>No process audits recorded yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $audit->firstItem() ?? 0 }}–{{ $audit->lastItem() ?? 0 }}</strong> of <strong>{{ $audit->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($audit->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $audit->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif

        @php
            $current = $audit->currentPage();
            $last    = $audit->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor

        @if ($audit->hasMorePages())
            <button data-page="{{ $audit->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
