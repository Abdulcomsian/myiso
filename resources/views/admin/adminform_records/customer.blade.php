@extends('admin.dashboard.layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"/>
@endsection

@section('content')
@php $urlparam = request()->route()->parameters; @endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid view_user_content" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div>
            <h2>Customers</h2>
            <p>List of customers for audits, service reviews, and satisfaction surveys.</p>
        </div>
        <div>
            <a href="{{ url('/edit_user/'.$urlparam['userid']) }}" class="am-btn am-btn-outline">
                <i class="fa fa-arrow-left"></i> Back to Forms
            </a>
        </div>
    </div>

    @if(Session::has('Error'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#b83432;background:rgba(235,77,75,0.08);">
            <i class="fa fa-exclamation-circle"></i> {{ Session::get('Error') }}
        </div>
    @endif
    @if ($message = Session::get('msg'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ $message }}
        </div>
    @endif

    <div class="am-card" style="padding:16px 20px;margin-bottom:16px;background:rgba(46,59,154,0.04);border:1px solid rgba(46,59,154,0.12);">
        <div style="display:flex;gap:12px;align-items:flex-start;">
            <span style="width:36px;height:36px;flex-shrink:0;border-radius:10px;background:var(--am-primary-tint);color:var(--am-primary);display:inline-flex;align-items:center;justify-content:center;font-size:15px;"><i class="fa fa-info-circle"></i></span>
            <div style="font-size:13px;color:var(--am-text);line-height:1.55;">
                Customers should be listed so that internal audits can be carried out on delivery / service quality, and to assist with customer satisfaction surveys.
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <div class="am-search" style="flex:1;max-width:340px;">
                <i class="fa fa-search"></i>
                <input type="text" id="amCustSearch" placeholder="Search customers…" autocomplete="off">
            </div>
            <button type="button" class="am-btn am-btn-primary" id="toggleCustForm">
                <i class="fa fa-plus"></i> Add Customer
            </button>
        </div>

        <div class="am-inline-form" id="newCustForm" style="margin:16px 20px;">
            <form action="{{ route('customerform') }}" id="add_form" method="POST" name="add_form">
                @csrf
                <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                <input type="hidden" name="is_admin" value="admin">
                <div class="form-row">
                    <div><label>Customer ID Number</label><input type="number" min="1" max="100000" required name="idNumber" id="idNumber" placeholder="Enter ID number"><span id="numbererror" style="color:var(--am-danger);font-size:11px;"></span></div>
                    <div><label>Customer Name</label><input type="text" name="name" id="name" placeholder="Enter customer name" required></div>
                </div>
                <div class="form-row">
                    <div><label>Business Address</label><input type="text" name="address" placeholder="Full business address" required></div>
                    <div><label>Customer Telephone</label><input type="text" name="create_phone_number" id="create_phone_number" placeholder="Phone with country code" required>
                        <input type="hidden" name="create_phone_number_country_code" id="create_phone_number_country_code">
                        <input type="hidden" name="create_phone_number_flag" id="create_phone_number_flag">
                    </div>
                </div>
                <div class="form-row">
                    <div><label>Customer Email Address</label><input type="email" name="Email" placeholder="Customer email" required></div>
                    <div><label>Customer Contact Name</label><input type="text" name="contactName" placeholder="Contact person's name" required></div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelCustForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm" id="add_customer_submit_button"><i class="fa fa-check"></i> Save Customer</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div class="am-table-wrap">
            <table class="am-table" id="amCustTable">
                <thead>
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Customer</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customer as $item)
                        <tr data-search="{{ strtolower($item->name . ' ' . $item->Email . ' ' . $item->idNumber . ' ' . $item->contactName) }}">
                            <td><span class="am-cell-sub">#{{ $item->idNumber }}</span></td>
                            <td>
                                <div class="am-user-cell">
                                    <span class="am-avatar">{{ strtoupper(substr($item->name ?? 'C', 0, 1)) }}</span>
                                    <div>
                                        <span class="am-cell-primary">{{ $item->name }}</span>
                                        <span class="am-cell-sub">ID: {{ $item->idNumber }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->phonecode }} {{ $item->phoneNumber }}</td>
                            <td>{{ $item->Email }}</td>
                            <td>{{ $item->contactName }}</td>
                            <td style="text-align:right;white-space:nowrap;">
                                <div class="am-actions">
                                    <button type="button" class="am-icon-btn" title="View" onclick='viewEid(@json($item))'><i class="fa fa-eye"></i></button>
                                    <button type="button" class="am-icon-btn" title="Edit" onclick='getEid(@json($item))'><i class="fa fa-pen"></i></button>
                                    <button type="button" class="am-icon-btn danger am-confirm-delete"
                                            title="Delete"
                                            data-action="{{ route('deletecustomeradmin') }}"
                                            data-id="{{ $item->id }}"
                                            data-label="{{ $item->name }}"
                                            data-type="Customer">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7"><div class="am-empty"><i class="fa fa-user-friends"></i><p>No customers added yet.</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="am-pagination" id="amCustPagination"></div>
    </div>
</div>

{{-- Edit Customer modal --}}
<div class="am-modal" id="EditCustomer" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:820px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Customer Details</h4>
        </div>
        <form action="{{ route('editCustomers') }}" id="edit_form" name="edit_form" method="POST" style="display:contents;">
            @csrf
            <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
            <input type="hidden" name="id" id="id_feild">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-6"><label>Customer ID Number</label><input type="number" class="form-control" name="idNumber" id="editidNumber" required><span id="editnumbererror" style="color:var(--am-danger);font-size:11px;"></span></div>
                    <div class="col-lg-6"><label>Customer Name</label><input type="text" class="form-control" name="name" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Business Address</label><input type="text" class="form-control" name="address" required></div>
                    <div class="col-lg-6"><label>Customer Telephone</label><div id="edit_phone_div"></div>
                        <input type="hidden" name="edit_phone_code" id="edit_phone_code">
                        <input type="hidden" name="edit_phone_flag" id="edit_phone_flag">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Customer Email Address</label><input type="email" class="form-control" name="Email" required></div>
                    <div class="col-lg-6"><label>Customer Contact Name</label><input type="text" class="form-control" name="contactName" required></div>
                </div>
            </div>
            <div class="am-modal__footer">
                <button type="button" class="am-btn am-btn-outline am-modal-close">Cancel</button>
                <button type="submit" class="am-btn am-btn-primary" id="update_customer_button"><i class="fa fa-check"></i> Update</button>
            </div>
        </form>
    </div>
</div>

{{-- View Customer modal --}}
<div class="am-modal" id="ViewCustomer" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:820px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">View Customer Details</h4>
        </div>
        <div class="am-modal__body" style="padding:20px;">
            <div class="form-group row">
                <div class="col-lg-6"><label>Customer ID Number</label><input type="number" readonly class="form-control" name="idNumber"></div>
                <div class="col-lg-6"><label>Customer Name</label><input type="text" readonly class="form-control" name="name"></div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6"><label>Business Address</label><input type="text" readonly class="form-control" name="address"></div>
                <div class="col-lg-6"><label>Customer Telephone</label><div id="view_phone_div"></div></div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6"><label>Customer Email Address</label><input type="email" readonly class="form-control" name="Email"></div>
                <div class="col-lg-6"><label>Customer Contact Name</label><input type="text" readonly class="form-control" name="contactName"></div>
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
    // Toggle form + search + pagination
    (function(){
        var t=document.getElementById('toggleCustForm'),f=document.getElementById('newCustForm'),c=document.getElementById('cancelCustForm');
        t&&t.addEventListener('click',function(){f.classList.toggle('open');});
        c&&c.addEventListener('click',function(){f.classList.remove('open');});
        function debounce(fn,w){var t;return function(){var c=this,a=arguments;clearTimeout(t);t=setTimeout(function(){fn.apply(c,a);},w);};}
        var per=10,i=document.getElementById('amCustSearch'),tb=document.querySelector('#amCustTable tbody');
        if(!tb)return;
        var rows=Array.prototype.slice.call(tb.querySelectorAll('tr[data-search]')),p=document.getElementById('amCustPagination'),F=rows.slice(),pg=1;
        function r(){var T=F.length,TP=Math.max(1,Math.ceil(T/per));if(pg>TP)pg=TP;rows.forEach(function(x){x.style.display='none';});F.slice((pg-1)*per,pg*per).forEach(function(x){x.style.display='';});var fr=T===0?0:(pg-1)*per+1,to=Math.min(pg*per,T);var h='<div class="am-pagination__info">Showing <strong>'+fr+'–'+to+'</strong> of <strong>'+T+'</strong></div><div class="am-pagination__nav">';h+='<button data-p="'+(pg-1)+'" '+(pg<=1?'disabled':'')+'>‹</button>';var s=Math.max(1,pg-2),e=Math.min(TP,s+4);s=Math.max(1,e-4);for(var q=s;q<=e;q++)h+='<button data-p="'+q+'" '+(q===pg?'class="active"':'')+'>'+q+'</button>';h+='<button data-p="'+(pg+1)+'" '+(pg>=TP?'disabled':'')+'>›</button></div>';p.innerHTML=h;}
        i&&i.addEventListener('input',debounce(function(){var q=this.value.trim().toLowerCase();F=q===''?rows.slice():rows.filter(function(x){return x.getAttribute('data-search').indexOf(q)!==-1;});pg=1;r();},250));
        p&&p.addEventListener('click',function(e){var b=e.target.closest('button[data-p]');if(!b||b.disabled)return;var q=parseInt(b.getAttribute('data-p'),10);if(!isNaN(q)&&q>=1){pg=q;r();}});
        r();
    })();

    // Phone intl-tel-input for add form
    var create_phone_number = window.intlTelInput(document.querySelector("#create_phone_number"), {
        separateDialCode: true,
        customPlaceholder: function (p) { return "e.g. " + p; },
    });

    var edit_phone_number = '';
    var view_phone_number = '';

    function getEid(data) {
        $("#id_feild").val(data.id);
        $("input[name='Email']").val(data.Email);
        $("input[name='address']").val(data.address);
        $("input[name='contactName']").val(data.contactName);
        $("input[name='idNumber']").val(data.idNumber);
        $("input[name='name']").val(data.name);
        $("#edit_phone_div").empty().append('<input type="text" class="form-control" required name="edit_phone_number" id="edit_phone_number" placeholder="Phone with country code">');
        $("input[name='edit_phone_number']").val(data.phoneNumber);
        var phoneflag = (data.phoneflag == 'preferred' || data.phoneflag == null) ? 'us' : data.phoneflag;
        edit_phone_number = window.intlTelInput(document.querySelector("#edit_phone_number"), {
            separateDialCode: true, initialCountry: phoneflag,
            customPlaceholder: function (p) { return "e.g. " + p; },
        });
        document.getElementById('EditCustomer').classList.add('open');
    }

    function viewEid(data) {
        $("input[name='Email']").val(data.Email);
        $("input[name='address']").val(data.address);
        $("input[name='contactName']").val(data.contactName);
        $("input[name='idNumber']").val(data.idNumber);
        $("input[name='name']").val(data.name);
        $("#view_phone_div").empty().append('<input type="text" class="form-control" name="view_phone_number" id="view_phone_number" placeholder="Phone">');
        $("input[name='view_phone_number']").val(data.phoneNumber);
        var phoneflag = (data.phoneflag == 'preferred' || data.phoneflag == null) ? 'us' : data.phoneflag;
        view_phone_number = window.intlTelInput(document.querySelector("#view_phone_number"), {
            separateDialCode: true, initialCountry: phoneflag,
            customPlaceholder: function (p) { return "e.g. " + p; },
        });
        document.getElementById('ViewCustomer').classList.add('open');
    }

    $("#add_customer_submit_button").click(function (e) {
        e.preventDefault();
        var d = create_phone_number.getSelectedCountryData();
        $('#create_phone_number_country_code').val(d.dialCode);
        $('#create_phone_number_flag').val(d.iso2);
        $("form[name='add_form']").submit();
    });

    $("#update_customer_button").click(function (e) {
        e.preventDefault();
        var d = edit_phone_number.getSelectedCountryData();
        $('#edit_phone_code').val(d.dialCode);
        $('#edit_phone_flag').val(d.iso2);
        $("form[name='edit_form']").submit();
    });

    $("#idNumber").blur(function () {
        var number = $("#idNumber").val();
        var user_id = $("input[name=user_id]").val();
        $.ajax({
            method: 'get', url: '{{url("/check-customer-number")}}',
            data: { number: number, is_admin: "admin", user_id: user_id },
            success: function (res) {
                if (res == "exist") { $("#idNumber").val(""); $("#numbererror").html("Number is already taken"); }
                else { $("#numbererror").html(""); }
            }
        });
    });

    $("#editidNumber").blur(function () {
        var number = $("#editidNumber").val();
        $.ajax({
            method: 'get', url: '{{url("/check-customer-number")}}',
            data: { number: number },
            success: function (res) {
                if (res == "exist") { $("#editidNumber").val(""); $("#editnumbererror").html("Number is already taken"); }
                else { $("#editnumbererror").html(""); }
            }
        });
    });
</script>
@endsection
