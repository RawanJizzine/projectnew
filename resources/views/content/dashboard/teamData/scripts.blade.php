<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#submitFormBtn').on('click', function() {
            var form = $('#addteamsdata')[0];
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
                    alert("Error Here!");
                    console.error('Error:', error);

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

        $("#open_modal_button").click(function() {
            console.log("ji");
            $("#add_team_modal").modal("show");
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
        $('#saveTeamBtn').on('click', function() {
            var form = document.getElementById('createTeamForm');
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
                    var team = data.team;
                    var newRow = '<tr>' +

                        '<td><img src="{{ asset('storage/') }}/' + team.image +
                        '" alt="Image" ></td>' +
                        '<td> <input readonly type="text" value="' + team.name +
                        '" name="name" class="form-control"> </td>' +
                        '<td> <input  readonly type="text" value="' + team.position +
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

                    $('#add_team_modal').modal('hide');
                    $('#createTeamForm')[0].reset();
                },
                error: function(error) {
                    alert('create new team data not success')
                    console.error('Error:', error);
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
                    }
                }
            });
        });

        $('.closebut').on('click', function() {
            $('#add_team_modal').modal('hide');
            $('#createTeamForm')[0].reset();
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
            var name = $(this).data('name');
            var position = $(this).data('position');
            var labelColor = $(this).data('label-color');
            var borderColor = $(this).data('border-color');

            $('#editTeamForm').attr('action', '/updateteam/' + id);
            $('#previewImageEdit').attr('src', '{{ asset('storage/') }}/' + image);
            $('#name_edit').val(name);
            $('#position_edit').val(position);

            $('#label_color_edit').val(labelColor);
            $('#border_color_edit').val(borderColor);

        });
        $('#updateTeamBtn').click(function() {
            var form = document.getElementById('editTeamForm');
            var formData = new FormData(form);

            $.ajax({
                type: 'POST',
                url: $('#editTeamForm').attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert('Data updated successfully')
                    $('#editFeature').modal('hide');
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
            var url = '/team/' + id;


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
                        alert("Data not found")
                        console.error('Error:', error);
                    }
                });
            }
        });
    });
</script>
