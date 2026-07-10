@extends('admin.dashboard.layouts.app')

@section('content')
@php $urlparam = request()->route()->parameters; @endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div>
            <h2>Calibration Records</h2>
            <p>Track testing and parameter checks of equipment to ensure it works correctly.</p>
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
                Calibration is the testing and/or parameter setting of machinery or instruments. All records require a frequency of calibration, shown as a reminder in your dashboard.
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <div class="am-search" style="flex:1;max-width:340px;">
                <i class="fa fa-search"></i>
                <input type="text" id="amCalSearch" placeholder="Search calibrations…" autocomplete="off">
            </div>
            <button type="button" class="am-btn am-btn-primary" id="toggleCalForm">
                <i class="fa fa-plus"></i> Add Calibration Record
            </button>
        </div>

        <div class="am-inline-form" id="newCalForm" style="margin:16px 20px;">
            <form action="{{ route('calibration') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                <input type="hidden" name="is_admin" value="admin">
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>Equipment Name</label><input type="text" name="equipment" required></div>
                </div>
                <div class="form-row">
                    <div><label>Serial Number</label><input type="text" name="serialNum" required></div>
                    <div><label>Location</label><input type="text" name="locaction" required></div>
                    <div><label>Test Method Reference</label><input type="text" name="testMethod" required></div>
                </div>
                <div class="form-row">
                    <div><label>Acceptance Criteria</label><input type="text" name="acceptance" required></div>
                    <div><label>Date Calibrated</label><input type="date" max="2999-12-31" name="calibratedDate" required></div>
                    <div><label>Certificate Number</label><input type="text" name="certificatenumber" required></div>
                </div>
                <div class="form-row">
                    <div><label>Frequency (Months, 1-12)</label><input type="number" min="1" max="12" name="freq" required></div>
                    <div><label>Report Reviewer</label><input type="text" name="reportRev" required></div>
                    <div>
                        <label>Sentence</label>
                        <select name="sentence" required>
                            <option value="">Select</option>
                            <option value="Pass">Pass</option>
                            <option value="Fail">Fail</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div><label>Attach Evidence</label><input name="attach_evidence" type="file"></div>
                    <div style="grid-column:span 2;"><label>Any Other Issues</label><input type="text" name="issues_points"></div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelCalForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Record</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div class="am-table-wrap">
            <table class="am-table" id="amCalTable">
                <thead>
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Equipment</th>
                        <th>Serial</th>
                        <th>Calibrated</th>
                        <th>Due</th>
                        <th>Sentence</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($caliber as $index => $data)
                        @php
                            $dueTs = strtotime("+".((int)$data->freq)." months", strtotime($data->calibratedDate));
                            $daysToDue = intval(($dueTs - time()) / 86400);
                            $dueClass = $daysToDue < 0 ? 'danger' : ($daysToDue < 30 ? 'warning' : 'success');
                            $sentenceClass = strtolower($data->sentence ?? '') === 'pass' ? 'success' : 'danger';
                        @endphp
                        <tr data-search="{{ strtolower($data->equipment . ' ' . $data->serialNum . ' ' . $data->certificatenumber) }}">
                            <td><span class="am-cell-sub">#{{ $index + 1 }}</span></td>
                            <td>
                                <span class="am-cell-primary">{{ $data->equipment }}</span>
                                <span class="am-cell-sub">Cert: {{ $data->certificatenumber }}</span>
                            </td>
                            <td>{{ $data->serialNum }}</td>
                            <td><span class="am-chip info">{{ date('d M Y', strtotime($data->calibratedDate)) }}</span></td>
                            <td>
                                @if ($daysToDue < 0)
                                    <span class="am-chip danger">Overdue</span>
                                @else
                                    <span class="am-chip {{ $dueClass }}">{{ date('d M Y', $dueTs) }}</span>
                                @endif
                            </td>
                            <td><span class="am-chip {{ $sentenceClass }}">{{ $data->sentence }}</span></td>
                            <td style="text-align:right;white-space:nowrap;">
                                <div class="am-actions">
                                    <button type="button" class="am-icon-btn" title="View" onclick='amCalView(@json($data))'><i class="fa fa-eye"></i></button>
                                    <button type="button" class="am-icon-btn" title="Edit" onclick='amCalEdit(@json($data))'><i class="fa fa-pen"></i></button>
                                    <button type="button" class="am-icon-btn danger am-confirm-delete"
                                            title="Delete"
                                            data-action="{{ route('deletecaliberinfo') }}"
                                            data-id="{{ $data->id }}"
                                            data-label="{{ $data->equipment }}"
                                            data-type="Calibration Record">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7"><div class="am-empty"><i class="fa fa-tachometer-alt"></i><p>No calibration records added yet.</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="am-pagination" id="amCalPagination"></div>
    </div>
</div>

{{-- View modal --}}
<div class="am-modal" id="viewCalModal" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:820px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Calibration Details</h4>
        </div>
        <div class="am-modal__body">
            @php $vf = [
                'equipment' => 'Equipment', 'serialNum' => 'Serial Number', 'locaction' => 'Location',
                'testMethod' => 'Test Method', 'acceptance' => 'Acceptance Criteria', 'calibratedDate' => 'Date Calibrated',
                'certificatenumber' => 'Certificate #', 'freq' => 'Frequency (months)', 'reportRev' => 'Report Reviewer',
                'sentence' => 'Sentence', 'issues_points' => 'Notes',
            ]; @endphp
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;font-size:13px;">
                @foreach($vf as $k => $lb)
                    <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">{{ $lb }}</div><div id="vcal-{{ $k }}">—</div></div>
                @endforeach
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Evidence</div><div id="vcal-ev">—</div></div>
            </div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="editCalModal" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Calibration Record</h4>
        </div>
        <form action="{{ route('calibrationedit') }}" method="POST" enctype="multipart/form-data" style="display:contents;">
            @csrf
            <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
            <input type="hidden" name="id" id="ecal-id">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-12"><label>Equipment Name</label><input type="text" class="form-control" name="equipment" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4"><label>Serial Number</label><input type="text" class="form-control" name="serialNum" required></div>
                    <div class="col-lg-4"><label>Location</label><input type="text" class="form-control" name="locaction" required></div>
                    <div class="col-lg-4"><label>Test Method Reference</label><input type="text" class="form-control" name="testMethod" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4"><label>Acceptance Criteria</label><input type="text" class="form-control" name="acceptance" required></div>
                    <div class="col-lg-4"><label>Date Calibrated</label><input type="date" class="form-control" name="calibratedDate" required></div>
                    <div class="col-lg-4"><label>Certificate Number</label><input type="text" class="form-control" name="certificatenumber" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4"><label>Frequency (Months)</label><input type="number" class="form-control" min="1" max="12" name="freq" required></div>
                    <div class="col-lg-4"><label>Report Reviewer</label><input type="text" class="form-control" name="reportRev" required></div>
                    <div class="col-lg-4"><label>Sentence</label>
                        <select class="form-control" name="sentence" required>
                            <option value="">Select</option>
                            <option value="Pass">Pass</option>
                            <option value="Fail">Fail</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6"><label>Attach Evidence</label><input name="attach_evidence" type="file" class="form-control"></div>
                    <div class="col-lg-6"><label>Any Other Issues</label><input type="text" class="form-control" name="issues_points"></div>
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
    var t=document.getElementById('toggleCalForm'),f=document.getElementById('newCalForm'),c=document.getElementById('cancelCalForm');
    t&&t.addEventListener('click',function(){f.classList.toggle('open');});
    c&&c.addEventListener('click',function(){f.classList.remove('open');});
    function debounce(fn,w){var t;return function(){var c=this,a=arguments;clearTimeout(t);t=setTimeout(function(){fn.apply(c,a);},w);};}
    var per=10,i=document.getElementById('amCalSearch'),tb=document.querySelector('#amCalTable tbody');
    if(!tb)return;
    var rows=Array.prototype.slice.call(tb.querySelectorAll('tr[data-search]')),p=document.getElementById('amCalPagination'),F=rows.slice(),pg=1;
    function r(){var T=F.length,TP=Math.max(1,Math.ceil(T/per));if(pg>TP)pg=TP;rows.forEach(function(x){x.style.display='none';});F.slice((pg-1)*per,pg*per).forEach(function(x){x.style.display='';});var fr=T===0?0:(pg-1)*per+1,to=Math.min(pg*per,T);var h='<div class="am-pagination__info">Showing <strong>'+fr+'–'+to+'</strong> of <strong>'+T+'</strong></div><div class="am-pagination__nav">';h+='<button data-p="'+(pg-1)+'" '+(pg<=1?'disabled':'')+'>‹</button>';var s=Math.max(1,pg-2),e=Math.min(TP,s+4);s=Math.max(1,e-4);for(var q=s;q<=e;q++)h+='<button data-p="'+q+'" '+(q===pg?'class="active"':'')+'>'+q+'</button>';h+='<button data-p="'+(pg+1)+'" '+(pg>=TP?'disabled':'')+'>›</button></div>';p.innerHTML=h;}
    i&&i.addEventListener('input',debounce(function(){var q=this.value.trim().toLowerCase();F=q===''?rows.slice():rows.filter(function(x){return x.getAttribute('data-search').indexOf(q)!==-1;});pg=1;r();},250));
    p&&p.addEventListener('click',function(e){var b=e.target.closest('button[data-p]');if(!b||b.disabled)return;var q=parseInt(b.getAttribute('data-p'),10);if(!isNaN(q)&&q>=1){pg=q;r();}});
    r();
})();
function amCalView(d){
    ['equipment','serialNum','locaction','testMethod','acceptance','calibratedDate','certificatenumber','freq','reportRev','sentence','issues_points'].forEach(function(k){
        var el = document.getElementById('vcal-'+k);
        if (el) el.textContent = d[k] || '—';
    });
    var ev = document.getElementById('vcal-ev');
    if (d.attach_evidence) { ev.innerHTML = '<a href="'+d.attach_evidence+'" target="_blank" style="color:var(--am-primary);"><i class="fa fa-external-link-alt"></i> View</a>'; } else ev.textContent='—';
    document.getElementById('viewCalModal').classList.add('open');
}
function amCalEdit(d){
    $("#ecal-id").val(d.id);
    ['equipment','serialNum','locaction','testMethod','acceptance','calibratedDate','certificatenumber','freq','reportRev','issues_points'].forEach(function(k){ $("#editCalModal input[name='"+k+"']").val(d[k]||''); });
    $("#editCalModal select[name='sentence']").val(d.sentence||'');
    document.getElementById('editCalModal').classList.add('open');
}
</script>
@endsection
