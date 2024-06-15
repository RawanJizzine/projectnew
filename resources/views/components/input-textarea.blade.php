@props([
    'id' => null,
    'name' => null,
    'label' => null,
    'placeholder'=>null,
    'class' => null,
    'disabled' => false,
    'readonly' => false,
    'rows' => null,
    'value' => null,
])
<label for="{{ $id }}" class="form-label">{{ $label }}</label>
<textarea    placeholder="{{$placeholder??''}}" class="form-control" id="{{ $id }}" name="{{ $name }}" rows="{{ $rows ?? 3 }}"
    @if ($disabled) disabled @endif @if ($readonly) readonly @endif>{{ $value }}
</textarea>
{{-- 
     <x-input-textarea placeholder="" id="r113"  label="Example textarea"  />
--}}
