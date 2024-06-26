<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#submitFormBtn').on('click', function() {
            var form = $('#addreviewsdata')[0];
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
                   
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
                    }else{
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
        $("#open_modal_button").click(function() {
            $("#add_review_modal").modal("show");
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
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('iconInput').addEventListener('change', function(event) {
            var input = event.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('previewIcon').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
                var blobUrl = URL.createObjectURL(input.files[0]);
                window.open(blobUrl, '_blank');
            }
        });
    });
    $(document).ready(function() {
        $('#saveReviewBtn').on('click', function() {
            var form = document.getElementById('createReviewForm');
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
                    $('#statusSuccessModal').modal('show');
                    var review = data.review;
                    var newRow = '<tr>' +

                        '<td><img src="{{ asset('reviews/') }}/' + review.image +
                        '" alt="Image" style="max-width: 100px; max-height: 100px;"></td>' +
                        '<td><textarea readonly name="description" class="form-control" rows="6">' +
                        review.description + '</textarea></td>' +
                        '<td> <input readonly  type="text" value="' + review.rating +
                        '" name="rating" class="form-control"> </td>' +
                        '<td><img src="{{ asset('reviews/') }}/' + review.icon +
                        '" alt="Icon" style="max-width: 100px; max-height: 100px;"></td>' +


                        '<td> <input readonly  type="text" value="' + review.name +
                        '" name="name" class="form-control"> </td>' +
                        '<td> <input readonly  type="text" value="' + review.position +
                        '" name="position" class="form-control"> </td>' +

                        '<td>' +
                        '<a href="" class="btn btn-sm btn-primary">Edit</a>' +
                        ' ' +
                        '<a href="" class="btn btn-sm btn-warning">Delete</a>' +
                        '</td>' +
                        '</tr>';

                    $('table tbody').append(newRow);
                    form.reset();
                    $('#previewImage').attr('src', '');
                    $('#previewIcon').attr('src', '');


                    $('#add_review_modal').modal('hide');
                    $('#createReviewForm')[0].reset();
                },
                error: function(error) {
                   
                    console.error('Error:', error);
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
                    }else{
                       
                        $('#add_review_modal').modal('hide');
                        $('#createReviewForm')[0].reset();
                        $('#statusErrorsModal').modal('show');
                    }
                }
            });
        });

        $('.closebut').on('click', function() {
            $('#add_review_modal').modal('hide');
            $('#createReviewForm')[0].reset();
           

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


        $('#SuccessOkBtn').click(function() {
            location.reload();
        });

        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            var image = $(this).data('image');
            var icon = $(this).data('icon');
            var name = $(this).data('name');
            var description = $(this).data('description');
            var rating = $(this).data('rating');
            var position = $(this).data('position');


            $('#editReviewForm').attr('action', '/updateReview/' + id);


            $('#previewImageEdit').attr('src', '{{ asset('reviews/') }}/' + image);
            $('#previewIconEdit').attr('src', '{{ asset('reviews/') }}/' + icon);
            $('#name_edit').val(name);
            $('#rating_edit').val(rating);
            $('#position_edit').val(position);
            $('#description_edit').val(description);
        });


        $('#updateReviewBtn').click(function() {
            var form = document.getElementById('editReviewForm');
            var formData = new FormData(form);

            $.ajax({
                type: 'POST',
                url: $('#editReviewForm').attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('.validation-errors').remove();
                    $('#statusSuccessModal').modal('show');
                    $('#editReview').modal('hide');

                   
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
        document.getElementById('iconInputEdit').addEventListener('change', function(event) {
            var input = event.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {

                    document.getElementById('previewIconEdit').src = e.target.result;
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
                url: '/review/' + appointmentIdToDelete,
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
