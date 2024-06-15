<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {

        $("#open_modal_button").click(function() {
            console.log("ji");
            $("#add_faq_modal").modal("show");
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
        $('#saveFaqBtn').on('click', function() {
            var form = document.getElementById('createFaqForm');
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
                    alert('Data created successfully')
                    var faq = data.faq;
                    var newRow = '<tr>' +
                        '<td> <input readonly type="text" value="' + faq.title +
                        '" name="title" class="form-control"> </td>' +
                        '<td><textarea  readonly name="description" class="form-control" rows="6">' +
                        faq.description + '</textarea></td>' +
                        '<td>' +
                        '<a href="" class="btn btn-sm btn-primary">Edit</a>' +
                        ' ' +
                        '<a href="" class="btn btn-sm btn-warning">Delete</a>' +
                        '</td>' +
                        '</tr>';

                    $('table tbody').append(newRow);
                    form.reset();
                    $('#previewImage').attr('src', '');

                    $('#add_faq_modal').modal('hide');
                    $('#createFaqForm')[0].reset();
                },
                error: function(error) {
                    console.error('Error:', error);
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
                    }
                }
            });
        });

        $('.closebut').on('click', function() {
            $('#add_faq_modal').modal('hide');
            $('#createFaqForm')[0].reset();
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
        $('#submitFormBtn').on('click', function() {
            var form = $('#addfaqsdata')[0];
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
                    alert('Data created successfully')
                },
                error: function(error) {
                    console.error('Error:', error);
                    alert('Error Here!')
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
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

            var title = $(this).data('title');
            var description = $(this).data('description');

            $('#editFaqForm').attr('action', '/updatefaq/' + id);

            $('#title_edit').val(title);
            $('#description_edit').val(description);
        });

        $('#updateFaqBtn').click(function() {
            var form = document.getElementById('editFaqForm');
            var formData = new FormData(form);

            $.ajax({
                type: 'POST',
                url: $('#editFaqForm').attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('.validation-errors').remove();
                    alert('Data updated successfully');
                    $('#editFaq').modal('hide');
                    location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                    alert('Error Here!')
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


    });

    $(document).ready(function() {
        $(".delete-btn").on("click", function() {
            var $rowToDelete = $(this).closest('tr');

            var id = $(this).data('id');
            var url = '/faq/' + id;


            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(data) {
                        console.log(data);
                        $rowToDelete.remove();
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
        });
    });
</script>
