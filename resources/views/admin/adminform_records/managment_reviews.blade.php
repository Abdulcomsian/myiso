@extends('admin.dashboard.layouts.app')

@section('content')
@php $urlparam = request()->route()->parameters; @endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div>
            <h2>Management Reviews</h2>
            <p>Ensure the effectiveness of your management system and drive continual improvement.</p>
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
                Management reviews measure the effectiveness of your management system, focusing on business direction and continual improvement. Conduct these monthly, quarterly, semiannually, or annually depending on your business.
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <div class="am-search" style="flex:1;max-width:340px;">
                <i class="fa fa-search"></i>
                <input type="text" id="amMgtSearch" placeholder="Search reviews…" autocomplete="off">
            </div>
            <button type="button" class="am-btn am-btn-primary" id="toggleMgtForm">
                <i class="fa fa-plus"></i> Add Management Review
            </button>
        </div>

        <div class="am-inline-form" id="newMgtForm" style="margin:16px 20px;">
            <form action="{{ route('mgtreview') }}" method="POST">
                @csrf
                <input type="hidden" name="mgtreviewId" value="241">
                <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                <input type="hidden" name="is_admin" value="admin">
                <div class="form-row">
                    <div><label>Review Date</label><input type="date" max="2999-12-31" name="reviewdate" required></div>
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
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelMgtForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Review</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div class="am-table-wrap">
            <table class="am-table" id="amMgtTable">
                <thead>
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Review Date</th>
                        <th>Attendees</th>
                        <th>Planned Objectives</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mgtrev as $index => $item)
                        <tr data-search="{{ strtolower($item->meetingatt . ' ' . $item->newquality) }}">
                            <td><span class="am-cell-sub">#{{ $index + 1 }}</span></td>
                            <td><span class="am-chip info">{{ date('d M Y', strtotime($item->reviewdate)) }}</span></td>
                            <td>{{ Str::limit($item->meetingatt, 80) }}</td>
                            <td>{{ Str::limit($item->newquality, 80) }}</td>
                            <td style="text-align:right;white-space:nowrap;">
                                <div class="am-actions">
                                    <button type="button" class="am-icon-btn" title="View" onclick='amMgtView(@json($item))'><i class="fa fa-eye"></i></button>
                                    <button type="button" class="am-icon-btn" title="Edit" onclick='amMgtEdit(@json($item))'><i class="fa fa-pen"></i></button>
                                    <button type="button" class="am-icon-btn danger am-confirm-delete"
                                            title="Delete"
                                            data-action="{{ route('deletemgtreviewadmin') }}"
                                            data-id="{{ $item->id }}"
                                            data-label="Review from {{ date('d M Y', strtotime($item->reviewdate)) }}"
                                            data-type="Management Review">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5"><div class="am-empty"><i class="fa fa-chart-line"></i><p>No management reviews recorded yet.</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="am-pagination" id="amMgtPagination"></div>
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
        <form action="{{ route('mgtreviewupdate') }}" method="POST" style="display:contents;">
            @csrf
            <input type="hidden" name="id" id="sdsd">
            <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
            <input type="hidden" name="is_admin" value="admin">
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
    var t=document.getElementById('toggleMgtForm'),f=document.getElementById('newMgtForm'),c=document.getElementById('cancelMgtForm');
    t&&t.addEventListener('click',function(){f.classList.toggle('open');});
    c&&c.addEventListener('click',function(){f.classList.remove('open');});
    function debounce(fn,w){var t;return function(){var c=this,a=arguments;clearTimeout(t);t=setTimeout(function(){fn.apply(c,a);},w);};}
    var per=10,i=document.getElementById('amMgtSearch'),tb=document.querySelector('#amMgtTable tbody');
    if(!tb)return;
    var rows=Array.prototype.slice.call(tb.querySelectorAll('tr[data-search]')),p=document.getElementById('amMgtPagination'),F=rows.slice(),pg=1;
    function r(){var T=F.length,TP=Math.max(1,Math.ceil(T/per));if(pg>TP)pg=TP;rows.forEach(function(x){x.style.display='none';});F.slice((pg-1)*per,pg*per).forEach(function(x){x.style.display='';});var fr=T===0?0:(pg-1)*per+1,to=Math.min(pg*per,T);var h='<div class="am-pagination__info">Showing <strong>'+fr+'–'+to+'</strong> of <strong>'+T+'</strong></div><div class="am-pagination__nav">';h+='<button data-p="'+(pg-1)+'" '+(pg<=1?'disabled':'')+'>‹</button>';var s=Math.max(1,pg-2),e=Math.min(TP,s+4);s=Math.max(1,e-4);for(var q=s;q<=e;q++)h+='<button data-p="'+q+'" '+(q===pg?'class="active"':'')+'>'+q+'</button>';h+='<button data-p="'+(pg+1)+'" '+(pg>=TP?'disabled':'')+'>›</button></div>';p.innerHTML=h;}
    i&&i.addEventListener('input',debounce(function(){var q=this.value.trim().toLowerCase();F=q===''?rows.slice():rows.filter(function(x){return x.getAttribute('data-search').indexOf(q)!==-1;});pg=1;r();},250));
    p&&p.addEventListener('click',function(e){var b=e.target.closest('button[data-p]');if(!b||b.disabled)return;var q=parseInt(b.getAttribute('data-p'),10);if(!isNaN(q)&&q>=1){pg=q;r();}});
    r();
})();
function amMgtView(d){
    var m={'1reviewdate':d.reviewdate?new Date(d.reviewdate).toLocaleDateString():'—','1meetingatt':d.meetingatt,'1prevmeeting':d.prevmeeting,'1recommendedchange':d.recommendedchange,'1sammarisecustomr':d.sammarisecustomr,'1prevobjectv':d.prevobjectv,'1conformity':d.conformity,'1nonconformities':d.nonconformities,'1monitoringres':d.monitoringres,'1auditres':d.auditres,'1externalprovider':d.externalprovider,'1adequacy':d.adequacy,'1effectiveness':d.effectiveness,'1newquality':d.newquality};
    Object.keys(m).forEach(function(k){var el=document.getElementById('v-'+k);if(el)el.textContent=m[k]||'—';});
    document.getElementById('DetailModal').classList.add('open');
}
function amMgtEdit(d){
    $("#sdsd").val(d.id);
    ['reviewdate','meetingatt','prevmeeting','recommendedchange','sammarisecustomr','prevobjectv','conformity','nonconformities','monitoringres','auditres','externalprovider','adequacy','effectiveness','newquality'].forEach(function(k){
        $("#editSupplier input[name='"+k+"']").val(d[k]||'');
    });
    document.getElementById('editSupplier').classList.add('open');
}
</script>
@endsection
