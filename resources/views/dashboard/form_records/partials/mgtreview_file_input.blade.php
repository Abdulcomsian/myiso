{{-- The file field on a Management Review, with the hint beside it.

     $id        unique per copy of the form
     $name      the field name
     $accept    the extensions the form asks for
     $hint      the line of help beside it
     $multiple  true for the meeting files, which take several at once
     $label     optional heading above it, e.g. Attach Supporting Evidence
     $note      optional grey words after that heading
--}}
@if (!empty($label))
    <label>{{ $label }}@if (!empty($note)) <span style="color:var(--am-text-soft);font-weight:500;text-transform:none;letter-spacing:0;">{{ $note }}</span>@endif</label>
@endif
<div class="mr-attach">
    <input type="file" id="{{ $id }}" name="{{ $name }}" accept="{{ $accept }}" {{ !empty($multiple) ? 'multiple' : '' }}>
    <span class="mr-attach__hint">{{ $hint }}</span>
</div>
