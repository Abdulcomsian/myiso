@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Management Reviews</h2>
            <p>Measure the effectiveness of your management system and drive continual improvement.</p>
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
                Management reviews are to ensure that the company can measure the effectiveness of the management system, whilst focusing on the direction of the business and its continual improvement. Conduct these monthly, quarterly, semiannually, or annually depending on the size and nature of the business.
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <form method="GET" action="{{ url('/add_management_review') }}" class="am-search" id="amMgtSearchForm" style="flex:1;max-width:340px;margin:0;">
                <i class="fa fa-search"></i>
                <input type="text" name="q" id="amMgtSearch" value="{{ $search ?? '' }}" placeholder="Search reviews…" autocomplete="off">
            </form>
            <button type="button" class="am-btn am-btn-primary" id="toggleMgtForm">
                <i class="fa fa-plus"></i> Add Management Review
            </button>
        </div>

        <div class="am-inline-form" id="newMgtForm" style="margin:16px 20px;">
            <form action="{{ route('mgtreview') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="mgtreviewId" value="241">
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>Review Date</label><input type="date" max="2999-12-31" name="reviewdate" required></div>
                </div>
                <div class="form-row">
                    <div><label>Meeting Attendees</label><textarea name="meetingatt" placeholder="Attendees names" required rows="3"></textarea></div>
                    <div><label>Previous Meeting Minutes</label><textarea name="prevmeeting" placeholder="Review of previous meeting" required rows="3"></textarea></div>
                </div>
                <div class="form-row">
                    <div><label>Changes Recommended (External / Internal)</label><textarea name="recommendedchange" required rows="3"></textarea></div>
                    <div><label>Customer Satisfaction Summary</label><textarea name="sammarisecustomr" required rows="3"></textarea></div>
                </div>
                <div class="form-row">
                    <div><label>Comment on Previous Objectives</label><textarea name="prevobjectv" required rows="3"></textarea></div>
                    <div><label>Process Performance &amp; Conformity</label><textarea name="conformity" required rows="3"></textarea></div>
                </div>
                <div class="form-row">
                    <div><label>Non-conformities &amp; Corrective Actions</label><textarea name="nonconformities" required rows="3"></textarea></div>
                    <div><label>Monitoring &amp; Measurement Results</label><textarea name="monitoringres" required rows="3"></textarea></div>
                </div>
                <div class="form-row">
                    <div><label>Audit Results</label><textarea name="auditres" required rows="3"></textarea></div>
                    <div><label>External Providers Performance</label><textarea name="externalprovider" required rows="3"></textarea></div>
                </div>
                <div class="form-row">
                    <div><label>Adequacy of Resources / Changes</label><textarea name="adequacy" required rows="3"></textarea></div>
                    <div><label>Effectiveness of Actions on Risks &amp; Opportunities</label><textarea name="effectiveness" required rows="3"></textarea></div>
                </div>
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>New Quality Objectives &amp; Improvement Opportunities</label><textarea name="newquality" required rows="3"></textarea></div>
                </div>
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>Attachment File (PDF, jpeg, txt, .docx, doc, png)</label><input name="attach_file" type="file" accept="image/*,.doc,.docx,.txt,.pdf,.jpeg,.png"></div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelMgtForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Review</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div id="amMgtContainer">
            @include('dashboard.form_records.partials.management_reviews_table')
        </div>
    </div>
</div>

{{-- View modal --}}
<div class="am-modal" id="DetailModal" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Management Review Details</h4>
        </div>
        <div class="am-modal__body">
            @php
                $fields = [
                    '1reviewdate' => 'Review Date',
                    '1meetingatt' => 'Attendees',
                    '1prevmeeting' => 'Previous Meeting',
                    '1recommendedchange' => 'Changes Recommended',
                    '1sammarisecustomr' => 'Customer Satisfaction Summary',
                    '1prevobjectv' => 'Comment on Previous Objectives',
                    '1conformity' => 'Process Performance',
                    '1nonconformities' => 'Non-conformities & Corrective Actions',
                    '1monitoringres' => 'Monitoring Results',
                    '1auditres' => 'Audit Results',
                    '1externalprovider' => 'External Providers Performance',
                    '1adequacy' => 'Adequacy of Resources',
                    '1effectiveness' => 'Effectiveness of Actions',
                    '1newquality' => 'New Quality Objectives',
                ];
            @endphp
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:14px;font-size:13px;">
                @foreach($fields as $id => $label)
                    <div>
                        <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">{{ $label }}</div>
                        <div id="v-{{ $id }}" style="color:var(--am-text);line-height:1.4;">—</div>
                    </div>
                @endforeach
                <div style="grid-column:1/-1;">
                    <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Attachment</div>
                    <div class="file_attachemnt_div" id="v-attach">—</div>
                </div>
            </div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="editSupplier" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Management Review</h4>
        </div>
        <form action="{{ route('mgtreviewupdate') }}" method="POST" enctype="multipart/form-data" style="display:contents;">
            @csrf
            <input type="hidden" name="id" id="sdsd">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-12"><label>Review Date</label><input type="date" class="form-control" required name="reviewdate"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Attendees</label><input type="text" class="form-control" name="meetingatt"></div>
                    <div class="col-lg-6"><label>Previous Meeting</label><input type="text" class="form-control" name="prevmeeting"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Changes Recommended</label><input type="text" class="form-control" name="recommendedchange"></div>
                    <div class="col-lg-6"><label>Customer Summary</label><input type="text" class="form-control" name="sammarisecustomr"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Previous Objectives</label><input type="text" class="form-control" name="prevobjectv"></div>
                    <div class="col-lg-6"><label>Process Performance</label><input type="text" class="form-control" name="conformity"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Non-conformities</label><input type="text" class="form-control" name="nonconformities"></div>
                    <div class="col-lg-6"><label>Monitoring Results</label><input type="text" class="form-control" name="monitoringres"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Audit Results</label><input type="text" class="form-control" name="auditres"></div>
                    <div class="col-lg-6"><label>External Providers</label><input type="text" class="form-control" name="externalprovider"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Adequacy of Resources</label><input type="text" class="form-control" name="adequacy"></div>
                    <div class="col-lg-6"><label>Effectiveness of Actions</label><input type="text" class="form-control" name="effectiveness"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12"><label>New Quality Objectives</label><input type="text" class="form-control" name="newquality"></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12"><label>Attachment File</label><input name="attach_file" type="file" class="form-control" accept="image/*,.doc,.docx,.txt,.pdf,.jpeg,.png"></div>
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
    var t = document.getElementById('toggleMgtForm');
    var f = document.getElementById('newMgtForm');
    var c = document.getElementById('cancelMgtForm');
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
    var input     = document.getElementById('amMgtSearch');
    var form      = document.getElementById('amMgtSearchForm');
    var container = document.getElementById('amMgtContainer');
    if (!container) return;
    var baseUrl = '{{ url('/add_management_review') }}';
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
function amMgtView(d) {
    var m = {'1reviewdate':d.reviewdate?new Date(d.reviewdate).toLocaleDateString():'—','1meetingatt':d.meetingatt,'1prevmeeting':d.prevmeeting,'1recommendedchange':d.recommendedchange,'1sammarisecustomr':d.sammarisecustomr,'1prevobjectv':d.prevobjectv,'1conformity':d.conformity,'1nonconformities':d.nonconformities,'1monitoringres':d.monitoringres,'1auditres':d.auditres,'1externalprovider':d.externalprovider,'1adequacy':d.adequacy,'1effectiveness':d.effectiveness,'1newquality':d.newquality};
    Object.keys(m).forEach(function(k){ var el = document.getElementById('v-'+k); if (el) el.textContent = m[k] || '—'; });
    var att = document.getElementById('v-attach');
    if (d.attach_file) att.innerHTML = '<a target="_blank" href="'+d.attach_file+'" style="color:var(--am-primary);"><i class="fa fa-external-link-alt"></i> View</a>';
    else att.textContent = '—';
    document.getElementById('DetailModal').classList.add('open');
}
function amMgtEdit(d) {
    var m = document.getElementById('editSupplier');
    m.querySelector("input[name='id']").value = d.id || '';
    ['reviewdate','meetingatt','prevmeeting','recommendedchange','sammarisecustomr','prevobjectv','conformity','nonconformities','monitoringres','auditres','externalprovider','adequacy','effectiveness','newquality'].forEach(function(k){
        var el = m.querySelector("input[name='"+k+"']");
        if (el) el.value = d[k] || '';
    });
    m.classList.add('open');
}
</script>
@endsection
