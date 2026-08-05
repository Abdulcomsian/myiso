<div class="am-table-wrap">
    <table class="am-table" id="amCustTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>Customer</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Contact</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customer as $item)
                <tr>
                    <td><span class="am-cell-sub">#{{ $item->idNumber }}</span></td>
                    <td>
                        <div class="am-user-cell">
                            <span class="am-avatar">{{ strtoupper(substr($item->name ?? 'C', 0, 1)) }}</span>
                            <div>
                                <span class="am-cell-primary">{{ $item->name }}</span>
                                <span class="am-cell-sub">ID: {{ $item->idNumber }}</span>
                            </div>
                        </div>
                    </td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->phonecode }} {{ $item->phoneNumber }}</td>
                    <td>{{ $item->Email }}</td>
                    <td>{{ $item->contactName }}</td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='viewEid(@json($item))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='getEid(@json($item))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ route('deletecustomeradmin') }}"
                                    data-id="{{ $item->id }}"
                                    data-label="{{ $item->name }}"
                                    data-type="Customer">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7"><div class="am-empty"><i class="fa fa-user-friends"></i><p>No customers added yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $customer->firstItem() ?? 0 }}–{{ $customer->lastItem() ?? 0 }}</strong> of <strong>{{ $customer->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($customer->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $customer->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $customer->currentPage();
            $last    = $customer->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($customer->hasMorePages())
            <button data-page="{{ $customer->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
