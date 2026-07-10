@extends('admin.dashboard.layouts.app')

@section('content')
@php $urlparam = request()->route()->parameters; @endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div>
            <h2>Work Instructions</h2>
            <p>Step-by-step processes used to conduct activities in the workplace.</p>
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
                Work instructions (also called processes) are step-by-step guides. Use this section to define activities that internal audits will later verify. External documents are fine as long as they're referenced here.
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <div class="am-search" style="flex:1;max-width:340px;">
                <i class="fa fa-search"></i>
                <input type="text" id="amWiSearch" placeholder="Search work instructions…" autocomplete="off">
            </div>
            <button type="button" class="am-btn am-btn-primary" id="toggleWiForm">
                <i class="fa fa-plus"></i> Add Work Instruction
            </button>
        </div>

        <div class="am-inline-form" id="newWiForm" style="margin:16px 20px;">
            <form action="{{ route('workinstructions') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
                <div class="form-row">
                    <div><label>Work Instruction Title</label><input type="text" name="workinstruction" placeholder="Process title" required></div>
                    <div><label>Reference</label><input type="text" name="instructionref" required></div>
                </div>
                <div class="form-row">
                    <div>
                        <label>Creator Employee ID</label>
                        <select name="empId" required>
                            <option value="">Select Employee</option>
                            @foreach($employess as $emp)
                                <option value="{{ $emp->empNumber }}">{{ $emp->empNumber }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div><label>Issue Date</label><input type="date" max="2999-12-31" name="issueDate" required></div>
                    <div><label>Revision Status</label><input type="text" name="revisionstatus" required></div>
                </div>
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>Scope</label><input type="text" name="scop" required></div>
                </div>
                <div class="form-row">
                    @for ($i = 1; $i <= 12; $i++)
                        <div><label>Point {{ $i }}</label><input type="text" name="point{{ $i }}"></div>
                    @endfor
                </div>
                <div class="form-row">
                    <div style="grid-column:1/-1;"><label>Compiled By</label><input type="text" name="CompiledBy" required></div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelWiForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save Instruction</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div class="am-table-wrap">
            <table class="am-table" id="amWiTable">
                <thead>
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Title</th>
                        <th>Reference</th>
                        <th>Scope</th>
                        <th>Compiled By</th>
                        <th>Issue Date</th>
                        <th>Revision</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($work as $index => $data)
                        <tr data-search="{{ strtolower($data->workinstruction . ' ' . $data->instructionref . ' ' . $data->scop . ' ' . ($data->CompiledBy ?? '')) }}">
                            <td><span class="am-cell-sub">#{{ $index + 1 }}</span></td>
                            <td><span class="am-cell-primary">{{ $data->workinstruction }}</span></td>
                            <td>{{ $data->instructionref }}</td>
                            <td>{{ Str::limit($data->scop, 60) }}</td>
                            <td>{{ $data->CompiledBy ?? '—' }}</td>
                            <td><span class="am-chip info">{{ date('d M Y', strtotime($data->issueDate)) }}</span></td>
                            <td>{{ $data->revisionstatus }}</td>
                            <td style="text-align:right;white-space:nowrap;">
                                <div class="am-actions">
                                    <button type="button" class="am-icon-btn" title="View" onclick='amWiView(@json($data))'><i class="fa fa-eye"></i></button>
                                    <button type="button" class="am-icon-btn" title="Edit" onclick='amWiEdit(@json($data))'><i class="fa fa-pen"></i></button>
                                    <button type="button" class="am-icon-btn danger am-confirm-delete"
                                            title="Delete"
                                            data-action="{{ route('deleteWork') }}"
                                            data-id="{{ $data->id }}"
                                            data-label="{{ $data->workinstruction }}"
                                            data-type="Work Instruction">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8"><div class="am-empty"><i class="fa fa-file-alt"></i><p>No work instructions added yet.</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="am-pagination" id="amWiPagination"></div>
    </div>
</div>

{{-- View modal --}}
<div class="am-modal" id="viewWiModal" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:820px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Work Instruction Details</h4>
        </div>
        <div class="am-modal__body">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;font-size:13px;">
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Title</div><div id="vwi-title">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Reference</div><div id="vwi-ref">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Employee ID</div><div id="vwi-emp">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Issue Date</div><div id="vwi-date">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Revision Status</div><div id="vwi-rev">—</div></div>
                <div><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Compiled By</div><div id="vwi-comp">—</div></div>
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Scope</div><div id="vwi-scope">—</div></div>
                <div style="grid-column:1/-1;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:8px;">Steps</div><ol id="vwi-points" style="padding-left:18px;margin:0;font-size:13px;line-height:1.6;"></ol></div>
            </div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="editWiModal" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Work Instruction</h4>
        </div>
        <form action="{{ route('editworkinstructions') }}" method="POST" style="display:contents;">
            @csrf
            <input type="hidden" name="user_id" value="{{ $urlparam['userid'] }}">
            <input type="hidden" name="id" id="ewi-id">
            <div class="am-modal__body" style="padding:20px;">
                <div class="form-group row">
                    <div class="col-lg-6"><label>Title</label><input type="text" class="form-control" name="workinstruction" required></div>
                    <div class="col-lg-6"><label>Reference</label><input type="text" class="form-control" name="instructionref" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label>Creator Employee ID</label>
                        <select class="form-control" name="empId" required>
                            <option value="">Select</option>
                            @foreach($employess as $emp)
                                <option value="{{ $emp->empNumber }}">{{ $emp->empNumber }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4"><label>Issue Date</label><input type="date" class="form-control" name="issueDate" required></div>
                    <div class="col-lg-4"><label>Revision Status</label><input type="text" class="form-control" name="revisionstatus" required></div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12"><label>Scope</label><input type="text" class="form-control" name="scop" required></div>
                </div>
                <div class="form-group row">
                    @for ($i = 1; $i <= 12; $i++)
                        <div class="col-lg-4"><label>Point {{ $i }}</label><input type="text" class="form-control" name="point{{ $i }}"></div>
                    @endfor
                </div>
                <div class="form-group row">
                    <div class="col-lg-12"><label>Compiled By</label><input type="text" class="form-control" name="CompiledBy" required></div>
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
    var t=document.getElementById('toggleWiForm'),f=document.getElementById('newWiForm'),c=document.getElementById('cancelWiForm');
    t&&t.addEventListener('click',function(){f.classList.toggle('open');});
    c&&c.addEventListener('click',function(){f.classList.remove('open');});
    function debounce(fn,w){var t;return function(){var c=this,a=arguments;clearTimeout(t);t=setTimeout(function(){fn.apply(c,a);},w);};}
    var per=10,i=document.getElementById('amWiSearch'),tb=document.querySelector('#amWiTable tbody');
    if(!tb)return;
    var rows=Array.prototype.slice.call(tb.querySelectorAll('tr[data-search]')),p=document.getElementById('amWiPagination'),F=rows.slice(),pg=1;
    function r(){var T=F.length,TP=Math.max(1,Math.ceil(T/per));if(pg>TP)pg=TP;rows.forEach(function(x){x.style.display='none';});F.slice((pg-1)*per,pg*per).forEach(function(x){x.style.display='';});var fr=T===0?0:(pg-1)*per+1,to=Math.min(pg*per,T);var h='<div class="am-pagination__info">Showing <strong>'+fr+'–'+to+'</strong> of <strong>'+T+'</strong></div><div class="am-pagination__nav">';h+='<button data-p="'+(pg-1)+'" '+(pg<=1?'disabled':'')+'>‹</button>';var s=Math.max(1,pg-2),e=Math.min(TP,s+4);s=Math.max(1,e-4);for(var q=s;q<=e;q++)h+='<button data-p="'+q+'" '+(q===pg?'class="active"':'')+'>'+q+'</button>';h+='<button data-p="'+(pg+1)+'" '+(pg>=TP?'disabled':'')+'>›</button></div>';p.innerHTML=h;}
    i&&i.addEventListener('input',debounce(function(){var q=this.value.trim().toLowerCase();F=q===''?rows.slice():rows.filter(function(x){return x.getAttribute('data-search').indexOf(q)!==-1;});pg=1;r();},250));
    p&&p.addEventListener('click',function(e){var b=e.target.closest('button[data-p]');if(!b||b.disabled)return;var q=parseInt(b.getAttribute('data-p'),10);if(!isNaN(q)&&q>=1){pg=q;r();}});
    r();
})();
function amWiView(d){
    document.getElementById('vwi-title').textContent = d.workinstruction||'—';
    document.getElementById('vwi-ref').textContent = d.instructionref||'—';
    document.getElementById('vwi-emp').textContent = d.empId||'—';
    document.getElementById('vwi-date').textContent = d.issueDate ? new Date(d.issueDate).toLocaleDateString() : '—';
    document.getElementById('vwi-rev').textContent = d.revisionstatus||'—';
    document.getElementById('vwi-comp').textContent = d.CompiledBy||'—';
    document.getElementById('vwi-scope').textContent = d.scop||'—';
    var pointsEl = document.getElementById('vwi-points');
    pointsEl.innerHTML = '';
    for (var i=1; i<=12; i++) {
        var pt = d['point'+i];
        if (pt) { var li=document.createElement('li'); li.textContent = pt; pointsEl.appendChild(li); }
    }
    document.getElementById('viewWiModal').classList.add('open');
}
function amWiEdit(d){
    $("#ewi-id").val(d.id);
    ['workinstruction','instructionref','issueDate','revisionstatus','scop','CompiledBy'].forEach(function(k){ $("#editWiModal input[name='"+k+"']").val(d[k]||''); });
    $("#editWiModal select[name='empId']").val(d.empId||'');
    for (var i=1; i<=12; i++) { $("#editWiModal input[name='point"+i+"']").val(d['point'+i]||''); }
    document.getElementById('editWiModal').classList.add('open');
}
</script>
@endsection
