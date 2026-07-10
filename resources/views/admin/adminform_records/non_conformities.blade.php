@extends('admin.dashboard.layouts.app')

@section('content')
@php $urlparam = request()->route()->parameters; @endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div>
            <h2>Non-Conformities</h2>
            <p>Track situations where products, services, or processes fail to meet specifications.</p>
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
                A non-conformance occurs when something doesn't meet specifications — in services, products, processes, supplier goods, or staff behavior. Minor (e.g. invoicing mistake) vs Major (e.g. employee misconduct).
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <div class="am-search" style="flex:1;max-width:340px;">
                <i class="fa fa-search"></i>
                <input type="text" id="amNcSearch" placeholder="Search NCRs…" autocomplete="off">
            </div>
            <button type="button" class="am-btn am-btn-primary" id="toggleNcForm">
                <i class="fa fa-plus"></i> Add Non-Conformity
            </button>
        </div>

        <div class="am-inline-form" id="newNcForm" style="margin:16px 20px;">
            <form action="{{ route('nonConfromForm') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                <div class="form-row">
                    <div>
                        <label>Type</label>
                        <select name="minor_major" required>
                            <option value="">Select</option>
                            <option value="Minor">Minor</option>
                            <option value="Major">Major</option>
                        </select>
                    </div>
                    <div><label>Supplier Name</label><input type="text" class="supplier_name" name="supplier_data" placeholder="Supplier name"></div>
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
        <div class="am-table-wrap">
            <table class="am-table" id="amNcTable">
                <thead>
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Type</th>
                        <th>Supplier</th>
                        <th>Reported By</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Processed</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers_nonconform as $index => $data)
                        <tr data-search="{{ strtolower($data->supplier_data . ' ' . $data->description . ' ' . $data->employee_name . ' ' . $data->non_confirm_status) }}">
                            <td><span class="am-cell-sub">#{{ $index + 1 }}</span></td>
                            <td>
                                @if ($data->non_confirm_status === 'Major')
                                    <span class="am-chip danger">Major</span>
                                @elseif ($data->non_confirm_status === 'Minor')
                                    <span class="am-chip warning">Minor</span>
                                @else
                                    <span class="am-cell-sub">—</span>
                                @endif
                            </td>
                            <td>
                                <span class="am-cell-primary">{{ $data->supplier_data ?? '—' }}</span>
                                <span class="am-cell-sub">ID: {{ $data->customerID }}</span>
                            </td>
                            <td>
                                <span class="am-cell-primary">{{ $data->employee_name }}</span>
                                <span class="am-cell-sub">EMP: {{ $data->employee_id }}</span>
                            </td>
                            <td>{{ Str::limit($data->description, 50) }}</td>
                            <td><span class="am-chip info">{{ $data->root_cause_category }}</span></td>
                            <td>{{ $data->dateNcR ? date('d M Y', strtotime($data->dateNcR)) : '—' }}</td>
                            <td style="text-align:right;white-space:nowrap;">
                                <div class="am-actions">
                                    <button type="button" class="am-icon-btn" title="View" onclick='amNcView(@json($data))'><i class="fa fa-eye"></i></button>
                                    <button type="button" class="am-icon-btn" title="Edit" onclick='amNcEdit(@json($data))'><i class="fa fa-pen"></i></button>
                                    <button type="button" class="am-icon-btn danger am-confirm-delete"
                                            title="Delete"
                                            data-action="{{ route('deleteNonConfrm') }}"
                                            data-id="{{ $data->noid }}"
                                            data-label="NCR #{{ $index + 1 }}"
                                            data-type="Non-Conformity">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8"><div class="am-empty"><i class="fa fa-exclamation-triangle"></i><p>No non-conformities recorded yet.</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="am-pagination" id="amNcPagination"></div>
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
                'non_confirm_status' => 'Type', 'supplier_data' => 'Supplier Name', 'customerID' => 'Supplier ID',
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
            <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
            <input type="hidden" name="noid" id="enc-id">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-4"><label>Type</label>
                        <select class="form-control" name="minor_major">
                            <option value="">Select</option>
                            <option value="Minor">Minor</option>
                            <option value="Major">Major</option>
                        </select>
                    </div>
                    <div class="col-lg-4"><label>Supplier Name</label><input type="text" class="form-control" name="supplier_data"></div>
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

<script>
(function(){
    var t=document.getElementById('toggleNcForm'),f=document.getElementById('newNcForm'),c=document.getElementById('cancelNcForm');
    t&&t.addEventListener('click',function(){f.classList.toggle('open');});
    c&&c.addEventListener('click',function(){f.classList.remove('open');});
    function debounce(fn,w){var t;return function(){var c=this,a=arguments;clearTimeout(t);t=setTimeout(function(){fn.apply(c,a);},w);};}
    var per=10,i=document.getElementById('amNcSearch'),tb=document.querySelector('#amNcTable tbody');
    if(!tb)return;
    var rows=Array.prototype.slice.call(tb.querySelectorAll('tr[data-search]')),p=document.getElementById('amNcPagination'),F=rows.slice(),pg=1;
    function r(){var T=F.length,TP=Math.max(1,Math.ceil(T/per));if(pg>TP)pg=TP;rows.forEach(function(x){x.style.display='none';});F.slice((pg-1)*per,pg*per).forEach(function(x){x.style.display='';});var fr=T===0?0:(pg-1)*per+1,to=Math.min(pg*per,T);var h='<div class="am-pagination__info">Showing <strong>'+fr+'–'+to+'</strong> of <strong>'+T+'</strong></div><div class="am-pagination__nav">';h+='<button data-p="'+(pg-1)+'" '+(pg<=1?'disabled':'')+'>‹</button>';var s=Math.max(1,pg-2),e=Math.min(TP,s+4);s=Math.max(1,e-4);for(var q=s;q<=e;q++)h+='<button data-p="'+q+'" '+(q===pg?'class="active"':'')+'>'+q+'</button>';h+='<button data-p="'+(pg+1)+'" '+(pg>=TP?'disabled':'')+'>›</button></div>';p.innerHTML=h;}
    i&&i.addEventListener('input',debounce(function(){var q=this.value.trim().toLowerCase();F=q===''?rows.slice():rows.filter(function(x){return x.getAttribute('data-search').indexOf(q)!==-1;});pg=1;r();},250));
    p&&p.addEventListener('click',function(e){var b=e.target.closest('button[data-p]');if(!b||b.disabled)return;var q=parseInt(b.getAttribute('data-p'),10);if(!isNaN(q)&&q>=1){pg=q;r();}});
    r();
})();
function amNcView(d){
    ['non_confirm_status','supplier_data','customerID','employee_name','employee_id','root_cause_category','description','rootCause','immediateCorp','actionPrevent','ActionRecurnce','effectiveDate','reviewdBy','dateNcP','dateNcR','CRE','PI','NCR_closed'].forEach(function(k){
        var el = document.getElementById('vnc-'+k);
        if (el) el.textContent = d[k] || '—';
    });
    document.getElementById('viewNcModal').classList.add('open');
}
function amNcEdit(d){
    $("#enc-id").val(d.noid);
    ['minor_major','supplier_data','employee_name','description','rootCause','immediateCorp','actionPrevent','ActionRecurnce','effectiveDate','reviewdBy','dateNcP','dateNcR','CRE'].forEach(function(k){ $("#editNcModal input[name='"+k+"'], #editNcModal textarea[name='"+k+"'], #editNcModal select[name='"+k+"']").val(d[k]||''); });
    $("#editNcModal select[name='minor_major']").val(d.non_confirm_status||'');
    $("#editNcModal select[name='customerID']").val(d.customerID||'');
    $("#editNcModal select[name='employee_id']").val(d.employee_id||'');
    $("#editNcModal select[name='root_cause_category']").val(d.root_cause_category||'');
    $("#editNcModal select[name='PI']").val(d.PI||'');
    $("#editNcModal select[name='NCR_closed']").val(d.NCR_closed||'');
    document.getElementById('editNcModal').classList.add('open');
}
</script>
@endsection
