{{-- The details popup and the delete confirmation, shared by the user page and
     the admin page so neither can drift. --}}
@php $L = App\MgtReviewQuestions::labels(); @endphp

<div class="am-modal" id="DetailModal" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:900px;">
        <div class="am-modal__header">
            <span class="am-modal__icon" style="background:var(--am-primary-tint);color:var(--am-primary);"><i class="fa fa-eye"></i></span>
            <h4 class="am-modal__title">{{ $L['details_title'] }}</h4>
        </div>
        <div class="am-modal__body" id="amMgtViewBody"></div>
        <div class="am-modal__footer"><button type="button" class="am-btn am-btn-outline am-modal-close">{{ $L['close'] }}</button></div>
    </div>
</div>

<div class="am-modal" id="amConfirmDelete" role="dialog" aria-modal="true">
    <div class="am-modal__box">
        <div class="am-modal__header">
            <span class="am-modal__icon"><i class="fa fa-exclamation-triangle"></i></span>
            <h4 class="am-modal__title">{!! $L['confirm_title'] !!}</h4>
        </div>
        <div class="am-modal__body">
            {!! $L['confirm_body'] !!}
        </div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline am-modal-close">{{ $L['cancel'] }}</button>
            <form id="amConfirmForm" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="id" id="amConfirmId">
                <button type="submit" class="am-btn" style="background:var(--am-danger);color:#fff;">
                    <i class="fa fa-trash"></i> {{ $L['confirm_yes'] }}
                </button>
            </form>
        </div>
    </div>
</div>
