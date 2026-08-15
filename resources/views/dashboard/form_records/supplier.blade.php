@extends('dashboard.layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"/>
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Suppliers</h2>
            <p>Register &amp; grade suppliers so you can monitor their performance across all areas of contact.</p>
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
                A supplier review is a tool to monitor and grade the performance levels of your suppliers.
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form method="GET" action="{{ url('/supplier') }}" class="am-search" id="amSupSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amSupSearch" value="{{ $search ?? '' }}" placeholder="Search suppliers…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleSupForm">
                <i class="fa fa-plus"></i> Add Supplier
            </button>
        </div>

        <div class="am-inline-form" id="newSupForm" style="margin:16px 20px;">
            <form action="{{ route('supplier') }}" id="addcust" method="POST">
                @csrf
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
        <div id="amSupContainer">
            @include('dashboard.form_records.partials.supplier_table')
        </div>
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
                <div class="col-lg-6"><label>Supplier ID</label><input type="number" readonly class="form-control" name="v_idnumber"></div>
                <div class="col-lg-6"><label>Supplier Name</label><input type="text" readonly class="form-control" name="v_suppliername"></div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12"><label>Supplier Address</label><input type="text" readonly class="form-control" name="v_supplieraddress"></div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6"><label>Country</label><input type="text" readonly class="form-control" name="v_suppliercountry"></div>
                <div class="col-lg-6"><label>Supplier Telephone</label><div id="view_phone_div"></div></div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6"><label>Supplier Email</label><input type="email" readonly class="form-control" name="v_supplieremail"></div>
                <div class="col-lg-6"><label>Contact Name</label><input type="text" readonly class="form-control" name="v_supplierContactNumber"></div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12"><label>Services</label><input type="text" readonly class="form-control" name="v_supplierservc"></div>
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
        var t = document.getElementById('toggleSupForm');
        var f = document.getElementById('newSupForm');
        var c = document.getElementById('cancelSupForm');
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
        var input = document.getElementById('amSupSearch');
        var form = document.getElementById('amSupSearchForm');
        var container = document.getElementById('amSupContainer');
        if (!container) return;
        var baseUrl = '{{ url('/supplier') }}';
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
        $('#view_phone_div').empty().append('<input type="text" name="v_supplierphn" class="form-control" id="editphone2" readonly placeholder="Supplier phone"/>');
        $("#viewSupplier input[name='v_idnumber']").val(data.idnumber);
        $("#viewSupplier input[name='v_supplierContactNumber']").val(data.supplierContactNumber);
        $("#viewSupplier input[name='v_supplieraddress']").val(data.supplieraddress);
        $("#viewSupplier input[name='v_suppliercountry']").val(data.suppliercountry);
        $("#viewSupplier input[name='v_supplieremail']").val(data.supplieremail);
        $("#viewSupplier input[name='v_suppliername']").val(data.suppliername);
        $("#viewSupplier input[name='v_supplierphn']").val(data.supplierphn);
        $("#viewSupplier input[name='v_supplierservc']").val(data.supplierservc);
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
