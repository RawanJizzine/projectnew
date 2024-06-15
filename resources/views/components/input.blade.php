@props([
    'id' => null,
    'name' => null,
    'type' => null,
    'value' => null,
    'label' => null,
    'helper_text' => null,
    'class' => null,
    'size' => 'md',
    'placeholder' => null,
    'disabled' => false,
    'readonly' => false,
    'list' => null,
    'datalist_id' => null,
    'options' => [],
    'multiple' => 'false',
    'step' => null,
    'min' => null,
    'max' => null,
    'email_span' => false,
])

<label for="{{ $name }}" class="form-label">{{ $label }}</label>

@if (!$email_span)
    @if ($type == 'datalist')
        @php
            $options = $options ? json_decode(htmlspecialchars_decode($options), true) : [];
        @endphp

        @if (count($options) > 0)
            <input class="form-control" list="datalistOptions" id="{{ $id }}" placeholder="{{ $placeholder }}" />
            <datalist id="{{ $datalist_id }}">
                @foreach ($options as $option)
                    <option value="{{ $option['key'] }}">{{ $option['value'] }}</option>
                @endforeach
            </datalist>

        @endif
    @else
        <input
            @if ($type == 'range') step="{{ $step ?? '' }}" min="{{ $min ?? '' }}" max="{{ $max ?? '' }}" @endif
            {{ $type == 'file' && $multiple == 'true' ? 'multiple' : '' }} list="{{ $datalist_id }}"
            {{ $readonly == 'true' ? 'readonly' : '' }} {{ $disabled == 'true' ? 'disabled' : '' }}
            type="{{ $type ?? 'text' }}"
            class="@if ($type != 'range') form-control form-control-{{ $size }} @else form-range @endif {{ $class }}"
            id="{{ $id }}" placeholder="{{ $placeholder }}" aria-describedby="helper_text"
            value="{{ $value }}"  name="{{$name}}"/>

        <div id="helper_text" class="form-text">
            {{ $helper_text }}
        </div>
    @endif
@else
    <div class="input-group input-group-merge">
        <input class="form-control" type="text" id="{{ $id }}" name="{{ $name }}"
            placeholder="{{ $placeholder }}" />
        <span class="input-group-text" id="email3">@example.com</span>
    </div>
@endif
{{-- types: text, password, email, number, date, time, datetime-local, month, week, url, search, tel, color, file, range, hidden --}}
{{-- size:lg or sm  or md --}}
{{-- $email_span: if we need display @example.com in  the side right of input email     --}}
{{--
            <x-input  placeholder="John Doe" id="r1"  type="text" label="Default" />
            <x-input  placeholder="John Doe" id="r2"  type="email" label="Email" />
            <x-input  placeholder="John Doe" id="r21"   label="Email with Span" email_span="true" />
            <x-input  placeholder="John Doe" id="r3"  readonly="true" type="text" label="Readonly" />
            <x-input  placeholder="JohnDoe@gmail.com" id="r4"  readonly="true" type="text" label="Read plain" class="form-control-plaintext"/>
            <x-input  placeholder="John Doe" id="r5"  readonly="true" type="text" label="Readonly" />
            <x-input type="range" class="form-range" id="r6" label="Range" min="0" max="5" step="0.5" />
            <x-input type="range" class="form-range" id="r7" label="Disable Range" min="0" max="5" step="0.5" disabled="true" />
            <x-input  placeholder="John Doe" id="r8"  type="number" label="Number" />     
            <x-input  placeholder="John Doe" id="r9"  type="phone" label="Phone" />
            <x-input  placeholder="John Doe" id="r10"  type="password" label="Password" />
            <x-input  placeholder="John Doe" id="r11"  type="week" label="Week" />
            <x-input  placeholder="John Doe" id="r12"  type="month" label="Month" />
            <x-input  placeholder="John Doe" id="r13"  type="date" label="Date" />
            <x-input  placeholder="John Doe" id="r14"  type="time" label="Time" />
            <x-input  placeholder="John Doe" id="r15"  type="color" label="Color" />
            <x-input  placeholder="John Doe" id="r1"  type="search" label="Search" />
            <x-input  placeholder="" id="r111"  type="file" label="Default file input example" />
            <x-input  placeholder="" id="r111"  type="file" label="Multiple files input example" />
            
datalist how use?
            <x-input datalist_id="datalistOptions" id="r111" label="Data List Options Input" list="datalistOptions" type="datalist"
            :options="json_encode($array11)"    placeholder="Type to search..." />
$array11 = [
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

--}}
