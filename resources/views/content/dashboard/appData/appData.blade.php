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
        Ads App Data
    </x-slot>

    <x-slot name="body">
        <form id="addappdata" action="{{ route('create-app-data') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="modal-body">
                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                <div class="form-group">
                    <x-input name="title" id="title" placeholder="Name Of Business" type="text" label="Name Of Business"
                        value="{{ $data->title ?? '' }}" />
                </div> 
                <div class="form-group">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control" accept="image/png,image/jpeg" id="imageInputelement"   >
                </div>
                <div class="form-group">
                    @if ($data->image ?? '')
                   
                        <img class="uploaded-image-element" src="{{ asset('images/' . $data->image) }}"
                            style="max-width: 100px; max-height: 100px;"   id="previewImageelement"   >
                    @else
                        <img class="uploaded-image-element" style="max-width: 100px; max-height: 100px;"  id="previewImageelement"    >
                    @endif
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="submit">submit</button>
                <div class="mx-2"></div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
<div class="modal fade" id="deleteSuccessModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-lg-4">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                    <circle class="path circle" fill="none" stroke="#198754" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                    <polyline class="path check" fill="none" stroke="#198754" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                </svg>
                <h4 class="text-success mt-3">Deleted!</h4>
                <p class="mt-3">Data has been successfully deleted.</p>
                <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteErrorModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-lg-4">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                    <circle class="path circle" fill="none" stroke="#dc3545" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                    <line class="path line" fill="none" stroke="#dc3545" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="65.1" y1="40" x2="65.1" y2="80" />
                    <line class="path line" fill="none" stroke="#dc3545" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="65.1" y1="90" x2="65.1" y2="100" />
                </svg>
                <h4 class="text-danger mt-3">Deletion Failed!</h4>
                <p class="mt-3">There was an error deleting the data. Please try again.</p>
                <button type="button" class="btn btn-sm btn-danger mt-3" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete Error Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-lg-4">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                    <circle class="path circle" fill="none" stroke="#ffc107" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                    <line class="path line" fill="none" stroke="#ffc107" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="65.1" y1="30" x2="65.1" y2="80" />
                    <line class="path line" fill="none" stroke="#ffc107" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="65.1" y1="90" x2="65.1" y2="100" />
                </svg>
                <h4 class="text-warning mt-3">Are you sure?</h4>
                <p class="mt-3">Do you really want to delete this data?</p>
                <button type="button" class="btn btn-sm btn-danger mt-3" id="confirmDeleteBtn">Delete</button>
                <button type="button" class="btn btn-sm btn-secondary mt-3" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>



@endsection
@include('content.dashboard.appData.scripts')