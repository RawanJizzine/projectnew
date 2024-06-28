<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $("#open_modal_button").click(function() {
            console.log("ji");
            $("#add_feature_modal").modal("show");
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
        var itemCount = 0;
        $('#saveFeatureBtn').on('click', function() {
            var form = document.getElementById('createFeatureForm');
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
                    $('#statusSuccessModal').modal('show');
                    var feature = data.feature;
                    itemCount++;
                    var newRow = '<tr>' +

                        '<td><img src="{{ asset('features/') }}/' + feature.image +
                        '" alt="Image" style="max-width: 100px; max-height: 100px;"></td>' +
                        '<td> <input type="text" value="' + feature.title +
                        '" name="title" class="form-control" readonly > </td>' +
                        '<td> <input type="text" value="' + feature.location +
                        '" name="location" class="form-control" readonly > </td>' +
                        '<td> <input type="text" value="' + feature.price +
                        '" name="title" class="form-control" readonly > </td>'

                        +
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


                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
                    } else {
                        $('#add_feature_modal').modal('hide');
                        $('#createFeatureForm')[0].reset();
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
            // Clear any existing error messages
            $('.validation-errors').remove();

            // Display new error messages
            $.each(errors, function(field, messages) {
                var input = $('[name="' + field + '"]');
                var container = input.closest('.form-group');

                // Display each error message
                $.each(messages, function(index, message) {
                    container.append('<p class="text-danger validation-errors">' + message +
                        '</p>');
                });
            });
        }
    });

    $(document).ready(function() {
        $('#submitFormBtn').on('click', function() {
            var form = $('#addfeaturesdata')[0];
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
                    $('#statusSuccessModal').modal('show');
                },
                error: function(error) {
                    console.error('Error:', error);

                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
                    } else {
                        $('#statusErrorsModal').modal('show');
                    }

                }
            });
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
            var title = $(this).data('title');
            var location = $(this).data('location');
            var description = $(this).data('description');
            var subdescription = $(this).data('subdescription');
            var price = $(this).data('price');


            $('#editFeatureForm').attr('action', '/updatefeature/' + id);
            $('#previewImageEdit').attr('src', '{{ asset('features/') }}/' + image);
            $('#title_edit').val(title);
            $('#description_edit').val(description);
            $('#location_edit').val(location);
            $('#sub_description_edit').val(subdescription);
            $('#price_edit').val(price);

        });
        $('#SuccessOkBtn').click(function() {
            location.reload();
        });
        $('#updateFeatureBtn').click(function() {
            var form = document.getElementById('editFeatureForm');
            var formData = new FormData(form);

            $.ajax({
                type: 'POST', // Use POST here
                url: $('#editFeatureForm').attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('.validation-errors').remove();


                    $('#statusSuccessModal').modal('show');

                },
                error: function(error) {

                    console.error('Error:', error);
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
                    } else {
                        $('#statusErrorsModal').modal('show');
                        $('#editFeature').modal('hide');
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

        document.getElementById('imageInputEdit').addEventListener('change', function(event) {
            var input = event.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Set the preview image source
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
                url: '/feature/' + appointmentIdToDelete,
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
