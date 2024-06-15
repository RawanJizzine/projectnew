@extends('layouts/commonFront')
@section('layoutContentFront')
    @include('layouts/sections/navbar/navbar-front')

    <head>
        <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
        <link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css" />
        <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">
    </head>

    <style>
        .box {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgb(255, 255, 255);
            width: 85%;
            height: auto;
            margin-left: 7.5%;
            margin-top: 6.25%;
            border-radius: 1%;
        }

        .container {
            padding-right: 1.5rem;
            padding-left: 0;
        }

        .btn-class-edit {
            padding-top: 3rem;
            padding-left: 0.8rem;
        }

        .col-md-6 {
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 40%;
        }

        .title {
            padding-top: 1rem;
            padding-left: 1rem;

            font-weight: bold;
            font-size: 2.5rem;

        }

        .text {
            padding-top: 0.4rem;
            font-size: 1.4rem;

            margin-left: 0%;
        }

        .row-edit {
            padding-top: 1rem;
            padding-left: 1rem;
        }

        @media screen and (max-width: 768px) {
            .box {
                width: 90%;
                margin-left: 5%;
                margin-top: 4%;
            }

            .col-md-6 {
                width: 100%;
            }

            .title {
                font-size: 2rem;

            }

            .text {
                font-size: 1.2rem;

            }
        }

        @media screen and (max-width: 576px) {
            .box {
                width: 95%;
                margin-left: 2.5%;
                margin-top: 3%;
            }

            .title {
                font-size: 1.8rem;
                margin-left: 0%;
            }

            .text {
                font-size: 1rem;
                margin-left: 0%;
            }
        }


        .details {
            background-color: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
        }

        .details h2 {
            margin-top: 0;
            padding-top: 3rem;
            padding-left: 0;
            font-weight: bold;
            font-size: 2.5rem;
        }

        .session-list {
            list-style-type: none;
            padding-left: 0;
            padding-top: 1rem;
        }

        .session-list li {
            margin-bottom: 5px;
            padding-top: 0.8rem;
            font-weight: 300;
            font-size: 1.2rem;
        }

        .session-list li strong {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .details p {
            margin-top: 10px;
            margin-bottom: 10px;
            font-weight: 400;
            font-size: 1.2rem;
        }

        .calendar {
            width: 100%;
            height: 300px;
        }
    </style>

    <div data-bs-spy="scroll" class="scrollspy-example">
        <!-- Hero: Start -->
        <section id="aaa">
            <div id="aaa" class="section-py landing-hero position-relative">
                <h2 style="text-align: center;  margin-top: 60px; font-size: 80px; ">{{ $appointments->title     }}</h2>
                <div class="col-lg-4 col-sm-6 box card shadow-lg">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <img height="309" width="560" src="{{ asset('images/' . $appointments->image) }}"
                                    class="img-fluid float-left" alt="Image" style="padding: 10px;">
                            </div>
                            <div class="col-md-6 card-left">
                                <h5 class="title">{{ $appointments->title     }}</h5>
                                <div class="row row-edit">
                                    <div class="col-auto">
                                        <i class="fa fa-desktop" style="font-size:24px; margin-top:3px;"   ></i>
                                    </div>
                                    <div class="col text">
                                        Online Zoom Meeting
                                    </div>
                                </div>
                                <div class="row row-edit">
                                    <div class="col-auto">
                                        <img src="{{ asset('assets/icon/tl.jpg') }}" alt="Icon"
                                            style="width: 34px; height: 40px;">
                                    </div>
                                    <div class="col text">
                                       {{ $appointments->location    }}
                                    </div>
                                </div>
                                <div class="mt-3 btn-class-edit">
                                    <a id="applyNowLink" href="{{ route('appointment.calander.page', ['id' => $appointments->id]) }}" class="btn btn-outline-primary" style="width: 170px; height: 40px;">
                                        Apply Now
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="details">
                            <h2>Details</h2>
                            <ul class="session-list">
                              
                                <li><strong>Bundle Cost:</strong> {{ $appointments->price }}$</li>
                            </ul>
                            <p>     {{ $appointments->sub_description }} </p>
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero: End -->
    </div>









    @include('layouts/sections/footer/footer-front')
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>



    <script></script>
@endsection
