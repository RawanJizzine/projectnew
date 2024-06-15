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
                    alert('Data created successfully')
                    var logo = data.logo;
                    var newRow = '<tr>' +

                        '<td><img src="{{ asset('storage/') }}/' + logo.image +
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
                    alert('Error Here!')
                    console.error('Error:', error);
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
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
            $('#previewImageEdit').attr('src', '{{ asset('storage/') }}/' + image);

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
                    alert('Data updated successfully')
                    $('#editLogo').modal('hide');
                    location.reload();
                },
                error: function(error) {
                    alert('Error Here!')
                    console.error('Error:', error);
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
                    }
                }
            });

            function displayValidationErrors(errors) {

                $('.validation-errors').remove();
                $.each(errors, function(field, messages) {
                    var input = $('[name="' + field + '"]');
                    var container = input.closest('.form-group');
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

                    document.getElementById('previewImageEdit').src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    });

    $(document).ready(function() {
        $(".delete-btn").on("click", function() {
            var $rowToDelete = $(this).closest('tr');

            var id = $(this).data('id');
            var url = '/logo/' + id;


            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(data) {
                        console.log(data);
                        alert('Delete this data successfully')
                        $rowToDelete.remove();
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        alert('Delete this data Not successfully')
                    }
                });
            }
        });
    });
</script>
