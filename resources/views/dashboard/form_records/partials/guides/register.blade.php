{{-- The guide for this page. Shown behind the "i" beside the title, on
     the user's page and on the admin's copy of it, so the two always say
     the same thing. --}}
<div class="am-modal" id="amPageGuide" role="dialog" aria-modal="true">
    <div class="am-modal__box" style="max-width:600px;">
        <div class="am-modal__header">
            <span class="am-modal__icon am-page-guide-icon"><i class="fa fa-info-circle"></i></span>
            <div>
                <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.4px;color:var(--am-text-muted);font-weight:600;">{{ $module['guide']['eyebrow'] }}</div>
                <h4 class="am-modal__title" style="color:var(--am-primary);">{{ $module['guide']['title'] }}</h4>
            </div>
        </div>
        <div class="am-modal__body" style="color:var(--am-text);">
            @foreach ($module['guide']['sections'] as $gi => $gs)
                <h5 style="font-size:13px;font-weight:600;color:var(--am-primary);margin:0 0 6px;">{{ $gs['heading'] }}</h5>
                @foreach ($gs['body'] as $gp)
                    <p style="margin:0 0 16px;">{{ $gp }}</p>
                @endforeach
                @if ($loop->last && !empty($module['guide']['steps']))
                    <ul style="margin:0;padding-inline-start:18px;list-style:disc;color:var(--am-text);font-size:13.5px;line-height:1.5;">
                        @foreach ($module['guide']['steps'] as $gstep)
                            <li @if (!$loop->last) style="margin-bottom:6px;" @endif>{{ $gstep }}</li>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
        <div class="am-modal__footer">
            <button type="button" class="am-btn am-btn-outline am-modal-close">Close</button>
        </div>
    </div>
</div>
