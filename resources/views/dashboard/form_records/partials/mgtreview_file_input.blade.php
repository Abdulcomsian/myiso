{{-- The file field on a Management Review, with the hint beside it.

     $id        unique per copy of the form
     $name      the field name
     $accept    the extensions the form asks for
     $hint      the line of help beside it
     $multiple  true for the meeting files, which take several at once
--}}
<div class="mr-attach">
    <input type="file" id="{{ $id }}" name="{{ $name }}" accept="{{ $accept }}" {{ !empty($multiple) ? 'multiple' : '' }}>
    <span class="mr-attach__hint">{{ $hint }}</span>
</div>
