@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Welcome, {{Auth::user()->name}}</h2>
            <p>Your ISO management portal</p>
        </div>
    </div>

    @if (!empty($showInactivityAlert) && $showInactivityAlert)
    {{-- Inactivity Warning Modal (only shows when previous last_login was 90+ days ago).
         Built on the same am-modal the delete confirmations use, so it is closed
         by its button, by the backdrop or by Escape like every other modal. --}}
    <div class="am-modal open" id="inactivityAlertOverlay" role="dialog" aria-modal="true">
        <div class="am-modal__box">
            <div class="am-modal__header">
                <span class="am-modal__icon"><i class="fa fa-exclamation-triangle"></i></span>
                <div>
                    <h4 class="am-modal__title">System Review Overdue</h4>
                    <p style="margin:2px 0 0;font-size:12.5px;color:var(--am-text-muted);">You haven't reviewed your documentation in a while</p>
                </div>
            </div>
            <div class="am-modal__body">
                It's been 90 days since your documentation system was reviewed. An unmaintained system risks audit
                failure and certification suspension or revocation. Please review and update your records.
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-danger am-modal-close">OK, I'll review</button>
            </div>
        </div>
    </div>
    @endif

    @if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    {{-- The four figures, where the five quick-link cards used to be.
         Every one of those five is in the sidebar too, so none of them
         lost its only way in. A client with no records behind any of the
         four sees nothing here at all. --}}
    @include('dashboard.partials.dash_charts', ['charts' => $charts])

    {{-- The objectives, as the tracker lists them. The ones already
         achieved are left out; everything else is here whether it is due
         an update or not. --}}
    <div class="am-card mb-3">
        <div class="am-card__body">
            <div style="margin-bottom:1.25rem;">
                <span style="display:inline-block;background:#c9d5f0;color:#3d5aa8;padding:6px 18px;border-radius:999px;font-size:14px;font-weight:600;">
                    Objectives Tracker
                </span>
            </div>
            <div id="amObjDashContainer">
                @include('dashboard.form_records.partials.objectives_table', [
                    'showFilters' => false,
                    'actions'     => ['view', 'progress'],
                    'viewAllUrl'  => url('/objectives_tracker'),
                ])
            </div>
        </div>
    </div>
    {{-- Requirements Due --}}
    <div class="am-card mb-3">
        <div class="am-card__body">
            <div style="margin-bottom:1.25rem;">
                <span style="display:inline-block;background:#c9d5f0;color:#3d5aa8;padding:6px 18px;border-radius:999px;font-size:14px;font-weight:600;letter-spacing:0.2px;">
                    Requirements Due
                </span>
            </div>
            <div id="amDashReqContainer" data-dash-list data-page-name="reqpage" data-url="{{ url('/requirements_dashboard') }}">
                @include('dashboard.partials.dash_requirements')
            </div>
        </div>
    </div>

    {{-- Calibration Due --}}
    <div class="am-card mb-3">
        <div class="am-card__body">
            <div style="margin-bottom:1.25rem;">
                <span style="display:inline-block;background:#c9d5f0;color:#3d5aa8;padding:6px 18px;border-radius:999px;font-size:14px;font-weight:600;letter-spacing:0.2px;">
                    Calibration Due
                </span>
            </div>
            <div id="amDashCalContainer" data-dash-list data-page-name="calpage" data-url="{{ url('/calibration_dashboard') }}">
                @include('dashboard.partials.dash_calibration')
            </div>
        </div>
    </div>

{{-- The three accordions at the foot of the page. There is no styles stack
     on this layout, so the rules live here beside the markup they dress. --}}
<style>
    /* The card carries the ribbon, not the heading row. The heading used to
       have a tinted box of its own and it sat inside the card's box - two
       backgrounds, one inside the other. .am-card has no border, only a
       radius and overflow:hidden, so one side gaining a border is clipped to
       the corner and costs nothing.

       border-inline-start, so the ribbon is on the side the heading starts
       at on the Arabic page too, without a second rule. */
    [data-acc] {
        border-inline-start: 3px solid #c9d5f0;
        transition: border-color 0.2s ease;
    }
    [data-acc]:hover,
    [data-acc][data-open] { border-inline-start-color: #3d5aa8; }

    /* the heading row: no box of its own, so it sits exactly where the
       heading sits on the three cards above, which are not accordions */
    .am-acc__head {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        padding: 0;
        border: 0;
        background: none;
        text-align: inherit;
        cursor: pointer;
        font: inherit;
        color: inherit;
    }
    /* margin-inline-end, so the control lands at the far edge on the Arabic
       site too without a second rule */
    .am-acc__head > span.am-acc__pill { margin-inline-end: auto; }
    .am-acc__toggle {
        flex: none;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #eef2fb;
        color: #3d5aa8;
        font-size: 12px;
        transition: background 0.2s ease, transform 0.3s ease;
    }
    .am-acc__head:hover .am-acc__toggle { background: #dfe6f7; }
    .am-acc__head:focus-visible {
        outline: 2px solid var(--am-primary-soft, #7c8fd0);
        outline-offset: 4px;
        border-radius: 6px;
    }

    /* Open: the control turns over.
       [data-acc][data-open] and not .am-acc[data-open] - the card carries
       the attribute, not a class of that name, and the class form matched
       nothing at all, which is why these would not open. */
    [data-acc][data-open] .am-acc__toggle { transform: rotate(180deg); }

    /* The panel opens on its own height. grid-template-rows 0fr -> 1fr needs
       no max-height guessed in advance, so a long table cannot be cut off
       and a short one does not crawl. The inner div is what the grid row
       measures, and what clips while it moves. */
    .am-acc__panel {
        display: grid;
        grid-template-rows: 0fr;
        margin-top: 0;
        opacity: 0;
        visibility: hidden;
        transition: grid-template-rows 0.3s ease, margin-top 0.3s ease,
                    opacity 0.2s ease, visibility 0s linear 0.3s;
    }
    .am-acc__inner { overflow: hidden; min-height: 0; }
    [data-acc][data-open] .am-acc__panel {
        grid-template-rows: 1fr;
        margin-top: 1.25rem;
        opacity: 1;
        visibility: visible;
        transition: grid-template-rows 0.3s ease, margin-top 0.3s ease,
                    opacity 0.25s ease 0.05s, visibility 0s;
    }
    /* someone who has asked for less movement gets the same page, instantly */
    @media (prefers-reduced-motion: reduce) {
        [data-acc], .am-acc__toggle, .am-acc__panel { transition: none; }
    }
</style>
    {{-- ISO Certificates --}}
    <div class="am-card mb-3" data-acc>
        <div class="am-card__body">
            <button type="button" class="am-acc__head" aria-expanded="false" aria-controls="amAccPanel1">
                <span class="am-acc__pill" style="display:inline-block;background:#c9d5f0;color:#3d5aa8;padding:6px 18px;border-radius:999px;font-size:14px;font-weight:600;letter-spacing:0.2px;">
                    ISO Certificates
                </span>
                <span class="am-acc__toggle" aria-hidden="true"><i class="fa fa-chevron-down"></i></span>
            </button>
            <div class="am-acc__panel" id="amAccPanel1">
                <div class="am-acc__inner">
            @php
                $hasCert = $user['iso9001_certificate'] || $user['iso14001_certificate'] || $user['iso45001_certificate'];
            @endphp
            @if(!$hasCert)
            <div class="am-empty">
                <i class="fa fa-certificate"></i>
                <p>No certificates uploaded.</p>
            </div>
            @else
            <div class="am-table-wrap">
                <table class="am-table">
                    <thead>
                        <tr>
                            <th>Certificate</th>
                            <th>Expiry</th>
                            <th>ISO Certificate</th>
                            <th>Audit Report</th>
                            <th>Description / Audit Comment</th>
                        </tr>
                    </thead>
                    <tbody>
@php
    // the standards in the order the admin form lists them. $stdDocs carries
    // each one's current audit report, which now sits in the row of the
    // certificate it belongs to rather than loose further down the page.
    $amIsoRows = ['iso9001' => 'ISO9001', 'iso14001' => 'ISO14001', 'iso45001' => 'ISO45001'];
@endphp
@foreach ($amIsoRows as $amStd => $amLabel)
@if ($user[$amStd . '_certificate'])
@php $amAudit = ($stdDocs[$amStd]['audit_report'] ?? null); @endphp
                        <tr>
                            <th>{{ $amLabel }}</th>
                            <td>{{ date("d/m/Y", strtotime($user[$amStd . '_expirydate'])) }}</td>
                            <td>
                                <a href="{{ asset($user[$amStd . '_certificate']) }}" target="_blank">
                                    <i class="far fa-file-pdf fa-2x" style="color:red;"></i>
                                </a>
                            </td>
                            <td>
@if ($amAudit)
                                <a href="{{ asset($amAudit->file_path) }}" target="_blank">
                                    <i class="far fa-file-pdf fa-2x" style="color:red;"></i>
                                </a>
@else
                                <span style="color:var(--am-text-soft);">&mdash;</span>
@endif
                            </td>
                            <td>
                                {{ $user[$amStd . '_description'] }}
@if ($amAudit && $amAudit->comment)
                                <div style="color:var(--am-text-muted);font-size:12.5px;margin-top:4px;">{{ $amAudit->comment }}</div>
@endif
                            </td>
                        </tr>
@endif
@endforeach
                    </tbody>
                </table>
            </div>
            @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Supporting Documents --}}
    <div class="am-card mb-3" data-acc>
        <div class="am-card__body">
            <button type="button" class="am-acc__head" aria-expanded="false" aria-controls="amAccPanel2">
                <span class="am-acc__pill" style="display:inline-block;background:#c9d5f0;color:#3d5aa8;padding:6px 18px;border-radius:999px;font-size:14px;font-weight:600;letter-spacing:0.2px;">
                    Supporting Documents
                </span>
                <span class="am-acc__toggle" aria-hidden="true"><i class="fa fa-chevron-down"></i></span>
            </button>
            <div class="am-acc__panel" id="amAccPanel2">
                <div class="am-acc__inner">
            @php
                // The two standing PDFs every client gets, plus one row per
                // standard that has a QA agreement of its own. A standard-less
                // Audit Report and QA Agreement used to sit here as well, with
                // the auditor's comment under them; each standard carries its
                // own now, so all three came off. The columns are still in the
                // database - this is only what the dashboard offers.
                //
                // These two are shipped with the site, not uploaded for a
                // client, so they carry no date of their own.
                $docs = [
                    ['title' => 'Remote Audit Overview',
                     'date'  => null,
                     'url'   => '/uploads/user/pdfs/Remote-Audit-Overview.pdf',
                     'none'  => ''],
                    ['title' => 'Use Of Certificate & Certification Marks',
                     'date'  => null,
                     'url'   => '/uploads/user/pdfs/Use-Of-Certificate-and-Certification-Marks.pdf',
                     'none'  => ''],
                ];
                // and one row per standard that has a QA agreement of its own,
                // which is what a client gains on taking a second standard later.
                // The standard is part of the name, there being no column of its
                // own for it - without it the rows would all read QA Agreement.
                foreach (($stdDocs ?? []) as $amStd => $amDocs) {
                    if (empty($amDocs['qa_agreement'])) { continue; }
                    $amQa = $amDocs['qa_agreement'];
                    $docs[] = [
                        'title' => \App\UserDocument::typeLabel('qa_agreement')
                                   . ' — ' . \App\UserDocument::standardLabel($amStd),
                        // when it was uploaded; rows saved before the table
                        // kept timestamps have none, and show a dash
                        'date'  => $amQa->created_at ? $amQa->created_at->format('d/m/Y') : null,
                        'url'   => asset($amQa->file_path),
                        'none'  => '',
                    ];
                }
            @endphp
            @include('dashboard.partials.dash_supporting_docs', [
                'docs'    => $docs
            ])
                </div>
            </div>
        </div>
    </div>
    {{-- Previous Certificates & Audit Reports. Always drawn: a client who
         has replaced nothing is told so inside the table, the way the
         other lists tell them. --}}
    <div class="am-card mb-3" data-acc>
        <div class="am-card__body">
            <button type="button" class="am-acc__head" aria-expanded="false" aria-controls="amAccPanel3">
                <span class="am-acc__pill" style="display:inline-block;background:#c9d5f0;color:#3d5aa8;padding:6px 18px;border-radius:999px;font-size:14px;font-weight:600;letter-spacing:0.2px;">
                    Previous Certificates &amp; Audit Reports
                </span>
                <span class="am-acc__toggle" aria-hidden="true"><i class="fa fa-chevron-down"></i></span>
            </button>
            <div class="am-acc__panel" id="amAccPanel3">
                <div class="am-acc__inner">
            <div id="amDashPrevContainer" data-dash-list data-page-name="prevpage" data-url="{{ url('/previous_documents') }}">
                @include('dashboard.partials.dash_previous_docs', ['prevDocs' => $prevDocs])
            </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Delete a superseded document off the client's own history --}}
<div class="am-modal" id="prevDocModal" role="dialog" aria-modal="true">
    <div class="am-modal__box">
        <div class="am-modal__header">
            <span class="am-modal__icon"><i class="fa fa-exclamation-triangle"></i></span>
            <h4 class="am-modal__title">Delete this record?</h4>
        </div>
        <div class="am-modal__body">
            You are about to permanently remove this superseded document from your history. This action cannot be undone.
        </div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
            <form action="{{ route('previous.document.delete') }}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="id" id="prev_doc_id" value=""/>
                <button type="submit" class="am-btn am-btn-danger">
                    <i class="fa fa-trash"></i> Yes, delete
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Delete Calibration Modal --}}
<div class="am-modal" id="calibrationModal" role="dialog" aria-modal="true">
    <div class="am-modal__box">
        <div class="am-modal__header">
            <span class="am-modal__icon"><i class="fa fa-exclamation-triangle"></i></span>
            <h4 class="am-modal__title">Delete Calibration Entry?</h4>
        </div>
        <div class="am-modal__body">
            You are about to permanently delete this calibration record. This action cannot be undone.
        </div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
            <form action="{{route('deletecaliberinfo')}}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="id" id="req_id2" value=""/>
                <button type="submit" class="am-btn am-btn-danger">
                    <i class="fa fa-trash"></i> Yes, delete
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Delete Requirement Modal --}}
<div class="am-modal" id="myModal" role="dialog" aria-modal="true">
    <div class="am-modal__box">
        <div class="am-modal__header">
            <span class="am-modal__icon"><i class="fa fa-exclamation-triangle"></i></span>
            <h4 class="am-modal__title">Delete Requirement?</h4>
        </div>
        <div class="am-modal__body">
            You are about to permanently delete this requirement. This action cannot be undone.
        </div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
            <form action="{{route('deleteRequirementadmin')}}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="id" id="req_id" value=""/>
                <button type="submit" class="am-btn am-btn-danger">
                    <i class="fa fa-trash"></i> Yes, delete
                </button>
            </form>
        </div>
    </div>
</div>

{{-- What the row buttons open. Edit and Delete are not drawn on this card,
     but their modals are here so turning them on is one word above. --}}
@include('dashboard.form_records.partials.objective_modals', ['evidenceId' => 'objDashEvidence'])
@include('dashboard.form_records.partials.objective_scripts', [
    'listUrl'     => url('/objectives_dashboard'),
    'containerId' => 'amObjDashContainer',
    'syncUrl'     => false,
])
@endsection

@section('myscript')
<script>
    // The three accordions at the foot of the page.
    //
    // Each opens on its own: opening one does not shut the others. Someone
    // checking a certificate against the document that supports it should be
    // able to have both open.
    //
    // Delegated from the document, like the other handlers in this file,
    // rather than bound to the three buttons at load. Nothing above it in
    // this block can then stop it binding, and the header is one full-width
    // button so a click anywhere along the row arrives here.
    //
    // The open state is an attribute on the card, not a style on the panel,
    // so the stylesheet owns every part of how it looks and this only says
    // whether it is open. aria-expanded is set on the button for anyone
    // listening rather than looking.
    document.addEventListener('click', function (e) {
        var head = e.target.closest ? e.target.closest('.am-acc__head') : null;
        if (!head) return;

        var card = head.closest('[data-acc]');
        if (!card) return;

        var open = head.getAttribute('aria-expanded') === 'true';
        head.setAttribute('aria-expanded', open ? 'false' : 'true');
        if (open) { card.removeAttribute('data-open'); }
        else      { card.setAttribute('data-open', ''); }
    });
    // Open modals.
    //
    // Delegated rather than bound to the buttons that happen to be on the page
    // at load: these lists are paged now, so the rows are replaced as you move
    // through them and a button bound once would be dead on the second page.
    document.addEventListener('click', function (e) {
        var req = e.target.closest('.delete_requirement');
        if (req) {
            e.preventDefault();
            document.getElementById('req_id').value = req.getAttribute('data-id');
            document.getElementById('myModal').classList.add('open');
            return;
        }
        var prev = e.target.closest('.prevDocModal');
        if (prev) {
            e.preventDefault();
            document.getElementById('prev_doc_id').value = prev.getAttribute('data-id');
            document.getElementById('prevDocModal').classList.add('open');
            return;
        }
        var cal = e.target.closest('.calibrationModal');
        if (cal) {
            e.preventDefault();
            document.getElementById('req_id2').value = cal.getAttribute('data-id');
            document.getElementById('calibrationModal').classList.add('open');
        }
    });

    // The pager on a dashboard card. One handler for every card that carries
    // data-dash-list, so a new card needs no new script. The address bar is
    // left alone - paging a card is not navigating the page.
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-dash-list] .am-page-link');
        if (!btn || btn.disabled) return;
        e.preventDefault();
        var box  = btn.closest('[data-dash-list]');
        var page = parseInt(btn.getAttribute('data-page'), 10);
        if (!box || isNaN(page) || page < 1) return;
        var url  = box.getAttribute('data-url');
        box.style.opacity = '0.5';
        fetch(url + '?' + (box.getAttribute('data-page-name') || 'page') + '=' + page, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function (r) { return r.text(); })
            .then(function (html) { box.innerHTML = html; box.style.opacity = ''; })
            .catch(function () { box.style.opacity = ''; });
    });

    // Close modal on Cancel / overlay click / Escape
    document.addEventListener('click', function(e) {
        var close = e.target.closest('.am-modal-close');
        if (close) { var m = close.closest('.am-modal'); if (m) m.classList.remove('open'); return; }
        if (e.target.classList && e.target.classList.contains('am-modal')) e.target.classList.remove('open');
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') document.querySelectorAll('.am-modal.open').forEach(function(m){ m.classList.remove('open'); });
    });
</script>
@endsection

{{-- What the row buttons open. Edit and Delete are not drawn on this card,
     but their modals are here so turning them on is one word above. --}}
