{{-- Records table for a simple register. Params: $module, $records (paginator) --}}
<div class="am-table-wrap">
    <table class="am-table">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                @foreach ($module['columns'] as $label)
                    <th>{{ $label }}</th>
                @endforeach
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($records as $index => $row)
                <tr>
                    <td><span class="am-cell-sub">#{{ $records->firstItem() + $index }}</span></td>
                    @foreach ($module['columns'] as $col => $label)
                        @php
                            $field = $module['fields'][$col];
                            $raw = $row->getRawOriginal($col);
                        @endphp
                        <td>
                            @if ($raw === null || $raw === '')
                                <span class="am-cell-sub">—</span>
                            @elseif ($field['type'] === 'date')
                                <span class="am-chip info">{{ \Carbon\Carbon::parse($raw)->format('d M Y') }}</span>
                            @elseif ($field['type'] === 'select')
                                @php $chip = $module['chips'][$col][$raw] ?? null; @endphp
                                @if ($chip)
                                    <span class="am-chip {{ $chip }}">{{ $field['options'][$raw] ?? $raw }}</span>
                                @else
                                    {{ $field['options'][$raw] ?? $raw }}
                                @endif
                            @elseif ($loop->first)
                                <span class="am-cell-primary">{{ \Illuminate\Support\Str::limit($raw, 60) }}</span>
                            @else
                                {{ \Illuminate\Support\Str::limit($raw, 60) }}
                            @endif
                        </td>
                    @endforeach
                    <td style="text-align:right;white-space:nowrap;">
                        <div class="am-actions">
                            <button type="button" class="am-icon-btn" title="View" onclick='amRegView(@json($row))'><i class="fa fa-eye"></i></button>
                            <button type="button" class="am-icon-btn" title="Edit" onclick='amRegEdit(@json($row))'><i class="fa fa-pen"></i></button>
                            <button type="button" class="am-icon-btn danger am-confirm-delete"
                                    title="Delete"
                                    data-action="{{ route($module['key'].'.destroy') }}"
                                    data-id="{{ $row->id }}"
                                    data-label="{{ \Illuminate\Support\Str::limit($row->getRawOriginal($module['label_field']), 40) }}"
                                    data-type="{{ $module['item_name'] }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="{{ count($module['columns']) + 2 }}"><div class="am-empty"><i class="fa {{ $module['icon'] }}"></i><p>{{ $module['empty'] }}</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $records->firstItem() ?? 0 }}–{{ $records->lastItem() ?? 0 }}</strong> of <strong>{{ $records->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($records->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $records->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $records->currentPage();
            $last    = $records->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($records->hasMorePages())
            <button data-page="{{ $records->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
