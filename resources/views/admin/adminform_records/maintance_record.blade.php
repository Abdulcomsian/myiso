@extends('admin.dashboard.layouts.app')

@section('content')
@php $urlparam = request()->route()->parameters; @endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    {{-- Page header --}}
    <div class="am-page-header">
        <div>
            <h2>Maintenance Records</h2>
            <p>Track periodic maintenance activities on equipment, tools, and facilities.</p>
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

    {{-- Info card --}}
    <div class="am-card" style="padding:16px 20px;margin-bottom:16px;background:rgba(46,59,154,0.04);border:1px solid rgba(46,59,154,0.12);">
        <div style="display:flex;gap:12px;align-items:flex-start;">
            <span style="width:36px;height:36px;flex-shrink:0;border-radius:10px;background:var(--am-primary-tint);color:var(--am-primary);display:inline-flex;align-items:center;justify-content:center;font-size:15px;">
                <i class="fa fa-info-circle"></i>
            </span>
            <div style="font-size:13px;color:var(--am-text);line-height:1.55;">
                Carrying out frequent maintenance checks and repairs is necessary to maintain production and service.
                Maintenance reviews should be carried out monthly, quarterly, semiannually, or annually depending on the size and nature of the business.
            </div>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form method="GET" action="{{ url('/maintainRecCheck/' . $urlparam['userid']) }}" class="am-search" id="amMrSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amMrSearch" value="{{ $search ?? '' }}" placeholder="Search maintenance records…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleMrForm">
                <i class="fa fa-plus"></i> Add Maintenance Record
            </button>
        </div>

        <div class="am-inline-form" id="newMrForm" style="margin:16px 20px;">
            <form action="{{ route('maintain_rec') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                <div class="form-row">
                    <div>
                        <label>Maintenance Date</label>
                        <input type="date" max="2999-12-31" name="mrdate" required>
                    </div>
                    <div>
                        <label>Item</label>
                        <input type="text" placeholder="e.g. Compressor unit" name="mritem" required>
                    </div>
                    <div>
                        <label>Activity</label>
                        <input type="text" placeholder="e.g. Filter replacement" name="mractivity" required>
                    </div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Location</label>
                        <input type="text" placeholder="e.g. Workshop A" name="mlocation" required>
                    </div>
                    <div>
                        <label>Observations</label>
                        <input type="text" placeholder="Findings" name="mrobservation" required>
                    </div>
                    <div>
                        <label>Actions Taken</label>
                        <input type="text" placeholder="What was done" name="mractions" required>
                    </div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Performed By</label>
                        <input type="text" placeholder="Full name" name="mractivityperofrmby" required>
                    </div>
                    <div>
                        <label>Attach Evidence (jpeg, mp3, mp4, xls, doc)</label>
                        <input name="attach_evidence" type="file">
                    </div>
                    <div>
                        <label>Any other issues?</label>
                        <input type="text" placeholder="Optional notes" name="any_issues">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelMrForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Record</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Table card --}}
    <div class="am-card">
        <div id="amMrContainer">
            @include('admin.adminform_records.partials.maintenance_table')
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
<div class="am-modal" id="amMrViewModal" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:720px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Maintenance Record</h4>
        </div>
        <div class="am-modal__body">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;font-size:13px;">
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Date</div><div id="v-mrdate"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Item</div><div id="v-mritem"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Activity</div><div id="v-mractivity"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Location</div><div id="v-mlocation"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Observations</div><div id="v-mrobservation"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Actions Taken</div><div id="v-mractions"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Performed By</div><div id="v-mrperformed"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Evidence</div><div id="v-mrevidence"></div></div>
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Other Notes</div><div id="v-mrissues"></div></div>
            </div>
        </div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline am-modal-close">Close</button>
        </div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="amMrEditModal" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:820px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Maintenance Record</h4>
        </div>
        <form action="{{ route('editmentainance') }}" method="POST" enctype="multipart/form-data" style="display:contents;">
            @csrf
            <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
            <input type="hidden" name="id" id="e-mr-id">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label>Maintenance Date</label>
                        <input type="date" class="form-control" name="mrdate" id="e-mrdate">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Item</label><input type="text" class="form-control" name="mritem" id="e-mritem"></div>
                    <div class="col-lg-6"><label>Activity</label><input type="text" class="form-control" name="mractivity" id="e-mractivity"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Location</label><input type="text" class="form-control" name="mlocation" id="e-mlocation"></div>
                    <div class="col-lg-6"><label>Observations</label><input type="text" class="form-control" name="mrobservation" id="e-mrobservation"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Actions Taken</label><input type="text" class="form-control" name="mractions" id="e-mractions"></div>
                    <div class="col-lg-6"><label>Performed By</label><input type="text" class="form-control" name="mractivityperofrmby" id="e-mrperformed"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Attach Evidence</label><input name="attach_evidence" type="file" class="form-control"></div>
                    <div class="col-lg-6"><label>Any Other Issues</label><textarea class="form-control" name="any_issues" id="e-mrissues"></textarea></div>
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
(function() {
    var toggle = document.getElementById('toggleMrForm');
    var form = document.getElementById('newMrForm');
    var cancel = document.getElementById('cancelMrForm');
    toggle && toggle.addEventListener('click', function(){ form.classList.toggle('open'); });
    cancel && cancel.addEventListener('click', function(){ form.classList.remove('open'); });
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
    var input     = document.getElementById('amMrSearch');
    var form      = document.getElementById('amMrSearchForm');
    var container = document.getElementById('amMrContainer');
    if (!container) return;
    var baseUrl = '{{ url('/maintainRecCheck/' . $urlparam['userid']) }}';
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

function amMrView(d) {
    document.getElementById('v-mrdate').textContent = d.mrdate ? new Date(d.mrdate).toLocaleDateString() : '—';
    document.getElementById('v-mritem').textContent = d.mritem || '—';
    document.getElementById('v-mractivity').textContent = d.mractivity || '—';
    document.getElementById('v-mlocation').textContent = d.mlocation || '—';
    document.getElementById('v-mrobservation').textContent = d.mrobservation || '—';
    document.getElementById('v-mractions').textContent = d.mractions || '—';
    document.getElementById('v-mrperformed').textContent = d.mractivityperofrmby || '—';
    document.getElementById('v-mrissues').textContent = d.any_issues || '—';
    var evidence = document.getElementById('v-mrevidence');
    if (d.attach_evidence) {
        evidence.innerHTML = '<a target="_blank" href="' + d.attach_evidence + '" style="color:var(--am-primary);"><i class="fa fa-external-link-alt"></i> View evidence</a>';
    } else {
        evidence.textContent = '—';
    }
    document.getElementById('amMrViewModal').classList.add('open');
}

function amMrEdit(d) {
    document.getElementById('e-mr-id').value = d.id || '';
    document.getElementById('e-mrdate').value = d.mrdate || '';
    document.getElementById('e-mritem').value = d.mritem || '';
    document.getElementById('e-mractivity').value = d.mractivity || '';
    document.getElementById('e-mlocation').value = d.mlocation || '';
    document.getElementById('e-mrobservation').value = d.mrobservation || '';
    document.getElementById('e-mractions').value = d.mractions || '';
    document.getElementById('e-mrperformed').value = d.mractivityperofrmby || '';
    document.getElementById('e-mrissues').value = d.any_issues || '';
    document.getElementById('amMrEditModal').classList.add('open');
}
</script>
@endsection
