@extends('admin.dashboard.layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"/>
@endsection

@section('content')
@php $urlparam = request()->route()->parameters; @endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div>
            <h2>Suppliers</h2>
            <p>Register &amp; grade suppliers so you can monitor their performance across all areas of contact.</p>
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
                A supplier review is a tool to monitor and grade the performance levels of your suppliers. This performance indicator can target all areas of contact with the supplier.
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <div class="am-search" style="flex:1;max-width:340px;">
                <i class="fa fa-search"></i>
                <input type="text" id="amSupSearch" placeholder="Search suppliers…" autocomplete="off">
            </div>
            <button type="button" class="am-btn am-btn-primary" id="toggleSupForm">
                <i class="fa fa-plus"></i> Add Supplier
            </button>
        </div>

        <div class="am-inline-form" id="newSupForm" style="margin:16px 20px;">
            <form action="{{ route('supplier') }}" id="addcust" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                <input type="hidden" name="is_admin" value="admin">
                <input type="hidden" name="phonecode" id="phonecode">
                <input type="hidden" name="phoneflag" id="phoneflag">
                <div class="form-row">
                    <div><label>Supplier ID Number</label><input type="number" min="1" name="idnumber" required placeholder="e.g. 1001"></div>
                    <div><label>Supplier Name</label><input type="text" name="suppliername" placeholder="Supplier name" required></div>
                    <div><label>Country</label><input type="text" name="suppliercountry" placeholder="Country" required></div>
                </div>
                <div class="form-row">
                    <div><label>Supplier Address</label><input type="text" name="supplieraddress" placeholder="Address" required></div>
                    <div><label>Supplier Phone Number</label><input type="text" name="supplierphn" id="supplierphn" placeholder="Phone" required></div>
                    <div><label>Supplier Email</label><input type="email" name="supplieremail" placeholder="email@example.com" required></div>
                </div>
                <div class="form-row">
                    <div><label>Contact Name</label><input type="text" name="supplierContactNumber" placeholder="Contact person" required></div>
                    <div style="grid-column:span 2;"><label>Services</label><input type="text" name="supplierservc" placeholder="Services supplied" required></div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelSupForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Supplier</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div class="am-table-wrap">
            <table class="am-table" id="amSupTable">
                <thead>
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Supplier</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Services</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($supplier as $data)
                        <tr data-search="{{ strtolower($data->suppliername . ' ' . $data->supplieremail . ' ' . $data->suppliercountry . ' ' . $data->supplierservc) }}">
                            <td><span class="am-cell-sub">#{{ $data->idnumber }}</span></td>
                            <td>
                                <div class="am-user-cell">
                                    <span class="am-avatar">{{ strtoupper(substr($data->suppliername ?? 'S', 0, 1)) }}</span>
                                    <div>
                                        <span class="am-cell-primary">{{ $data->suppliername }}</span>
                                        <span class="am-cell-sub">{{ $data->supplierContactNumber }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $data->supplieraddress }}</td>
                            <td>{{ $data->suppliercountry }}</td>
                            <td>{{ $data->phonecode }} {{ $data->supplierphn }}</td>
                            <td>{{ $data->supplieremail }}</td>
                            <td>{{ $data->supplierservc }}</td>
                            <td style="text-align:right;white-space:nowrap;">
                                <div class="am-actions">
                                    <button type="button" class="am-icon-btn" title="View" onclick='viewEid(@json($data))'><i class="fa fa-eye"></i></button>
                                    <button type="button" class="am-icon-btn" title="Edit" onclick='getEid(@json($data))'><i class="fa fa-pen"></i></button>
                                    <button type="button" class="am-icon-btn danger am-confirm-delete"
                                            title="Delete"
                                            data-action="{{ route('deleteSupplierAdmin') }}"
                                            data-id="{{ $data->id }}"
                                            data-label="{{ $data->suppliername }}"
                                            data-type="Supplier">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8"><div class="am-empty"><i class="fa fa-truck"></i><p>No suppliers added yet.</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="am-pagination" id="amSupPagination"></div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="editSupplier" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Supplier Details</h4>
        </div>
        <form action="{{ route('supplieredit') }}" method="POST" id="editcust" style="display:contents;">
            @csrf
            <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
            <input type="hidden" name="is_admin" value="admin">
            <input type="hidden" name="id" id="id_feild">
            <input type="hidden" name="phonecode" id="editphonecode">
            <input type="hidden" name="phoneflag" id="editphoneflag">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-6"><label>Supplier ID Number</label><input type="number" class="form-control" name="idnumber"></div>
                    <div class="col-lg-6"><label>Supplier Name</label><input type="text" class="form-control" name="suppliername"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12"><label>Supplier Address</label><input type="text" class="form-control" name="supplieraddress"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Country</label><input type="text" class="form-control" name="suppliercountry"></div>
                    <div class="col-lg-6"><label>Supplier Telephone</label><div id="edit_phone_div"></div></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Supplier Email</label><input type="email" class="form-control" name="supplieremail"></div>
                    <div class="col-lg-6"><label>Contact Name</label><input type="text" class="form-control" name="supplierContactNumber"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12"><label>Services</label><input type="text" class="form-control" name="supplierservc"></div>
                </div>
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
                <button type="submit" class="am-btn am-btn-primary" id="supupdate"><i class="fa fa-check"></i> Update</button>
            </div>
        </form>
    </div>
</div>

{{-- View modal --}}
<div class="am-modal" id="viewSupplier" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">View Supplier Details</h4>
        </div>
        <div class="am-modal__body" style="padding:20px;">
            <div class="form-group row">
                <div class="col-lg-6"><label>Supplier ID</label><input type="number" readonly class="form-control" name="idnumber"></div>
                <div class="col-lg-6"><label>Supplier Name</label><input type="text" readonly class="form-control" name="suppliername"></div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12"><label>Supplier Address</label><input type="text" readonly class="form-control" name="supplieraddress"></div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6"><label>Country</label><input type="text" readonly class="form-control" name="suppliercountry"></div>
                <div class="col-lg-6"><label>Supplier Telephone</label><div id="view_phone_div"></div></div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6"><label>Supplier Email</label><input type="email" readonly class="form-control" name="supplieremail"></div>
                <div class="col-lg-6"><label>Contact Name</label><input type="text" readonly class="form-control" name="supplierContactNumber"></div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12"><label>Services</label><input type="text" readonly class="form-control" name="supplierservc"></div>
            </div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
    </div>
</div>
@endsection

@section('myscript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>
<script>
    (function(){
        var t=document.getElementById('toggleSupForm'),f=document.getElementById('newSupForm'),c=document.getElementById('cancelSupForm');
        t&&t.addEventListener('click',function(){f.classList.toggle('open');});
        c&&c.addEventListener('click',function(){f.classList.remove('open');});
        function debounce(fn,w){var t;return function(){var c=this,a=arguments;clearTimeout(t);t=setTimeout(function(){fn.apply(c,a);},w);};}
        var per=10,i=document.getElementById('amSupSearch'),tb=document.querySelector('#amSupTable tbody');
        if(!tb)return;
        var rows=Array.prototype.slice.call(tb.querySelectorAll('tr[data-search]')),p=document.getElementById('amSupPagination'),F=rows.slice(),pg=1;
        function r(){var T=F.length,TP=Math.max(1,Math.ceil(T/per));if(pg>TP)pg=TP;rows.forEach(function(x){x.style.display='none';});F.slice((pg-1)*per,pg*per).forEach(function(x){x.style.display='';});var fr=T===0?0:(pg-1)*per+1,to=Math.min(pg*per,T);var h='<div class="am-pagination__info">Showing <strong>'+fr+'–'+to+'</strong> of <strong>'+T+'</strong></div><div class="am-pagination__nav">';h+='<button data-p="'+(pg-1)+'" '+(pg<=1?'disabled':'')+'>‹</button>';var s=Math.max(1,pg-2),e=Math.min(TP,s+4);s=Math.max(1,e-4);for(var q=s;q<=e;q++)h+='<button data-p="'+q+'" '+(q===pg?'class="active"':'')+'>'+q+'</button>';h+='<button data-p="'+(pg+1)+'" '+(pg>=TP?'disabled':'')+'>›</button></div>';p.innerHTML=h;}
        i&&i.addEventListener('input',debounce(function(){var q=this.value.trim().toLowerCase();F=q===''?rows.slice():rows.filter(function(x){return x.getAttribute('data-search').indexOf(q)!==-1;});pg=1;r();},250));
        p&&p.addEventListener('click',function(e){var b=e.target.closest('button[data-p]');if(!b||b.disabled)return;var q=parseInt(b.getAttribute('data-p'),10);if(!isNaN(q)&&q>=1){pg=q;r();}});
        r();
    })();

    var addPhone = window.intlTelInput(document.querySelector("#supplierphn"), {
        separateDialCode: true,
        customPlaceholder: function (p) { return "e.g. " + p; },
    });

    function getEid(data) {
        $('#edit_phone_div').empty().append('<input type="text" name="editsupplierphn" class="form-control" id="editphone" placeholder="Supplier phone">');
        $("#id_feild").val(data.id);
        $("#editSupplier input[name='idnumber']").val(data.idnumber);
        $("#editSupplier input[name='supplierContactNumber']").val(data.supplierContactNumber);
        $("#editSupplier input[name='supplieraddress']").val(data.supplieraddress);
        $("#editSupplier input[name='suppliercountry']").val(data.suppliercountry);
        $("#editSupplier input[name='supplieremail']").val(data.supplieremail);
        $("#editSupplier input[name='suppliername']").val(data.suppliername);
        $("#editSupplier input[name='editsupplierphn']").val(data.supplierphn);
        $("#editSupplier input[name='supplierservc']").val(data.supplierservc);
        var phoneflag = (data.phoneflag == 'preferred' || data.phoneflag == null) ? 'us' : data.phoneflag;
        window.intlTelInput(document.querySelector("#editphone"), {
            separateDialCode: true, initialCountry: phoneflag,
            customPlaceholder: function (p) { return "e.g. " + p; },
        });
        document.getElementById('editSupplier').classList.add('open');
    }

    function viewEid(data) {
        $('#view_phone_div').empty().append('<input type="text" name="supplierphn" class="form-control" id="editphone2" placeholder="Supplier phone"/>');
        $("#viewSupplier input[name='idnumber']").val(data.idnumber);
        $("#viewSupplier input[name='supplierContactNumber']").val(data.supplierContactNumber);
        $("#viewSupplier input[name='supplieraddress']").val(data.supplieraddress);
        $("#viewSupplier input[name='suppliercountry']").val(data.suppliercountry);
        $("#viewSupplier input[name='supplieremail']").val(data.supplieremail);
        $("#viewSupplier input[name='suppliername']").val(data.suppliername);
        $("#viewSupplier input[name='supplierphn']").val(data.supplierphn);
        $("#viewSupplier input[name='supplierservc']").val(data.supplierservc);
        var phoneflag = (data.phoneflag == 'preferred' || data.phoneflag == null) ? 'us' : data.phoneflag;
        window.intlTelInput(document.querySelector("#editphone2"), {
            separateDialCode: true, initialCountry: phoneflag,
            customPlaceholder: function (p) { return "e.g. " + p; },
        });
        document.getElementById('viewSupplier').classList.add('open');
    }

    $("#addcust").submit(function () {
        var d = addPhone.getSelectedCountryData();
        $("#phonecode").val(d.dialCode);
        $("#phoneflag").val(d.iso2);
    });

    $("#editcust").submit(function () {
        var i = 0;
        $('.iti__selected-dial-code').each(function () {
            if (i === 1) { $("#editphonecode").val($(this).text()); }
            i++;
        });
        var j = 0;
        $(".iti__selected-flag").each(function () {
            if (j === 1) {
                var str = $(this).attr('aria-activedescendant');
                if (str) {
                    var n = str.lastIndexOf('-');
                    $("#editphoneflag").val(str.substring(n + 1));
                }
            }
            j++;
        });
    });
</script>
@endsection
