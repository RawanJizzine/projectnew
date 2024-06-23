@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>

</style>

@section('content')
    <div style="margin-top: 2%;" class="d-flex justify-content-between flex-wrap">
        <h3>Appointment Availability</h3>
        <button type="button" class="btn btn-primary" style=" margin-right:0%;     width: 150px; height: 40px;"
            data-target="#add_appointment_modal" data-toggle="modal">
            Create
        </button>
    </div>

    <x-card>
        <x-slot name="body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointment ?? [] as $index => $data)
                            <tr>
                               
                                <td>
                                    <input type="text" value="{{ $data->place }}" name="title"
                                        class="form-control" readonly>
                                </td>
                                <td>
                                    <input type="text" value="{{ $data->date }}" name="location"
                                        class="form-control" readonly>
                                </td>
                                <td>
                                    <input type="text" value="{{ $data->time }}" name="price"
                                        class="form-control" readonly>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary edit-btn" data-toggle="modal"
                                        data-target="#editAppointment" data-id="{{ $data->id }}"
                                        data-place="{{ $data->place }}" data-date="{{ $data->date }}"
                                        data-time="{{ $data->time }}" 
                                        >
                                        Edit
                                    </a>
                                    <a href="#" data-id="{{ $data->id }}" data-target="#deleteappointmentModal"
                                        class="btn btn-sm btn-warning delete-btn">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="editAppointment" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        </div>
                        <form id="editAppointmentForm" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                               
                               
                                <div class="form-group">
                                    <label for="place_edit" class="form-label">Appointment location</label>
                                    <textarea name="place_edit" id="place_edit" class="form-control" rows="4" required></textarea>
                                </div>
                                <div class="form-group">
                                    <x-input type="date" label="Date" id="date_edit" name="date_edit"
                                        class="form-control" required="true" />
                                </div>
                                <div class="form-group">
                                    <x-input type="time" label="Time" id="time_edit" name="time_edit"
                                        class="form-control" required="true" />
                                </div>
                                <input type="hidden" name="id_edit" id="id_edit">
                               
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="updateAppBtn">Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-card>


    <div class="modal fade" id="add_appointment_modal" tabindex="-1" role="dialog"
        aria-labelledby="addAppointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="addFeatureModalLabel">Create New Appointment Availability</h1>
                </div>
                <form id="createAppointmentForm" action="{{ route('save-appointment-availability') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">


                        <div class="form-group">
                            <label for="app" class="form-label"> location</label>
                            <textarea type="text"  name="place" class="form-control" required="true">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <x-input type="date" label="Date" name="date" class="form-control" required="true" />
                        </div>


                        <div class="form-group">
                            <x-input type="time" label="Time" name="time" class="form-control" required="true" />
                        </div>
                       
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="saveappointmentBtn">Save</button>
                        <button type="button" class="btn btn-secondary closebut" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $("#open_modal_button").click(function() {
            console.log("ji");
            $("#add_appointment_modal").modal("show");
        });
    });
    $(document).ready(function() {
        var itemCount = 0;
        $('#saveappointmentBtn').on('click', function() {
            var form = document.getElementById('createAppointmentForm');
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
                    alert('Data created successfully');
                    var app = data.app;
                    itemCount++;
                    var newRow = '<tr>' +
                    '<td><input type="text" value="' + app.place + '" name="place" class="form-control" readonly></td>' +
                    '<td><input type="text" value="' + app.date + '" name="date" class="form-control" readonly></td>' +
                    '<td><input type="text" value="' + app.time + '" name="time" class="form-control" readonly></td>' +
                    '<td>' +
                    '<a href="#" class="btn btn-sm btn-primary edit-btn" data-toggle="modal" data-target="#editFeature" data-id="' + app.id + '" data-place="' + app.place + '" data-date="' + app.date + '" data-time="' + app.time + '">Edit</a> ' +
                    '<a href="#" data-id="' + app.id + '" data-target="#deleteappointmentModal" class="btn btn-sm btn-warning delete-btn">Delete</a>' +
                    '</td>' +
                    '</tr>';

                    $('table tbody').append(newRow);
                    form.reset();
                   

                    $('#add_appointment_modal').modal('hide');
                    $('#createAppointmentForm')[0].reset();
                },
                error: function(error) {

                    console.error('Error:', error);
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
                    }
                    alert('Error Here!')
                }
            });
        });

        $('.closebut').on('click', function() {
            $('#add_appointment_modal').modal('hide');
            $('#createAppointmentForm')[0].reset();


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
        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            var place = $(this).data('place');
            var date = $(this).data('date');
            var time= $(this).data('time');
           
            
            
            $('#editAppointmentForm').attr('action', '/updateappavailability/' + id);
            $('#id_edit').val(id);
            $('#place_edit').val(place);
            $('#date_edit').val(date);
            $('#time_edit').val(time);
           

        });

        $('#updateAppBtn').click(function() {
            var form = document.getElementById('editAppointmentForm');
            var formData = new FormData(form);

            $.ajax({
                type: 'POST', // Use POST here
                url: $('#editAppointmentForm').attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('.validation-errors').remove();
                    alert('Data updated successfully')
                    $('#editAppointment').modal('hide');
                    location.reload();
                },
                error: function(error) {

                    console.error('Error:', error);
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
                    }
                    alert('Error Here!')
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

       
    });

    $(document).ready(function() {
        $(".delete-btn").on("click", function() {
            var $rowToDelete = $(this).closest('tr');
            var id = $(this).data('id');
            var url = '/deleteappavailability/' + id;
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
                        alert('Data deleted successfully');
                    },
                    error: function(error) {
                        alert('Error Here!')
                        console.error('Error:', error);
                    }
                });
            }
        });
    });
</script>
