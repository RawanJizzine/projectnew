@props([
    'checked' => false,
    'name' => null,
    'disabled' => false,
    'id' => null,
    'type' => null,
    'class' => null,
    'readonly' => false,
    'label' => null,
    'form' => null,
    'radiooptions' => [],
    'alt' => null,
    'datalabel'=>null,
    'others'=>null,
])

@switch($form)
    @case('checkbox-radio-basic')
        <h5 class="my-4">{{ $label }}</h5>
        <div class="row ">
            <?php
            $count = 0; ?>
            @foreach ($radiooptions as $option)
                @if ($count == 0)
                    <div class="col-md mb-md-0 mb-2">
                    @else
                        <div class="col-md">
                @endif


                <div class="form-check custom-option custom-option-basic">
                    <label class="form-check-label custom-option-content" for="{{ $option['id'] }}">

                        <input name="{{ $option['name'] }}" class="form-check-input" type="{{ $type }}" value="1"
                            id="{{ $option['id'] }}" {{ $option['checked'] == 'true' ? 'checked' : '' }} />

                        <span class="custom-option-header">
                            <span class="h6 mb-0">{{ $option['first_span'] }}</span>
                            <span class="text-muted">{{ $option['second_span'] }}</span>
                        </span>
                        <span class="custom-option-body">
                            <small>{{ $option['description'] }} </small>
                        </span>

                    </label>
                </div>
        </div>
        <?php $count++; ?>
        @endforeach
        </div>
    @break

    @case('checkbox-radio-icon')
        <h5 class="my-4">{{ $label }}</h5>
        <div class="row ">

            @foreach ($radiooptions as $option)
                <div class="col-md mb-md-0 mb-2">

                    <div class="form-check custom-option custom-option-icon">
                        <label class="form-check-label custom-option-content" for="{{ $option['id'] }}">

                            <span class="custom-option-body">
                                <i class="{{ $option['icon'] }}"></i>
                                <span class="custom-option-title">{{ $option['title'] }}</span>
                                <small>{{ $option['description'] }}</small>
                            </span>

                            <input name="{{ $option['name'] }}" class="form-check-input" type="{{ $type }}"
                                value="1" id="{{ $option['id'] }}" {{ $option['checked'] == 'true' ? 'checked' : '' }} />

                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    @break

    @case('checkbox-radio-image')
        <h5 class="my-4">{{ $label }}</h5>
        <div class="card-body">
            <div class="row">
                @foreach ($radiooptions as $option)
                    <div class="col-md mb-md-0 mb-2 ">

                        <div class="form-check custom-option custom-option-image {{ $class }}">
                            <label class="form-check-label custom-option-content" for="{{ $option['id'] }}">
                                <span class="custom-option-body">
                                    <img src="{{ $option['src'] }}" alt="{{ $alt }}" />
                                </span>
                            </label>
                            <input name="{{ $option['name'] }}" class="form-check-input" type="{{ $type }}"
                                value="{{ $option['value'] }}" id="{{ $option['id'] }}"
                                {{ $option['checked'] == 'true' ? 'checked' : '' }} />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @break

    @default
   
        <input class="form-check-input {{ $class }}" type="{{ $type }}"
            @if ($disabled == 'true') disabled @endif @if ($readonly == 'true') readonly @endif
            @if ($checked == 'true') checked @endif name="{{ $name }}" id="{{ $id }}" data-label="{{$datalabel}}"  @if($others == 'checked') checked @endif     />
        <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
@endswitch
{{-- Colors: 
    form-check form-check-primary (purple)
    form-check form-check-secondary (gray)
    form-check form-check-success (green)
    form-check form-check-info (blue)
    form-check form-check-warning (yellow)
    form-check form-check-danger (red)
    form-check form-check-light (white)
    form-check form-check-dark (black)
    / --}}
{{--
   type: checkbox or radio 
   --}}
{{--
   form:  
   ===>  checkbox-radio-icon
<<
(if we need radio or checkbox with icon and text in small card) 
how use?  
$array3 = [
        [
            'id' => 'customRadioIcon1',
            'name' => 'customDeliveryRadioIcon',
            'icon' => 'ti ti-briefcase',
            'title' => 'Standard',
            'description' => 'Delivery in 3-5 days.',
            'value' => '',
            'checked' => 'false',
        ],
        [
            'id' => 'customRadioIcon2',
            'name' => 'customDeliveryRadioIcon',
            'icon' => 'ti ti-send',
            'title' => 'Express',
            'description' => 'Delivery within 2 days.',
            'value' => '',
            'checked' => 'false',

        ],
        [
            'id' => 'customRadioIcon3',
            'name' => 'customDeliveryRadioIcon',
            'icon' => 'ti ti-crown',
            'title' => 'Overnight',
            'description' => 'Delivery within a day.',
            'value' => '',
            'checked' => 'false',

        ],
];
<x-input-checkbox-radio :radiooptions="$array3" form="checkbox-radio-icon"  type="checkbox"/>
$array4 = [
        [
            'id' => 'customRadio1',
            'name' => 'customDeliveryRadioIcon',
            'icon' => 'ti ti-rocket',
            'title' => 'Standard',
            'description' => 'Cake sugar plum fruitcake I love sweet roll jelly-o.',
            'value' => '',
            'checked' => 'false',
        ],
        [
            'id' => 'customRadio2',
            'name' => 'customDeliveryRadioIcon',
            'icon' => 'ti ti-rocket',
            'title' => 'Express',
            'description' => 'Cake sugar plum fruitcake I love sweet roll jelly-o..',
            'value' => '',
            'checked' => 'false',

        ],
        
];
 <x-input-checkbox-radio :radiooptions="$array4" form="checkbox-radio-icon"  type="radio"/>
>>



<<
(if we need discount,free,$,..any text  with description in card , radio or checkbox )
how use?
$array1=  [
        [
            'id' => 'aa',
            'name' => 'ss',
            'first_span'=>'Updates',
            'second_span' => 'Free',
            'description' => 'Get Updates regarding related products',
            'value' => '',
            'checked'=>'true',
        ],
    
        [
            'id' => '1',
            'name' => 'ss',
            'first_span'=>'Discount',
            'second_span' => '20%',
            'description' => 'Get Updates regarding related products',
            'value' => '',
            'checked'=>'false',
        ],

];
   <x-input-checkbox-radio :radiooptions="$array1" form="checkbox-radio-basic"  type="radio"/>

$array2=  [
        [
            'id' => 'ee',
            'name' => 'zz',
            'first_span'=>'Updates',
            'second_span' => 'Free',
            'description' => 'Get Updates regarding related products',
            'value' => '',
            'checked'=>'true',
        ],
    
        [
            'id' => 'ef',
            'name' => 's',
            'first_span'=>'Discount',
            'second_span' => '20%',
            'description' => 'Get Updates regarding related products',
            'value' => '',
            'checked'=>'false',
        ],

];
   <x-input-checkbox-radio :radiooptions="$array2" form="checkbox-radio-basic"  type="checkbox"/>
>>

<<
(if we need image as  radio or checkbox )
$class : 
- custom-option-image-radio  (for radio)
- custom-option-image-check (for checkbox)
$alt:
- cbImg (for checkbox)
- radioImg (for radio)
how use?
$array5 = [
    [
        'name'=>'customRadioImage',
        'src' => '../../assets/img/backgrounds/speaker.png',
        'value' => '',
        'id' => 'customRadioImg1',
        'checked' => true,
    ],
    [
        'name'=>'customRadioImage',
        'src' => '../../assets/img/backgrounds/airpods.png',
        'value' => '',
        'id' => 'customRadioImg2',
        'checked' => false,
    ],
    [
        'name'=>'customRadioImage',
        'src' => '../../assets/img/backgrounds/headphones.png',
        'value' => '',
        'id' => 'customRadioImg3',
        'checked' => false,
    ],
];
<x-input-checkbox-radio :radiooptions="$array5" form="checkbox-radio-image" class="custom-option-image-check" alt="cbImg" type="checkbox"/>
<x-input-checkbox-radio :radiooptions="$array5" form="checkbox-radio-image" class="custom-option-image-radio" alt="radioImg" type="radio"/>
>>


   
<<
===>  default,without form (normal radio or checkbox )
  Default Radio  :  
   <x-input-checkbox-radio  type="radio" name="item1" label="value1" />
   <x-input-checkbox-radio  type="radio" name="item1" label="value2" />
   <x-input-checkbox-radio  type="radio" name="item1" label="value3" />


   Default Checkbox :
    <x-input-checkbox-radio  type="checkbox" name="item1" label="value1" />
    <x-input-checkbox-radio  type="checkbox" name="item1" label="value2" />
    <x-input-checkbox-radio  type="checkbox" name="item1" label="value3" />
  
  
>>

   --}}
