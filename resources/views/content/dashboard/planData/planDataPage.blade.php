@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>

.modal#statusSuccessModal .modal-content, 
.modal#statusErrorsModal .modal-content,
.modal#deleteSuccessModal .modal-content, 
.modal#deleteErrorModal .modal-content,
.modal#deleteConfirmationModal .modal-content {
	border-radius: 30px;
}

.modal#statusSuccessModal .modal-content svg, 
.modal#statusErrorsModal .modal-content svg,
.modal#deleteSuccessModal .modal-content svg, 
.modal#deleteErrorModal .modal-content svg,
.modal#deleteConfirmationModal .modal-content svg {
	width: 100px; 
	display: block; 
	margin: 0 auto;
}

.modal#statusSuccessModal .modal-content .path, 
.modal#statusErrorsModal .modal-content .path,
.modal#deleteSuccessModal .modal-content .path, 
.modal#deleteErrorModal .modal-content .path,
.modal#deleteConfirmationModal .modal-content .path {
	stroke-dasharray: 1000; 
	stroke-dashoffset: 0;
}

.modal#statusSuccessModal .modal-content .path.circle, 
.modal#statusErrorsModal .modal-content .path.circle,
.modal#deleteSuccessModal .modal-content .path.circle, 
.modal#deleteErrorModal .modal-content .path.circle,
.modal#deleteConfirmationModal .modal-content .path.circle {
	-webkit-animation: dash 0.9s ease-in-out; 
	animation: dash 0.9s ease-in-out;
}

.modal#statusSuccessModal .modal-content .path.line, 
.modal#statusErrorsModal .modal-content .path.line,
.modal#deleteSuccessModal .modal-content .path.line, 
.modal#deleteErrorModal .modal-content .path.line,
.modal#deleteConfirmationModal .modal-content .path.line {
	stroke-dashoffset: 1000; 
	-webkit-animation: dash 0.95s 0.35s ease-in-out forwards; 
	animation: dash 0.95s 0.35s ease-in-out forwards;
}

.modal#statusSuccessModal .modal-content .path.check, 
.modal#statusErrorsModal .modal-content .path.check,
.modal#deleteSuccessModal .modal-content .path.check, 
.modal#deleteErrorModal .modal-content .path.check,
.modal#deleteConfirmationModal .modal-content .path.check {
	stroke-dashoffset: -100; 
	-webkit-animation: dash-check 0.95s 0.35s ease-in-out forwards; 
	animation: dash-check 0.95s 0.35s ease-in-out forwards;
}

@-webkit-keyframes dash { 
	0% {
		stroke-dashoffset: 1000;
	}
	100% {
		stroke-dashoffset: 0;
	}
}

@keyframes dash { 
	0% {
		stroke-dashoffset: 1000;
	}
	100% {
		stroke-dashoffset: 0;
	}
}

@-webkit-keyframes dash-check { 
	0% {
		stroke-dashoffset: -100;
	}
	100% {
		stroke-dashoffset: 900;
	}
}

@keyframes dash-check {
	0% {
		stroke-dashoffset: -100;
	}
	100% {
		stroke-dashoffset: 900;
	}
}

</style>

@section('content')

    <x-card>
        <x-slot name="title">
            Ads Plan
        </x-slot>

        <x-slot name="body">
            <form id="addplansdata" action="{{ route('create-plan') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <x-input name="title_plan" id="title_plan" placeholder="Title" type="text"
                            value="{{ $plan->title ?? '' }}" label="Title" />
                    </div>
                    <div class="form-group">
                        <x-input name="first_description" id="first_description" placeholder="Description 1" type="text"
                            value="{{ $plan->first_description ?? '' }}" label="Description 1" />
                    </div>
                    <div class="form-group">
                        <x-input name="second_description" id="second_description" placeholder="Description 2"
                            type="text" value="{{ $plan->second_description ?? '' }}" label="Description 2" />
                    </div>
                    <div class="form-group">
                        <x-input name="tertiary_description" id="tertiary_description" placeholder="Description 3"
                            type="text" value="{{ $plan->tertiary_description ?? '' }}" label="Description 3" />
                    </div>
                    <div class="form-group">
                        <x-input name="four_description" id="four_description" placeholder="Description 4" type="text"
                            value="{{ $plan->four_description ?? '' }}" label="Description 4" />
                    </div>
                    <div class="form-group">
                        <x-input name="switch_text_left" id="switch_text_left" placeholder="Switch Text Left" type="text"
                            value="{{ $plan->text_switch_left ?? '' }}" label="Switch Text Left" />
                    </div>
                    <div class="form-group">
                        <x-input name="switch_text_right" id="switch_text_right" placeholder="Switch Text Right"
                            type="text" value="{{ $plan->text_switch_right ?? '' }}" label="Switch Text Left" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="submit" id="submitFormBtn">submit</button>
                </div>
            </form>
        </x-slot>
    </x-card>


   














    <div class="modal fade" id="statusErrorsModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-lg-4">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#db3646" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3" />
                        <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2" />
                    </svg>
                    <h4 class="text-danger mt-3">Error!</h4>
                    <p class="mt-3">An error occurred while saving data.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-danger" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="statusSuccessModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"> 
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document"> 
            <div class="modal-content"> 
                <div class="modal-body text-center p-lg-4"> 
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#198754" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <polyline class="path check" fill="none" stroke="#198754" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " /> 
                    </svg> 
                    <h4 class="text-success mt-3">Oh Yeah!</h4> 
                    <p class="mt-3">You have successfully saved data.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal" id="SuccessOkBtn">Ok</button> 
                </div> 
            </div> 
        </div> 
    </div>




@endsection
@include('content.dashboard.planData.scripts')
