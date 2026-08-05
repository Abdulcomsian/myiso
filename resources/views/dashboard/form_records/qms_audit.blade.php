@extends('dashboard.layouts.app')

@section('content')
@php
// Full ISO 9001:2015 audit checklist mapping:
// [radio_field, evidence_field (or null), clause_no, label]
$qmsChecklist = [
    ['qmsCorects',       'evidence',    '4.1',  'Understanding the organization and its context'],
    ['needExpactations', 'evidance2',   '4.2',  'Interested parties requirements and expectations'],
    ['correction3',      'evidence3',   '4.3',  'Scope of the quality management system'],
    ['correction4',      'evidance4',   '4.4',  'Quality management system and its procedures'],
    ['correction5',      'evidence5',   '5.1',  'Leadership and commitment'],
    ['correction6',      'evidance7',   '5.2',  'Policy (Quality Policy)'],
    ['correction7',      'evidance7_1', '5.3',  'Organizational roles, responsibilities & authorities'],
    ['correction8',      'evidance8',   '6.1',  'Actions to address risks and opportunities'],
    ['correction9',      'evidance10',  '6.2',  'Quality objectives and planning'],
    ['correction11',     'evidance12',  '6.3',  'Planning of changes'],
    ['correction12',     'evidence13',  '7.1',  'Resources (people, infrastructure, environment)'],
    ['correction13',     'evidance14',  '7.2',  'Competence (training records)'],
    ['correction14',     null,          '7.3',  'Awareness'],
    ['correction15',     'evidence15',  '7.4',  'Communication'],
    ['correction16',     null,          '7.5',  'Documented information'],
    ['correciton17',     null,          '8.1',  'Planning and managing operations'],
    ['correction18',     'evidence19',  '8.2',  'Requirements for products and services'],
    ['correction19',     'evidence20',  '8.3',  'Design and development'],
    ['correction20',     'evidence21',  '8.4',  'Control of externally-provided processes/products'],
    ['correction21',     null,          '8.5',  'Production and service provision'],
    ['correction22',     'evidence23',  '8.6',  'Release of products and services'],
    ['correction23',     null,          '8.7',  'Control of nonconforming outputs'],
    ['correction24',     'evidence25',  '9.1',  'Monitoring, measurement, analysis & evaluation'],
    ['correction25',     'evidence26',  '9.1.2','Customer satisfaction'],
    ['correction26',     'evidence27',  '9.2',  'Internal audit'],
    ['correction27',     'evidence28',  '9.3',  'Management review'],
    ['correction28',     'evidence29',  '10.1', 'Improvement'],
    ['correction30',     'evidence30',  '10.2', 'Nonconformity and corrective action'],
    ['correction29',     'evidence31',  '10.3', 'Continual improvement'],
];
@endphp

<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>QMS Audits</h2>
            <p>Annual horizontal audit against each clause of the ISO 9001:2015 standard.</p>
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

    <div class="am-card" style="padding:16px 20px;margin-bottom:16px;background:rgba(46,59,154,0.04);border:1px solid rgba(46,59,154,0.12);">
        <div style="display:flex;gap:12px;align-items:flex-start;">
            <span style="width:36px;height:36px;flex-shrink:0;border-radius:10px;background:var(--am-primary-tint);color:var(--am-primary);display:inline-flex;align-items:center;justify-content:center;font-size:15px;"><i class="fa fa-info-circle"></i></span>
            <div style="font-size:13px;color:var(--am-text);line-height:1.55;">
                Horizontal audit against each ISO clause. Frequency is typically annual to determine your compliance level.
                Audits will be conducted in accordance with <a href="{{ url('auidt') }}" style="color:var(--am-primary);">Audits</a>.
            </div>
        </div>
    </div>

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
                    <div><label>Attach Evidence</label><input name="attach_evidence" type="file" accept="image/*,.doc,.docx,.txt,.pdf"></div>
                </div>
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>Audit Comments &amp; Actions</label><textarea name="audit_comments_actions" rows="2" required></textarea></div>
                </div>
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>Any Other Issues</label><input type="text" name="any_issues" placeholder="Notes"></div>
                </div>

                <div style="border-top:1px solid var(--am-border);padding-top:14px;margin-top:6px;">
                    <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:10px;">ISO 9001:2015 Clause Checklist</div>
                    @foreach($qmsChecklist as $qmsRow)
                        @php
                            $radioName = $qmsRow[0];
                            $evidenceName = $qmsRow[1];
                            $clause = $qmsRow[2];
                            $label = $qmsRow[3];
                        @endphp
                        <div class="form-row" style="margin-bottom:8px;">
                            <div style="grid-column:span 3;">
                                <label><strong style="color:var(--am-primary);">{{ $clause }}</strong> — {{ $label }}</label>
                                <div style="display:flex;gap:12px;font-size:13px;padding:6px 0;">
                                    <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" value="Yes" required name="{{ $radioName }}"> Yes</label>
                                    <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" value="No" required name="{{ $radioName }}"> No</label>
                                    <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" value="NA" required name="{{ $radioName }}"> N/A</label>
                                </div>
                            </div>
                            @if ($evidenceName)
                                <div style="grid-column:span 3;">
                                    <label>Evidence</label>
                                    <input type="text" name="{{ $evidenceName }}" placeholder="Evidence notes">
                                </div>
                            @endif
                        </div>
                    @endforeach
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
                <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:10px;">Clause Answers</div>
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
                <div class="form-group row">
                    <div class="col-lg-12"><label>Audit Comments &amp; Actions</label><textarea class="form-control" name="audit_comments_actions" rows="2"></textarea></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-8"><label>Any Other Issues</label><input type="text" class="form-control" name="any_issues"></div>
                    <div class="col-lg-4"><label>Attach Evidence</label><input name="attach_evidence" type="file" class="form-control"></div>
                </div>

                @foreach($qmsChecklist as $qmsRow)
                    @php
                        $radioName = $qmsRow[0];
                        $evidenceName = $qmsRow[1];
                        $clause = $qmsRow[2];
                        $label = $qmsRow[3];
                    @endphp
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label><strong style="color:var(--am-primary);">{{ $clause }}</strong> — {{ Str::limit($label, 60) }}</label>
                            <div style="display:flex;gap:12px;font-size:13px;padding:6px 0;">
                                <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" value="Yes" name="{{ $radioName }}"> Yes</label>
                                <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" value="No" name="{{ $radioName }}"> No</label>
                                <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" value="NA" name="{{ $radioName }}"> N/A</label>
                            </div>
                        </div>
                        @if ($evidenceName)
                            <div class="col-lg-6"><label>Evidence</label><input type="text" class="form-control" name="{{ $evidenceName }}"></div>
                        @endif
                    </div>
                @endforeach
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

<?php
    $qmsChecklistJs = collect($qmsChecklist)->map(function($c){
        return ['radio' => $c[0], 'evidence' => $c[1], 'clause' => $c[2], 'label' => $c[3]];
    })->values();
?>
var qmsChecklist = {!! json_encode($qmsChecklistJs) !!};

function amQmsView(d){
    document.getElementById('vqms-auditor').textContent = d.auditrName||'—';
    document.getElementById('vqms-date').textContent = d.competedDate ? new Date(d.competedDate).toLocaleDateString() : '—';
    document.getElementById('vqms-comments').textContent = d.audit_comments_actions||'—';
    document.getElementById('vqms-issues').textContent = d.any_issues||'—';
    var ev = document.getElementById('vqms-ev');
    if (d.attach_evidence) { ev.innerHTML = '<a href="'+d.attach_evidence+'" target="_blank" style="color:var(--am-primary);"><i class="fa fa-external-link-alt"></i> View</a>'; } else ev.textContent='—';
    var chk = document.getElementById('vqms-checklist');
    chk.innerHTML = '';
    qmsChecklist.forEach(function(f){
        var row = document.createElement('div');
        var answer = d[f.radio] || '—';
        var badgeCls = answer === 'Yes' ? 'success' : (answer === 'No' ? 'danger' : 'info');
        var ev = f.evidence && d[f.evidence] ? '<div style="font-size:12px;color:var(--am-text-muted);margin-top:2px;padding-left:12px;">Evidence: ' + d[f.evidence] + '</div>' : '';
        row.innerHTML = '<div style="display:flex;gap:10px;align-items:center;padding:6px 10px;background:var(--am-hover);border-radius:6px;"><strong style="color:var(--am-primary);min-width:44px;">' + f.clause + '</strong><div style="flex:1;">' + f.label + '</div><span class="am-chip ' + badgeCls + '">' + answer + '</span></div>' + ev;
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
    qmsChecklist.forEach(function(f){
        m.querySelectorAll("input[name='"+f.radio+"']").forEach(function(r){ r.checked = false; });
        if (d[f.radio]) {
            var chk = m.querySelector("input[name='"+f.radio+"'][value='"+d[f.radio]+"']");
            if (chk) chk.checked = true;
        }
        if (f.evidence) {
            var el = m.querySelector("input[name='"+f.evidence+"']");
            if (el) el.value = d[f.evidence] || '';
        }
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
