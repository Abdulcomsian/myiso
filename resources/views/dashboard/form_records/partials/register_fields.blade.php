{{-- Form fields for a simple register. Params: $module, $mode ('add' | 'edit') --}}
@php $useOld = $mode === 'add' && old('_form') === 'add'; @endphp
<div class="am-register-grid">
    @foreach ($module['fields'] as $name => $field)
        @php
            $required = !empty($field['required']);
            $wide = !empty($field['wide']) || $field['type'] === 'textarea';
            $value = $useOld ? old($name) : '';
            $cls = $mode === 'edit' ? 'form-control' : '';
        @endphp
        <div class="{{ $wide ? 'wide' : '' }}">
            <label>{{ $field['label'] }}{{ $required ? ' *' : '' }}</label>
            @if ($field['type'] === 'textarea')
                <textarea name="{{ $name }}" class="{{ $cls }}" rows="3" maxlength="5000" placeholder="{{ $field['placeholder'] ?? '' }}" {{ $required ? 'required' : '' }}>{{ $value }}</textarea>
            @elseif ($field['type'] === 'select')
                <select name="{{ $name }}" class="{{ $cls }}" {{ $required ? 'required' : '' }}>
                    <option value="" disabled {{ $value ? '' : 'selected' }}>Select…</option>
                    @foreach ($field['options'] as $optValue => $optLabel)
                        <option value="{{ $optValue }}" {{ (string) $value === (string) $optValue ? 'selected' : '' }}>{{ $optLabel }}</option>
                    @endforeach
                </select>
            @elseif ($field['type'] === 'date')
                <input type="date" name="{{ $name }}" class="{{ $cls }}" max="2999-12-31" value="{{ $value }}" {{ $required ? 'required' : '' }}>
            @else
                <input type="text" name="{{ $name }}" class="{{ $cls }}" maxlength="255" placeholder="{{ $field['placeholder'] ?? '' }}" value="{{ $value }}" {{ $required ? 'required' : '' }}>
            @endif
        </div>
    @endforeach
</div>
