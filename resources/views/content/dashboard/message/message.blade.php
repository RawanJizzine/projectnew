@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    @media (max-width: 576px) {
        #sendMessage {
            padding: 10px;
            
        }

        #sendMessage textarea {
            width: 100%;
         
        }

        .btn {
            width: 100%;
            margin-top: 1rem;
           
        }
    }
    .btn {
          
            margin-top: 1rem;
           
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
        Send New Letter To Subscriber
    </x-slot>

    <x-slot name="body">
        <form id="sendMessage" action="{{ route('send.email') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea name="message" rows="6" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="submit">Send to Emails</button>
        </form>
    </x-slot>
</x-card>

    <x-card>
        <x-slot name="title">
            Book Appointment
        </x-slot>

        <x-slot name="body">
            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="inst_date">Select Date</label>
                    <div id="calendar" style="height: 400px; width: 420px;"></div>
                    <input type="hidden" id="selectedDate" name="selectedDate">
                </div>
                <div class="form-group">
                    <label for="time">Time</label>
                    <select name="time" id="time" class="form-control" required>
                        <option value="">Select Time</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="client_name">Client Name</label>
                    <input type="text" name="client_name" id="client_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="client_phone">Client Phone</label>
                    <input type="phone" name="client_phone" id="client_phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="name_session">Name Of Session</label>
                    <input type="name_session" name="name_session" id="name_session" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Book Appointment</button>
            </form>
        </x-slot>
    </x-card>

    <div class="modal fade" id="statusErrorsModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-lg-4">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                    <circle class="path circle" fill="none" stroke="#db3646" stroke-width="6" stroke-miterlimit="10"
                        cx="65.1" cy="65.1" r="62.1" />
                    <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round"
                        stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3" />
                    <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round"
                        stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2" />
                </svg>
                <h4 class="text-danger mt-3">Error!</h4>
                <p class="mt-3">An error occurred while send email.</p>
                <button type="button" class="btn btn-sm mt-3 btn-danger" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="statusSuccessModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-lg-4">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                    <circle class="path circle" fill="none" stroke="#198754" stroke-width="6"
                        stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                    <polyline class="path check" fill="none" stroke="#198754" stroke-width="6"
                        stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                </svg>
                <h4 class="text-success mt-3">Oh Yeah!</h4>
                <p class="mt-3">You have successfully send email.</p>
                <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal"
                    id="SuccessOkBtn">Ok</button>
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
    var officialHolidays = {!! json_encode($officialHolidays)!!};

    var fullCalendar = $('#calendar').fullCalendar({
        initialView: 'dayGridMonth',
        selectable: true,
        select: (info) => {
            const selectedDate = info._d;
            const selectedDateStr = selectedDate.toISOString().slice(0, 10);
            $('#selectedDate').val(selectedDateStr);

            $.ajax({
                url: '/get-available-times',
                method: 'POST',
                data: {
                    date: selectedDateStr,
                    _token: '{{ csrf_token() }}'
                },
                success: (response) => {
                    const times = response.times;
                    const select = $('#time');
                    select.empty();
                    select.append('<option value="">Select Time</option>');
                    times.forEach((time) => {
                        select.append(`<option value="${time}">${time}</option>`);
                    });
                },
                error: (xhr, status, error) => {
                    console.error('AJAX Error:', error);
                }
            });
        },

        events: function(info, successCallback, failureCallback) {

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

    $('#calendarDate').change(function() {
        fullCalendar.fullCalendar('gotoDate', $(this).val());
    });
});
    $(document).ready(function() {
        $('#sendMessage').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    $('.validation-errors').remove();


$('#statusSuccessModal').modal('show');
$('#addNewPatientInfo')[0].reset();

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
        });

        function displayValidationErrors(errors) {

            $('.validation-errors').remove();


            $.each(errors, function(field, messages) {
                var input = $('[name="' + field + '"]');
                var container = input.closest('.form-control');
                $.each(messages, function(index, message) {
                    container.append('<p class="text-danger validation-errors">' + message +
                        '</p>');
                });
            });
        }
    });
</script>
