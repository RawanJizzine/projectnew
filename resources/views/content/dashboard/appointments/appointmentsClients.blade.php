@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>

</style>
@section('content')
    <x-card>
        <x-slot name="title">
            <!-- Add any title content here -->
        </x-slot>

        <x-slot name="body">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3 ml-md-3">
                <h3 style="white-space: nowrap;">Appointment of Client</h3>
                <div class="mt-2 mt-md-0 d-flex justify-content-end justify-content-md-end w-100 w-md-auto">
                    <button id="createNewAppointmentBtn" type="button" class="btn btn-primary mr-md-2 mb-2 mb-md-0"
                        style="width: 150px; height: 40px;">
                        Create New Appointment
                    </button>

                    <a href="{{ route('appointment-availability') }}" class="btn btn-primary"
                        style="width: 150px; height: 40px; margin-left: 1rem;">
                        Appointment Availability
                    </a>
                </div>
            </div>
            <div class="table-responsive ml-md-3">
                <div class="mb-3">
                    <input id="searchInput" type="text" class="form-control" placeholder="Search for appointments...">
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Name of Session</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="appointmentsTable">
                        @foreach ($appointments as $appointment)
                            <tr data-appointment-id="{{ $appointment->id }}">
                                <td>{{ $appointment->name }}</td>
                                <td>{{ $appointment->phone }}</td>
                                <td>{{ $appointment->session_name }}</td>
                                <td>{{ $appointment->date }}</td>
                                <td>{{ $appointment->time }}</td>
                                <td id="status-{{ $appointment->id }}">
                                    <button type="button" class="btn btn-sm" style="width: 80px; height: 40px; background: {{ $appointment->status === 'pending' ? 'red' : 'green' }}; color: white;" onclick="markAsCompleted({{ $appointment->id }})">{{ $appointment->status }}</button>
                                </td>
                                <td>
                                    
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

function markAsCompleted(appId) {
    fetch(`/appDashboard/${appId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token if not already included
        },
        body: JSON.stringify({})
    })
    .then(response => {
        if (response.ok) {
            // Optionally, update UI to reflect the change
            location.reload(); // Reload the page to see the updated status
        } else {
            console.error('Failed to mark appointment as completed');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

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
                    rowToDelete.remove(); // Remove the row from the table
                    alert('Appointment deleted successfully.');

                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        $('#createNewAppointmentBtn').click(function() {
            window.location.href = "{{ route('appointment.calander.dashboard') }}";
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input = document.getElementById('searchInput');
            var filter = input.value.toLowerCase();
            var table = document.getElementById('appointmentsTable');
            var tr = table.getElementsByTagName('tr');

            for (var i = 0; i < tr.length; i++) {
                var tdName = tr[i].getElementsByTagName('td')[0];
                var tdPhone = tr[i].getElementsByTagName('td')[1];
                var tdSession = tr[i].getElementsByTagName('td')[2];
                var tdDate = tr[i].getElementsByTagName('td')[3];
                var tdTime = tr[i].getElementsByTagName('td')[4];

                if (tdName || tdPhone || tdSession || tdDate || tdTime) {
                    var textValue = (tdName.textContent || tdName.innerText) + " " +
                        (tdPhone.textContent || tdPhone.innerText) + " " +
                        (tdSession.textContent || tdSession.innerText) + " " +
                        (tdDate.textContent || tdDate.innerText) + " " +
                        (tdTime.textContent || tdTime.innerText);

                    if (textValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        });
    });
</script>
