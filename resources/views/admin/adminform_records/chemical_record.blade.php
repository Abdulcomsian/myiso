@extends('admin.dashboard.layouts.app')

@section('content')
@php $urlparam = request()->route()->parameters; @endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div>
            <h2>Chemical Control (COSHH)</h2>
            <p>Log hazardous substances used in your workplace to protect employees and comply with regulations.</p>
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
                COSHH (Control of Substances Hazardous to Health) helps prevent or reduce workers' exposure to hazardous substances by maintaining a current information log.
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form method="GET" action="{{ url('/chemicalcheck/' . $urlparam['userid']) }}" class="am-search" id="amChSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amChSearch" value="{{ $search ?? '' }}" placeholder="Search chemicals…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleChForm">
                <i class="fa fa-plus"></i> Add COSHH
            </button>
        </div>

        <div class="am-inline-form" id="newChForm" style="margin:16px 20px;">
            <form action="{{ route('chemicalform') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                <input type="hidden" name="is_admin" value="admin">
                <div class="form-row">
                    <div><label>Chemical Name</label><input type="text" name="chemicalname" required></div>
                    <div><label>Chemical Type</label><input type="text" name="chemical_type" placeholder="Gas / liquid / solid" required></div>
                    <div><label>Location Used</label><input type="text" name="location" placeholder="Area / department" required></div>
                </div>
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>Chemical Description (main constituents)</label><input type="text" name="chemical_desc" required></div>
                </div>
                <div class="form-row">
                    <div><label>Activity Hazard</label><input type="text" name="activity_hazard" required></div>
                    <div><label>Identified Chemical Hazard</label><input type="text" name="identified_chazard" placeholder="Corrosive / Toxic / Oxidiser" required></div>
                    <div><label>Identified Hazard</label><input type="text" name="identified_hazard" placeholder="Splashes / breathing vapour" required></div>
                </div>
                <div class="form-row">
                    <div><label>Target Organs</label><input type="text" name="target_organs" required></div>
                    <div><label>Who is at Risk</label><input type="text" name="who_risk" required></div>
                    <div><label>Protection Required</label><input type="text" name="protection_required" placeholder="Gloves / glasses / overalls" required></div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Still Used in Production?</label>
                        <div style="display:flex;gap:12px;font-size:13px;padding:6px 0;">
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" required value="Yes" name="still_used"> Yes, still used</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" required value="No" name="still_used"> No, legacy</label>
                        </div>
                    </div>
                    <div><label>Attach Evidence</label><input name="attach_evidence" type="file"></div>
                    <div><label>Any Other Issues</label><textarea name="any_issues" placeholder="Notes" rows="2"></textarea></div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelChForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save COSHH Entry</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div id="amChContainer">
            @include('admin.adminform_records.partials.chemical_table')
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
<div class="am-modal" id="viewChModal" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:820px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Chemical Details</h4>
        </div>
        <div class="am-modal__body">
            @php
                $fields = [
                    'chemical_name' => 'Chemical Name',
                    'chemical_desc' => 'Description',
                    'chemical_type' => 'Type',
                    'location_used' => 'Location',
                    'activity_hazard' => 'Activity Hazard',
                    'identified_chazard' => 'Chemical Hazard',
                    'identified_hazard' => 'Identified Hazard',
                    'target_organs' => 'Target Organs',
                    'who_risk' => 'Who is at Risk',
                    'protection_required' => 'Protection Required',
                    'still_used' => 'Status',
                    'any_issues' => 'Notes',
                ];
            @endphp
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;font-size:13px;">
                @foreach($fields as $k => $lb)
                    <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">{{ $lb }}</div><div id="vch-{{ $k }}">—</div></div>
                @endforeach
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Evidence</div><div id="vch-ev">—</div></div>
            </div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="editChModal" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Chemical Record</h4>
        </div>
        <form action="{{ route('chemicalUpdate') }}" method="POST" enctype="multipart/form-data" style="display:contents;">
            @csrf
            <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
            <input type="hidden" name="id" id="ech-id">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-6"><label>Chemical Name</label><input type="text" class="form-control" name="chemicalname" required></div>
                    <div class="col-lg-6"><label>Chemical Type</label><input type="text" class="form-control" name="chemical_type" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12"><label>Description</label><input type="text" class="form-control" name="chemical_desc" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Location</label><input type="text" class="form-control" name="location" required></div>
                    <div class="col-lg-6"><label>Activity Hazard</label><input type="text" class="form-control" name="activity_hazard" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Chemical Hazard</label><input type="text" class="form-control" name="identified_chazard" required></div>
                    <div class="col-lg-6"><label>Identified Hazard</label><input type="text" class="form-control" name="identified_hazard" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Target Organs</label><input type="text" class="form-control" name="target_organs" required></div>
                    <div class="col-lg-6"><label>Who is at Risk</label><input type="text" class="form-control" name="who_risk" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Protection Required</label><input type="text" class="form-control" name="protection_required" required></div>
                    <div class="col-lg-6">
                        <label>Still Used?</label>
                        <div style="display:flex;gap:12px;font-size:13px;padding:6px 0;">
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" value="Yes" name="still_used"> Yes</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" value="No" name="still_used"> No</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Attach Evidence</label><input name="attach_evidence" type="file" class="form-control"></div>
                    <div class="col-lg-6"><label>Any Other Issues</label><textarea class="form-control" name="any_issues"></textarea></div>
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
    var t=document.getElementById('toggleChForm'),f=document.getElementById('newChForm'),c=document.getElementById('cancelChForm');
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
    var input     = document.getElementById('amChSearch');
    var form      = document.getElementById('amChSearchForm');
    var container = document.getElementById('amChContainer');
    if (!container) return;
    var baseUrl = '{{ url('/chemicalcheck/' . $urlparam['userid']) }}';
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
function amChView(d){
    ['chemical_name','chemical_desc','chemical_type','location_used','activity_hazard','identified_chazard','identified_hazard','target_organs','who_risk','protection_required','still_used','any_issues'].forEach(function(k){
        var el = document.getElementById('vch-'+k);
        if (el) el.textContent = d[k] || '—';
    });
    var ev = document.getElementById('vch-ev');
    if (d.attach_evidence) { ev.innerHTML = '<a href="'+d.attach_evidence+'" target="_blank" style="color:var(--am-primary);"><i class="fa fa-external-link-alt"></i> View</a>'; } else ev.textContent = '—';
    document.getElementById('viewChModal').classList.add('open');
}
function amChEdit(d){
    $("#ech-id").val(d.id);
    $("#editChModal input[name='chemicalname']").val(d.chemical_name || '');
    ['chemical_type','chemical_desc','location','activity_hazard','identified_chazard','identified_hazard','target_organs','who_risk','protection_required'].forEach(function(k){
        var mapped = k === 'location' ? 'location_used' : k;
        $("#editChModal input[name='"+k+"']").val(d[mapped] || d[k] || '');
    });
    $("#editChModal textarea[name='any_issues']").val(d.any_issues || '');
    $("#editChModal input[name='still_used']").prop('checked', false);
    $("#editChModal input[name='still_used'][value='"+d.still_used+"']").prop('checked', true);
    document.getElementById('editChModal').classList.add('open');
}
</script>
@endsection
