@props([
    'class' => null,
    'active' => false,
    'class_header' => null,
    'with_icon' => false,
    'id' => null,
    'icon' => null,
    'title' => null,
    'type' => null,
    'id_repeater_section' => null,
    'id_header' => null,
])
<div class="accordion mt-3 {{ $class }}">

    <!-- Payment Method -->


    @switch($type)
        @case('accordion_repeater')
            <div id="{{ $id_repeater_section }}" class="accordion-item">
                <h2 class="accordion-header" id="repeaterFormHeader">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $id }}"
                        aria-expanded="true" aria-controls="{{ $id }}">
                        {{ $title }}
                    </button>
                </h2>
                <div id="{{ $id }}" class="accordion-collapse collapse" aria-labelledby="repeaterFormHeader" data-bs-parent="#{{$id_header}}">
                    <div class="accordion-body">
                        {{ $body }}
                    </div>
                </div>
            </div>
        @break

        @default
            <div class="card accordion-item   {{ $active == 'true' ? 'active' : '' }}       ">
                <h2 class="accordion-header {{ $class_header }} ">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#{{ $id }}" aria-expanded="false">
                        @if ($with_icon == 'true')
                            <i class="{{ $icon }} mx-1"></i>
                        @endif
                        {{ $title }}
                    </button>
                </h2>
                <div id="{{ $id }}" class="accordion-collapse collapse" aria-labelledby="headingPaymentMethod"
                    data-bs-parent="#collapsibleSection">
                    <form>
                        <div class="accordion-body">
                            {{ $body }}
                        </div>
                    </form>
                </div>
            </div>
    @endswitch




</div>
{{--
accordion without arrow:
$class => accordion-without-arrow
$class_header => text-body d-flex justify-content-between

accordion With border:
$class => accordion-bordered

accordion with icon:
$class_header => d-flex align-items-center
$with_icon => must be true to display the icon 
$icon => for put icon 
--}}
{{-- 
   how use ? 
    <x-accordion id="by" with_icon="true" icon="ti ti-home" >
    
    <x-slot name="label">
     Item 1
    </x-slot>
    <x-slot name="body">
        <x-input  email_span="true"  />
  
    </x-slot>
    
</x-accordion>   
<x-accordion id="hi"  >
    <x-slot name="title">
        
    </x-slot>
    <x-slot name="label">
        Item 2
    </x-slot>
    <x-slot name="body">
        //here put any content we need 
        <x-input-checkbox-radio  type="radio" name="item1" label="value1" />
        <x-input-checkbox-radio  type="radio" name="item1" label="value2" />
        <x-input-checkbox-radio  type="radio" name="item1" label="value3" />
  
  
    </x-slot>
    
</x-accordion>   



form repeater accordion must icrease 
-'type' => null,
-'id_repeater_section'=>null,
-'id_header'=>null,
$("#id_header .accordion-button").attr("data-bs-target", "#id_repeater_section").click();

 <x-accordion id="must be put any id needed" id_repeater_section="repeaterFormSection" id_header="featdata" type="accordion_repeater">  
    --}}
