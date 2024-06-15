<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $("#open_modal_button").click(function() {
                $("#add_plan_modal").modal("show");
            });
        });
        $('#submitFormBtn').on('click', function() {
            var form = $('#addplansdata')[0];
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
                    alert("save data success");
                },
                error: function(error) {
                    alert(error);
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
        $('#savePlanBtn').on('click', function() {
            var form = document.getElementById('createPlanForm');
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
                    var plan = data.plan;
                    var newRow = '<tr>' +

                        '<td><img src="{{ asset('storage/') }}/' + plan.image +
                        '" alt="Image" style="max-width: 100px; max-height: 100px;"></td>' +
                        '<td> <input readonly   type="text" value="' + plan.title +
                        '" name="title" class="form-control"> </td>' +
                        '<td> <input readonly type="number" value="' + plan.monthly_price +
                        '" name="monthly_price" class="form-control"> </td>' +
                        '<td> <input  readonly type="number" value="' + plan.yearly_price +
                        '" name="yearly_price" class="form-control"> </td>' +
                        '<td> <input  readonly type="number" value="' + plan.total_price +
                        '" name="total_price" class="form-control"> </td>' +

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
                    alert('Error Here!')
                    console.error('Error:', error);
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
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
        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            var image = $(this).data('image');
            var title = $(this).data('title');
            var monthly = $(this).data('monthly-price');
            var yearly = $(this).data('yearly-price');
            var total = $(this).data('total-price');
            var button = $(this).data('text-button');
            $('#editPlanForm').attr('action', '/updateplan/' + id);
            $('#previewImageEdit').attr('src', '{{ asset('storage/') }}/' + image);
            $('#title_edit').val(title);
            $('#monthly_edit').val(monthly);
            $('#yearly_edit').val(yearly);
            $('#total_price_edit').val(total);
            $('#text_button_edit').val(button);

        });

        $('#updatePlanBtn').click(function() {
            var form = document.getElementById('editPlanForm');
            var formData = new FormData(form);

            $.ajax({
                type: 'POST', // Use POST here
                url: $('#editPlanForm').attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('.validation-errors').remove();
                    alert('Data updated successfully')
                    $('#editPlan').modal('hide');

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
            var url = '/plandata/' + id;


            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(data) {
                        console.log(data);
                        alert('Data deleted successfully')
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


    $(document).ready(function() {
        $('#addpricingdata').on('submit', function(e) {
            e.preventDefault();


            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    alert('Data created successfully')
                    location.reload();
                    console.log(response);
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


    })
    $(document).ready(function() {

        $('#add_btn_plan').on('click', function() {
            var plan_data = @json($plan_data);
            var key = Date.now();
            var html = '';
            html += '<tr>';
            html +=
                '<td><button type="button" class="btn btn-primary" id="removeplan">-</button></td>';
            html += '<td>';
            html += '<select name="data[' + key + '][plan_name]" class="form-control">';
            plan_data.forEach(function(plan) {
                console.log('hahahaha');
                console.log(plan);
                html += '<option value="' + plan.id + '">' + plan.title + '</option>';
            });
            html += '</select>';
            html += '</td>';

            html += '<td><input type="text"   name="data[' + key +
                '][content_list]"    class="form-control" ></td>';


            html += '</tr>';
            $('#plan_table').append(html);

        })
        $(document).on('click', '#removeplan', function() {
            $(this).closest('tr').remove();
        });

    });


    $(document).ready(function() {
        var plan_data = @json($plan_data);


        $.ajax({
            type: 'GET',
            url: '{{ route('get-list-plan') }}',
            success: function(response) {
                if (response.success) {
                
                    populateTableplan(response.data);
                } else {
                    console.log('Error fetching data from the server.');
                }
            },
            error: function(error) {
                console.log(error);
                console.log('Error fetching data from the server.');
            }
        });


        function populateTableplan(data) {

            console.log(data);
            $('#plan_table').empty();

            $.each(data, function(key, item) {


                var html = '<tr>';


                html +=
                    '<td><button type="button" class="btn btn-primary remove-btn-plan">-</button></td>';
                html += '<input type="hidden" name="data[' + key + '][id]" value="' + (item.id ?
                    item
                    .id : '') + '">';
                html += '<td><select name="data[' + key + '][plan_name]" class="form-control">';
                plan_data.forEach(function(plan) {
                    var isSelectedplan = plan.id === item.plan_data_id ? 'selected' : '';
                    html += '<option value="' + plan.id + '" ' + isSelectedplan + '>' + plan
                        .title +
                        '</option>';
                });
                html += '</select></td>';


                html += '<td><input type="text" name="data[' + key +
                    '][content_list]" class="form-control" value="' + item.content_list + '"></td>';
                html += '</tr>';
                $('#plan_table').append(html);


            });
        }


        $('#plan_table').on('click', '.remove-btn-plan', function() {
            var row = $(this).closest('tr');
            var id = row.find('input[name*="[id]"]').val();

            var url = '/planlist/' + id;

            if (confirm('Are you sure you want to delete this?')) {

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        console.log("s");
                        row.remove();

                    },
                    error: function(error) {
                        console.log("error");
                        console.error('Error:', error);
                    }
                });
            }
        });



    });
</script>
