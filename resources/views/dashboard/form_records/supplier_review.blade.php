@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div style="display:flex;align-items:center;gap:12px;">
            <button type="button" class="am-page-guide-btn"
                onclick="document.getElementById('amPageGuide').classList.add('open')"
                title="About Supplier Reviews" aria-label="About Supplier Reviews">
                <i class="fa fa-info-circle"></i>
            </button>
            <div>
                <h2>Supplier Reviews</h2>
            </div>
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
            <form method="GET" action="{{ url('/supplier_review') }}" class="am-search" id="amSrSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amSrSearch" value="{{ $search ?? '' }}" placeholder="Search reviews…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleSrForm">
                <i class="fa fa-plus"></i> Add Supplier Evaluation
            </button>
        </div>

        <div class="am-inline-form" id="newSrForm" style="margin:16px 20px;">
            <form method="POST" action="{{ route('supplier_review_store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div>
                        <label>Supplier ID Number</label>
                        <select name="sup_id" required>
                            <option value="" selected disabled>Select supplier…</option>
                            @foreach($all_suppliers as $supplier)
                                <option value="{{ $supplier->idnumber }}">{{ $supplier->idnumber }} — {{ $supplier->suppliername }}</option>
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
                    <div style="grid-column:span 2;"><label>Notes</label><textarea name="other_issue" required></textarea></div>
                    <div style="grid-column:span 2;"><label>Attach Evidence</label><input type="file" name="attach_evidence" required></div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelSrForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Review</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div id="amSrContainer">
            @include('dashboard.form_records.partials.supplier_review_table')
        </div>
    </div>
</div>

{{-- Page guide --}}
<div class="am-modal" id="amPageGuide" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:600px;">
        <div class="am-modal__header">
            <span class="am-modal__icon am-page-guide-icon"><i class="fa fa-info-circle"></i></span>
            <div>
                <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;">FORMS &amp; RECORDS</div>
                <h4 class="am-modal__title" style="color:var(--am-primary);">Supplier Review</h4>
            </div>
        </div>
        <div class="am-modal__body" style="color:var(--am-text);">
            <h5 style="font-size:13px;font-weight:600;color:var(--am-primary);margin:0 0 6px;">What is it?</h5>
            <p style="margin:0 0 16px;">A scorecard for measuring how well each supplier performs on quality, price and delivery, and giving an overall score out of ten. Don't confuse it with the Suppliers record: that is the directory of the companies you buy from, while this form is where you record how well they perform.</p>

            <h5 style="font-size:13px;font-weight:600;color:var(--am-primary);margin:0 0 6px;">Why does it matter?</h5>
            <p style="margin:0 0 16px;">The standard expects you to choose suppliers on evidence and to keep monitoring their performance. When an auditor asks, “How do you know your suppliers are good enough?”, these reviews and their attached evidence are your answer. Low overall scores show in red, so a supplier whose performance is slipping is easy to spot before your customers feel it.</p>

            <h5 style="font-size:13px;font-weight:600;color:var(--am-primary);margin:0 0 6px;">Key steps</h5>
            <ul style="margin:0;padding-inline-start:18px;list-style:disc;color:var(--am-text);font-size:13.5px;line-height:1.5;">
                <li style="margin-bottom:6px;">Add the supplier to Suppliers first so they appear in the list.</li>
                <li style="margin-bottom:6px;">Click Add Supplier Evaluation, then choose the supplier.</li>
                <li style="margin-bottom:6px;">Enter the product, activity or area being reviewed, and the date of the review.</li>
                <li style="margin-bottom:6px;">Score quality, price and delivery from 0 to 10, then give an overall score.</li>
                <li style="margin-bottom:6px;">Add any other notes and attach supporting evidence, such as delivery records, invoices or emails.</li>
                <li style="margin-bottom:6px;">Click Save Review. Review every main supplier at least once a year, and sooner after any problem.</li>
                <li>If a supplier scores low or causes a problem, record a Non-Conformity, and discuss supplier performance at Management Reviews.</li>
            </ul>
        </div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline am-modal-close">Close</button>
        </div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="editsupplier_rev" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Supplier Evaluation</h4>
        </div>
        <form method="POST" action="{{ route('editSupplierReview') }}" enctype="multipart/form-data" style="display:contents;">
            @csrf
            <input type="hidden" name="id" id="srEditId">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-6"><label>Supplier ID</label>
                        <select class="form-control" name="sup_id" required>
                            <option value="" selected disabled>Select supplier…</option>
                            @foreach($all_suppliers as $supplier)
                                <option value="{{ $supplier->idnumber }}">{{ $supplier->idnumber }} — {{ $supplier->suppliername }}</option>
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
                    <div class="col-lg-6"><label>Notes</label><textarea class="form-control" name="other_issue" required></textarea></div>
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
<div class="am-modal" id="viewSupplierRev" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:720px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Review Details</h4>
        </div>
        <div class="am-modal__body">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;font-size:13px;">
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Supplier</div><div id="v-sr-sup"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Product / Area</div><div id="v-sr-prod"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Quality</div><div id="v-sr-q"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Price</div><div id="v-sr-p"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Delivery</div><div id="v-sr-d"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Overall</div><div id="v-sr-o"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Assessment Date</div><div id="v-sr-date"></div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Evidence</div><div id="v-sr-ev"></div></div>
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Notes</div><div id="v-sr-oi"></div></div>
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
    var t = document.getElementById('toggleSrForm');
    var f = document.getElementById('newSrForm');
    var c = document.getElementById('cancelSrForm');
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
    var input = document.getElementById('amSrSearch');
    var form = document.getElementById('amSrSearchForm');
    var container = document.getElementById('amSrContainer');
    if (!container) return;
    var baseUrl = '{{ url('/supplier_review') }}';
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
function amSrView(d, label) {
    document.getElementById('v-sr-sup').textContent = label + ' (ID ' + d.sup_id + ')';
    document.getElementById('v-sr-prod').textContent = d.product_activity_area || '—';
    document.getElementById('v-sr-q').textContent = d.qualityScore + '/10';
    document.getElementById('v-sr-p').textContent = d.priceScore + '/10';
    document.getElementById('v-sr-d').textContent = d.DScore + '/10';
    document.getElementById('v-sr-o').textContent = d.OveralScore + '/10';
    document.getElementById('v-sr-date').textContent = d.AssesmentDate ? new Date(d.AssesmentDate).toLocaleDateString() : '—';
    document.getElementById('v-sr-oi').textContent = d.other_issues || '—';
    var ev = document.getElementById('v-sr-ev');
    if (d.attach_evidence) {
        ev.innerHTML = '<a href="{{ asset("supplier_review_evidence") }}/' + d.attach_evidence + '" target="_blank" style="color:var(--am-primary);"><i class="fa fa-external-link-alt"></i> View file</a>';
    } else { ev.textContent = '—'; }
    document.getElementById('viewSupplierRev').classList.add('open');
}
function amSrEdit(d) {
    document.getElementById('srEditId').value = d.id || '';
    var m = document.getElementById('editsupplier_rev');
    m.querySelector("input[name='AssesmentDate']").value = d.AssesmentDate || '';
    m.querySelector("input[name='DScore']").value = d.DScore || '';
    m.querySelector("input[name='OveralScore']").value = d.OveralScore || '';
    m.querySelector("select[name='sup_id']").value = d.sup_id || '';
    m.querySelector("input[name='priceScore']").value = d.priceScore || '';
    m.querySelector("input[name='qualityScore']").value = d.qualityScore || '';
    m.querySelector("input[name='product_activity_area_edit']").value = d.product_activity_area || '';
    m.querySelector("[name='other_issue']").value = d.other_issues || '';
    m.classList.add('open');
}
</script>
@endsection
