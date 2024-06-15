@props([
    'title' => null,
    'includ_icon' => false,
    'tabs' => [],
    'type' => null,
])

@switch($type)
    @case('basic')
        <div class="col-xl-6">
            <div class="nav-align-top nav-tabs-shadow mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    @foreach ($tabs as $index => $tab)
                        <li class="nav-item">
                            <button type="button" class="nav-link {{ $index === 0 ? 'active' : '' }}" role="tab"
                                data-bs-toggle="tab" {{-- Add data-bs-toggle attribute --}}
                                data-bs-target="#navs-top-{{ strtolower($tab['label']) }}"
                                aria-controls="navs-top-{{ strtolower($tab['label']) }}"
                                aria-selected="{{ $index === 0 ? 'true' : 'false' }}">

                                @if ($includ_icon == 'true')
                                    <i class="{{ $tab['icon_class'] }}"></i> {{-- Include icon --}}
                                @endif

                                {{ $tab['label'] }}
                                @if (optional($tab)['rounded-pill'] !== null)
                                    <span
                                        class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1">{{ $tab['rounded-pill'] }}</span>
                                    {{-- Include icon --}}
                                @endif
                            </button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach ($tabs as $index => $tab)
                        <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                            id="navs-top-{{ strtolower($tab['label']) }}" role="tabpanel">
                            @foreach (optional($tab)['components'] ?? [] as $item)
                                @switch(optional($item)['component-file'])
                                    @case('input-select')
                                        <x-input-select id="{{ optional($item)['id'] }}" type="{{ optional($item)['type'] }}"
                                            options="{{ json_encode(optional($item)['option']) }}"
                                            label="{{ optional($item)['label'] }}" multiple="{{ optional($item)['multiple'] }}"
                                            disabled="{{ optional($item)['disabled'] }}"
                                            selected_key="{{ optional($item)['selected_key'] }}"
                                            class_color="{{ optional($item)['class_color'] }}" />
                                    @break

                                    @case('input-float')
                                        <x-input-float id="{{ optional($item)['id'] }}" name="{{ optional($item)['name'] }}"
                                            label="{{ optional($item)['label'] }}" placeholder="{{ optional($item)['placeholder'] }}"
                                            disabled="{{ optional($item)['disabled'] }}"
                                            helper_text="{{ optional($item)['helper_text'] }}" type="{{ optional($item)['type'] }}"
                                            value="{{ optional($item)['value'] }}" />
                                    @break

                                    @case('input-switch')
                                        <x-input-switch id="{{ optional($item)['id'] }}" name="{{ optional($item)['name'] }}"
                                            class="{{ optional($item)['class'] }}" type="{{ optional($item)['type'] }}"
                                            label="{{ optional($item)['label'] }}"
                                            switch_label="{{ optional($item)['switch_label'] }}"
                                            showicon="{{ optional($item)['showicon'] }}" checked="{{ optional($item)['checked'] }}"
                                            disabled="{{ optional($item)['disabled'] }}" size="{{ optional($item)['size'] }}"
                                            class_validation="{{ optional($item)['class_validation'] }}" />
                                    @break

                                    @case('input-tags')
                                        <x-input-tags id="{{ optional($item)['id'] }}" name="{{ optional($item)['name'] }}"
                                            class="{{ optional($item)['class'] }}" placeholder="{{ optional($item)['placeholder'] }}"
                                            readonly="{{ optional($item)['readonly'] }}" value="{{ optional($item)['value'] }}"
                                            label="{{ optional($item)['label'] }}" />
                                    @break

                                    @case('input-textarea')
                                        <x-input-textarea id="{{ optional($item)['id'] }}" name="{{ optional($item)['name'] }}"
                                            class="{{ optional($item)['class'] }}" disabled="{{ optional($item)['disabled'] }}"
                                            readonly="{{ optional($item)['readonly'] }}" value="{{ optional($item)['value'] }}"
                                            row="{{ optional($item)['row'] }}" />
                                    @break

                                    @case('input-checkbox-radio')
                                        <x-input-checkbox-radio id="{{ optional($item)['id'] }}" name="{{ optional($item)['name'] }}"
                                            class="{{ optional($item)['class'] }}" type="{{ optional($item)['type'] }}"
                                            label="{{ optional($item)['label'] }}" checked="{{ optional($item)['checked'] }}"
                                            disabled="{{ optional($item)['disabled'] }}" readonly="{{ optional($item)['readonly'] }}"
                                            value="{{ optional($item)['value'] }}" />
                                    @break

                                    @case('input')
                                        <x-input id="{{ optional($item)['id'] }}" name="{{ optional($item)['name'] }}"
                                            label="{{ optional($item)['label'] }}" placeholder="{{ optional($item)['placeholder'] }}"
                                            helper_text="{{ optional($item)['helper_text'] }}" type="{{ optional($item)['type'] }}"
                                            value="{{ optional($item)['value'] }}" class="{{ optional($item)['class'] }}"
                                            disabled="{{ optional($item)['disabled'] }}" readonly="{{ optional($item)['readonly'] }}"
                                            options="{{ json_encode(optional($item)['option']) }}"
                                            multiple="{{ optional($item)['multiple'] }}" size="{{ optional($item)['size'] }}"
                                            min="{{ optional($item)['min'] }}" max="{{ optional($item)['max'] }}"
                                            step="{{ optional($item)['step'] }}" />
                                    @break

                                    @default
                                        <h4 class="text-muted">{{ optional($item)['title'] }}</h4>
                                        <p>
                                            {{ $item['text'] }}
                                        </p>
                                @endswitch
                            @endforeach


                        </div>
                    @endforeach


                </div>

            </div>
        </div>
    @break

    @case('vertical')
        <div class="col-xl-6">
            <h6 class="text-muted">{{ $title }}</h6>
            <div class="nav-align-left nav-tabs-shadow mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    @foreach ($tabs as $index => $tab)
                        <li class="nav-item">
                            <button type="button" class="nav-link {{ $index === 0 ? 'active' : '' }}" role="tab"
                                data-bs-toggle="tab" {{-- Add data-bs-toggle attribute --}}
                                data-bs-target="#navs-left-{{ strtolower($tab['label']) }}"
                                aria-controls="navs-left-{{ strtolower($tab['label']) }}"
                                aria-selected="{{ $index === 0 ? 'true' : 'false' }}">

                                @if ($includ_icon == 'true')
                                    <i class="{{ $tab['icon_class'] }}"></i> {{-- Include icon --}}
                                @endif

                                {{ $tab['label'] }}
                                @if (optional($tab)['rounded-pill'] !== null)
                                    <span
                                        class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1">{{ $tab['rounded-pill'] }}</span>
                                    {{-- Include icon --}}
                                @endif
                            </button>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach ($tabs as $index => $tab)
                        <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                            id="navs-left-{{ strtolower($tab['label']) }}" role="tabpanel">
                            @foreach (optional($tab)['components'] ?? [] as $item)
                                @switch(optional($item)['component-file'])
                                    @case('input-select')
                                        <x-input-select id="{{ optional($item)['id'] }}" type="{{ optional($item)['type'] }}"
                                            options="{{ json_encode(optional($item)['option']) }}"
                                            label="{{ optional($item)['label'] }}" multiple="{{ optional($item)['multiple'] }}"
                                            disabled="{{ optional($item)['disabled'] }}"
                                            selected_key="{{ optional($item)['selected_key'] }}"
                                            class_color="{{ optional($item)['class_color'] }}" />
                                    @break

                                    @case('input-float')
                                        <x-input-float id="{{ optional($item)['id'] }}" name="{{ optional($item)['name'] }}"
                                            label="{{ optional($item)['label'] }}"
                                            placeholder="{{ optional($item)['placeholder'] }}"
                                            disabled="{{ optional($item)['disabled'] }}"
                                            helper_text="{{ optional($item)['helper_text'] }}"
                                            type="{{ optional($item)['type'] }}" value="{{ optional($item)['value'] }}" />
                                    @break

                                    @case('input-switch')
                                        <x-input-switch id="{{ optional($item)['id'] }}" name="{{ optional($item)['name'] }}"
                                            class="{{ optional($item)['class'] }}" type="{{ optional($item)['type'] }}"
                                            label="{{ optional($item)['label'] }}"
                                            switch_label="{{ optional($item)['switch_label'] }}"
                                            showicon="{{ optional($item)['showicon'] }}"
                                            checked="{{ optional($item)['checked'] }}"
                                            disabled="{{ optional($item)['disabled'] }}" size="{{ optional($item)['size'] }}"
                                            class_validation="{{ optional($item)['class_validation'] }}" />
                                    @break

                                    @case('input-tags')
                                        <x-input-tags id="{{ optional($item)['id'] }}" name="{{ optional($item)['name'] }}"
                                            class="{{ optional($item)['class'] }}"
                                            placeholder="{{ optional($item)['placeholder'] }}"
                                            readonly="{{ optional($item)['readonly'] }}" value="{{ optional($item)['value'] }}"
                                            label="{{ optional($item)['label'] }}" />
                                    @break

                                    @case('input-textarea')
                                        <x-input-textarea id="{{ optional($item)['id'] }}" name="{{ optional($item)['name'] }}"
                                            class="{{ optional($item)['class'] }}" disabled="{{ optional($item)['disabled'] }}"
                                            readonly="{{ optional($item)['readonly'] }}" value="{{ optional($item)['value'] }}"
                                            row="{{ optional($item)['row'] }}" />
                                    @break

                                    @case('input-checkbox-radio')
                                        <x-input-checkbox-radio id="{{ optional($item)['id'] }}"
                                            name="{{ optional($item)['name'] }}" class="{{ optional($item)['class'] }}"
                                            type="{{ optional($item)['type'] }}" label="{{ optional($item)['label'] }}"
                                            checked="{{ optional($item)['checked'] }}"
                                            disabled="{{ optional($item)['disabled'] }}"
                                            readonly="{{ optional($item)['readonly'] }}" value="{{ optional($item)['value'] }}" />
                                    @break

                                    @case('input')
                                        <x-input id="{{ optional($item)['id'] }}" name="{{ optional($item)['name'] }}"
                                            label="{{ optional($item)['label'] }}"
                                            placeholder="{{ optional($item)['placeholder'] }}"
                                            helper_text="{{ optional($item)['helper_text'] }}"
                                            type="{{ optional($item)['type'] }}" value="{{ optional($item)['value'] }}"
                                            class="{{ optional($item)['class'] }}" disabled="{{ optional($item)['disabled'] }}"
                                            readonly="{{ optional($item)['readonly'] }}"
                                            options="{{ json_encode(optional($item)['option']) }}"
                                            multiple="{{ optional($item)['multiple'] }}" size="{{ optional($item)['size'] }}"
                                            min="{{ optional($item)['min'] }}" max="{{ optional($item)['max'] }}"
                                            step="{{ optional($item)['step'] }}" />
                                    @break

                                    @default
                                        <h4 class="text-muted">{{ optional($item)['title'] }}</h4>
                                        <p>
                                            {{ $item['text'] }}
                                        </p>
                                @endswitch
                            @endforeach


                        </div>
                    @endforeach


                </div>

            </div>
        </div>
    @break

    @case('tabs_with_card')
        <div class="col-xl-6">
            <h6 class="text-muted">{{ $title }}</h6>
            <div class="card text-center mb-3">
                <div class="card-header pt-0">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        @foreach ($tabs as $index => $tab)
                            <li class="nav-item">
                                <button type="button" class="nav-link {{ $index === 0 ? 'active' : '' }}" role="tab"
                                    data-bs-toggle="tab" {{-- Add data-bs-toggle attribute --}}
                                    data-bs-target="#navs-top-{{ strtolower($tab['label']) }}"
                                    aria-controls="navs-top-{{ strtolower($tab['label']) }}"
                                    aria-selected="{{ $index === 0 ? 'true' : 'false' }}">

                                    @if ($includ_icon == 'true')
                                        <i class="{{ $tab['icon_class'] }}"></i> {{-- Include icon --}}
                                    @endif

                                    {{ $tab['label'] }}
                                    @if (optional($tab)['rounded-pill'] !== null)
                                        <span
                                            class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1">{{ $tab['rounded-pill'] }}</span>
                                        {{-- Include icon --}}
                                    @endif
                                </button>
                            </li>
                        @endforeach
                    </ul>
                    <div class="card-body">
                        <div class="tab-content p-0 pt-4">
                            @foreach ($tabs as $index => $tab)
                                <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                                    id="navs-top-{{ strtolower($tab['label']) }}" role="tabpanel">
                                    @foreach (optional($tab)['components'] ?? [] as $item)
                                        @switch(optional($item)['component-file'])
                                            @case('input-select')
                                                <x-input-select id="{{ optional($item)['id'] }}"
                                                    type="{{ optional($item)['type'] }}"
                                                    options="{{ json_encode(optional($item)['option']) }}"
                                                    label="{{ optional($item)['label'] }}"
                                                    multiple="{{ optional($item)['multiple'] }}"
                                                    disabled="{{ optional($item)['disabled'] }}"
                                                    selected_key="{{ optional($item)['selected_key'] }}"
                                                    class_color="{{ optional($item)['class_color'] }}" />
                                            @break

                                            @case('input-float')
                                                <x-input-float id="{{ optional($item)['id'] }}"
                                                    name="{{ optional($item)['name'] }}" label="{{ optional($item)['label'] }}"
                                                    placeholder="{{ optional($item)['placeholder'] }}"
                                                    disabled="{{ optional($item)['disabled'] }}"
                                                    helper_text="{{ optional($item)['helper_text'] }}"
                                                    type="{{ optional($item)['type'] }}" value="{{ optional($item)['value'] }}" />
                                            @break

                                            @case('input-switch')
                                                <x-input-switch id="{{ optional($item)['id'] }}"
                                                    name="{{ optional($item)['name'] }}" class="{{ optional($item)['class'] }}"
                                                    type="{{ optional($item)['type'] }}" label="{{ optional($item)['label'] }}"
                                                    switch_label="{{ optional($item)['switch_label'] }}"
                                                    showicon="{{ optional($item)['showicon'] }}"
                                                    checked="{{ optional($item)['checked'] }}"
                                                    disabled="{{ optional($item)['disabled'] }}"
                                                    size="{{ optional($item)['size'] }}"
                                                    class_validation="{{ optional($item)['class_validation'] }}" />
                                            @break

                                            @case('input-tags')
                                                <x-input-tags id="{{ optional($item)['id'] }}"
                                                    name="{{ optional($item)['name'] }}" class="{{ optional($item)['class'] }}"
                                                    placeholder="{{ optional($item)['placeholder'] }}"
                                                    readonly="{{ optional($item)['readonly'] }}"
                                                    value="{{ optional($item)['value'] }}"
                                                    label="{{ optional($item)['label'] }}" />
                                            @break

                                            @case('input-textarea')
                                                <x-input-textarea id="{{ optional($item)['id'] }}"
                                                    name="{{ optional($item)['name'] }}" class="{{ optional($item)['class'] }}"
                                                    disabled="{{ optional($item)['disabled'] }}"
                                                    readonly="{{ optional($item)['readonly'] }}"
                                                    value="{{ optional($item)['value'] }}" row="{{ optional($item)['row'] }}" />
                                            @break

                                            @case('input-checkbox-radio')
                                                <x-input-checkbox-radio id="{{ optional($item)['id'] }}"
                                                    name="{{ optional($item)['name'] }}" class="{{ optional($item)['class'] }}"
                                                    type="{{ optional($item)['type'] }}" label="{{ optional($item)['label'] }}"
                                                    checked="{{ optional($item)['checked'] }}"
                                                    disabled="{{ optional($item)['disabled'] }}"
                                                    readonly="{{ optional($item)['readonly'] }}"
                                                    value="{{ optional($item)['value'] }}" />
                                            @break

                                            @case('input')
                                                <x-input id="{{ optional($item)['id'] }}" name="{{ optional($item)['name'] }}"
                                                    label="{{ optional($item)['label'] }}"
                                                    placeholder="{{ optional($item)['placeholder'] }}"
                                                    helper_text="{{ optional($item)['helper_text'] }}"
                                                    type="{{ optional($item)['type'] }}" value="{{ optional($item)['value'] }}"
                                                    class="{{ optional($item)['class'] }}"
                                                    disabled="{{ optional($item)['disabled'] }}"
                                                    readonly="{{ optional($item)['readonly'] }}"
                                                    options="{{ json_encode(optional($item)['option']) }}"
                                                    multiple="{{ optional($item)['multiple'] }}"
                                                    size="{{ optional($item)['size'] }}" min="{{ optional($item)['min'] }}"
                                                    max="{{ optional($item)['max'] }}" step="{{ optional($item)['step'] }}" />
                                            @break

                                            @default
                                                <h4 class="text-muted">{{ optional($item)['title'] }}</h4>
                                                <p>
                                                    {{ $item['text'] }}
                                                </p>
                                        @endswitch
                                    @endforeach


                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    @break

@endswitch


{{--
 includ_icon: if you need add icon on with the name of tabs ,
 type: It is necessary to put the type of these types
 -basic => tabs on the top side, can put it with icon,and rounded-pill,
 -vertical => tabs on the left side, can put it with icon,and rounded-pill,
 -tabs_with_card => tabs on the top side, can put it with icon,and rounded-pill,the content its in center,
 $tab['components']: contain multiple components with properties for each component.
 $item['component-file']:what is the component file of this content.
 $tab['icon_class']: the form and class of icon
 $tab['rounded-pill']:if we need use to put rounded-pill beside the name of tabs
 --}}



{{--
 how use the component tabs?
  <x-tabs  :tabs="$details['tabs']" :type="$details['type']"  includ_icon="$details['includ_icon']" />
 form of array:
 $details = [
        'title' => '',
        'includ_icon' => 'true',
        'type' => '',
        'tabs' => [
            [
                'id' => 'tab1',
                'label' => 'Home',
                'icon_class' => 'tf-icons ti ti-home ti-xs me-1',
                'rounded-pill' => '3',
                'components' => [['id' => '1', 'text' => 'Icing pastry pudding oat cake. Lemon drops cotton candy caramels cake caramels sesame snaps powder. Bear claw candy topping.'], ['id' => '2', 'name' => 'Sara', 'component-file' => 'input', 'type' => 'password', 'label' => 'Password']],
            ],
            [
                'id' => 'tab2',
                'label' => 'Profile',
                'icon_class' => 'tf-icons ti ti-user ti-xs me-1',
            ],
           
        ],
    ];
  
  
  
  
  --}}
