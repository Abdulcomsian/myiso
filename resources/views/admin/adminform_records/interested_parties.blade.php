@extends('admin.dashboard.layouts.app')

@section('content')
@php $urlparam = request()->route()->parameters; @endphp

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div>
            <h2>Interested Parties</h2>
            <p>Register of stakeholders whose needs &amp; expectations must be considered.</p>
        </div>
        <div>
            <a href="{{ url('/edit_user/'.$urlparam['id']) }}" class="am-btn am-btn-outline">
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
                ISO 9001:2015 Section 4.2 requires understanding the needs and expectations of interested parties.
                This register documents them — refer to Quality Manual §4.2.2 for definitions.
            </div>
        </div>
    </div>

    <div class="am-card" style="margin-bottom:16px;">
        <div class="am-card__toolbar">
            <div class="am-search" style="flex:1;max-width:340px;">
                <i class="fa fa-search"></i>
                <input type="text" id="amIpSearch" placeholder="Search interested parties…" autocomplete="off">
            </div>
            <button type="button" class="am-btn am-btn-primary" id="toggleIpForm">
                <i class="fa fa-plus"></i> Add Interested Party
            </button>
        </div>

        <div class="am-inline-form" id="newIpForm" style="margin:16px 20px;">
            <form action="{{ route('interestedform') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $urlparam['id'] }}">
                <div class="form-row">
                    <div><label>Interested Party</label><input type="text" name="interestedparty" placeholder="e.g. Customers, Suppliers, Employees" required></div>
                    <div><label>Needs &amp; Expectations</label><input type="text" name="needs" placeholder="e.g. On-time delivery" required></div>
                </div>
                <div class="form-actions">
                    <button type="button" class="am-btn am-btn-outline am-btn-sm" id="cancelIpForm">Cancel</button>
                    <button type="submit" class="am-btn am-btn-primary am-btn-sm"><i class="fa fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>

    <div class="am-card">
        <div class="am-table-wrap">
            <table class="am-table" id="amIpTable">
                <thead>
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Interested Party</th>
                        <th>Needs &amp; Expectations</th>
                        <th>Created</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($interested as $index => $data)
                        <tr data-search="{{ strtolower($data->interested_party . ' ' . $data->needs) }}">
                            <td><span class="am-cell-sub">#{{ $index + 1 }}</span></td>
                            <td><span class="am-cell-primary">{{ $data->interested_party }}</span></td>
                            <td>{{ $data->needs }}</td>
                            <td><span class="am-chip info">{{ date('d M Y', strtotime($data->created_at)) }}</span></td>
                            <td style="text-align:right;white-space:nowrap;">
                                <div class="am-actions">
                                    <button type="button" class="am-icon-btn" title="View" onclick='amIpView(@json($data))'><i class="fa fa-eye"></i></button>
                                    <button type="button" class="am-icon-btn" title="Edit" onclick='amIpEdit(@json($data))'><i class="fa fa-pen"></i></button>
                                    <button type="button" class="am-icon-btn danger am-confirm-delete"
                                            title="Delete"
                                            data-action="{{ route('deleteInterested') }}"
                                            data-id="{{ $data->id }}"
                                            data-label="{{ $data->interested_party }}"
                                            data-type="Interested Party">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5"><div class="am-empty"><i class="fa fa-users"></i><p>No interested parties added yet.</p></div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="am-pagination" id="amIpPagination"></div>
    </div>
</div>

{{-- View modal --}}
<div class="am-modal" id="amIpViewModal" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:560px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">Interested Party</h4>
        </div>
        <div class="am-modal__body">
            <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Interested Party</div>
            <div id="v-ip-party" style="font-size:14px;color:var(--am-text);margin-bottom:16px;"></div>
            <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;margin-bottom:4px;">Needs &amp; Expectations</div>
            <div id="v-ip-needs" style="font-size:14px;color:var(--am-text);"></div>
        </div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">Close</button></div>
    </div>
</div>

{{-- Edit modal --}}
<div class="am-modal" id="amIpEditModal" role="dialog" aria-modal="true">
    <div class="am-modal__box am-form" style="max-width:600px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-pen"></i></span>
            <h4 class="am-modal__title">Edit Interested Party</h4>
        </div>
        <form action="{{ route('interestedUpdate') }}" method="POST" style="display:contents;">
            @csrf
            <input type="hidden" name="user_id" value="{{ $urlparam['id'] }}">
            <input type="hidden" name="id" id="e-ip-id">
            <div class="am-modal__body" style="padding:22px;">
                <div class="form-group row"><div class="col-lg-12"><label>Interested Party</label><input type="text" class="form-control" name="interestedparty" id="e-ip-party" required></div></div>
                <div class="form-group row"><div class="col-lg-12"><label>Needs &amp; Expectations</label><input type="text" class="form-control" name="needs" id="e-ip-needs" required></div></div>
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
    var t=document.getElementById('toggleIpForm'),f=document.getElementById('newIpForm'),c=document.getElementById('cancelIpForm');
    t&&t.addEventListener('click',function(){f.classList.toggle('open');});
    c&&c.addEventListener('click',function(){f.classList.remove('open');});
    function debounce(fn,w){var t;return function(){var c=this,a=arguments;clearTimeout(t);t=setTimeout(function(){fn.apply(c,a);},w);};}
    var per=10,i=document.getElementById('amIpSearch'),tb=document.querySelector('#amIpTable tbody');
    if(!tb)return;
    var rows=Array.prototype.slice.call(tb.querySelectorAll('tr[data-search]')),p=document.getElementById('amIpPagination'),F=rows.slice(),pg=1;
    function r(){var T=F.length,TP=Math.max(1,Math.ceil(T/per));if(pg>TP)pg=TP;rows.forEach(function(x){x.style.display='none';});F.slice((pg-1)*per,pg*per).forEach(function(x){x.style.display='';});var fr=T===0?0:(pg-1)*per+1,to=Math.min(pg*per,T);var h='<div class="am-pagination__info">Showing <strong>'+fr+'–'+to+'</strong> of <strong>'+T+'</strong></div><div class="am-pagination__nav">';h+='<button data-p="'+(pg-1)+'" '+(pg<=1?'disabled':'')+'>‹</button>';var s=Math.max(1,pg-2),e=Math.min(TP,s+4);s=Math.max(1,e-4);for(var q=s;q<=e;q++)h+='<button data-p="'+q+'" '+(q===pg?'class="active"':'')+'>'+q+'</button>';h+='<button data-p="'+(pg+1)+'" '+(pg>=TP?'disabled':'')+'>›</button></div>';p.innerHTML=h;}
    i&&i.addEventListener('input',debounce(function(){var q=this.value.trim().toLowerCase();F=q===''?rows.slice():rows.filter(function(x){return x.getAttribute('data-search').indexOf(q)!==-1;});pg=1;r();},250));
    p&&p.addEventListener('click',function(e){var b=e.target.closest('button[data-p]');if(!b||b.disabled)return;var q=parseInt(b.getAttribute('data-p'),10);if(!isNaN(q)&&q>=1){pg=q;r();}});
    r();
})();
function amIpView(d){document.getElementById('v-ip-party').textContent=d.interested_party||'—';document.getElementById('v-ip-needs').textContent=d.needs||'—';document.getElementById('amIpViewModal').classList.add('open');}
function amIpEdit(d){document.getElementById('e-ip-id').value=d.id||'';document.getElementById('e-ip-party').value=d.interested_party||'';document.getElementById('e-ip-needs').value=d.needs||'';document.getElementById('amIpEditModal').classList.add('open');}
</script>
@endsection
