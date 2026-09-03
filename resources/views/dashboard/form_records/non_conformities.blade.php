@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Non-Conformities</h2>
            <p>Track situations where products, services, or processes fail to meet specifications.</p>
        </div>
    </div>

    @if(session('message'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ session('message') }}
        </div>
    @endif

    <div class="am-card" style="padding:16px 20px;margin-bottom:16px;background:rgba(46,59,154,0.04);border:1px solid rgba(46,59,154,0.12);">
        <div style="display:flex;gap:12px;align-items:flex-start;">
            <span style="width:36px;height:36px;flex-shrink:0;border-radius:10px;background:var(--am-primary-tint);color:var(--am-primary);display:inline-flex;align-items:center;justify-content:center;font-size:15px;"><i class="fa fa-info-circle"></i></span>
            <div style="font-size:13px;color:var(--am-text);line-height:1.55;">
                A non-conformance occurs when something doesn't meet specifications — in services, products, processes, supplier goods, or staff behavior. Minor (e.g. invoicing mistake) vs Major (e.g. employee misconduct).
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form method="GET" action="{{ url('/non_confromities') }}" class="am-search" id="amNcSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amNcSearch" value="{{ $search ?? '' }}" placeholder="Search NCRs…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleNcForm">
                <i class="fa fa-plus"></i> Add Non-Conformity
            </button>
        </div>

        <div class="am-inline-form" id="newNcForm" style="margin:16px 20px;">
            <form action="{{ route('nonConfromForm') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div>
                        <label>Type</label>
                        <select name="minor_major" required>
                            <option value="">Select</option>
                            <option value="Minor">Minor</option>
                            <option value="Major">Major</option>
                        </select>
                    </div>
                    <div>
                        <label>Non-Conformity Category</label>
                        <select name="supplier_data" required>
                            <option value="">Select</option>
                            <option value="Employee">Employee</option>
                            <option value="Supplier">Supplier</option>
                            <option value="Customer">Customer</option>
                            <option value="Equipment">Equipment</option>
                            <option value="Audit">Audit</option>
                            <option value="Design">Design</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label>Supplier ID</label>
                        <select onchange="get_customer(this)" required name="customerID" id="customer_id">
                            <option value="" disabled selected>Select supplier ID</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->idnumber }}">{{ $customer->idnumber }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div><label>Employee Who Reported NCR</label><input type="text" class="Employee_name" name="employee_name" placeholder="Employee name"></div>
                    <div>
                        <label>Employee ID</label>
                        <select onchange="get_employee(this)" required name="employee_id" id="employee_id">
                            <option value="" disabled selected>Select employee ID</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->empNumber }}">{{ $employee->empNumber }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label>Root Cause Category</label>
                        <select name="root_cause_category">
                            <option value="Other">Other</option>
                            <option value="Planning">Planning</option>
                            <option value="Production">Production</option>
                            <option value="Non-liable">Non-liable</option>
                            <option value="Training">Training</option>
                            <option value="Management">Management</option>
                            <option value="Human Factor">Human Factor</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div><label>NCR Description</label><input type="text" name="description" placeholder="Fault description"></div>
                    <div><label>Root Cause</label><input type="text" name="rootCause" placeholder="Root cause"></div>
                </div>
                <div class="form-row">
                    <div><label>Immediate Corrective Action</label><input type="text" name="immediateCorp"></div>
                    <div><label>Action to Prevent Recurrence</label><input type="text" name="actionPrevent"></div>
                </div>
                <div class="form-row">
                    <div><label>Effectiveness of Action</label><input type="text" name="ActionRecurnce"></div>
                    <div><label>Effectiveness Review Date</label><input type="date" name="effectiveDate"></div>
                </div>
                <div class="form-row">
                    <div><label>Review Performed By</label><input type="text" name="reviewdBy"></div>
                    <div><label>Date NC Processed</label><input type="date" name="dateNcP"></div>
                    <div><label>Date NC Received</label><input type="date" name="dateNcR"></div>
                </div>
                <div class="form-row">
                    <div><label>Customer Response Time (Days)</label><input type="number" min="0" name="CRE"></div>
                    <div>
                        <label>Product Impact</label>
                        <select name="PI">
                            <option value=""></option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    <div>
                        <label>NCR Closed</label>
                        <select name="NCR_closed">
                            <option value=""></option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelNcForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save NCR</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div id="amNcContainer">
            @include('dashboard.form_records.partials.non_conformities_table')
        </div>
    </div>
</div>

{{-- View modal --}}
<div class="am-modal" id="viewNcModal" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Non-Conformity Details</h4>
        </div>
        <div class="am-modal__body">
            @php $vf = [
                'non_confirm_status' => 'Type', 'supplier_data' => 'Non-Conformity Category', 'customerID' => 'Supplier ID',
                'employee_name' => 'Reported By', 'employee_id' => 'Employee ID', 'root_cause_category' => 'Root Cause Category',
                'description' => 'Description', 'rootCause' => 'Root Cause',
                'immediateCorp' => 'Immediate Corrective Action', 'actionPrevent' => 'Prevent Recurrence',
                'ActionRecurnce' => 'Effectiveness of Action', 'effectiveDate' => 'Effectiveness Review Date',
                'reviewdBy' => 'Reviewed By', 'dateNcP' => 'Date NC Processed', 'dateNcR' => 'Date NC Received',
                'CRE' => 'Customer Response Time', 'PI' => 'Product Impact', 'NCR_closed' => 'NCR Closed',
            ]; @endphp
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;font-size:13px;">
                @foreach($vf as $k => $lb)
                    <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">{{ $lb }}</div><div id="vnc-{{ $k }}">—</div></div>
                @endforeach
            </div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="editNcModal" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:1000px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Non-Conformity</h4>
        </div>
        <form action="{{ route('editnonConfirm') }}" method="POST" style="display:contents;">
            @csrf
            <input type="hidden" name="id" id="enc-id">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-4"><label>Type</label>
                        <select class="form-control" name="minor_major">
                            <option value="">Select</option>
                            <option value="Minor">Minor</option>
                            <option value="Major">Major</option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label>Non-Conformity Category</label>
                        <select class="form-control" name="supplier_data">
                            <option value="">Select</option>
                            <option value="Employee">Employee</option>
                            <option value="Supplier">Supplier</option>
                            <option value="Customer">Customer</option>
                            <option value="Equipment">Equipment</option>
                            <option value="Audit">Audit</option>
                            <option value="Design">Design</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-lg-4"><label>Supplier ID</label>
                        <select class="form-control" name="customerID">
                            <option value="">Select</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->idnumber }}">{{ $customer->idnumber }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4"><label>Employee Name</label><input type="text" class="form-control" name="employee_name"></div>
                    <div class="col-lg-4"><label>Employee ID</label>
                        <select class="form-control" name="employee_id">
                            <option value="">Select</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->empNumber }}">{{ $employee->empNumber }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4"><label>Root Cause Category</label>
                        <select class="form-control" name="root_cause_category">
                            <option value="Other">Other</option><option value="Planning">Planning</option><option value="Production">Production</option><option value="Non-liable">Non-liable</option><option value="Training">Training</option><option value="Management">Management</option><option value="Human Factor">Human Factor</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Description</label><input type="text" class="form-control" name="description"></div>
                    <div class="col-lg-6"><label>Root Cause</label><input type="text" class="form-control" name="rootCause"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Immediate Corrective Action</label><input type="text" class="form-control" name="immediateCorp"></div>
                    <div class="col-lg-6"><label>Prevent Recurrence</label><input type="text" class="form-control" name="actionPrevent"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Effectiveness of Action</label><input type="text" class="form-control" name="ActionRecurnce"></div>
                    <div class="col-lg-6"><label>Effectiveness Review Date</label><input type="date" class="form-control" name="effectiveDate"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4"><label>Reviewed By</label><input type="text" class="form-control" name="reviewdBy"></div>
                    <div class="col-lg-4"><label>Date NC Processed</label><input type="date" class="form-control" name="dateNcP"></div>
                    <div class="col-lg-4"><label>Date NC Received</label><input type="date" class="form-control" name="dateNcR"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4"><label>Customer Response Time</label><input type="number" min="0" class="form-control" name="CRE"></div>
                    <div class="col-lg-4"><label>Product Impact</label>
                        <select class="form-control" name="PI"><option value=""></option><option value="Yes">Yes</option><option value="No">No</option></select>
                    </div>
                    <div class="col-lg-4"><label>NCR Closed</label>
                        <select class="form-control" name="NCR_closed"><option value=""></option><option value="Yes">Yes</option><option value="No">No</option></select>
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
    var t = document.getElementById('toggleNcForm');
    var f = document.getElementById('newNcForm');
    var c = document.getElementById('cancelNcForm');
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
    var input = document.getElementById('amNcSearch');
    var form = document.getElementById('amNcSearchForm');
    var container = document.getElementById('amNcContainer');
    if (!container) return;
    var baseUrl = '{{ url('/non_confromities') }}';
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

function get_customer(obj) {
    // Supplier Name field removed - dropdown is now Non-Conformity Category
    // Function kept as no-op in case of external references
}
function get_employee(obj) {
    var id = obj.value;
    fetch('{{ url('/get_employee_name_by_id') }}?id=' + encodeURIComponent(id) + '&user_id={{ Auth::user()->id }}', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(function(r){ return r.json(); })
    .then(function(res){
        if (res.Status) {
            var input = document.querySelector('.Employee_name');
            if (input) input.value = res.surname || '';
        }
    })
    .catch(function(){});
}

function amNcView(d){
    ['non_confirm_status','supplier_data','customerID','employee_name','employee_id','root_cause_category','description','rootCause','immediateCorp','actionPrevent','ActionRecurnce','effectiveDate','reviewdBy','dateNcP','dateNcR','CRE','PI','NCR_closed'].forEach(function(k){
        var el = document.getElementById('vnc-'+k);
        if (el) el.textContent = d[k] || '—';
    });
    document.getElementById('viewNcModal').classList.add('open');
}
function amNcEdit(d){
    document.getElementById('enc-id').value = d.noid || '';
    var m = document.getElementById('editNcModal');
    ['employee_name','description','rootCause','immediateCorp','actionPrevent','ActionRecurnce','effectiveDate','reviewdBy','dateNcP','dateNcR','CRE'].forEach(function(k){
        var el = m.querySelector("input[name='"+k+"']");
        if (el) el.value = d[k] || '';
    });
    var setSel = function(name, val){ var el = m.querySelector("select[name='"+name+"']"); if (el) el.value = val || ''; };
    setSel('minor_major', d.non_confirm_status);
    setSel('supplier_data', d.supplier_data);
    setSel('customerID', d.customerID);
    setSel('employee_id', d.employee_id);
    setSel('root_cause_category', d.root_cause_category);
    setSel('PI', d.PI);
    setSel('NCR_closed', d.NCR_closed);
    m.classList.add('open');
}
</script>
@endsection
