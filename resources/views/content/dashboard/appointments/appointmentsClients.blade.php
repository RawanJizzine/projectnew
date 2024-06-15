@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">


@section('content')
    <x-card>
        <x-slot name="title">
          
        </x-slot>

        <x-slot name="body">
            <div class="d-flex justify-content-between">
                <h3>Appointment of Client</h3>
                <button id="createNewAppointmentBtn" type="button" class="btn btn-primary" style="width: 170px; height: 40px;">
                    Create New Appointment
                </button>
            </div>
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Name of Session</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr data-appointment-id="{{ $appointment->id }}">
                            <td>{{ $appointment->name }}</td>
                            <td>{{ $appointment->phone }}</td>
                            <td>{{ $appointment->session_name }}</td>
                            <td>{{ $appointment->date }}</td>
                            <td>{{ $appointment->time }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary edit-btn" data-toggle="modal">Edit</a>
                                <a href="#" class="btn btn-sm btn-warning delete-btn">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>


                    
                </table>


            </div>
        </x-slot>
    </x-card>

   


@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('.delete-btn').click(function(e) {
            e.preventDefault();

            var appointmentId = $(this).closest('tr').data('appointment-id');

            $.ajax({
                type: 'DELETE',
                url: '/appointments/' + appointmentId,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                  
                    location.reload();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#createNewAppointmentBtn').click(function() {
            window.location.href = "{{ route('appointment.calander.dashboard') }}";
        });
    });
</script>


