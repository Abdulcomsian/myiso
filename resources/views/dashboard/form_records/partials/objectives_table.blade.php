{{-- The list, with the status filters above it. Loaded on its own when the
     search box or a pager link is used, so it has to stand alone. --}}
<div style="padding:16px 20px 0;display:flex;gap:8px;flex-wrap:wrap;">
    <a href="#" data-status-filter="" class="am-chip {{ ($status ?? '') === '' ? 'info' : '' }}" style="text-decoration:none;cursor:pointer;">All ({{ $counts[''] ?? 0 }})</a>
    @foreach (App\Objective::statuses() as $key => $st)
        <a href="#" data-status-filter="{{ $key }}"
           class="am-chip {{ ($status ?? '') === $key ? $st['chip'] : '' }}"
           style="text-decoration:none;cursor:pointer;{{ ($status ?? '') === $key ? '' : 'opacity:.75;' }}">
            {{ $st['label'] }} ({{ $counts[$key] ?? 0 }})
        </a>
    @endforeach
</div>

<div class="am-table-wrap">
    <table class="am-table" id="amObjTable">
        <thead>
            <tr>
                <th>Objective</th>
                <th>Person Responsible</th>
                <th>Deadline</th>
                <th>Latest Progress</th>
                <th>Status</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($objectives as $data)
                @php
                    $last = $latest[$data->id] ?? null;
                    $st   = App\Objective::statuses()[$data->status] ?? ['label' => $data->status, 'chip' => ''];
                    $history = ($data->updates ?? collect())->values();
                @endphp
                <tr>
                    <td>
                        <span class="am-cell-primary">{{ $data->objective }}</span>
                        @if ($data->target)
                            <span class="am-cell-sub">Target: {{ $data->target }}@if ($data->starting_point) (was {{ $data->starting_point }})@endif</span>
                        @endif
                    </td>
                    <td>{{ $data->person_responsible ?: '—' }}</td>
                    <td><span class="am-chip info">{{ $data->deadline ? date('d M Y', strtotime($data->deadline)) : '—' }}</span></td>
                    <td>
                        @if ($last)
                            {{ $last->note }}
                            <span class="am-cell-sub">Updated {{ date('d M Y', strtotime($last->update_date ?: $last->created_at)) }}</span>
                        @else
                            <span class="am-cell-sub">No progress recorded yet.</span>
                        @endif
                    </td>
                    <td><span class="am-chip {{ $st['chip'] }}">{{ $st['label'] }}</span></td>
                    <td style="text-align:right;white-space:nowrap;">
                        @php
                            $payload = [
                                'id' => $data->id, 'objective' => $data->objective,
                                'how_measured' => $data->how_measured, 'starting_point' => $data->starting_point,
                                'target' => $data->target, 'how_achieved' => $data->how_achieved,
                                'person_responsible' => $data->person_responsible, 'agreed_at' => $data->agreed_at,
                                'deadline' => $data->deadline, 'status' => $data->status,
                            ];
                            $notes = $data->updates()->get()->map(function ($u) {
                                return ['update_date' => $u->update_date ?: $u->created_at,
                                        'status' => $u->status, 'note' => $u->note, 'evidence' => $u->evidence];
                            });
                        @endphp
                        <button type="button" class="am-icon-btn" title="View" onclick='amObjView(@json($payload))'><i class="fa fa-eye"></i></button>
                        @if (in_array($data->status, ['achieved', 'not_achieved'], true))
                            {{-- finished, so the history is there to read rather than add to --}}
                            <button type="button" class="am-btn am-btn-outline am-btn-sm" onclick='amObjProgress(@json($payload), @json($notes))'>View</button>
                        @else
                            <button type="button" class="am-btn am-btn-outline am-btn-sm" onclick='amObjProgress(@json($payload), @json($notes))'>Update</button>
                        @endif
                        <button type="button" class="am-icon-btn" title="Edit" onclick='amObjEdit(@json($payload))'><i class="fa fa-pen"></i></button>
                        <button type="button" class="am-icon-btn" title="Delete" onclick="amObjDelete({{ $data->id }})"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6"><div class="am-empty"><i class="fa fa-bullseye"></i><p>No objectives added yet.</p></div></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $objectives->firstItem() ?? 0 }}–{{ $objectives->lastItem() ?? 0 }}</strong> of <strong>{{ $objectives->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($objectives->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $objectives->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $objectives->currentPage();
            $last    = $objectives->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($objectives->hasMorePages())
            <button data-page="{{ $objectives->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
