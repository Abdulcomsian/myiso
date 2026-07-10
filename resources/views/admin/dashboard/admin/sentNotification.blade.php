@extends('admin.dashboard.layouts.app')

@section('content')
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    {{-- Page header --}}
    <div class="am-page-header">
        <div>
            <h2>Sent Messages</h2>
            <p>Every conversation you've sent — click one to view the full thread.</p>
        </div>
        <div>
            <a href="{{ url('/send_message') }}" class="am-btn am-btn-primary">
                <i class="fa fa-paper-plane"></i> Compose Message
            </a>
        </div>
    </div>

    {{-- Flash message --}}
    @if ($message = Session::get('success'))
        <div class="am-card" style="padding:14px 20px;margin-bottom:16px;color:#1a8a5c;background:rgba(38,194,129,0.08);">
            <i class="fa fa-check-circle"></i> {{ $message }}
        </div>
    @endif

    {{-- Sent card --}}
    <div class="am-card">
        <div class="am-card__toolbar">
            <form id="amSentSearchForm" class="am-search" style="flex:1;max-width:340px;margin:0;" onsubmit="return false;">
                <i class="fa fa-search"></i>
                <input type="text" id="amSentSearch" name="q" value="{{ $search ?? '' }}" placeholder="Search recipients…" autocomplete="off">
            </form>
            <div style="margin-left:auto;font-size:12.5px;color:var(--am-text-muted);">
                <strong>{{ number_format($totalConvos ?? 0) }}</strong> total conversation{{ ($totalConvos ?? 0) === 1 ? '' : 's' }}
            </div>
        </div>

        <div id="amSentContainer" style="position:relative;">
            @include('admin.dashboard.admin.partials.sent_list')
        </div>
    </div>

</div>

<script>
(function() {
    var baseUrl   = '{{ url("/sent_notification") }}';
    var container = document.getElementById('amSentContainer');
    var input     = document.getElementById('amSentSearch');

    function debounce(fn, wait) {
        var t;
        return function() {
            var ctx = this, args = arguments;
            clearTimeout(t);
            t = setTimeout(function(){ fn.apply(ctx, args); }, wait);
        };
    }

    function fetchPage(page) {
        var params = new URLSearchParams();
        if (input && input.value.trim() !== '') params.set('q', input.value.trim());
        if (page) params.set('page', page);

        container.style.opacity = '0.5';
        container.style.pointerEvents = 'none';

        fetch(baseUrl + '?' + params.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function(r){ return r.text(); })
            .then(function(html) {
                container.innerHTML = html;
                container.style.opacity = '';
                container.style.pointerEvents = '';
                window.history.replaceState({}, '', baseUrl + '?' + params.toString());
            })
            .catch(function(){
                container.style.opacity = '';
                container.style.pointerEvents = '';
            });
    }

    input && input.addEventListener('input', debounce(function(){ fetchPage(1); }, 350));
    container && container.addEventListener('click', function(e) {
        var btn = e.target.closest('.am-page-link');
        if (!btn || btn.disabled) return;
        e.preventDefault();
        var p = parseInt(btn.getAttribute('data-page'), 10);
        if (!isNaN(p) && p > 0) fetchPage(p);
    });
})();
</script>

@endsection
