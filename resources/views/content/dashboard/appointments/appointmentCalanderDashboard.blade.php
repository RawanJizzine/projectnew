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
</style>

@section('content')
    <x-card>
        <x-slot name="title">

        </x-slot>

        <x-slot name="body">

            <form action="{{ route('appointments.store') }}" method="POST">
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

</script>
