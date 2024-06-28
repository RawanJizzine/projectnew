@extends('layouts.layoutMaster')

@section('title', 'Dashboard')
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
    <div class="text-center mb-4">
        <h3 class="address-title mb-2">Patient Information</h3>
        <p class="text-muted address-subtitle"></p>
    </div>
    <form method="POST" id="addNewPatientInfo" class="row g-3" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $patient->id ?? '' }}">
        <div class="col-12 col-md-3">
            <label class="form-label" for="patientfullname">Patient Full Name</label>
            <input type="text" id="patientfullname" value="{{ $patient->fullname ?? '' }}"    name="patientfullname" class="form-control" placeholder="John"
                required />
        </div>
        <div class="col-12 col-md-3">
            <label class="form-label" for="phonenumber">Phone Number</label>
            <input type="number" id="phonenumber" value="{{ $patient->phonenumber ?? '' }}"     name="phonenumber" class="form-control" placeholder="00000000"
                required />
        </div>
        <div class="col-12 col-md-3">
            <label class="form-label" for="sex">Sex</label>
            <input type="text" id="sex" name="sex" value="{{ $patient->sex ?? '' }}"    class="form-control" required />
        </div>
        <div class="col-12 col-md-3">
            <label class="form-label" for="dateofbirth">Date Of Birth</label>
            <input type="date" id="dateofbirth" value="{{ $patient->dateofbirth ?? '' }}"      name="dateofbirth" class="form-control" required />
        </div>
        <div class="col-12 col-md-3">
            <label class="form-label" for="width">Width</label>
            <input type="number" id="width"   value="{{ $patient->width ?? '' }}"        name="width" class="form-control" required />
        </div>
        <div class="col-12 col-md-3">
            <label class="form-label" for="height">Height</label>
            <input type="number" id="height" name="height"  value="{{ $patient->height ?? '' }}"       class="form-control" required />
        </div>

        <div id="files-container" class="product-group-container">

            @if ($patient->filesPatientInfo->isNotEmpty())
                @foreach ($patient->filesPatientInfo as $index => $file)
                    <x-card>
                        <x-slot name="title"></x-slot>
                        <x-slot name="body">
                            <div class="row g-3">
                                <input type="hidden" name="file[{{ $index }}][id]" value="{{ $file->id ?? '' }}">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="title">Title of file</label>
                                    <input type="text" id="titleoffile{{ $index }}"
                                        name="file[{{ $index }}][title]" class="form-control"
                                        value="{{ $file->title }}" required />
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="file">File</label>
                                    <div class="input-group">
                                        <input type="file" id="file{{ $index }}"
                                            name="file[{{ $index }}][file]" class="form-control file-input"
                                            data-file-index="{{ $index }}">
                                        <span style="font-size: 2em; padding-left: 20px;" id="file-icon{{ $index }}">
                                            <i class="fas fa-file"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </x-slot>
                    </x-card>
                @endforeach
            @else
                <x-card>
                    <x-slot name="title"></x-slot>
                    <x-slot name="body">
                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="title">Title of file</label>
                                <input type="text" id="titleoffile0" name="file[0][title]" class="form-control"
                                    required />
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="file">File</label>
                                <div class="input-group">
                                    <input type="file" id="file0" name="file[0][file]"
                                        class="form-control file-input" data-file-index="0">
                                    <span style="font-size: 2em; padding-left: 20px;" id="file-icon0"></span>
                                </div>
                            </div>
                        </div>
                    </x-slot>
                </x-card>
            @endif

        </div>

        <div class="col-12 text-center">
            <button type="button" id="add-file" class="btn btn-secondary">Add Another File</button>
        </div>
        <div class="col-12 text-center">
            <button type="button" id="save-patient-info" class="btn btn-primary">Save Patient Information</button>
        </div>
    </form>

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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha384-DyZ88mC6Up2uqSg21CRAxJpM4nE1Efw1EEXG+41dAhN8pZw5+Oz59py0ENQbj1q4" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function() {
    let fileIndex = {{ $patient->filesPatientInfo->count() }};

    function showFileIcon(input) {
        const file = input.files[0];
        const fileType = file.type;
        const fileIconId = 'file-icon' + input.getAttribute('data-file-index');
        const fileIcon = document.getElementById(fileIconId);
        fileIcon.innerHTML = getFileIcon(fileType);
        fileIcon.onclick = function () {
            openFileInNewWindow(input);
        };
    }

    function getFileIcon(fileType) {
        switch (fileType) {
            case 'image/jpeg':
            case 'image/png':
            case 'image/gif':
                return '<i class="fas fa-file-image"></i>';
            case 'application/pdf':
                return '<i class="fas fa-file-pdf"></i>';
            case 'text/plain':
                return '<i class="fas fa-file-alt"></i>';
            case 'application/msword':
            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                return '<i class="fas fa-file-word"></i>';
            case 'application/vnd.ms-excel':
            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                return '<i class="fas fa-file-excel"></i>';
            case 'application/vnd.ms-powerpoint':
            case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
                return '<i class="fas fa-file-powerpoint"></i>';
            default:
                return '<i class="fas fa-file"></i>';
        }
    }

    function getFileIconByExtension(extension) {
        switch (extension) {
            case 'jpeg':
            case 'jpg':
            case 'png':
            case 'gif':
                return '<i class="fas fa-file-image"></i>';
            case 'pdf':
                return '<i class="fas fa-file-pdf"></i>';
            case 'txt':
                return '<i class="fas fa-file-alt"></i>';
            case 'doc':
            case 'docx':
                return '<i class="fas fa-file-word"></i>';
            case 'xls':
            case 'xlsx':
                return '<i class="fas fa-file-excel"></i>';
            case 'ppt':
            case 'pptx':
                return '<i class="fas fa-file-powerpoint"></i>';
            default:
                return '<i class="fas fa-file"></i>';
        }
    }

    function openFileInNewWindow(input) {
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = function (e) {
            const url = URL.createObjectURL(file);
            const a = document.createElement('a');
            a.href = url;
            a.target = '_blank';
            a.rel = 'noopener noreferrer';
            a.click();
        }
        reader.readAsDataURL(file);
    }

    $('#add-file').click(function () {
        $('#files-container').append(`
            <x-card>
                <x-slot name="title"></x-slot>
                <x-slot name="body">
                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="title">Title of file</label>
                            <input type="text" id="titleoffile${fileIndex}" name="file[${fileIndex}][title]" class="form-control" required />
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="file">File</label>
                            <div class="input-group">
                                <input type="file" id="file${fileIndex}" name="file[${fileIndex}][file]" class="form-control file-input" data-file-index="${fileIndex}">
                                <span style="font-size: 2em; padding-left: 20px;" id="file-icon${fileIndex}"></span>
                            </div>
                        </div>
                    </div>
                </x-slot>
            </x-card>
        `);
        fileIndex++;
    });

    $(document).on('change', '.file-input', function() {
        showFileIcon(this);
    });

    $('#save-patient-info').click(function() {
            let formData = new FormData($('#addNewPatientInfo')[0]);

            $.ajax({
                url: "{{ route('files.store') }}", // Update this to your actual route
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('Success:', response);
                    $('.validation-errors').remove();


                    $('#statusSuccessModal').modal('show');
                    $('#addNewPatientInfo')[0].reset();

                    // Clear file icons
                    $('.file-input').each(function() {
                        const fileIndex = $(this).data('file-index');
                        $('#file-icon' + fileIndex).empty();
                    });

                    // Remove dynamically added file inputs (except the first one)
                    $('#files-container').empty();
                },
                error: function(error) {
                    console.error('Error:', error);
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
                    } else {
                        $('#statusSuccessModal').modal('show');

                    }
                }
            });

            function displayValidationErrors(errors) {
                // Clear any existing error messages
                $('.validation-errors').remove();

                // Display new error messages
                $.each(errors, function(field, messages) {
                    var input = $('[name="' + field + '"]');
                    var container = input.closest('.form-group');

                    // Display each error message
                    $.each(messages, function(index, message) {
                        container.append('<p class="text-danger validation-errors">' +
                            message +
                            '</p>');
                    });
                });
            }
        });

    // Show icons for preloaded files
    @if($patient->filesPatientInfo->isNotEmpty())
    @foreach($patient->filesPatientInfo as $index => $file)
        (function(fileIconId, filePath) {
            const fileIcon = document.getElementById(fileIconId);
            const fileExtension = filePath.split('.').pop();
            fileIcon.innerHTML = getFileIconByExtension(fileExtension);
            fileIcon.onclick = function () {
                window.open('/files/' + filePath, '_blank');
            };
        })('file-icon{{ $index }}', '{{ $file->path }}');
    @endforeach
@endif
});
</script>
