@props([
    'id' => null,
    'label' => null,
    'options' => [],
    'multiple' => 'false',
    'type' => null,
    'disabled' => 'false',
    'selected_key' => null,
    'class_color' => null,
])

@php
    $options = $options ? json_decode(htmlspecialchars_decode($options), true) : [];
@endphp
@switch($type)
    @case('option_group')
        <div class="{{ $class_color }}">
            <label for="{{ $id }}" class="form-label">{{ $label }}</label>
            <select id="{{ $id }}" class="form-select select2">
                @foreach ($options as $group)
                    <optgroup label="{{ $group['label'] }}">
                        @foreach ($group['options'] as $option)
                            <option value="{{ $option['key'] }}" @if ($option['key'] == $selected_key) selected @endif>
                                {{ $option['value'] }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>
    @break

    @case('option_group_icons')
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
        <select id="{{ $id }}" class="select2-icons form-select">
            @foreach ($options as $group)
                <optgroup label="{{ $group['label'] }}">
                    @foreach ($group['options'] as $option)
                        <option value="{{ $option['key'] }}" data-icon="{{ $option['icon'] }}"
                            @if ($option['key'] == $selected_key) selected @endif>
                            {{ $option['value'] }}
                        </option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>
    @break

    @case('option_icons')
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>

        <select {{ $multiple == 'true' ? 'multiple' : '' }} {{ $disabled == 'true' ? 'disabled' : '' }} id="{{ $id }}"
            class="select2-icons form-select" data-allow-clear="true">
            @foreach ($options as $option)
                <option {{ $option['key'] == $selected_key ? 'selected' : '' }} value="{{ $option['key'] }}"
                    data-icon="{{ $option['icon'] }}">{{ $option['value'] }}</option>
            @endforeach
        </select>
    @break

    @default
        <div class="{{ $class_color }}">

            <label for="{{ $id }}" class="form-label">{{ $label }}</label>
            <select id="{{ $id }}" {{ $multiple == 'true' ? 'multiple' : '' }}
                {{ $disabled == 'true' ? 'disabled' : '' }} class="select2 form-select form-select-lg" data-allow-clear="true">
                @foreach ($options as $option)
                    <option {{ $option['key'] == $selected_key ? 'selected' : '' }} value="{{ $option['key'] }}">
                        {{ $option['value'] }}</option>
                @endforeach
            </select>
        </div>
@endswitch

{{--
  <<
 $class_color: this active only when  $type='option_group' and on default cas
 Colors: 
    select2-primary (purple)
    select2-success (green)
    select2-info (blue)
    select2-warning (yellow)
    select2-danger (red)
    select2-dark (black)

  >>
  <<
  on default cas : when we have normal select 
  how use ? 
  $array6 = [
        [
            'key' => 1,
            'value' => 'home1',
        ],
        [
            'key' => 2,
            'value' => 'home2',
        ],
        [
            'key' => 3,
            'value' => 'home3',
        ],
        
    ];
  1. here, the $id must be select2Basic
  <x-input-select id="select2Basic"    options="{{ json_encode($array6) }}"  />
  2. with multiple select 
  <x-input-select id="anyid" multiple="true"   options="{{ json_encode($array6) }}"  />
  >> 
  
  
  
  <<
  $type="option_group"
  in this ,if we need select with group option
  how use?
  $array7 = [
        [
            'label' => 'Options',
            'options' => [
                [
                    'key' => 1,
                    'value' => 'option1',
                    
                ],
                [
                    'key' => 2,
                    'value' => 'option2',
                    
                ],
                [
                    'key' => 3,
                    'value' => 'option3',
                    
                ],
            ],
        ],
        [
            'label' => 'Item',
            'options' => [
                [
                    'key' => 4,
                    'value' => 'Item1',
                   
                ],
                [
                    'key' => 5,
                    'value' => 'Item2',
                    
                ],
                [
                    'key' => 6,
                    'value' => 'Item3',
                    
                ],
            ],
        ],
    ];
  <x-input-select id="select2Basic"    options="{{ json_encode($array7) }}"  />
  
  >> 
  <<
  $type="option_group_icons"
  in this ,if we need select with group option and icons
  $array8 = [
        [
            'label' => 'Options',
            'options' => [
                [
                    'key' => 1,
                    'value' => 'option1',
                    'icon' => 'ti ti-brand-bootstrap',
                ],
                [
                    'key' => 2,
                    'value' => 'option2',
                    'icon' => 'ti ti-brand-bootstrap',
                ],
                [
                    'key' => 3,
                    'value' => 'option3',
                    'icon' => 'ti ti-brand-bootstrap',
                ],
            ],
        ],
        [
            'label' => 'Item',
            'options' => [
                [
                    'key' => 4,
                    'value' => 'Item1',
                    'icon' => 'ti ti-brand-bootstrap',
                ],
                [
                    'key' => 5,
                    'value' => 'Item2',
                    'icon' => 'ti ti-brand-bootstrap',
                ],
                [
                    'key' => 6,
                    'value' => 'Item3',
                    'icon' => 'ti ti-brand-bootstrap',
                ],
            ],
        ],
    ];
  <x-input-select id="select2Basic"    options="{{ json_encode($array8) }}"  />
  >>

  <<
  $type="option_icons"
  in this if we need select with icons,without group option 
  how use?
  $array10= [
        
        [
            'key' => 1,
            'value' => 'home',
            'icon'=>'ti ti-brand-bootstrap'
        ],
        [
            'key' => 2,
            'value' => 'home',
            'icon'=>'ti ti-brand-bootstrap'
        ],
        [
            'key' => 3,
            'value' => 'home',
            'icon'=>'ti ti-brand-bootstrap'
        ],
    
            ];

          <x-input-select id="LOLO" type="option_icons" options="{{ json_encode($array10) }}" selected_key='1' />
   
  >>  
    
--}}
