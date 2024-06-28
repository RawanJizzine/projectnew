<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $("#open_modal_button").click(function() {
            console.log("ji");
            $("#add_logo_modal").modal("show");
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('imageInput').addEventListener('change', function(event) {
            var input = event.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
                var blobUrl = URL.createObjectURL(input.files[0]);
                window.open(blobUrl, '_blank');
            }
        });
    });

    $(document).ready(function() {
        $('#saveLogoBtn').on('click', function() {
            var form = document.getElementById('createLogoForm');
            var formData = new FormData(form);
            $.ajax({
                url: form.action,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(data) {
                    console.log(data);
                    $('.validation-errors').remove();
                    $('#statusSuccessModal').modal('show');
                    var logo = data.logo;
                    var newRow = '<tr>' +

                        '<td><img src="{{ asset('logo/') }}/' + logo.image +
                        '" alt="Image" style="max-width: 100px; max-height: 100px;"></td>' +

                        '<td>' +
                        '<a href="" class="btn btn-sm btn-primary">Edit</a>' +
                        ' ' +
                        '<a href="" class="btn btn-sm btn-warning">Delete</a>' +
                        '</td>' +
                        '</tr>';

                    $('table tbody').append(newRow);
                    form.reset();
                    $('#previewImage').attr('src', '');

                    $('#add_feature_modal').modal('hide');
                    $('#createFeatureForm')[0].reset();
                },
                error: function(error) {
                   
                    console.error('Error:', error);
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
                    }else{
                        $('#statusErrorsModal').modal('show');
                    }
                }
            });
        });

        $('.closebut').on('click', function() {
            $('#add_feature_modal').modal('hide');
            $('#createFeatureForm')[0].reset();
            $('.validation-errors').remove();
        });


        function displayValidationErrors(errors) {

            $('.validation-errors').remove();
            $.each(errors, function(field, messages) {
                var input = $('[name="' + field + '"]');
                var container = input.closest('.form-group');
                $.each(messages, function(index, message) {
                    container.append('<p class="text-danger validation-errors">' + message +
                        '</p>');
                });
            });
        }
    });



    $(document).ready(function() {
        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            var image = $(this).data('image');
            $('#editLogoForm').attr('action', '/updatelogo/' + id);
            $('#previewImageEdit').attr('src', '{{ asset('logo/') }}/' + image);
        });

        $('#SuccessOkBtn').click(function() {
            location.reload();
        });
        $('#updateLogoBtn').click(function() {
            var form = document.getElementById('editLogoForm');
            var formData = new FormData(form);

            $.ajax({
                type: 'POST',
                url: $('#editLogoForm').attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#statusSuccessModal').modal('show');
                    $('#editLogo').modal('hide');
                   
                },
                error: function(error) {
                 
                    console.error('Error:', error);
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
                    }else{
                        $('#statusErrorsModal').modal('show');
                        $('#editLogo').modal('hide');
                    }
                }
            });

            function displayValidationErrors(errors) {
                $('.validation-errors').remove();
                $.each(errors, function(field, messages) {
                    var input = $('[name="' + field + '"]');
                    var container = input.closest('.form-group');
                    $.each(messages, function(index, message) {
                        container.append('<p class="text-danger validation-errors">' + message + '</p>');
                    });
                });
            }
        });

        document.getElementById('imageInputEdit').addEventListener('change', function(event) {
            var input = event.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('previewImageEdit').src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    });

    $(document).ready(function() {
        let appointmentIdToDelete;
        let $rowToDelete;

        $('.delete-btn').click(function(e) {
            e.preventDefault();
            appointmentIdToDelete = $(this).data('id');
            $rowToDelete = $(this).closest('tr');
            $('#deleteConfirmationModal').modal('show');
        });

        $('#confirmDeleteBtn').click(function() {
            $.ajax({
                url: '/logo/' + appointmentIdToDelete,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#deleteConfirmationModal').modal('hide');
                    $('#deleteSuccessModal').modal('show');
                    $rowToDelete.remove();
                },
                error: function(error) {
                    $('#deleteConfirmationModal').modal('hide');
                    $('#deleteErrorModal').modal('show');
                    console.error('Error:', error);
                }
            });
        });

        $('#deleteSuccessOkBtn').click(function() {
            location.reload();
        });
    });
</script>
