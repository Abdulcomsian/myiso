{{-- Previous Certificates & Audit Reports: everything a renewal or a
     re-upload put aside.

     Laid out as the two cards above it are, so the three read as one page, and
     paged the way the Calibration Due card is - this is the one list on the
     dashboard that only ever grows.

     The card is drawn whether or not there is anything in it: a client who has
     replaced nothing is told so in the table, the way the other lists tell
     them, rather than being left wondering where the section went.

     The delete is the client's own: it reaches only their history, and only
     documents already superseded, never the one they are certified against
     today. There is no "View all" here because this list has no page of its
     own; the card is the whole of it.

     $prevDocs   the superseded documents, newest first, a page at a time --}}
<div class="am-table-wrap">
    <table class="am-table">
        <thead>
            <tr>
                <th style="width:20%;">Standard</th>
                <th style="width:30%;">Document</th>
                <th style="width:22%;">Replaced On</th>
                <th style="width:16%;">File</th>
                <th style="width:12%;">Action</th>
            </tr>
        </thead>
        <tbody>
@forelse ($prevDocs as $doc)
            <tr>
                <th>{{ \App\UserDocument::standardLabel($doc->standard) }}</th>
                <td>{{ \App\UserDocument::typeLabel($doc->doc_type) }}</td>
                <td>
@if ($doc->archivedOn())
                    {{ $doc->archivedOn() }}
@else
                    <span style="color:var(--am-text-soft);">&mdash;</span>
@endif
                </td>
                <td>
                    <a href="{{ asset($doc->file_path) }}" target="_blank">
                        <i class="far fa-file-pdf fa-2x" style="color:red;"></i>
                    </a>
                </td>
                <td>
                    <a href="javascript:;" data-id="{{ $doc->id }}" class="prevDocModal am-btn am-btn-sm am-btn-danger" title="Delete">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
@empty
            <tr><td colspan="5"><div class="am-empty"><i class="fa fa-history"></i><p>No certificate or audit report has been replaced yet.</p></div></td></tr>
@endforelse
        </tbody>
    </table>
</div>

@if ($prevDocs->total())
<div class="am-pagination">
    <div class="am-pagination__info">
        Showing <strong>{{ $prevDocs->firstItem() ?? 0 }}–{{ $prevDocs->lastItem() ?? 0 }}</strong> of <strong>{{ $prevDocs->total() }}</strong>
    </div>
    <div class="am-pagination__nav">
        @if ($prevDocs->onFirstPage())
            <button disabled>‹</button>
        @else
            <button data-page="{{ $prevDocs->currentPage() - 1 }}" class="am-page-link">‹</button>
        @endif
        @php
            $current = $prevDocs->currentPage();
            $last    = $prevDocs->lastPage();
            $start   = max(1, $current - 2);
            $end     = min($last, $start + 4);
            $start   = max(1, $end - 4);
        @endphp
        @for ($p = $start; $p <= $end; $p++)
            <button data-page="{{ $p }}" class="am-page-link {{ $p == $current ? 'active' : '' }}">{{ $p }}</button>
        @endfor
        @if ($prevDocs->hasMorePages())
            <button data-page="{{ $prevDocs->currentPage() + 1 }}" class="am-page-link">›</button>
        @else
            <button disabled>›</button>
        @endif
    </div>
</div>
@endif
