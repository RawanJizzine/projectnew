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
                    alert("send Message Successfully")

                },
                error: function(error) {
                    alert('You cannot send a message because there are no emails!');
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
                var container = input.closest('.form-control');
                $.each(messages, function(index, message) {
                    container.append('<p class="text-danger validation-errors">' + message +
                        '</p>');
                });
            });
        }
    });
</script>
