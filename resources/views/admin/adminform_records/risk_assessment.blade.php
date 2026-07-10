@extends('admin.dashboard.layouts.app')

@section('content')
@php $urlparam = request()->route()->parameters; @endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div>
            <h2>Risk Assessments</h2>
            <p>Evaluate contracts before acceptance — quality, delivery, price, and risk score.</p>
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
                Detail possible scenarios when accepting a contract, and compare risk and consequence of issues occurring.
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <div class="am-search" style="flex:1;max-width:340px;">
                <i class="fa fa-search"></i>
                <input type="text" id="amRaSearch" placeholder="Search assessments…" autocomplete="off">
            </div>
            <button type="button" class="am-btn am-btn-primary" id="toggleRaForm">
                <i class="fa fa-plus"></i> Add Risk Assessment
            </button>
        </div>

        <div class="am-inline-form" id="newRaForm" style="margin:16px 20px;">
            <form action="{{ route('assessment') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                <div class="form-row">
                    <div><label>Job Number</label><input type="text" name="jobNumber" required></div>
                    <div><label>Date</label><input type="date" max="2999-12-31" name="date" required></div>
                    <div><label>Delivery Date</label><input type="date" max="2999-12-31" name="dateDevelry" required></div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Meet Quality Standard?</label>
                        <div style="display:flex;gap:10px;font-size:12.5px;padding:6px 0;">
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="qualitySatandard" value="Yes" required> Yes</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="qualitySatandard" value="No" required> No</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="qualitySatandard" value="NA" required> N/A</label>
                        </div>
                    </div>
                    <div style="grid-column:span 2;"><label>Comments</label><input type="text" name="commentsstandard" placeholder="Notes"></div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Meet Delivery Date?</label>
                        <div style="display:flex;gap:10px;font-size:12.5px;padding:6px 0;">
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="delevryStandard" value="yes" required> Yes</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="delevryStandard" value="no" required> No</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="delevryStandard" value="NA" required> N/A</label>
                        </div>
                    </div>
                    <div style="grid-column:span 2;"><label>Comments</label><input type="text" name="commentsdelvery" placeholder="Notes"></div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Meet Price?</label>
                        <div style="display:flex;gap:10px;font-size:12.5px;padding:6px 0;">
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="priceRequiremnt" value="yes" required> Yes</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="priceRequiremnt" value="No" required> No</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="priceRequiremnt" value="NA" required> N/A</label>
                        </div>
                    </div>
                    <div style="grid-column:span 2;"><label>Comments</label><input type="text" name="commentprice" placeholder="Notes"></div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Interested Parties Affected?</label>
                        <div style="display:flex;gap:10px;font-size:12.5px;padding:6px 0;">
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="interestedDeemed" value="Yes" required> Yes</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="interestedDeemed" value="No" required> No</label>
                            <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="interestedDeemed" value="NA" required> N/A</label>
                        </div>
                    </div>
                    <div style="grid-column:span 2;"><label>Comments</label><input type="text" name="commentsDeemed" placeholder="Notes"></div>
                </div>
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>Decision Comment</label><input type="text" name="DecisionComment" placeholder="Overall decision" required></div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Risk Probability (1-4)</label>
                        <select name="RiskProbability" required>
                            <option value="">Select</option>
                            <option value="4">4 — Very likely</option>
                            <option value="3">3 — Likely</option>
                            <option value="2">2 — Not likely</option>
                            <option value="1">1 — Very unlikely</option>
                        </select>
                    </div>
                    <div>
                        <label>Risk Severity (1-4)</label>
                        <select name="riskSeverity" required>
                            <option value="">Select</option>
                            <option value="4">4 — Catastrophic</option>
                            <option value="3">3 — Critical</option>
                            <option value="2">2 — Marginal</option>
                            <option value="1">1 — Negligible</option>
                        </select>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelRaForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Assessment</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div class="am-table-wrap">
            <table class="am-table" id="amRaTable">
                <thead>
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Job Number</th>
                        <th>Date</th>
                        <th>Quality</th>
                        <th>Delivery</th>
                        <th>Price</th>
                        <th>Risk Score</th>
                        <th>Decision</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assessment as $index => $data)
                        @php
                            $risk = ((int)$data->RiskProbability) * ((int)$data->riskSeverity);
                            $riskCls = $risk >= 12 ? 'danger' : ($risk >= 6 ? 'warning' : 'success');
                        @endphp
                        <tr data-search="{{ strtolower($data->jobNumber . ' ' . $data->DecisionComment) }}">
                            <td><span class="am-cell-sub">#{{ $index + 1 }}</span></td>
                            <td><span class="am-cell-primary">{{ $data->jobNumber }}</span></td>
                            <td><span class="am-chip info">{{ date('d M Y', strtotime($data->date)) }}</span></td>
                            <td>{{ ucfirst($data->qualitySatandard) }}</td>
                            <td>{{ ucfirst($data->delevryStandard) }}</td>
                            <td>{{ ucfirst($data->priceRequiremnt) }}</td>
                            <td><span class="am-chip {{ $riskCls }}">{{ $data->RiskProbability }} × {{ $data->riskSeverity }} = {{ $risk }}</span></td>
                            <td>{{ Str::limit(ucfirst($data->DecisionComment), 40) }}</td>
                            <td style="text-align:right;white-space:nowrap;">
                                <div class="am-actions">
                                    <button type="button" class="am-icon-btn" title="View" onclick='amRaView(@json($data))'><i class="fa fa-eye"></i></button>
                                    <button type="button" class="am-icon-btn" title="Edit" onclick='amRaEdit(@json($data))'><i class="fa fa-pen"></i></button>
                                    <button type="button" class="am-icon-btn danger am-confirm-delete"
                                            title="Delete"
                                            data-action="{{ route('deleteAssesmnetadmin') }}"
                                            data-id="{{ $data->id }}"
                                            data-label="Job #{{ $data->jobNumber }}"
                                            data-type="Risk Assessment">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9"><div class="am-empty"><i class="fa fa-user-shield"></i><p>No risk assessments recorded yet.</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="am-pagination" id="amRaPagination"></div>
    </div>
</div>

{{-- View modal --}}
<div class="am-modal" id="view_Modal" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:820px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Risk Assessment Details</h4>
        </div>
        <div class="am-modal__body">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;font-size:13px;">
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Job Number</div><div id="vra-job">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Date</div><div id="vra-date">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Delivery Date</div><div id="vra-dd">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Quality Standard</div><div id="vra-qs">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Delivery Standard</div><div id="vra-ds">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Price Requirement</div><div id="vra-pr">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Interested Parties</div><div id="vra-ip">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Risk Probability</div><div id="vra-rp">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Risk Severity</div><div id="vra-rs">—</div></div>
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Decision Comment</div><div id="vra-dc">—</div></div>
            </div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="editModal" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Risk Assessment</h4>
        </div>
        <form action="{{ route('editassessment') }}" method="POST" style="display:contents;">
            @csrf
            <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
            <input type="hidden" name="id" id="era-id">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-4"><label>Job Number</label><input type="text" class="form-control" name="jobNumber" required></div>
                    <div class="col-lg-4"><label>Date</label><input type="date" class="form-control" name="date" required></div>
                    <div class="col-lg-4"><label>Delivery Date</label><input type="date" class="form-control" name="dateDevelry" required></div>
                </div>
                @php
                    $radios = [
                        'qualitySatandard'  => ['Meet Quality Standard?',    ['Yes','No','NA']],
                        'delevryStandard'   => ['Meet Delivery Standard?',   ['yes','no','NA']],
                        'priceRequiremnt'   => ['Meet Price?',               ['yes','No','NA']],
                        'interestedDeemed'  => ['Interested Parties?',       ['Yes','No','NA']],
                    ];
                @endphp
                @foreach($radios as $name => [$label, $opts])
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>{{ $label }}</label>
                        <div style="display:flex;gap:12px;font-size:13px;padding:6px 0;">
                            @foreach($opts as $val)
                                <label style="display:inline-flex;gap:4px;align-items:center;"><input type="radio" name="{{ $name }}" value="{{ $val }}"> {{ $val === 'NA' ? 'N/A' : ucfirst($val) }}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6"><label>Comments</label><input type="text" class="form-control" name="comments{{ $name === 'qualitySatandard' ? 'standard' : ($name === 'delevryStandard' ? 'delvery' : ($name === 'priceRequiremnt' ? 'price' : 'Deemed')) }}"></div>
                </div>
                @endforeach
                <div class="form-group row">
                    <div class="col-lg-12"><label>Decision Comment</label><input type="text" class="form-control" name="DecisionComment" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Risk Probability</label>
                        <select class="form-control" name="RiskProbability" required>
                            <option value="">Select</option>
                            <option value="4">4 — Very likely</option><option value="3">3 — Likely</option><option value="2">2 — Not likely</option><option value="1">1 — Very unlikely</option>
                        </select>
                    </div>
                    <div class="col-lg-6"><label>Risk Severity</label>
                        <select class="form-control" name="riskSeverity" required>
                            <option value="">Select</option>
                            <option value="4">4 — Catastrophic</option><option value="3">3 — Critical</option><option value="2">2 — Marginal</option><option value="1">1 — Negligible</option>
                        </select>
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
    var t=document.getElementById('toggleRaForm'),f=document.getElementById('newRaForm'),c=document.getElementById('cancelRaForm');
    t&&t.addEventListener('click',function(){f.classList.toggle('open');});
    c&&c.addEventListener('click',function(){f.classList.remove('open');});
    function debounce(fn,w){var t;return function(){var c=this,a=arguments;clearTimeout(t);t=setTimeout(function(){fn.apply(c,a);},w);};}
    var per=10,i=document.getElementById('amRaSearch'),tb=document.querySelector('#amRaTable tbody');
    if(!tb)return;
    var rows=Array.prototype.slice.call(tb.querySelectorAll('tr[data-search]')),p=document.getElementById('amRaPagination'),F=rows.slice(),pg=1;
    function r(){var T=F.length,TP=Math.max(1,Math.ceil(T/per));if(pg>TP)pg=TP;rows.forEach(function(x){x.style.display='none';});F.slice((pg-1)*per,pg*per).forEach(function(x){x.style.display='';});var fr=T===0?0:(pg-1)*per+1,to=Math.min(pg*per,T);var h='<div class="am-pagination__info">Showing <strong>'+fr+'–'+to+'</strong> of <strong>'+T+'</strong></div><div class="am-pagination__nav">';h+='<button data-p="'+(pg-1)+'" '+(pg<=1?'disabled':'')+'>‹</button>';var s=Math.max(1,pg-2),e=Math.min(TP,s+4);s=Math.max(1,e-4);for(var q=s;q<=e;q++)h+='<button data-p="'+q+'" '+(q===pg?'class="active"':'')+'>'+q+'</button>';h+='<button data-p="'+(pg+1)+'" '+(pg>=TP?'disabled':'')+'>›</button></div>';p.innerHTML=h;}
    i&&i.addEventListener('input',debounce(function(){var q=this.value.trim().toLowerCase();F=q===''?rows.slice():rows.filter(function(x){return x.getAttribute('data-search').indexOf(q)!==-1;});pg=1;r();},250));
    p&&p.addEventListener('click',function(e){var b=e.target.closest('button[data-p]');if(!b||b.disabled)return;var q=parseInt(b.getAttribute('data-p'),10);if(!isNaN(q)&&q>=1){pg=q;r();}});
    r();
})();
function amRaView(d){
    document.getElementById('vra-job').textContent = d.jobNumber||'—';
    document.getElementById('vra-date').textContent = d.date ? new Date(d.date).toLocaleDateString() : '—';
    document.getElementById('vra-dd').textContent = d.dateDevelry ? new Date(d.dateDevelry).toLocaleDateString() : '—';
    document.getElementById('vra-qs').innerHTML = (d.qualitySatandard||'—') + '<div style="font-size:12px;color:var(--am-text-muted);margin-top:4px;">' + (d.commentsstandard||'') + '</div>';
    document.getElementById('vra-ds').innerHTML = (d.delevryStandard||'—') + '<div style="font-size:12px;color:var(--am-text-muted);margin-top:4px;">' + (d.commentsdelvery||'') + '</div>';
    document.getElementById('vra-pr').innerHTML = (d.priceRequiremnt||'—') + '<div style="font-size:12px;color:var(--am-text-muted);margin-top:4px;">' + (d.commentprice||'') + '</div>';
    document.getElementById('vra-ip').innerHTML = (d.interestedDeemed||'—') + '<div style="font-size:12px;color:var(--am-text-muted);margin-top:4px;">' + (d.commentsDeemed||'') + '</div>';
    document.getElementById('vra-rp').textContent = d.RiskProbability||'—';
    document.getElementById('vra-rs').textContent = d.riskSeverity||'—';
    document.getElementById('vra-dc').textContent = d.DecisionComment||'—';
    document.getElementById('view_Modal').classList.add('open');
}
function amRaEdit(d){
    $("#era-id").val(d.id);
    ['jobNumber','date','dateDevelry','DecisionComment','commentprice','commentsDeemed','commentsdelvery','commentsstandard'].forEach(function(k){ $("#editModal input[name='"+k+"']").val(d[k]||''); });
    $("#editModal input[name='qualitySatandard']").prop('checked', false);
    $("#editModal input[name='qualitySatandard'][value='"+d.qualitySatandard+"']").prop('checked', true);
    $("#editModal input[name='delevryStandard']").prop('checked', false);
    $("#editModal input[name='delevryStandard'][value='"+d.delevryStandard+"']").prop('checked', true);
    $("#editModal input[name='priceRequiremnt']").prop('checked', false);
    $("#editModal input[name='priceRequiremnt'][value='"+d.priceRequiremnt+"']").prop('checked', true);
    $("#editModal input[name='interestedDeemed']").prop('checked', false);
    $("#editModal input[name='interestedDeemed'][value='"+d.interestedDeemed+"']").prop('checked', true);
    $("#editModal select[name='RiskProbability']").val(d.RiskProbability||'');
    $("#editModal select[name='riskSeverity']").val(d.riskSeverity||'');
    document.getElementById('editModal').classList.add('open');
}
</script>

@endsection
