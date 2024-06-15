<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {

        $("#open_modal_button").click(function() {
            console.log("ji");
            $("#add_fun_modal").modal("show");
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('imageInput').addEventListener('change', function(event) {
            var input = event.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Set the preview image source
                    document.getElementById('previewImage').src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);

                // Open the image in a new tab
                var blobUrl = URL.createObjectURL(input.files[0]);
                window.open(blobUrl, '_blank');
            }
        });
    });
    $(document).ready(function() {
        $('#saveFunBtn').on('click', function() {
            var form = document.getElementById('createFunForm');
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
                    $('.validation-errors').remove();
                    console.log(data);
                    alert('Data created successfully')
                    var fun = data.fun;
                    var newRow = '<tr>' +
                        '<td><img src="{{ asset('storage/') }}/' + fun.image +
                        '" alt="Image" style="max-width: 100px; max-height: 100px;"></td>' +
                        '<td> <input readonly type="text" value="' + fun.event +
                        '" name="event" class="form-control"> </td>' +
                        '<td> <input  readonly   type="text" value="' + fun.title +
                        '" name="title" class="form-control"> </td>' +

                        '<td> <input readonly type="text" value="' + fun.text +
                        '" name="text" class="form-control"> </td>' +
                        '<td>' +
                        '<a href="" class="btn btn-sm btn-primary">Edit</a>' +
                        ' ' +
                        '<a href="" class="btn btn-sm btn-warning">Delete</a>' +
                        '</td>' +
                        '</tr>';

                    $('table tbody').append(newRow);
                    form.reset();
                    $('#previewImage').attr('src', '');

                    $('#add_fun_modal').modal('hide');
                    $('#createfunForm')[0].reset();
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
            $('#add_fun_modal').modal('hide');
            $('#createFunForm')[0].reset();
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
            var event = $(this).data('event');
            var title = $(this).data('title');
            var text = $(this).data('text');

            var borderColor = $(this).data('border-color');

            $('#editFunForm').attr('action', '/updatefun/' + id);
            $('#previewImageEdit').attr('src', '{{ asset('storage/') }}/' + image);
            $('#event_edit').val(event);
            $('#title_edit').val(title);
            $('#text_edit').val(text);
            $('#border_color_edit').val(borderColor);
        });
        $('#updateFunBtn').click(function() {
            var form = document.getElementById('editFunForm');
            var formData = new FormData(form);
            $.ajax({
                type: 'POST',
                url: $('#editFunForm').attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert(response.message);
                    $('#editFun').modal('hide');
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
                    // Set the preview image source
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
            var url = '/fun/' + id;


            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(data) {
                        alert('Data deleted successfully')
                        console.log(data);
                        $rowToDelete.remove();
                    },
                    error: function(error) {
                        alert('Data not found')
                        console.error('Error:', error);
                    }
                });
            }
        });
    });
</script>
