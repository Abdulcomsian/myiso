<div class="am-table-wrap">
    <table class="am-table" id="amSupTable">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th>Supplier</th>
                <th>Address</th>
                <th>Country</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Services</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($supplier as $data)
                <tr>
                    <td><span class="am-cell-sub">#{{ $data->idnumber }}</span></td>
                    <td>
                        <div class="am-user-cell">
                            <span class="am-avatar">{{ strtoupper(substr($data->suppliername ?? 'S', 0, 1)) }}</span>
                            <div>
                                <span class="am-cell-primary">{{ $data->suppliername }}</span>
                                <span class="am-cell-sub">{{ $data->supplierContactNumber }}</span>
                            </div>
                        </div>
                    </td>
                    <td>{{ $data->supplieraddress }}</td>
                    <td>{{ $data->suppliercountry }}</td>
                    <td>{{ $data->phonecode }} {{ $data->supplierphn }}</td>
                    <td>{{ $data->supplieremail }}</td>
                    <td>{{ $data->supplierservc }}</td>
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='viewEid(@json($data))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='getEid(@json($data))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ route('deleteSupplier') }}"
                                    data-id="{{ $data->id }}"
                                    data-label="{{ $data->suppliername }}"
                                    data-type="Supplier">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8"><div class="am-empty"><i class="fa fa-truck"></i><p>No suppliers added yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $supplier->firstItem() ?? 0 }}–{{ $supplier->lastItem() ?? 0 }}</strong> of <strong>{{ $supplier->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($supplier->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $supplier->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $supplier->currentPage();
            $last    = $supplier->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($supplier->hasMorePages())
            <button data-page="{{ $supplier->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
