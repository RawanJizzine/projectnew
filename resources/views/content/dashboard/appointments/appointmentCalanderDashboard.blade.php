@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .product-img {
        float: left;
        width: 45%;
        /* Adjusted width for responsiveness */
    }

    .product-img img {
        width: 100%;
        /* Made image responsive within its container */
        border-radius: 7px 0 0 7px;
    }

    .product-info {

        float: left;
        height: 50rem;
        /* Fixed height */
        width: 90%;
        /* Adjusted width for responsiveness */
        background-color: #ffffff;
        border-radius: 0 7px 7px 0;
        overflow-y: auto;
        /* Adds a scrollbar if content overflows */
        overflow-x: hidden;
        /* Prevents horizontal overflow */
    }

    .product-text {
        padding: 20px;
        background-color: #ffffff;
        width: 100%;
        /* Ensures full width of the container */
        max-width: 600px;
        height: 468px;
        /* Fixed maximum width */
        box-sizing: border-box;
        /* Includes padding in the width calculation */
        margin: 0 auto;
        /* Centers the element horizontally */
        color: #fff;

        /* Added padding for better spacing */
    }

    .product-text h1 {
        font-size: 24px;
        /* Adjusted font size for better readability */
        margin-bottom: 10px;
        /* Added margin for better spacing */
    }

    .product-text h2 {
        font-size: 14px;
        /* Adjusted font size for better readability */
        margin-bottom: 20px;
        /* Added margin for better spacing */
        text-transform: uppercase;
        color: #d2d2d2;
        letter-spacing: 0.2em;
    }

    .product-text p {
        font-size: 14px;
        /* Adjusted font size for better readability */
        color: #8d8d8d;
        line-height: 1.5em;
        margin-bottom: 20px;
        /* Added margin for better spacing */
    }

    .button-here {
        float: right;
        display: inline-block;
        height: 50px;
        width: 176px;

        box-sizing: border-box;
        border: transparent;
        border-radius: 60px;
        font-family: 'Raleway', sans-serif;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: #ffffff;
        background-color: #9cebd5;
        cursor: pointer;
        outline: none;
    }

    .text-here {


        font-family: 'Playfair Display', serif;
        color: #8d8d8d;

        font-size: 30px;
        font-weight: bold;

    }



    @media screen and (max-width: 768px) {
        .wrapper {
            max-width: 100%;
            /* Adjusted max-width for smaller screens */
        }

        .product-img,
        .product-info {
            width: 100%;
            /* Made product info and image full width for smaller screens */
            float: none;
            /* Removed float for better stacking */
        }

        .product-img img {
            border-radius: 7px 7px 0 0;
            /* Adjusted border radius for better appearance */
        }

        .product-price-btn button {
            width: 60%;
            margin: 0 10px 0 0;


            /* Made button full width for smaller screens */
        }



    }

    .calanderstyle {


        width: 350px;
        height: 380px;
    }

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

        </x-slot>

        <x-slot name="body">

            <form  id="appointmentForm"      action="{{ route('appointments.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="inst_date">Select Date</label>
                    <div class="calanderstyle" id="calendar"></div>
                    <input type="hidden" id="selectedDate" name="selectedDate">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <select name="location" id="location" class="form-control" required>
                        <option value="">Select Location</option>
                        @foreach ($appointmentsplace as $place)
                            <option value="{{ $place->place }}">{{ $place->place }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="margin-top: 1%;" class="form-group">
                    <label for="time">Time</label>
                    <select name="time" id="time" class="form-control" required>
                        <option value="">Select Time</option>
                    </select>
                </div>
                <div style="margin-top: 1%;" class="form-group">
                    <label for="client_name">Client Name</label>
                    <input type="text" name="client_name" id="client_name" class="form-control" required>
                </div>
                <div style="margin-top: 1%;" class="form-group">
                    <label for="client_phone">Client Phone</label>
                    <input type="phone" name="client_phone" id="client_phone" class="form-control" required>
                </div>
                <div style="margin-top: 1%;" class="form-group">
                    <label for="name_session">Name Of Session</label>

                    <select id="name_session" name="name_session" class="form-control select2 ">
                        @foreach ($appointment as $feature)
                            <option value="{{ $feature->title }}">{{ $feature->title }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" style="margin-left: 38%; margin-top:5%;" class="btn btn-primary">Book
                    Appointment</button>
            </form>

        </x-slot>
    </x-card>


    <div class="modal fade" id="statusErrorsModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-lg-4">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#db3646" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3" />
                        <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2" />
                    </svg>
                    <h4 class="text-danger mt-3">Error!</h4>
                    <p class="mt-3">An error occurred while saving data.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-danger" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="statusSuccessModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"> 
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document"> 
            <div class="modal-content"> 
                <div class="modal-body text-center p-lg-4"> 
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#198754" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <polyline class="path check" fill="none" stroke="#198754" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " /> 
                    </svg> 
                    <h4 class="text-success mt-3">Oh Yeah!</h4> 
                    <p class="mt-3">You have successfully saved data.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal" id="SuccessOkBtn">Ok</button> 
                </div> 
            </div> 
        </div> 
    </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />

<script>
   $(document).ready(function($) {
    var officialHolidays = {!! json_encode($officialHolidays) !!};
    var today = moment().format('YYYY-MM-DD');

$('#selectedDate').val(today);
    $('#calendar').fullCalendar({
        initialView: 'dayGridMonth',
        selectable: true,
        select: function(start, end, jsEvent, view) {
            const selectedDateStr = start.format('YYYY-MM-DD');
            $('#selectedDate').val(selectedDateStr);
            
            $.ajax({
                url: '/get-available-location',
                method: 'POST',
                data: {
                    date: selectedDateStr,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    const locations = response.locations;
                    const select = $('#location');
                    select.empty();
                    select.append('<option value="">Select Location</option>');
                    locations.forEach(function(location) {
                        const place = location.place;
                        select.append(`<option value="${place}">${place}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        },
        dayRender: function(date, cell) {
            const isoDate = date.format('YYYY-MM-DD');
            const holiday = officialHolidays[isoDate];
            if (holiday) {
                cell.css('background-color', 'red');
                cell.append(`<span style="color: white">${holiday}</span>`);
            }
            if (date.day() === 0) { // Sunday
                cell.css('background-color', 'blue');
            }
        }
    });

    $('#location').change(function() {
        const selectedDate = $('#selectedDate').val();
        
        const selectedLocation = $(this).val();

        if (selectedDate && selectedLocation) {
            $.ajax({
                url: '{{ route('get-times') }}',
                method: 'POST',
                data: {
                    date: selectedDate,
                    location: selectedLocation,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    const times = response.times;
                    const select = $('#time');
                    select.empty();
                    select.append('<option value="">Select Time</option>');
                    times.forEach(function(time) {
                      console.log(time.time)
                        select.append(`<option value="${time.time}">${time.time}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }
    });
});
$(document).ready(function() {
    $('#appointmentForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function(response) {
                // Handle success
                $('.validation-errors').remove();
                    $('#statusSuccessModal').modal('show');
                   
                // Optionally, you can clear the form or update the UI as needed
            },
            error: function(response) {
                // Handle error
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
});
</script>
