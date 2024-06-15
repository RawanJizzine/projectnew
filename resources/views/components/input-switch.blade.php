@props([
    'id' => null,
    'name' => null,
    'class' => null,
    'type' => null,
    'size' => null,
    'label' => null,
    'switch_label' => null,
    'showicon' => false,
    'checked' => false,
    'disabled' => false,
    'class_validation' => null,
])

<div class="text-light small fw-medium mb-3">{{ $label }}</div>

<label class="switch {{ $class }} {{ $size !== null ? 'switch-' . $size : '' }}">
    <input name="{{ $name }}" type="{{ $type }}" class="switch-input {{ $class_validation }}"
        {{ $checked == 'true' ? 'checked' : '' }} {{ $disabled == 'true' ? 'disabled' : '' }} />
    <span class="switch-toggle-slider">
        <span class="switch-on">
            @if ($showicon == 'true')
                <i class="ti ti-check"></i>
            @endif
        </span>
        <span class="switch-off">
            @if ($showicon == 'true')
                <i class="ti ti-x"></i>
            @endif
        </span>
    </span>
    <span class="switch-label">{{ $switch_label }}</span>
</label>








<!--
type: checkbox or radio
class:
switch-square => for form switch square,
switch-primary => color purple
switch-secondary => color gray
switch-success => color green
switch-danger => color red
switch-warning => color yellow
switch-info => color blue
switch-dark => color black
size:
-lg,
-sm,
class_validation:
is-valid => color of switch is green
is-invalid => color of switch is green
showicon:
icon check and icon x (not check)
-->

{{--

1-switch-square-checkbox: <x-input-switch class="switch-square" switch_label="switch-square-checkbox"  type="checkbox" checked="true"  />
2-switch-normal-checkbox: <x-input-switch switch_label="switch-normal-checkbox"  type="checkbox"  checked="true" />
            
3-switch-normal-radio
<x-input-switch class="switch-success" switch_label="switch-normal-radio"  type="radio"  name="r1" checked="true"  />
<x-input-switch class="switch-success" switch_label="switch-normal-radio"  type="radio" name="r1"  />

4-switch with icon check:    <x-input-switch   showicon='true' switch_label="switch with icon check" type="checkbox" checked="true" />
5-switch is valid:   <x-input-switch   class_validation="is-valid" switch_label="switch is valid" type="checkbox" checked="true" /> (color green)
6-switch is invalid:   <x-input-switch   class_validation="is-invalid" switch_label="switch is invalid" type="checkbox" checked="true" /> (color red)
7-switch info example: <x-input-switch class="switch-square switch-info" switch_label="switch info example"  type="checkbox" checked="true"  />
8-switch with size :  <x-input-switch switch_label="switch-large"  type="checkbox"  checked="true" size="lg"/>              
--}}
