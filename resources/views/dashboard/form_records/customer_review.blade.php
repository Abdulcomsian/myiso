@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Customer Review</h2>
            <p>Score customers on quality, price, delivery and overall performance.</p>
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
                Customer reviews monitor and grade your performance across all customer touchpoints — quality of service, delivery time accuracy, staff politeness, and more.
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form method="GET" action="{{ url('/customer_review') }}" class="am-search" id="amCrSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amCrSearch" value="{{ $search ?? '' }}" placeholder="Search reviews…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleCrForm">
                <i class="fa fa-plus"></i> Add Customer Evaluation
            </button>
        </div>

        <div class="am-inline-form" id="newCrForm" style="margin:16px 20px;">
            <form method="POST" action="{{ route('customer_rview') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div>
                        <label>Customer ID Number</label>
                        <select name="cus_id" required>
                            <option value="" selected disabled>Select customer…</option>
                            @foreach($all_customers as $customer)
                                <option value="{{ $customer->idNumber }}">{{ $customer->idNumber }} — {{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label>Product / Activity / Area</label><input type="text" name="product_activity_area" placeholder="Being reviewed" required></div>
                    <div><label>Assessment Date</label><input type="date" max="2999-12-31" name="AssesmentDate" required></div>
                </div>
                <div class="form-row">
                    <div><label>Quality Score (0-10)</label><input type="number" min="0" max="10" name="qualityScore" placeholder="0-10" required></div>
                    <div><label>Price Score (0-10)</label><input type="number" min="0" max="10" name="priceScore" placeholder="0-10" required></div>
                    <div><label>Delivery Score (0-10)</label><input type="number" min="0" max="10" name="DScore" placeholder="0-10" required></div>
                    <div><label>Overall Score (0-10)</label><input type="number" min="0" max="10" name="OveralScore" placeholder="0-10" required></div>
                </div>
                <div class="form-row">
                    <div style="grid-column:span 2;"><label>Any Other Issues</label><input type="text" name="other_issue" placeholder="Notes" required></div>
                    <div style="grid-column:span 2;"><label>Attach Evidence</label><input type="file" name="attach_evidence" required></div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelCrForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Review</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div id="amCrContainer">
            @include('dashboard.form_records.partials.customer_review_table')
        </div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="editcustomer_rev" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Customer Evaluation</h4>
        </div>
        <form method="POST" action="{{ route('editCustomerReview') }}" enctype="multipart/form-data" style="display:contents;">
            @csrf
            <input type="hidden" name="id" id="editid">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-6"><label>Customer ID</label>
                        <select class="form-control" name="cus_id" required>
                            <option value="" selected disabled>Select customer…</option>
                            @foreach($all_customers as $customer)
                                <option value="{{ $customer->idNumber }}">{{ $customer->idNumber }} — {{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6"><label>Product / Activity / Area</label><input class="form-control" type="text" name="product_activity_area_edit"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3"><label>Quality (0-10)</label><input type="number" min="0" max="10" class="form-control" name="qualityScore" required></div>
                    <div class="col-lg-3"><label>Price (0-10)</label><input type="number" min="0" max="10" class="form-control" name="priceScore" required></div>
                    <div class="col-lg-3"><label>Delivery (0-10)</label><input type="number" min="0" max="10" class="form-control" name="DScore" required></div>
                    <div class="col-lg-3"><label>Overall (0-10)</label><input type="number" min="0" max="10" class="form-control" name="OveralScore" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Assessment Date</label><input type="date" max="2999-12-31" class="form-control" name="AssesmentDate" required></div>
                    <div class="col-lg-6"><label>Any Other Issues</label><input type="text" class="form-control" name="other_issue" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12"><label>Attach Evidence</label><input type="file" class="form-control" name="attach_evidence"></div>
                </div>
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
                <button type="submit" class="am-btn am-btn-primary"><i class="fa fa-check"></i> Update</button>
            </div>
        </form>
    </div>
</div>

{{-- View modal --}}
<div class="am-modal" id="viewCustomerRev" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:720px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Review Details</h4>
        </div>
        <div class="am-modal__body">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;font-size:13px;">
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Customer</div><div id="v-cr-cust"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Product / Area</div><div id="v-cr-prod"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Quality</div><div id="v-cr-q"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Price</div><div id="v-cr-p"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Delivery</div><div id="v-cr-d"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Overall</div><div id="v-cr-o"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Assessment Date</div><div id="v-cr-date"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Evidence</div><div id="v-cr-ev"></div></div>
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Other Issues</div><div id="v-cr-oi"></div></div>
            </div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
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
    var t = document.getElementById('toggleCrForm');
    var f = document.getElementById('newCrForm');
    var c = document.getElementById('cancelCrForm');
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
    var input = document.getElementById('amCrSearch');
    var form = document.getElementById('amCrSearchForm');
    var container = document.getElementById('amCrContainer');
    if (!container) return;
    var baseUrl = '{{ url('/customer_review') }}';
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
function amCrView(d, label) {
    document.getElementById('v-cr-cust').textContent = label + ' (ID ' + d.cus_id + ')';
    document.getElementById('v-cr-prod').textContent = d.product_activity_area || '—';
    document.getElementById('v-cr-q').textContent = d.qualityScore + '/10';
    document.getElementById('v-cr-p').textContent = d.priceScore + '/10';
    document.getElementById('v-cr-d').textContent = d.DScore + '/10';
    document.getElementById('v-cr-o').textContent = d.OveralScore + '/10';
    document.getElementById('v-cr-date').textContent = d.AssesmentDate ? new Date(d.AssesmentDate).toLocaleDateString() : '—';
    document.getElementById('v-cr-oi').textContent = d.other_issues || '—';
    var ev = document.getElementById('v-cr-ev');
    if (d.attach_evidence) {
        ev.innerHTML = '<a href="{{ asset("customer_review_evidence") }}/' + d.attach_evidence + '" target="_blank" style="color:var(--am-primary);"><i class="fa fa-external-link-alt"></i> View file</a>';
    } else { ev.textContent = '—'; }
    document.getElementById('viewCustomerRev').classList.add('open');
}
function amCrEdit(d) {
    document.getElementById('editid').value = d.id || '';
    var m = document.getElementById('editcustomer_rev');
    m.querySelector("input[name='AssesmentDate']").value = d.AssesmentDate || '';
    m.querySelector("input[name='DScore']").value = d.DScore || '';
    m.querySelector("input[name='OveralScore']").value = d.OveralScore || '';
    m.querySelector("select[name='cus_id']").value = d.cus_id || '';
    m.querySelector("input[name='priceScore']").value = d.priceScore || '';
    m.querySelector("input[name='qualityScore']").value = d.qualityScore || '';
    m.querySelector("input[name='product_activity_area_edit']").value = d.product_activity_area || '';
    m.querySelector("input[name='other_issue']").value = d.other_issues || '';
    m.classList.add('open');
}
</script>
@endsection
