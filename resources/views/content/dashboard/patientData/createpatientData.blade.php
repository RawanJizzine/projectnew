@extends('layouts.layoutMaster')

@section('title', 'Dashboard')

@section('content')
    <div class="text-center mb-4">
        <h3 class="address-title mb-2">Patient Information</h3>
        <p class="text-muted address-subtitle"></p>
    </div>
    <form method="POST" id="addNewPatientInfo" class="row g-3" enctype="multipart/form-data">
        @csrf
        
        <div class="col-12 col-md-3">
            <label class="form-label" for="patientfullname">Patient Full Name</label>
            <input type="text" id="patientfullname"   name="patientfullname" class="form-control" placeholder="John"
                required />
        </div>
        <div class="col-12 col-md-3">
            <label class="form-label" for="phonenumber">Phone Number</label>
            <input type="number" id="phonenumber"      name="phonenumber" class="form-control" placeholder="00000000"
                required />
        </div>
        <div class="col-12 col-md-3">
            <label class="form-label" for="sex">Sex</label>
            <input type="text" id="sex" name="sex"     class="form-control" required />
        </div>
        <div class="col-12 col-md-3">
            <label class="form-label" for="dateofbirth">Date Of Birth</label>
            <input type="date" id="dateofbirth"       name="dateofbirth" class="form-control" required />
        </div>
        <div class="col-12 col-md-3">
            <label class="form-label" for="width">Width</label>
            <input type="number" id="width"    name="width" class="form-control" required />
        </div>
        <div class="col-12 col-md-3">
            <label class="form-label" for="height">Height</label>
            <input type="number" id="height" name="height"      class="form-control" required />
        </div>

        <div id="files-container" class="product-group-container">

            
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
           

        </div>

        <div class="col-12 text-center">
            <button type="button" id="add-file" class="btn btn-secondary">Add Another File</button>
        </div>
        <div class="col-12 text-center">
            <button type="button" id="save-patient-info" class="btn btn-primary">Save Patient Information</button>
        </div>
    </form>
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha384-DyZ88mC6Up2uqSg21CRAxJpM4nE1Efw1EEXG+41dAhN8pZw5+Oz59py0ENQbj1q4" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function() {
    let fileIndex = 1;  // Initialize fileIndex

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
            }
        });
    });

    // Show icons for preloaded files

});
</script>
