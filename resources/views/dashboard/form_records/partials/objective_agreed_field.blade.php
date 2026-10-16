{{-- Where the objective was agreed: at a Management Review, or on a date of
     its own when the meeting was not a recorded review.

     $cls  the class the surrounding form expects on its controls
     $uid  'add' or 'edit', so the two copies on one page keep separate ids

     The date sits in an unclassed wrapper on purpose. "hidden" is beaten by
     .form-control's display:block, so putting it on the input would leave the
     field showing; on a plain div it wins. --}}
<label>Agreed at</label>
<select name="agreed_at" data-obj-agreed id="objAgreed{{ $uid ?? 'add' }}" class="{{ $cls ?? '' }}">
    <option value="">Choose Management Review…</option>
    @foreach ($reviews ?? [] as $rev)
        <option value="{{ $rev->id }}">{{ $rev->reviewLabel() }}</option>
    @endforeach
    <option value="custom">Custom date…</option>
</select>
<div data-obj-agreed-custom hidden style="margin-top:6px;">
    <input type="date" max="{{ date('Y-m-d') }}" name="agreed_on" class="{{ $cls ?? '' }}">
</div>
