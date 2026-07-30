@extends('dashboard.layouts.app')

@section('content')
<div class="am-content">

    <div class="am-page-header">
        <div>
            <h2>Schedule Training</h2>
            <p>Select a day and time below to book your training session.</p>
        </div>
    </div>

    <div class="am-card">
        <div class="am-card__body" style="padding:32px;">
            <div class="calendly-inline-widget"
                 data-url="https://calendly.com/isoonline/30min?name={{ urlencode(Auth::check() ? Auth::user()->name : '') }}&email={{ urlencode(Auth::check() ? Auth::user()->email : '') }}"
                 style="min-width:320px; height:750px;"></div>
            <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
        </div>
    </div>

</div>
@endsection
