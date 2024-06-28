@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.modal#statusSuccessModal .modal-content, 
.modal#statusErrorsModal .modal-content,
.modal#deleteSuccessModal .modal-content, 
.modal#deleteErrorModal .modal-content,
.modal#deleteConfirmationModal .modal-content {
	border-radius: 30px;
}

.modal#statusSuccessModal .modal-content svg, 
.modal#statusErrorsModal .modal-content svg,
.modal#deleteSuccessModal .modal-content svg, 
.modal#deleteErrorModal .modal-content svg,
.modal#deleteConfirmationModal .modal-content svg {
	width: 100px; 
	display: block; 
	margin: 0 auto;
}

.modal#statusSuccessModal .modal-content .path, 
.modal#statusErrorsModal .modal-content .path,
.modal#deleteSuccessModal .modal-content .path, 
.modal#deleteErrorModal .modal-content .path,
.modal#deleteConfirmationModal .modal-content .path {
	stroke-dasharray: 1000; 
	stroke-dashoffset: 0;
}

.modal#statusSuccessModal .modal-content .path.circle, 
.modal#statusErrorsModal .modal-content .path.circle,
.modal#deleteSuccessModal .modal-content .path.circle, 
.modal#deleteErrorModal .modal-content .path.circle,
.modal#deleteConfirmationModal .modal-content .path.circle {
	-webkit-animation: dash 0.9s ease-in-out; 
	animation: dash 0.9s ease-in-out;
}

.modal#statusSuccessModal .modal-content .path.line, 
.modal#statusErrorsModal .modal-content .path.line,
.modal#deleteSuccessModal .modal-content .path.line, 
.modal#deleteErrorModal .modal-content .path.line,
.modal#deleteConfirmationModal .modal-content .path.line {
	stroke-dashoffset: 1000; 
	-webkit-animation: dash 0.95s 0.35s ease-in-out forwards; 
	animation: dash 0.95s 0.35s ease-in-out forwards;
}

.modal#statusSuccessModal .modal-content .path.check, 
.modal#statusErrorsModal .modal-content .path.check,
.modal#deleteSuccessModal .modal-content .path.check, 
.modal#deleteErrorModal .modal-content .path.check,
.modal#deleteConfirmationModal .modal-content .path.check {
	stroke-dashoffset: -100; 
	-webkit-animation: dash-check 0.95s 0.35s ease-in-out forwards; 
	animation: dash-check 0.95s 0.35s ease-in-out forwards;
}

@-webkit-keyframes dash { 
	0% {
		stroke-dashoffset: 1000;
	}
	100% {
		stroke-dashoffset: 0;
	}
}

@keyframes dash { 
	0% {
		stroke-dashoffset: 1000;
	}
	100% {
		stroke-dashoffset: 0;
	}
}

@-webkit-keyframes dash-check { 
	0% {
		stroke-dashoffset: -100;
	}
	100% {
		stroke-dashoffset: 900;
	}
}

@keyframes dash-check {
	0% {
		stroke-dashoffset: -100;
	}
	100% {
		stroke-dashoffset: 900;
	}
}
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
    <div class="modal fade" id="deleteSuccessModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-lg-4">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#198754" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <polyline class="path check" fill="none" stroke="#198754" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                    </svg>
                    <h4 class="text-success mt-3">Deleted!</h4>
                    <p class="mt-3">Data has been successfully deleted.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteErrorModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-lg-4">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#dc3545" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <line class="path line" fill="none" stroke="#dc3545" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="65.1" y1="40" x2="65.1" y2="80" />
                        <line class="path line" fill="none" stroke="#dc3545" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="65.1" y1="90" x2="65.1" y2="100" />
                    </svg>
                    <h4 class="text-danger mt-3">Deletion Failed!</h4>
                    <p class="mt-3">There was an error deleting the data. Please try again.</p>
                    <button type="button" class="btn btn-sm btn-danger mt-3" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Error Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-lg-4">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#ffc107" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <line class="path line" fill="none" stroke="#ffc107" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="65.1" y1="30" x2="65.1" y2="80" />
                        <line class="path line" fill="none" stroke="#ffc107" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="65.1" y1="90" x2="65.1" y2="100" />
                    </svg>
                    <h4 class="text-warning mt-3">Are you sure?</h4>
                    <p class="mt-3">Do you really want to delete this data?</p>
                    <button type="button" class="btn btn-sm btn-danger mt-3" id="confirmDeleteBtn">Delete</button>
                    <button type="button" class="btn btn-sm btn-secondary mt-3" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {
    var button = document.getElementById('createNewAppointmentBtn');
    if (button) {
        button.addEventListener('click', function() {
            window.location.href = '/appointmentsCalanderDashboard'; // Replace '/your-target-url' with the actual URL of the page you want to redirect to
        });
    }
});
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
    let appointmentIdToDelete;
    let $rowToDelete;

    // Handle delete button click
    $('.delete-btn').on('click', function(e) {
        e.preventDefault();
        appointmentIdToDelete = $(this).closest('tr').data('appointment-id');
        $rowToDelete = $(this).closest('tr');
        $('#deleteConfirmationModal').modal('show');
    });

    // Handle confirm delete button click
    $('#confirmDeleteBtn').on('click', function() {
        if (appointmentIdToDelete) {
            $.ajax({
                url: '/appointments/' + appointmentIdToDelete,
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
        }
    });

    // Handle success modal OK button click
    $('#deleteSuccessOkBtn').on('click', function() {
        location.reload();
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
