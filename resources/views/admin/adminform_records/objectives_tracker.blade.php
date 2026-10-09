@extends('admin.dashboard.layouts.app')

@section('content')
@php
    // whose objectives these are; every form has to say so, because the
    // controller takes the owner from the request when an admin is signed in
    $ownerId = $ownerId ?? request()->route('userid');
@endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div style="display:flex;align-items:center;gap:12px;">
            <button type="button" class="am-page-guide-btn"
                onclick="document.getElementById('amPageGuide').classList.add('open')"
                title="About Objectives Tracker" aria-label="About Objectives Tracker">
                <i class="fa fa-info-circle"></i>
            </button>
            <div>
                <h2>Objectives Tracker</h2>
            </div>
        </div>
        <div>
            <a href="{{ url('/edit_user/'.$ownerId) }}" class="am-btn am-btn-outline">
                <i class="fa fa-arrow-left"></i> Back to Forms
            </a>
        </div>
    </div>

    @if(session('Success'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ session('Success') }}
        </div>
    @endif

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form method="GET" action="{{ url('/objectivesCheck/' . $ownerId) }}" class="am-search" id="amObjSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amObjSearch" value="{{ $search ?? '' }}" placeholder="Search objectives…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleObjForm">
                <i class="fa fa-plus"></i> Add Objective
            </button>
        </div>

        <div class="am-inline-form" id="newObjForm" style="margin:16px 20px;">
            <form action="{{ route('objective.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $ownerId }}">
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>Objective *</label><input type="text" name="objective" placeholder="Reduce general waste sent to landfill by 15%" required></div>
                </div>
                <div class="form-row">
                    <div><label>How it is measured *</label><input type="text" name="how_measured" placeholder="Monthly waste weight on supplier invoices" required></div>
                    <div><label>Starting point</label><input type="text" name="starting_point" placeholder="4.2 tonnes in 2025"></div>
                    <div><label>Target *</label><input type="text" name="target" placeholder="3.6 tonnes or less" required></div>
                </div>
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>How will this be achieved</label><textarea name="how_achieved" rows="3" placeholder="Add recycling bins to every station; train staff at the April team meeting; switch to a supplier that recycles cardboard"></textarea></div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Person responsible *</label>
                        <select name="person_responsible" required>
                            <option value="">Choose employee…</option>
                            @foreach ($employees as $emp)
                                <option value="{{ trim($emp->first_name . ' ' . $emp->surname) }}">{{ trim($emp->first_name . ' ' . $emp->surname) ?: $emp->empNumber }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label>Agreed at</label>
                        <select name="agreed_at">
                            <option value="">Choose Management Review…</option>
                            @foreach ($reviews as $rev)
                                <option value="{{ $rev->id }}">{{ $rev->mgtreviewId ? 'Review ' . $rev->mgtreviewId : 'Review' }}@if($rev->reviewdate) — {{ date('d M Y', strtotime($rev->reviewdate)) }}@endif</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label>Deadline *</label><input type="date" max="2999-12-31" name="deadline" required></div>
                    <div>
                        <label>Status</label>
                        <select name="status">
                            @foreach (App\Objective::statuses() as $key => $st)
                                <option value="{{ $key }}" {{ $key === 'not_started' ? 'selected' : '' }}>{{ $st['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelObjForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Objective</button>
                </div>
            </form>
        </div>
    </div>

    {{-- What each status means --}}
    <div class="am-card" style="margin-bottom:16px;padding:16px 20px;background:rgba(46,59,154,0.04);border:1px solid var(--am-primary);">
        <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-primary);font-weight:600;margin-bottom:12px;">What each status means</div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:14px 18px;">
            @foreach (App\Objective::statuses() as $st)
                <div>
                    <span class="am-chip {{ $st['chip'] }}">{{ $st['label'] }}</span>
                    <div style="font-size:12.5px;color:var(--am-text);line-height:1.5;margin-top:6px;">{{ $st['means'] }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="am-card">
        <div id="amObjContainer">
            @include('dashboard.form_records.partials.objectives_table')
        </div>
    </div>
</div>

{{-- View modal --}}
<div class="am-modal" id="viewObjModal" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:760px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Objective Details</h4>
        </div>
        <div class="am-modal__body">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px 18px;">
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Objective</div><div id="vobj-objective">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">How it is measured</div><div id="vobj-measured">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Starting point</div><div id="vobj-start">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Target</div><div id="vobj-target">—</div></div>
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">How will this be achieved</div><div id="vobj-achieved">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Person responsible</div><div id="vobj-person">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Deadline</div><div id="vobj-deadline">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Status</div><div id="vobj-status">—</div></div>
            </div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="editObjModal" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Objective</h4>
        </div>
        <form action="{{ route('objective.update') }}" method="POST" style="display:contents;">
            @csrf
            <input type="hidden" name="user_id" value="{{ $ownerId }}">
            <input type="hidden" name="id" id="eobj-id">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-12"><label>Objective *</label><input type="text" class="form-control" name="objective" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4"><label>How it is measured *</label><input type="text" class="form-control" name="how_measured" required></div>
                    <div class="col-lg-4"><label>Starting point</label><input type="text" class="form-control" name="starting_point"></div>
                    <div class="col-lg-4"><label>Target *</label><input type="text" class="form-control" name="target" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12"><label>How will this be achieved</label><textarea class="form-control" name="how_achieved" rows="3"></textarea></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label>Person responsible *</label>
                        <select class="form-control" name="person_responsible" required>
                            <option value="">Choose employee…</option>
                            @foreach ($employees as $emp)
                                <option value="{{ trim($emp->first_name . ' ' . $emp->surname) }}">{{ trim($emp->first_name . ' ' . $emp->surname) ?: $emp->empNumber }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label>Agreed at</label>
                        <select class="form-control" name="agreed_at">
                            <option value="">Choose Management Review…</option>
                            @foreach ($reviews as $rev)
                                <option value="{{ $rev->id }}">{{ $rev->mgtreviewId ? 'Review ' . $rev->mgtreviewId : 'Review' }}@if($rev->reviewdate) — {{ date('d M Y', strtotime($rev->reviewdate)) }}@endif</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3"><label>Deadline *</label><input type="date" max="2999-12-31" class="form-control" name="deadline" required></div>
                    <div class="col-lg-3">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            @foreach (App\Objective::statuses() as $key => $st)
                                <option value="{{ $key }}">{{ $st['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
                <button type="submit" class="am-btn am-btn-primary"><i class="fa fa-check"></i> Update</button>
            </div>
        </form>
    </div>
</div>

{{-- Update progress --}}
<div class="am-modal" id="progressObjModal" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:860px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-chart-line"></i></span>
            <div>
                <h4 class="am-modal__title">Update Progress</h4>
                <div id="pobj-title" style="font-size:12.5px;color:var(--am-text-muted);"></div>
            </div>
        </div>
        <form action="{{ route('objective.progress') }}" method="POST" enctype="multipart/form-data" style="display:contents;">
            @csrf
            <input type="hidden" name="user_id" value="{{ $ownerId }}">
            <input type="hidden" name="objective_id" id="pobj-id">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-6"><label>Progress note *</label><input type="text" class="form-control" name="note" placeholder="Down 9% compared with the same period last year" required></div>
                    <div class="col-lg-3">
                        <label>Status *</label>
                        <select class="form-control" name="status" id="pobj-status" required>
                            @foreach (App\Objective::statuses() as $key => $st)
                                <option value="{{ $key }}">{{ $st['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3"><label>Date</label><input type="date" max="2999-12-31" class="form-control" name="update_date" id="pobj-date"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label>Evidence <span style="color:var(--am-text-soft);">PDF, JPEG, TXT, DOCX or PNG — a waste invoice, energy bill, complaints log or accident report</span></label>
                        <input type="file" class="form-control" name="evidence" accept=".pdf,.jpg,.jpeg,.txt,.doc,.docx,.png">
                    </div>
                </div>

                <div style="border-top:1px solid var(--am-border);padding-top:14px;margin-top:6px;">
                    <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:10px;">Progress history</div>
                    <div id="pobj-history"></div>
                </div>
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
                <button type="submit" class="am-btn am-btn-primary"><i class="fa fa-check"></i> Save Update</button>
            </div>
        </form>
    </div>
</div>

{{-- Delete --}}
<div class="am-modal" id="amObjConfirmDelete" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:460px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:rgba(235,77,75,0.12);color:var(--am-danger);"><i class="fa fa-exclamation-triangle"></i></span>
            <h4 class="am-modal__title">Delete Objective</h4>
        </div>
        <div class="am-modal__body"><p style="margin:0;">This removes the objective and its whole progress history. This cannot be undone.</p></div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
            <form action="{{ route('objective.destroy') }}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="user_id" value="{{ $ownerId }}">
                <input type="hidden" name="id" id="dobj-id">
                <button type="submit" class="am-btn am-btn-danger"><i class="fa fa-trash"></i> Delete</button>
            </form>
        </div>
    </div>
</div>

<script>
// Closing a modal: the close button, the backdrop, or Escape - the same
// handler every other page on this site uses.
document.addEventListener('click', function(e) {
    var close = e.target.closest('.am-modal-close');
    if (close) { var m = close.closest('.am-modal'); if (m) m.classList.remove('open'); return; }
    if (e.target.classList && e.target.classList.contains('am-modal')) e.target.classList.remove('open');
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') document.querySelectorAll('.am-modal.open').forEach(function(m){ m.classList.remove('open'); });
});
var amObjStatuses = @json(App\Objective::statuses());

document.addEventListener('DOMContentLoaded', function () {
    var form   = document.getElementById('newObjForm');
    var toggle = document.getElementById('toggleObjForm');
    var cancel = document.getElementById('cancelObjForm');
    toggle && toggle.addEventListener('click', function () { form.classList.toggle('open'); });
    cancel && cancel.addEventListener('click', function () { form.classList.remove('open'); });
});

// search and paging without a full page load, as the other lists do
(function () {
    var input     = document.getElementById('amObjSearch');
    var form      = document.getElementById('amObjSearchForm');
    var container = document.getElementById('amObjContainer');
    if (!container) return;
    var baseUrl = '{{ url('/objectivesCheck/' . $ownerId) }}';
    var status  = '{{ $status ?? '' }}';

    function debounce(fn, wait) { var t; return function () { var c = this, a = arguments; clearTimeout(t); t = setTimeout(function () { fn.apply(c, a); }, wait); }; }
    function fetchPage(page) {
        var q = input ? input.value.trim() : '';
        var url = baseUrl + '?q=' + encodeURIComponent(q) + '&status=' + encodeURIComponent(status) + '&page=' + page;
        container.style.opacity = '0.5';
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function (r) { return r.text(); })
            .then(function (html) { container.innerHTML = html; container.style.opacity = ''; window.history.replaceState({}, '', url); })
            .catch(function () { container.style.opacity = ''; });
    }
    form && form.addEventListener('submit', function (e) { e.preventDefault(); fetchPage(1); });
    input && input.addEventListener('input', debounce(function () { fetchPage(1); }, 300));
    container.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-page]');
        if (!btn) return;
        e.preventDefault();
        var p = parseInt(btn.getAttribute('data-page'), 10);
        if (!isNaN(p) && p > 0) fetchPage(p);
    });
    container.addEventListener('click', function (e) {
        var chip = e.target.closest('[data-status-filter]');
        if (!chip) return;
        e.preventDefault();
        status = chip.getAttribute('data-status-filter');
        fetchPage(1);
    });
})();

function amObjView(d) {
    document.getElementById('vobj-objective').textContent = d.objective || '—';
    document.getElementById('vobj-measured').textContent  = d.how_measured || '—';
    document.getElementById('vobj-start').textContent     = d.starting_point || '—';
    document.getElementById('vobj-target').textContent    = d.target || '—';
    document.getElementById('vobj-achieved').textContent  = d.how_achieved || '—';
    document.getElementById('vobj-person').textContent    = d.person_responsible || '—';
    document.getElementById('vobj-deadline').textContent  = d.deadline ? new Date(d.deadline).toLocaleDateString() : '—';
    var st = amObjStatuses[d.status];
    document.getElementById('vobj-status').innerHTML =
        '<span class="am-chip ' + (st ? st.chip : '') + '">' + (st ? st.label : (d.status || '—')) + '</span>';
    document.getElementById('viewObjModal').classList.add('open');
}

function amObjEdit(d) {
    var m = document.getElementById('editObjModal');
    document.getElementById('eobj-id').value = d.id || '';
    ['objective', 'how_measured', 'starting_point', 'target', 'deadline'].forEach(function (k) {
        var el = m.querySelector("[name='" + k + "']");
        if (el) el.value = d[k] || '';
    });
    var ta = m.querySelector("[name='how_achieved']"); if (ta) ta.value = d.how_achieved || '';
    ['person_responsible', 'agreed_at', 'status'].forEach(function (k) {
        var el = m.querySelector("select[name='" + k + "']");
        if (el) el.value = d[k] || '';
    });
    m.classList.add('open');
}

// the history is rendered from the rows the server sent with the list
function amObjProgress(d, history) {
    document.getElementById('pobj-id').value = d.id || '';
    document.getElementById('pobj-title').textContent = d.objective || '';
    var sel = document.getElementById('pobj-status'); if (sel) sel.value = d.status || 'not_started';
    var dt = document.getElementById('pobj-date');
    if (dt && !dt.value) { dt.value = new Date().toISOString().slice(0, 10); }   // today, as a starting point

    var box = document.getElementById('pobj-history');
    box.innerHTML = '';
    if (!history || !history.length) {
        box.innerHTML = '<div style="font-size:13px;color:var(--am-text-muted);">No progress recorded yet.</div>';
    } else {
        history.forEach(function (h) {
            var st = amObjStatuses[h.status] || { chip: '', label: h.status };
            var row = document.createElement('div');
            row.style.cssText = 'display:grid;grid-template-columns:110px 120px 1fr 110px;gap:12px;align-items:start;padding:10px 0;border-bottom:1px solid var(--am-border);font-size:13px;';
            row.innerHTML =
                '<div style="color:var(--am-text-muted);">' + (h.update_date ? new Date(h.update_date).toLocaleDateString() : '—') + '</div>' +
                '<div><span class="am-chip ' + st.chip + '">' + st.label + '</span></div>' +
                '<div>' + (h.note ? String(h.note).replace(/[<>&]/g, function (c) { return { '<': '&lt;', '>': '&gt;', '&': '&amp;' }[c]; }) : '') + '</div>' +
                '<div>' + (h.evidence
                    ? '<a href="{{ asset('objective_evidence') }}/' + encodeURIComponent(h.evidence) + '" target="_blank">' + h.evidence + '</a>'
                    : '—') + '</div>';
            box.appendChild(row);
        });
    }
    document.getElementById('progressObjModal').classList.add('open');
}

function amObjDelete(id) {
    document.getElementById('dobj-id').value = id;
    document.getElementById('amObjConfirmDelete').classList.add('open');
}
</script>
{{-- The guide behind the "i" beside the title --}}
@include('dashboard.form_records.partials.guides.objectives_tracker')

@endsection
