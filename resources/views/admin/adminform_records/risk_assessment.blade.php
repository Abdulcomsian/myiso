@extends('admin.dashboard.layouts.app')

@section('content')
@php $urlparam = request()->route()->parameters; @endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div>
            <h2>Risk Assessments</h2>
            <p>Evaluate contracts before acceptance — quality, delivery, price, and risk score.</p>
        </div>
        <div>
            <a href="{{ url('/edit_user/'.$urlparam['userid']) }}" class="am-btn am-btn-outline">
                <i class="fa fa-arrow-left"></i> Back to Forms
            </a>
        </div>
    </div>

    @if ($message = Session::get('msg'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ $message }}
        </div>
    @endif

    <div class="am-card" style="padding:16px 20px;margin-bottom:16px;background:rgba(46,59,154,0.04);border:1px solid rgba(46,59,154,0.12);">
        <div style="display:flex;gap:12px;align-items:flex-start;">
            <span style="width:36px;height:36px;flex-shrink:0;border-radius:10px;background:var(--am-primary-tint);color:var(--am-primary);display:inline-flex;align-items:center;justify-content:center;font-size:15px;"><i class="fa fa-info-circle"></i></span>
            <div style="font-size:13px;color:var(--am-text);line-height:1.55;">
                Detail possible scenarios when accepting a contract, and compare risk and consequence of issues occurring.
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form method="GET" action="{{ url('/riskAssesmntCheck/' . $urlparam['userid']) }}" class="am-search" id="amRaSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amRaSearch" value="{{ $search ?? '' }}" placeholder="Search assessments…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleRaForm">
                <i class="fa fa-plus"></i> Add Risk Assessment
            </button>
        </div>

        <div class="am-inline-form" id="newRaForm" style="margin:16px 20px;">
            <form action="{{ route('assessment') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                <div class="form-row">
                    <div><label>Job Number</label><input type="text" name="jobNumber" required></div>
                    <div><label>Date</label><input type="date" max="2999-12-31" name="date" required></div>
                    <div><label>Delivery Date</label><input type="date" max="2999-12-31" name="dateDevelry" required></div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Meet Quality Standard?</label>
                        <div style="display:flex;gap:10px;font-size:12.5px;padding:6px 0;">
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="qualitySatandard" value="Yes" required> Yes</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="qualitySatandard" value="No" required> No</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="qualitySatandard" value="NA" required> N/A</label>
                        </div>
                    </div>
                    <div style="grid-column:span 2;"><label>Comments</label><input type="text" name="commentsstandard" placeholder="Notes"></div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Meet Delivery Date?</label>
                        <div style="display:flex;gap:10px;font-size:12.5px;padding:6px 0;">
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="delevryStandard" value="yes" required> Yes</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="delevryStandard" value="no" required> No</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="delevryStandard" value="NA" required> N/A</label>
                        </div>
                    </div>
                    <div style="grid-column:span 2;"><label>Comments</label><input type="text" name="commentsdelvery" placeholder="Notes"></div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Meet Price?</label>
                        <div style="display:flex;gap:10px;font-size:12.5px;padding:6px 0;">
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="priceRequiremnt" value="yes" required> Yes</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="priceRequiremnt" value="No" required> No</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="priceRequiremnt" value="NA" required> N/A</label>
                        </div>
                    </div>
                    <div style="grid-column:span 2;"><label>Comments</label><input type="text" name="commentprice" placeholder="Notes"></div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Interested Parties Affected?</label>
                        <div style="display:flex;gap:10px;font-size:12.5px;padding:6px 0;">
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="interestedDeemed" value="Yes" required> Yes</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="interestedDeemed" value="No" required> No</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="interestedDeemed" value="NA" required> N/A</label>
                        </div>
                    </div>
                    <div style="grid-column:span 2;"><label>Comments</label><input type="text" name="commentsDeemed" placeholder="Notes"></div>
                </div>
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>Decision Comment</label><input type="text" name="DecisionComment" placeholder="Overall decision" required></div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Risk Probability (1-4)</label>
                        <select name="RiskProbability" required>
                            <option value="">Select</option>
                            <option value="4">4 — Very likely</option>
                            <option value="3">3 — Likely</option>
                            <option value="2">2 — Not likely</option>
                            <option value="1">1 — Very unlikely</option>
                        </select>
                    </div>
                    <div>
                        <label>Risk Severity (1-4)</label>
                        <select name="riskSeverity" required>
                            <option value="">Select</option>
                            <option value="4">4 — Catastrophic</option>
                            <option value="3">3 — Critical</option>
                            <option value="2">2 — Marginal</option>
                            <option value="1">1 — Negligible</option>
                        </select>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelRaForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Assessment</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div id="amRaContainer">
            @include('admin.adminform_records.partials.risk_assessment_table')
        </div>
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

{{-- View modal --}}
<div class="am-modal" id="view_Modal" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:820px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Risk Assessment Details</h4>
        </div>
        <div class="am-modal__body">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;font-size:13px;">
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Job Number</div><div id="vra-job">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Date</div><div id="vra-date">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Delivery Date</div><div id="vra-dd">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Quality Standard</div><div id="vra-qs">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Delivery Standard</div><div id="vra-ds">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Price Requirement</div><div id="vra-pr">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Interested Parties</div><div id="vra-ip">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Risk Probability</div><div id="vra-rp">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Risk Severity</div><div id="vra-rs">—</div></div>
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Decision Comment</div><div id="vra-dc">—</div></div>
            </div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="editModal" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Risk Assessment</h4>
        </div>
        <form action="{{ route('editassessment') }}" method="POST" style="display:contents;">
            @csrf
            <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
            <input type="hidden" name="id" id="era-id">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-4"><label>Job Number</label><input type="text" class="form-control" name="jobNumber" required></div>
                    <div class="col-lg-4"><label>Date</label><input type="date" class="form-control" name="date" required></div>
                    <div class="col-lg-4"><label>Delivery Date</label><input type="date" class="form-control" name="dateDevelry" required></div>
                </div>
                @php
                    $radios = [
                        'qualitySatandard'  => ['Meet Quality Standard?',    ['Yes','No','NA']],
                        'delevryStandard'   => ['Meet Delivery Standard?',   ['yes','no','NA']],
                        'priceRequiremnt'   => ['Meet Price?',               ['yes','No','NA']],
                        'interestedDeemed'  => ['Interested Parties?',       ['Yes','No','NA']],
                    ];
                @endphp
                @foreach($radios as $name => [$label, $opts])
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>{{ $label }}</label>
                        <div style="display:flex;gap:12px;font-size:13px;padding:6px 0;">
                            @foreach($opts as $val)
                                <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="{{ $name }}" value="{{ $val }}"> {{ $val === 'NA' ? 'N/A' : ucfirst($val) }}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6"><label>Comments</label><input type="text" class="form-control" name="comments{{ $name === 'qualitySatandard' ? 'standard' : ($name === 'delevryStandard' ? 'delvery' : ($name === 'priceRequiremnt' ? 'price' : 'Deemed')) }}"></div>
                </div>
                @endforeach
                <div class="form-group row">
                    <div class="col-lg-12"><label>Decision Comment</label><input type="text" class="form-control" name="DecisionComment" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Risk Probability</label>
                        <select class="form-control" name="RiskProbability" required>
                            <option value="">Select</option>
                            <option value="4">4 — Very likely</option><option value="3">3 — Likely</option><option value="2">2 — Not likely</option><option value="1">1 — Very unlikely</option>
                        </select>
                    </div>
                    <div class="col-lg-6"><label>Risk Severity</label>
                        <select class="form-control" name="riskSeverity" required>
                            <option value="">Select</option>
                            <option value="4">4 — Catastrophic</option><option value="3">3 — Critical</option><option value="2">2 — Marginal</option><option value="1">1 — Negligible</option>
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

<script>
document.addEventListener('click', function(e) {
    var close = e.target.closest('.am-modal-close');
    if (close) { var m = close.closest('.am-modal'); if (m) m.classList.remove('open'); return; }
    if (e.target.classList && e.target.classList.contains('am-modal')) e.target.classList.remove('open');
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') document.querySelectorAll('.am-modal.open').forEach(function(m){ m.classList.remove('open'); });
});
(function(){
    var t=document.getElementById('toggleRaForm'),f=document.getElementById('newRaForm'),c=document.getElementById('cancelRaForm');
    t&&t.addEventListener('click',function(){f.classList.toggle('open');});
    c&&c.addEventListener('click',function(){f.classList.remove('open');});
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
    var input     = document.getElementById('amRaSearch');
    var form      = document.getElementById('amRaSearchForm');
    var container = document.getElementById('amRaContainer');
    if (!container) return;
    var baseUrl = '{{ url('/riskAssesmntCheck/' . $urlparam['userid']) }}';
    function debounce(fn, wait) { var t; return function() { var ctx = this, args = arguments; clearTimeout(t); t = setTimeout(function() { fn.apply(ctx, args); }, wait); }; }
    function showLoading() { container.style.opacity = '0.5'; container.style.pointerEvents = 'none'; }
    function hideLoading() { container.style.opacity = ''; container.style.pointerEvents = ''; }
    function fetchPage(page) {
        var q = input ? input.value.trim() : '';
        var url = baseUrl + '?q=' + encodeURIComponent(q) + '&page=' + page;
        showLoading();
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function(r){ return r.text(); })
            .then(function(html) { container.innerHTML = html; hideLoading(); })
            .catch(function() { hideLoading(); });
    }
    input && input.addEventListener('input', debounce(function() { fetchPage(1); }, 350));
    form  && form.addEventListener('submit', function(e) { e.preventDefault(); fetchPage(1); });
    container.addEventListener('click', function(e) {
        var btn = e.target.closest('.am-page-link');
        if (!btn || btn.disabled) return;
        e.preventDefault();
        var p = parseInt(btn.getAttribute('data-page'), 10);
        if (!isNaN(p) && p > 0) fetchPage(p);
    });
})();
function amRaView(d){
    document.getElementById('vra-job').textContent = d.jobNumber||'—';
    document.getElementById('vra-date').textContent = d.date ? new Date(d.date).toLocaleDateString() : '—';
    document.getElementById('vra-dd').textContent = d.dateDevelry ? new Date(d.dateDevelry).toLocaleDateString() : '—';
    document.getElementById('vra-qs').innerHTML = (d.qualitySatandard||'—') + '<div style="font-size:12px;color:var(--am-text-muted);margin-top:4px;">' + (d.commentsstandard||'') + '</div>';
    document.getElementById('vra-ds').innerHTML = (d.delevryStandard||'—') + '<div style="font-size:12px;color:var(--am-text-muted);margin-top:4px;">' + (d.commentsdelvery||'') + '</div>';
    document.getElementById('vra-pr').innerHTML = (d.priceRequiremnt||'—') + '<div style="font-size:12px;color:var(--am-text-muted);margin-top:4px;">' + (d.commentprice||'') + '</div>';
    document.getElementById('vra-ip').innerHTML = (d.interestedDeemed||'—') + '<div style="font-size:12px;color:var(--am-text-muted);margin-top:4px;">' + (d.commentsDeemed||'') + '</div>';
    document.getElementById('vra-rp').textContent = d.RiskProbability||'—';
    document.getElementById('vra-rs').textContent = d.riskSeverity||'—';
    document.getElementById('vra-dc').textContent = d.DecisionComment||'—';
    document.getElementById('view_Modal').classList.add('open');
}
function amRaEdit(d){
    $("#era-id").val(d.id);
    ['jobNumber','date','dateDevelry','DecisionComment','commentprice','commentsDeemed','commentsdelvery','commentsstandard'].forEach(function(k){ $("#editModal input[name='"+k+"']").val(d[k]||''); });
    $("#editModal input[name='qualitySatandard']").prop('checked', false);
    $("#editModal input[name='qualitySatandard'][value='"+d.qualitySatandard+"']").prop('checked', true);
    $("#editModal input[name='delevryStandard']").prop('checked', false);
    $("#editModal input[name='delevryStandard'][value='"+d.delevryStandard+"']").prop('checked', true);
    $("#editModal input[name='priceRequiremnt']").prop('checked', false);
    $("#editModal input[name='priceRequiremnt'][value='"+d.priceRequiremnt+"']").prop('checked', true);
    $("#editModal input[name='interestedDeemed']").prop('checked', false);
    $("#editModal input[name='interestedDeemed'][value='"+d.interestedDeemed+"']").prop('checked', true);
    $("#editModal select[name='RiskProbability']").val(d.RiskProbability||'');
    $("#editModal select[name='riskSeverity']").val(d.riskSeverity||'');
    document.getElementById('editModal').classList.add('open');
}
</script>

@endsection
