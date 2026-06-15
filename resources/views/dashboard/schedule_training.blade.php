@extends('dashboard.layouts.app')

@section('content')
<style>
	section#schedule_training_section { padding: 30px 20px; background: #FFF !important; }
	.calendly-inline-widget { min-width: 320px; height: 750px; }
</style>

<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
	<div class="row">
		<div class="col-xl-12 col-lg-12">
			<h2>Schedule Training</h2>
			<p>Select a day and time below to book your training session.</p>
		</div>
	</div>

	<section id="schedule_training_section" class="mt-3">
		<div class="container">
			<div class="calendly-inline-widget"
				 data-url="https://calendly.com/jamie-isoonline/30min?name={{ urlencode(Auth::check() ? Auth::user()->name : '') }}&email={{ urlencode(Auth::check() ? Auth::user()->email : '') }}"></div>
			<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
		</div>
	</section>
</div>
@endsection
