<div class="am-table-wrap">
    <table class="am-table" id="amEmpTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>Employee</th>
                <th>Email</th>
                <th>Job Details</th>
                <th>CV</th>
                <th>Start Date</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($userinfo as $index => $item)
                <tr>
                    <td><span class="am-cell-sub">#{{ $item->empNumber }}</span></td>
                    <td>
                        <div class="am-user-cell">
                            <span class="am-avatar">{{ strtoupper(substr($item->first_name ?? 'E', 0, 1)) }}</span>
                            <div>
                                <span class="am-cell-primary">{{ $item->first_name }} {{ $item->surname }}</span>
                                <span class="am-cell-sub">EMP: {{ $item->empNumber }}</span>
                            </div>
                        </div>
                    </td>
                    <td>{{ $item->email }}</td>
                    <td>{{ Str::limit($item->jobdetails, 50) }}</td>
                    <td>
                        @if (!empty($item->cv))
                            @php $extPath = pathinfo($item->cv); @endphp
                            @if (($extPath['extension'] ?? '') === 'pdf')
                                <a style="color:var(--am-primary);cursor:pointer;" onclick="viewCV('{{ asset($item->cv) }}')"><i class="fa fa-file-pdf"></i> View</a>
                            @else
                                <a target="_blank" href="{{ asset($item->cv) }}" style="color:var(--am-primary);"><i class="fa fa-file-alt"></i> View</a>
                            @endif
                        @else
                            <span class="am-cell-sub">—</span>
                        @endif
                    </td>
                    <td><span class="am-chip info">{{ date('d M Y', strtotime($item->startDate)) }}</span></td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='amEmpView(@json($item))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='amEmpEdit(@json($item))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ route('employess-delete') }}"
                                    data-id="{{ $item->id }}"
                                    data-extra="type=employee"
                                    data-label="{{ $item->first_name }} {{ $item->surname }}"
                                    data-type="Employee">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7"><div class="am-empty"><i class="fa fa-id-badge"></i><p>No employees added yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $userinfo->firstItem() ?? 0 }}–{{ $userinfo->lastItem() ?? 0 }}</strong> of <strong>{{ $userinfo->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($userinfo->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $userinfo->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $userinfo->currentPage();
            $last    = $userinfo->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($userinfo->hasMorePages())
            <button data-page="{{ $userinfo->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
