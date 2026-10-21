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

    {{-- Quick Links --}}
    {{-- <h6 class="dash-section-title">Quick Links</h6> --}}
    <div style="display:flex; gap:1rem; flex-wrap:wrap; margin-bottom:1.5rem;">
        <a href="{{url('quality_manual')}}" style="flex:1; min-width:160px; text-decoration:none;">
            <div class="am-card" style="text-align:center; padding:1.25rem 1rem; cursor:pointer;">
                <div style="font-size:2rem; color:var(--am-primary); margin-bottom:.5rem;"><i class="fa fa-book"></i></div>
                <div style="font-weight:600; color:var(--am-text);">Main Procedures &amp; Forms</div>
            </div>
        </a>
        <a href="{{url('sale_processes')}}" style="flex:1; min-width:160px; text-decoration:none;">
            <div class="am-card" style="text-align:center; padding:1.25rem 1rem; cursor:pointer;">
                <div style="font-size:2rem; color:var(--am-primary); margin-bottom:.5rem;"><i class="fa fa-cogs"></i></div>
                <div style="font-weight:600; color:var(--am-text);">Processes</div>
            </div>
        </a>
        <a href="{{url('documented_information')}}" style="flex:1; min-width:160px; text-decoration:none;">
            <div class="am-card" style="text-align:center; padding:1.25rem 1rem; cursor:pointer;">
                <div style="font-size:2rem; color:var(--am-primary); margin-bottom:.5rem;"><i class="fa fa-file-text"></i></div>
                <div style="font-weight:600; color:var(--am-text);">Procedures</div>
            </div>
        </a>
        <a href="{{url('requirements_aspect')}}" style="flex:1; min-width:160px; text-decoration:none;">
            <div class="am-card" style="text-align:center; padding:1.25rem 1rem; cursor:pointer;">
                <div style="font-size:2rem; color:var(--am-primary); margin-bottom:.5rem;"><i class="fa fa-clipboard"></i></div>
                <div style="font-weight:600; color:var(--am-text);">Forms &amp; Records</div>
            </div>
        </a>
        <a href="{{url('work_instruction')}}" style="flex:1; min-width:160px; text-decoration:none;">
            <div class="am-card" style="text-align:center; padding:1.25rem 1rem; cursor:pointer;">
                <div style="font-size:2rem; color:var(--am-primary); margin-bottom:.5rem;"><i class="fa fa-list-ol"></i></div>
                <div style="font-weight:600; color:var(--am-text);">Local Work Instructions</div>
            </div>
        </a>
    </div>

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

    {{-- ISO Certificates --}}
    <div class="am-card mb-3">
        <div class="am-card__body">
            <div style="margin-bottom:1.25rem;">
                <span style="display:inline-block;background:#c9d5f0;color:#3d5aa8;padding:6px 18px;border-radius:999px;font-size:14px;font-weight:600;letter-spacing:0.2px;">
                    ISO Certificates
                </span>
            </div>
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

    {{-- Supporting Documents --}}
    <div class="am-card mb-3">
        <div class="am-card__body">
            <div style="margin-bottom:1.25rem;">
                <span style="display:inline-block;background:#c9d5f0;color:#3d5aa8;padding:6px 18px;border-radius:999px;font-size:14px;font-weight:600;letter-spacing:0.2px;">
                    Supporting Documents
                </span>
            </div>
            @php
                // The two standing PDFs every client gets, plus one tile per
                // standard that has a QA agreement of its own. A standard-less
                // Audit Report and QA Agreement used to sit here as well, with
                // the auditor's comment under them; each standard carries its
                // own now, so all three came off. The columns are still in the
                // database - this is only what the dashboard offers.
                $docs = [
                    ['title' => 'Remote Audit Overview',
                     'url'   => '/uploads/user/pdfs/Remote-Audit-Overview.pdf',
                     'none'  => ''],
                    ['title' => 'Use Of Certificate & Certification Marks',
                     'url'   => '/uploads/user/pdfs/Use-Of-Certificate-and-Certification-Marks.pdf',
                     'none'  => ''],
                ];
                // and one tile per standard that has a QA agreement of its own,
                // which is what a client gains on taking a second standard later
                foreach (($stdDocs ?? []) as $amStd => $amDocs) {
                    if (empty($amDocs['qa_agreement'])) { continue; }
                    $docs[] = [
                        'title' => \App\UserDocument::typeLabel('qa_agreement')
                                   . ' — ' . \App\UserDocument::standardLabel($amStd),
                        'url'   => asset($amDocs['qa_agreement']->file_path),
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
                <button type="submit" class="am-btn am-btn-lightblue">
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
                <button type="submit" class="am-btn am-btn-lightblue">
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
