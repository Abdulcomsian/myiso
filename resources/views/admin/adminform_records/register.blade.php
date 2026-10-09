@extends('admin.dashboard.layouts.app')

@section('content')
<div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content" style="padding:26px;">

    <div class="am-page-header">
        <div style="display:flex;align-items:center;gap:12px;">
            <button type="button" class="am-page-guide-btn"
                onclick="document.getElementById('amPageGuide').classList.add('open')"
                title="About {{ $module['title'] }}" aria-label="About {{ $module['title'] }}">
                <i class="fa fa-info-circle"></i>
            </button>
            <div>
                <h2>{{ $module['title'] }}</h2>
            </div>
        </div>
        <div>
            <a href="{{ url('/edit_user/'.$ownerId) }}" class="am-btn am-btn-outline">
                <i class="fa fa-arrow-left"></i> Back to Forms
            </a>
        </div>
    </div>

    {{-- Delete confirmation modal and modal close handlers come from the admin layout --}}
    @include('dashboard.form_records.partials.register_page')
</div>
{{-- The guide behind the "i" beside the title --}}
@include('dashboard.form_records.partials.guides.register')


<script>
// Closing a modal: the close button, the backdrop, or Escape - the same
// handler the rest of the pages use.
document.addEventListener('click', function(e) {
    var close = e.target.closest('.am-modal-close');
    if (close) { var m = close.closest('.am-modal'); if (m) m.classList.remove('open'); return; }
    if (e.target.classList && e.target.classList.contains('am-modal')) e.target.classList.remove('open');
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') document.querySelectorAll('.am-modal.open').forEach(function(m){ m.classList.remove('open'); });
});
</script>

@endsection
