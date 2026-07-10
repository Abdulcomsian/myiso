@extends('admin.dashboard.layouts.app')

@section('content')
@php $urlparam = request()->route()->parameters; @endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div>
            <h2>Accident Risk Assessments</h2>
            <p>Identify potential accident scenarios, their likelihood, severity, and mitigation.</p>
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
                Detail possible scenarios of potential accidents, compare risk and consequence, and document measures taken to reduce their risk.
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <div class="am-search" style="flex:1;max-width:340px;">
                <i class="fa fa-search"></i>
                <input type="text" id="amArSearch" placeholder="Search assessments…" autocomplete="off">
            </div>
            <button type="button" class="am-btn am-btn-primary" id="toggleArForm">
                <i class="fa fa-plus"></i> Add Assessment
            </button>
        </div>

        <div class="am-inline-form" id="newArForm" style="margin:16px 20px;">
            <form method="POST" action="{{ route('accident_risk') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>Scenario — Describe the activity</label><input type="text" name="activityscenario" placeholder="e.g. Employee using ladder" required></div>
                </div>
                <div class="form-row">
                    <div><label>Risk Likelihood (1-6, 6 = most likely)</label><input type="number" min="1" max="6" name="risklikehood" required></div>
                    <div><label>Risk Severity (1-6, 6 = most severe)</label><input type="number" min="1" max="6" name="riskseverity" required></div>
                </div>
                <div class="form-row">
                    <div><label>Env. Accident — What Gets Out &amp; How Much</label><input type="text" name="envaccident" required></div>
                    <div><label>Env. Accident — Where Does It End Up</label><input type="text" name="envaccidental" required></div>
                </div>
                <div class="form-row">
                    <div><label>Consequences</label><input type="text" name="consequences" required></div>
                    <div><label>Prevention / Risk Reduction</label><input type="text" name="reducerisk" required></div>
                </div>
                <div class="form-row">
                    <div><label>Revised Risk Likelihood (1-6)</label><input type="number" min="1" max="6" name="revisedrisk" required></div>
                    <div><label>Revised Risk Severity (1-6)</label><input type="number" min="1" max="6" name="reviseRiskSever" required></div>
                </div>
                <div class="form-row">
                    <div><label>Attach Evidence (jpeg, mp3, mp4, xls, doc)</label><input name="attach_evidence" type="file"></div>
                    <div><label>Any Other Issues</label><textarea name="any_issues" placeholder="Notes" rows="2"></textarea></div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelArForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Assessment</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div class="am-table-wrap">
            <table class="am-table" id="amArTable">
                <thead>
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Scenario</th>
                        <th>Initial Risk</th>
                        <th>Revised Risk</th>
                        <th>Prevention</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($riskassesment as $index => $data)
                        @php
                            $initial = ((int)$data->risklikehood) * ((int)$data->riskseverity);
                            $revised = ((int)$data->revisedrisk) * ((int)$data->reviseRiskSever);
                            $initClass = $initial >= 24 ? 'danger' : ($initial >= 12 ? 'warning' : 'success');
                            $revClass  = $revised >= 24 ? 'danger' : ($revised >= 12 ? 'warning' : 'success');
                        @endphp
                        <tr data-search="{{ strtolower($data->activityscenario . ' ' . $data->reducerisk . ' ' . $data->consequences) }}">
                            <td><span class="am-cell-sub">#{{ $index + 1 }}</span></td>
                            <td>
                                <span class="am-cell-primary">{{ Str::limit($data->activityscenario, 60) }}</span>
                                <span class="am-cell-sub">{{ Str::limit($data->consequences, 60) }}</span>
                            </td>
                            <td><span class="am-chip {{ $initClass }}">{{ $data->risklikehood }} × {{ $data->riskseverity }} = {{ $initial }}</span></td>
                            <td><span class="am-chip {{ $revClass }}">{{ $data->revisedrisk }} × {{ $data->reviseRiskSever }} = {{ $revised }}</span></td>
                            <td>{{ Str::limit($data->reducerisk, 50) }}</td>
                            <td style="text-align:right;white-space:nowrap;">
                                <div class="am-actions">
                                    <button type="button" class="am-icon-btn" title="View" onclick='amArView(@json($data))'><i class="fa fa-eye"></i></button>
                                    <button type="button" class="am-icon-btn" title="Edit" onclick='amArEdit(@json($data))'><i class="fa fa-pen"></i></button>
                                    <button type="button" class="am-icon-btn danger am-confirm-delete"
                                            title="Delete"
                                            data-action="{{ route('deleteRisk') }}"
                                            data-id="{{ $data->id }}"
                                            data-label="{{ Str::limit($data->activityscenario, 40) }}"
                                            data-type="Accident Risk Assessment">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><div class="am-empty"><i class="fa fa-first-aid"></i><p>No accident risk assessments recorded yet.</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="am-pagination" id="amArPagination"></div>
    </div>
</div>

{{-- View modal --}}
<div class="am-modal" id="editInfo" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:820px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Accident Risk Details</h4>
        </div>
        <div class="am-modal__body">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;font-size:13px;">
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Scenario</div><div id="v-ar-scenario">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Risk Likelihood</div><div id="v-ar-likel">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Risk Severity</div><div id="v-ar-sev">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Env. Accident (what/how much)</div><div id="v-ar-env">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Env. Accident (where)</div><div id="v-ar-envwhere">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Consequences</div><div id="v-ar-cons">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Prevention</div><div id="v-ar-prev">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Revised Likelihood</div><div id="v-ar-revlik">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Revised Severity</div><div id="v-ar-revsev">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Evidence</div><div id="v-ar-ev">—</div></div>
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Any Other Issues</div><div id="v-ar-issues">—</div></div>
            </div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="editmodalData" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Accident Risk Assessment</h4>
        </div>
        <form action="{{ route('accidentedit') }}" method="POST" enctype="multipart/form-data" style="display:contents;">
            @csrf
            <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
            <input type="hidden" id="editrisk" name="id">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-12"><label>Scenario</label><input type="text" class="form-control" name="activityscenario" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Risk Likelihood (1-6)</label><input type="number" class="form-control" min="1" max="6" name="risklikehood" required></div>
                    <div class="col-lg-6"><label>Risk Severity (1-6)</label><input type="number" class="form-control" min="1" max="6" name="riskseverity" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Env. Accident (what/how much)</label><input type="text" class="form-control" name="envaccident" required></div>
                    <div class="col-lg-6"><label>Env. Accident (where)</label><input type="text" class="form-control" name="envaccidental" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Consequences</label><input type="text" class="form-control" name="consequences" required></div>
                    <div class="col-lg-6"><label>Prevention</label><input type="text" class="form-control" name="reducerisk" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Revised Likelihood</label><input type="number" class="form-control" min="1" max="6" name="revisedrisk" required></div>
                    <div class="col-lg-6"><label>Revised Severity</label><input type="number" class="form-control" min="1" max="6" name="reviseRiskSever" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Attach Evidence</label><input name="attach_evidence" type="file" class="form-control"></div>
                    <div class="col-lg-6"><label>Any Other Issues</label><textarea class="form-control" name="any_issues"></textarea></div>
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
    var t=document.getElementById('toggleArForm'),f=document.getElementById('newArForm'),c=document.getElementById('cancelArForm');
    t&&t.addEventListener('click',function(){f.classList.toggle('open');});
    c&&c.addEventListener('click',function(){f.classList.remove('open');});
    function debounce(fn,w){var t;return function(){var c=this,a=arguments;clearTimeout(t);t=setTimeout(function(){fn.apply(c,a);},w);};}
    var per=10,i=document.getElementById('amArSearch'),tb=document.querySelector('#amArTable tbody');
    if(!tb)return;
    var rows=Array.prototype.slice.call(tb.querySelectorAll('tr[data-search]')),p=document.getElementById('amArPagination'),F=rows.slice(),pg=1;
    function r(){var T=F.length,TP=Math.max(1,Math.ceil(T/per));if(pg>TP)pg=TP;rows.forEach(function(x){x.style.display='none';});F.slice((pg-1)*per,pg*per).forEach(function(x){x.style.display='';});var fr=T===0?0:(pg-1)*per+1,to=Math.min(pg*per,T);var h='<div class="am-pagination__info">Showing <strong>'+fr+'–'+to+'</strong> of <strong>'+T+'</strong></div><div class="am-pagination__nav">';h+='<button data-p="'+(pg-1)+'" '+(pg<=1?'disabled':'')+'>‹</button>';var s=Math.max(1,pg-2),e=Math.min(TP,s+4);s=Math.max(1,e-4);for(var q=s;q<=e;q++)h+='<button data-p="'+q+'" '+(q===pg?'class="active"':'')+'>'+q+'</button>';h+='<button data-p="'+(pg+1)+'" '+(pg>=TP?'disabled':'')+'>›</button></div>';p.innerHTML=h;}
    i&&i.addEventListener('input',debounce(function(){var q=this.value.trim().toLowerCase();F=q===''?rows.slice():rows.filter(function(x){return x.getAttribute('data-search').indexOf(q)!==-1;});pg=1;r();},250));
    p&&p.addEventListener('click',function(e){var b=e.target.closest('button[data-p]');if(!b||b.disabled)return;var q=parseInt(b.getAttribute('data-p'),10);if(!isNaN(q)&&q>=1){pg=q;r();}});
    r();
})();
function amArView(d){
    document.getElementById('v-ar-scenario').textContent = d.activityscenario||'—';
    document.getElementById('v-ar-likel').textContent = d.risklikehood||'—';
    document.getElementById('v-ar-sev').textContent = d.riskseverity||'—';
    document.getElementById('v-ar-env').textContent = d.envaccident||'—';
    document.getElementById('v-ar-envwhere').textContent = d.envaccidental||'—';
    document.getElementById('v-ar-cons').textContent = d.consequences||'—';
    document.getElementById('v-ar-prev').textContent = d.reducerisk||'—';
    document.getElementById('v-ar-revlik').textContent = d.revisedrisk||'—';
    document.getElementById('v-ar-revsev').textContent = d.reviseRiskSever||'—';
    document.getElementById('v-ar-issues').textContent = d.any_issues||'—';
    var ev = document.getElementById('v-ar-ev');
    if (d.attach_evidence) { ev.innerHTML = '<a href="'+d.attach_evidence+'" target="_blank" style="color:var(--am-primary);"><i class="fa fa-external-link-alt"></i> View</a>'; } else ev.textContent='—';
    document.getElementById('editInfo').classList.add('open');
}
function amArEdit(d){
    $("#editrisk").val(d.id);
    ['activityscenario','risklikehood','riskseverity','envaccident','envaccidental','consequences','reducerisk','revisedrisk','reviseRiskSever'].forEach(function(k){
        $("#editmodalData input[name='"+k+"']").val(d[k]||'');
    });
    $("#editmodalData textarea[name='any_issues']").val(d.any_issues||'');
    document.getElementById('editmodalData').classList.add('open');
}
</script>
@endsection
