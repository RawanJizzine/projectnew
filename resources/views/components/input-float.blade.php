@props(['id' => null, 'name'=>null,'label'=>null,'placeholder'=>null,'disabled'=>false,'helper_text'=>null,'type'=>null,'value'=>null])
<div class="form-floating">
    <input type="{{ $type }}" class="form-control" id="{{ $id }}" name="{{ $name }}" placeholder="{{ $placeholder }}" aria-describedby="float_helper_text" />
    <label for="floatingInput">{{ $label }}</label>
    <div id="float_helper_text" class="form-text">
        {{ $helper_text }}
    </div>
</div>
{{--
 <x-input-float
            type="text"
            class="form-control"
            helper_text="We'll never share your details with anyone else."
            id="r1"
            label="Name"
            aria-describedby="floatingInputHelp" />
--}}