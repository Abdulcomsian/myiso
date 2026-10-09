@extends('dashboard.layouts.app')

@section('content')
@php
// The 17 questions the audit asks, and the colour each standard badge wears.
$qmsQuestions = App\QmsAuditQuestions::all();
$qmsBadgeChip = App\QmsAuditQuestions::badgeChips();
@endphp

<div class="am-content">

    <div class="am-page-header">
        <div style="display:flex;align-items:center;gap:12px;">
            <button type="button" class="am-page-guide-btn"
                onclick="document.getElementById('amPageGuide').classList.add('open')"
                title="About QMS Audits" aria-label="About QMS Audits">
                <i class="fa fa-info-circle"></i>
            </button>
            <div>
                <h2>QMS Audits</h2>
            </div>
        </div>
        <div class="am-page-header__actions">
            <a href="{{ asset('download_qms_audit/QMS-Audit-Report.pdf') }}" target="_blank" class="am-btn am-btn-outline">
                <i class="fa fa-download"></i> Download QMS Audit
            </a>
        </div>
    </div>

    @if(session('message'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ session('message') }}
        </div>
    @endif
    @if(session('msg'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ session('msg') }}
        </div>
    @endif

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form method="GET" action="{{ url('/qms_audit') }}" class="am-search" id="amQmsSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amQmsSearch" value="{{ $search ?? '' }}" placeholder="Search QMS audits…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleQmsForm">
                <i class="fa fa-plus"></i> Add QMS Audit
            </button>
        </div>

        <div class="am-inline-form" id="newQmsForm" style="margin:16px 20px;">
            <form action="{{ route('qmsaudit') }}" method="POST" enctype="multipart/form-data" class="addForm">
                @csrf
                <div class="form-row">
                    <div><label>Auditor Name</label><input type="text" name="auditrName" required></div>
                    <div><label>Date Completed</label><input type="date" max="2999-12-31" name="competedDate" required></div>
                </div>
                <div style="padding-top:4px;">
                    @foreach ($qmsQuestions as $q)
                        @include('dashboard.form_records.partials.qms_question_card', [
                            'q' => $q,
                            'prefix' => 'add',
                            'answers' => $qmsAnswers ?? [],
                            'notes' => $qmsNotes ?? [],
                        ])
                    @endforeach
                </div>

<div class="form-row">
    <div><label>Audit Comments &amp; Actions</label><textarea name="audit_comments_actions" rows="3" required placeholder="Summary of what you found, what will be fixed, who by and when."></textarea></div>
    <div><label>Any Other Issues</label><textarea name="any_issues" rows="3" placeholder="Anything outside the checklist worth raising at the next Management Review."></textarea></div>
</div>

                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelQmsForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Audit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div id="amQmsContainer">
            @include('dashboard.form_records.partials.qms_audit_table')
        </div>
    </div>
</div>

{{-- Page guide --}}
<div class="am-modal" id="amPageGuide" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:600px;">
        <div class="am-modal__header">
            <span class="am-modal__icon am-page-guide-icon"><i class="fa fa-info-circle"></i></span>
            <div>
                <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;">Forms &amp; Records</div>
                <h4 class="am-modal__title" style="color:var(--am-primary);">QMS Audits</h4>
            </div>
        </div>
        <div class="am-modal__body" style="color:var(--am-text);">
            <h5 style="font-size:13px;font-weight:600;color:var(--am-primary);margin:0 0 6px;">What is it?</h5>
            <p style="margin:0 0 16px;">A once-a-year minimum check of your whole system against ISO 9001, 14001 and 45001, or individual standards in 17 questions. A Process Audit looks at one job; this looks at everything.</p>

            <h5 style="font-size:13px;font-weight:600;color:var(--am-primary);margin:0 0 6px;">Why does it matter?</h5>
            <p style="margin:0 0 16px;">This is your own health check before the certification auditor does theirs. Carrying one out, and fixing what it finds, is what separates a business that manages its system from one that just files paperwork. The auditor asks for this summary at every annual surveillance.</p>

            <h5 style="font-size:13px;font-weight:600;color:var(--am-primary);margin:0 0 6px;">Basic steps</h5>
            <ul style="margin:0;padding-inline-start:18px;list-style:disc;color:var(--am-text);font-size:13.5px;line-height:1.5;">
                <li style="margin-bottom:6px;">Click Add QMS Audit and record who carried it out and the date completed.</li>
                <li style="margin-bottom:6px;">Work through the 17 questions, using “WHAT TO CHECK” list. Skip lines labelled for a standard you do not hold.</li>
                <li style="margin-bottom:6px;">Answer Yes, No or N/A using the grey box. Be honest — finding problems is the whole point.</li>
                <li style="margin-bottom:6px;">Raise a Non-Conformity for anything that fell short, so the fix gets tracked properly.</li>
                <li>Recording evidence is vital here, so where possible record / photograph / scan evidence and attach it.</li>
            </ul>
        </div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline am-modal-close">Close</button>
        </div>
    </div>
</div>

{{-- View modal --}}
<div class="am-modal" id="editProcessAudit" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">QMS Audit Details</h4>
        </div>
        <div class="am-modal__body">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;font-size:13px;margin-bottom:20px;">
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Auditor</div><div id="vqms-auditor">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Date Completed</div><div id="vqms-date">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Evidence File</div><div id="vqms-ev">—</div></div>
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Comments &amp; Actions</div><div id="vqms-comments">—</div></div>
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Any Other Issues</div><div id="vqms-issues">—</div></div>
            </div>
            <div style="border-top:1px solid var(--am-border);padding-top:14px;">
                <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:10px;">Answers</div>
                <div id="vqms-checklist" style="display:grid;grid-template-columns:1fr;gap:8px;font-size:13px;"></div>
            </div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="geteditdetails" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:1000px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit QMS Audit</h4>
        </div>
        <form action="{{ route('update_qmsaudit') }}" method="POST" enctype="multipart/form-data" style="display:contents;">
            @csrf
            <input type="hidden" name="id" id="eqms-id">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-6"><label>Auditor Name</label><input type="text" class="form-control" name="auditrName" required></div>
                    <div class="col-lg-6"><label>Date Completed</label><input type="date" class="form-control" name="competedDate" required></div>
                </div>

                @foreach ($qmsQuestions as $q)
                    @include('dashboard.form_records.partials.qms_question_card', [
                        'q' => $q,
                        'prefix' => 'edit',
                        'answers' => $qmsAnswers ?? [],
                        'notes' => $qmsNotes ?? [],
                    ])
                @endforeach
<div class="form-group row">
    <div class="col-lg-6"><label>Audit Comments &amp; Actions</label><textarea class="form-control" name="audit_comments_actions" rows="3" required></textarea></div>
    <div class="col-lg-6"><label>Any Other Issues</label><textarea class="form-control" name="any_issues" rows="3"></textarea></div>
</div>
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
                <button type="submit" class="am-btn am-btn-primary"><i class="fa fa-check"></i> Update</button>
            </div>
        </form>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="am-modal" id="amConfirmDelete" role="dialog" aria-modal="true">
    <div class="am-modal__box">
        <div class="am-modal__header">
            <span class="am-modal__icon"><i class="fa fa-exclamation-triangle"></i></span>
            <h4 class="am-modal__title">Delete <span id="amConfirmType">Item</span>?</h4>
        </div>
        <div class="am-modal__body">
            You are about to permanently delete <strong id="amConfirmLabel">this item</strong>. This action cannot be undone.
        </div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
            <form id="amConfirmForm" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="id" id="amConfirmId">
                <button type="submit" class="am-btn" style="background:var(--am-danger);color:#fff;">
                    <i class="fa fa-trash"></i> Yes, delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// The "what to check" panels. Every question opens its own in place; the
// panel is found by walking up to the question rather than by id, because
// the form is rendered twice and an id would not be unique.
document.addEventListener('click', function (e) {
    var btn = e.target.closest('.qms-guide-toggle');
    if (!btn) return;
    var card = btn.closest('[data-qms-q]');
    var pnl = card && card.querySelector('.qms-guide');
    if (!pnl) return;
    var open = pnl.classList.toggle('is-open');
    btn.classList.toggle('is-open', open);
});
document.addEventListener('click', function(e) {
    var close = e.target.closest('.am-modal-close');
    if (close) { var m = close.closest('.am-modal'); if (m) m.classList.remove('open'); return; }
    if (e.target.classList && e.target.classList.contains('am-modal')) e.target.classList.remove('open');
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') document.querySelectorAll('.am-modal.open').forEach(function(m){ m.classList.remove('open'); });
});
(function() {
    var t = document.getElementById('toggleQmsForm');
    var f = document.getElementById('newQmsForm');
    var c = document.getElementById('cancelQmsForm');
    t && t.addEventListener('click', function() { f.classList.toggle('open'); });
    c && c.addEventListener('click', function() { f.classList.remove('open'); });
})();
document.addEventListener('click', function(e) {
    var btn = e.target.closest('.am-confirm-delete');
    if (!btn) return;
    e.preventDefault();
    document.getElementById('amConfirmForm').setAttribute('action', btn.getAttribute('data-action') || '');
    document.getElementById('amConfirmId').value = btn.getAttribute('data-id') || '';
    document.getElementById('amConfirmType').textContent = btn.getAttribute('data-type') || 'Item';
    document.getElementById('amConfirmLabel').textContent = btn.getAttribute('data-label') || 'this item';
    document.getElementById('amConfirmDelete').classList.add('open');
});
(function() {
    var input = document.getElementById('amQmsSearch');
    var form = document.getElementById('amQmsSearchForm');
    var container = document.getElementById('amQmsContainer');
    if (!container) return;
    var baseUrl = '{{ url('/qms_audit') }}';
    function debounce(fn, wait) { var t; return function() { var ctx = this, args = arguments; clearTimeout(t); t = setTimeout(function() { fn.apply(ctx, args); }, wait); }; }
    function showLoading() { container.style.opacity = '0.5'; container.style.pointerEvents = 'none'; }
    function hideLoading() { container.style.opacity = ''; container.style.pointerEvents = ''; }
    function fetchPage(page) {
        var q = input ? input.value.trim() : '';
        var url = baseUrl + '?q=' + encodeURIComponent(q) + '&page=' + page;
        showLoading();
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function(r) { return r.text(); })
            .then(function(html) { container.innerHTML = html; hideLoading(); })
            .catch(function() { hideLoading(); });
    }
    input && input.addEventListener('input', debounce(function() { fetchPage(1); }, 350));
    form && form.addEventListener('submit', function(e) { e.preventDefault(); fetchPage(1); });
    container.addEventListener('click', function(e) {
        var btn = e.target.closest('.am-page-link');
        if (!btn || btn.disabled) return;
        e.preventDefault();
        var p = parseInt(btn.getAttribute('data-page'), 10);
        if (!isNaN(p) && p > 0) fetchPage(p);
    });
})();

// the questions, so the scripts can label an answer without repeating them
var qmsQuestions = {!! json_encode(collect($qmsQuestions)->map(function ($q) {
    return ['no' => $q['no'], 'title' => $q['title'], 'na' => (bool) $q['tick_na']];
})->values()) !!};

// an audit carries its answers with it; key them by question for lookup
function amQmsEsc(s) {
    return String(s == null ? '' : s).replace(/[<>&]/g, function (c) {
        return { '<': '&lt;', '>': '&gt;', '&': '&amp;' }[c];
    });
}
function qmsAnswersOf(d) {
    var by = {};
    (d.answers || []).forEach(function (a) { by[a.question_no] = a; });
    return by;
}

function amQmsView(d){
    document.getElementById('vqms-auditor').textContent = d.auditrName||'—';
    document.getElementById('vqms-date').textContent = d.competedDate ? new Date(d.competedDate).toLocaleDateString() : '—';
    document.getElementById('vqms-comments').textContent = d.audit_comments_actions||'—';
    document.getElementById('vqms-issues').textContent = d.any_issues||'—';
    var ev = document.getElementById('vqms-ev');
    if (d.attach_evidence) { ev.innerHTML = '<a href="'+d.attach_evidence+'" target="_blank" style="color:var(--am-primary);"><i class="fa fa-external-link-alt"></i> View</a>'; } else ev.textContent='—';
    var chk = document.getElementById('vqms-checklist');
    chk.innerHTML = '';
    var byNo = qmsAnswersOf(d);
    qmsQuestions.forEach(function (q) {
        var a = byNo[q.no] || {};
        var answer = a.answer || '—';
        var cls = answer === 'Yes' ? 'success' : (answer === 'No' ? 'danger' : 'info');
        var note = a.note ? '<div style="font-size:12px;color:var(--am-text-muted);margin-top:2px;">' + amQmsEsc(a.note) + '</div>' : '';
        var file = a.evidence_file
            ? ' <a href="{{ asset('qms_evidence') }}/' + encodeURIComponent(a.evidence_file) + '" target="_blank">file</a>'
            : '';
        var row = document.createElement('div');
        row.innerHTML = '<div style="display:flex;gap:10px;align-items:flex-start;padding:6px 10px;background:var(--am-hover);border-radius:var(--am-radius-sm);margin-bottom:6px;">'
            + '<span class="am-chip ' + cls + '" style="flex-shrink:0;">' + answer + '</span>'
            + '<div><strong>' + q.no + '.</strong> ' + amQmsEsc(q.title) + note + file + '</div></div>';
        chk.appendChild(row);
    });
    document.getElementById('editProcessAudit').classList.add('open');
}
function amQmsEdit(d){
    document.getElementById('eqms-id').value = d.id || '';
    var m = document.getElementById('geteditdetails');
    ['auditrName','competedDate','audit_comments_actions','any_issues'].forEach(function(k){
        var el = m.querySelector("input[name='"+k+"'], textarea[name='"+k+"']");
        if (el) el.value = d[k] || '';
    });
    var byNo = qmsAnswersOf(d);
    qmsQuestions.forEach(function (q) {
        var a = byNo[q.no] || {};
        m.querySelectorAll("input[name='q[" + q.no + "]']").forEach(function (r) {
            r.checked = (a.answer === r.value);
        });
        var note = m.querySelector("textarea[name='qnote[" + q.no + "]']");
        if (note) note.value = a.note || '';
    });
    m.classList.add('open');
}

function qmsfun(id) {
    fetch('{{ url('/generate-pdf-qms') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({ qms_id: id })
    })
    .then(function(r){ return r.json(); })
    .then(function(res){ if (res.url) window.open(res.url, '_blank'); })
    .catch(function(){ console.error('Failed to generate PDF'); });
}
</script>
@endsection
