@extends('dashboard.layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"/>
@endsection

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Customers</h2>
            <p>List of customers for audits, service reviews, and satisfaction surveys.</p>
        </div>
    </div>

    @if(session('message'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ session('message') }}
        </div>
    @endif
    @if(Session::has('Error'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#b83432;background:rgba(235,77,75,0.08);">
            <i class="fa fa-exclamation-circle"></i> {{ Session::get('Error') }}
        </div>
    @endif
    @if(Session::has('Success'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ Session::get('Success') }}
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
            <form method="GET" action="{{ url('/customer') }}" class="am-search" id="amCustSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amCustSearch" value="{{ $search ?? '' }}" placeholder="Search customers…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleCustForm">
                <i class="fa fa-plus"></i> Add Customer
            </button>
        </div>

        <div class="am-inline-form" id="newCustForm" style="margin:16px 20px;">
            <form action="{{ route('customerform') }}" id="add_form" method="POST" name="add_form">
                @csrf
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
        <div id="amCustContainer">
            @include('dashboard.form_records.partials.customer_table')
        </div>
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
                <div class="col-lg-6"><label>Customer ID Number</label><input type="number" readonly class="form-control" name="v_idNumber"></div>
                <div class="col-lg-6"><label>Customer Name</label><input type="text" readonly class="form-control" name="v_name"></div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6"><label>Business Address</label><input type="text" readonly class="form-control" name="v_address"></div>
                <div class="col-lg-6"><label>Customer Telephone</label><div id="view_phone_div"></div></div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6"><label>Customer Email Address</label><input type="email" readonly class="form-control" name="v_Email"></div>
                <div class="col-lg-6"><label>Customer Contact Name</label><input type="text" readonly class="form-control" name="v_contactName"></div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>
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
        var t = document.getElementById('toggleCustForm');
        var f = document.getElementById('newCustForm');
        var c = document.getElementById('cancelCustForm');
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
        var input = document.getElementById('amCustSearch');
        var form = document.getElementById('amCustSearchForm');
        var container = document.getElementById('amCustContainer');
        if (!container) return;
        var baseUrl = '{{ url('/customer') }}';
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

    // Phone intl-tel-input for add form
    var create_phone_number = window.intlTelInput(document.querySelector("#create_phone_number"), {
        separateDialCode: true,
        customPlaceholder: function (p) { return "e.g. " + p; },
    });

    var edit_phone_number = '';

    function getEid(data) {
        $("#id_feild").val(data.id);
        $("#EditCustomer input[name='Email']").val(data.Email);
        $("#EditCustomer input[name='address']").val(data.address);
        $("#EditCustomer input[name='contactName']").val(data.contactName);
        $("#EditCustomer input[name='idNumber']").val(data.idNumber);
        $("#EditCustomer input[name='name']").val(data.name);
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
        $("#ViewCustomer input[name='v_Email']").val(data.Email);
        $("#ViewCustomer input[name='v_address']").val(data.address);
        $("#ViewCustomer input[name='v_contactName']").val(data.contactName);
        $("#ViewCustomer input[name='v_idNumber']").val(data.idNumber);
        $("#ViewCustomer input[name='v_name']").val(data.name);
        $("#view_phone_div").empty().append('<input type="text" class="form-control" name="view_phone_number" id="view_phone_number" placeholder="Phone">');
        $("input[name='view_phone_number']").val(data.phoneNumber);
        var phoneflag = (data.phoneflag == 'preferred' || data.phoneflag == null) ? 'us' : data.phoneflag;
        window.intlTelInput(document.querySelector("#view_phone_number"), {
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
        $.ajax({
            method: 'get', url: '{{url("/check-customer-number")}}',
            data: { number: number },
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
