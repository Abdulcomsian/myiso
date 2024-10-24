
<div class="kt-input-icon kt-input-icon--right"  style="margin-top: 10px;">
    <select name="userid[]" id="langOpt3" class="form-control" multiple>
        @foreach ($users as $item)
            <option value="{{$item->id}}">{{$item->name}} </option>
        @endforeach
    </select>
</div>