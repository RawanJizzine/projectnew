@props(['title'=>'', 'button_title'=>'','icon'=>'plus','sub_title'=>''])
<div class=" flex-grow-1">
    <div class="card mb-2">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center  ">
                <div>
                    <h4 class="card-title mb-0">{{ $title }}</h4>
                    <h6 class="card-subtitle mb-0  mt-1">{{ $sub_title ?? '' }}</h6>
                </div>
                <div>
                    {{ $body }}
                </div>
              </div>
        </div>
      </div>
    </div>