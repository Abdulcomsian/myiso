@extends('admin.dashboard.layouts.app')

@section('content')
@php $urlparam = request()->route()->parameters; @endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div>
            <h2>Work Instructions</h2>
            <p>Step-by-step processes used to conduct activities in the workplace.</p>
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
                Work instructions (also called processes) are step-by-step guides. Use this section to define activities that internal audits will later verify. External documents are fine as long as they're referenced here.
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form method="GET" action="{{ url('/workinstructionCheck/' . $urlparam['userid']) }}" class="am-search" id="amWiSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amWiSearch" value="{{ $search ?? '' }}" placeholder="Search work instructions…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleWiForm">
                <i class="fa fa-plus"></i> Add Work Instruction
            </button>
        </div>

        <div class="am-inline-form" id="newWiForm" style="margin:16px 20px;">
            <form action="{{ route('workinstructions') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                <div class="form-row">
                    <div><label>Work Instruction Title</label><input type="text" name="workinstruction" placeholder="Process title" required></div>
                    <div><label>Reference</label><input type="text" name="instructionref" required></div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Creator Employee ID</label>
                        <select name="empId" required>
                            <option value="">Select Employee</option>
                            @foreach($employess as $emp)
                                <option value="{{ $emp->empNumber }}">{{ $emp->empNumber }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label>Issue Date</label><input type="date" max="2999-12-31" name="issueDate" required></div>
                    <div><label>Revision Status</label><input type="text" name="revisionstatus" required></div>
                </div>
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>Scope</label><input type="text" name="scop" required></div>
                </div>
                <div class="form-row">
                    @for ($i = 1; $i <= 12; $i++)
                        <div><label>Point {{ $i }}</label><input type="text" name="point{{ $i }}"></div>
                    @endfor
                </div>
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>Compiled By</label><input type="text" name="CompiledBy" required></div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelWiForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Instruction</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div id="amWiContainer">
            @include('admin.adminform_records.partials.work_instruction_table')
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
<div class="am-modal" id="viewWiModal" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:820px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Work Instruction Details</h4>
        </div>
        <div class="am-modal__body">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;font-size:13px;">
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Title</div><div id="vwi-title">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Reference</div><div id="vwi-ref">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Employee ID</div><div id="vwi-emp">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Issue Date</div><div id="vwi-date">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Revision Status</div><div id="vwi-rev">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Compiled By</div><div id="vwi-comp">—</div></div>
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Scope</div><div id="vwi-scope">—</div></div>
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:8px;">Steps</div><ol id="vwi-points" style="padding-left:18px;margin:0;font-size:13px;line-height:1.6;"></ol></div>
            </div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="editWiModal" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Work Instruction</h4>
        </div>
        <form action="{{ route('editworkinstructions') }}" method="POST" style="display:contents;">
            @csrf
            <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
            <input type="hidden" name="id" id="ewi-id">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-6"><label>Title</label><input type="text" class="form-control" name="workinstruction" required></div>
                    <div class="col-lg-6"><label>Reference</label><input type="text" class="form-control" name="instructionref" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label>Creator Employee ID</label>
                        <select class="form-control" name="empId" required>
                            <option value="">Select</option>
                            @foreach($employess as $emp)
                                <option value="{{ $emp->empNumber }}">{{ $emp->empNumber }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4"><label>Issue Date</label><input type="date" class="form-control" name="issueDate" required></div>
                    <div class="col-lg-4"><label>Revision Status</label><input type="text" class="form-control" name="revisionstatus" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12"><label>Scope</label><input type="text" class="form-control" name="scop" required></div>
                </div>
                <div class="form-group row">
                    @for ($i = 1; $i <= 12; $i++)
                        <div class="col-lg-4"><label>Point {{ $i }}</label><input type="text" class="form-control" name="point{{ $i }}"></div>
                    @endfor
                </div>
                <div class="form-group row">
                    <div class="col-lg-12"><label>Compiled By</label><input type="text" class="form-control" name="CompiledBy" required></div>
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
    var t=document.getElementById('toggleWiForm'),f=document.getElementById('newWiForm'),c=document.getElementById('cancelWiForm');
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
    var input     = document.getElementById('amWiSearch');
    var form      = document.getElementById('amWiSearchForm');
    var container = document.getElementById('amWiContainer');
    if (!container) return;
    var baseUrl = '{{ url('/workinstructionCheck/' . $urlparam['userid']) }}';
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
function amWiView(d){
    document.getElementById('vwi-title').textContent = d.workinstruction||'—';
    document.getElementById('vwi-ref').textContent = d.instructionref||'—';
    document.getElementById('vwi-emp').textContent = d.empId||'—';
    document.getElementById('vwi-date').textContent = d.issueDate ? new Date(d.issueDate).toLocaleDateString() : '—';
    document.getElementById('vwi-rev').textContent = d.revisionstatus||'—';
    document.getElementById('vwi-comp').textContent = d.CompiledBy||'—';
    document.getElementById('vwi-scope').textContent = d.scop||'—';
    var pointsEl = document.getElementById('vwi-points');
    pointsEl.innerHTML = '';
    for (var i=1; i<=12; i++) {
        var pt = d['point'+i];
        if (pt) { var li=document.createElement('li'); li.textContent = pt; pointsEl.appendChild(li); }
    }
    document.getElementById('viewWiModal').classList.add('open');
}
function amWiEdit(d){
    $("#ewi-id").val(d.id);
    ['workinstruction','instructionref','issueDate','revisionstatus','scop','CompiledBy'].forEach(function(k){ $("#editWiModal input[name='"+k+"']").val(d[k]||''); });
    $("#editWiModal select[name='empId']").val(d.empId||'');
    for (var i=1; i<=12; i++) { $("#editWiModal input[name='point"+i+"']").val(d['point'+i]||''); }
    document.getElementById('editWiModal').classList.add('open');
}
</script>
@endsection
