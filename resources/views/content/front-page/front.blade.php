@section('title', 'Landing Page ')

@extends('layouts/layoutFront')
@section('contentFront')

    <style>
        .product-categories {
            margin: 2rem 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 1rem;
        }

        .category-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .category-item {
            flex-basis: calc(33.33% - 2rem);
            margin: 1rem;
            text-align: center;
        }

        .category-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            margin-bottom: 0.5rem;
        }

        .category-name {
            margin: 0;
            font-size: 1.2rem;
        }

        .category-link {
            color: #333;
            text-decoration: none;
        }

        .category-link:hover {
            text-decoration: underline;
        }


        .features-icon-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgb(255, 255, 255);
            width: 27%;
            margin-right: 2%;
            height: 500px;
            margin-left: 50px;
        }

        .description-text {
            font-weight: 400;
            font-size: 100%;
        }

        .title-text {
            font-weight: 900;
            font-size: 200%;
        }

        .features-icon-box img {
            width: 100%;
            height: auto;
            max-width: 390px;
        }

        .read-more-link {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            font-weight: 900;
        }

        @media screen and (max-width: 992px) {
            .features-icon-box {
                width: 40%;
                /* Adjusted width for medium screens */
            }
        }

        @media screen and (max-width: 768px) {
            .features-icon-box {
                width: 60%;
                /* Adjusted width for small screens */
            }
        }

        @media screen and (max-width: 576px) {
            .features-icon-box {
                width: 80%;
                /* Adjusted width for extra small screens */
                margin-left: 10%;
                /* Adjusted left margin for better centering */
                margin-right: 10%;
                /* Adjusted right margin for better centering */
            }
        }

        .tab-wrapper {
            overflow-x: scroll;
            white-space: nowrap;
            position: relative;
        }

        .tab-inner-wrapper {
            transition: transform 0.25s ease;
        }

        .tab-item {
            display: inline-block;
            margin-right: 16px;
        }

        .text-wrapper {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .next {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            background-color: #f2f2f2;
            cursor: pointer;
        }

        .arrow {
            width: 16px;
            height: 16px;
            background-image: url('arrow.png');
            background-size: cover;
        }

        .show {
            display: block;
        }


        /* hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh */
        .content {
            margin-left: 34px;
        }

        .title-categori {

            font-size: 1.875rem;
            margin-top: 5vh;
            background-color: #ffffff;
            padding: 1rem;


        }

        @media only screen and (max-width: 767px) {
            .title-categori {
                font-size: 1.5rem;
                margin-left: 1rem;
                /* 24px */
            }
        }

        .content-cat {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 110px;

            padding-right: 150px;

        }

        /* Styles for smaller screens */
        @media only screen and (max-width: 767px) {
            .content-cat {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
                padding-right: 10px;
                padding-left: 13px;
            }
        }

        .category {

            width: calc(50% - 20px);
            max-width: 190px;
            height: 75px;
            margin: 10px;
            padding: 12px;
            border-radius: 15px;
            text-align: center;
            display: flex;
            flex-direction: row;
            align-items: center;
            background-color: #d9d213;
            /* Default background color */
        }


        .category:nth-child(2n) {
            background-color: #162797;
            /* Alternate background color */
        }



        .category-title {
            font-size: 20px;
            color: #333;
        }

        @media only screen and (max-width: 767px) {
            .category {
                width: calc(100% - 20px);
            }
        }

        .product {
            background: #c45688;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px;
            padding-top: 100%;
            margin-left: 1%;
            margin-right: 2%;
            margin-top: 4%;
        }

        /* ya houssein ya habibi ya houssein ya habibi ya houssein ya habibi ya houssein ya habibi  */
        .hthree {
            text-align: center;
            font-size: 30px;
            margin: 0;
            padding-top: 10px;
        }

        .aClass {
            text-decoration: none;

        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
            justify-content: center;
            align-items: center;
            margin: 50px 0;
        }

        .content-product {
            width: 20%;
            margin: 15px;
            box-sizing: border-box;
            float: left;
            text-align: center;
            border-radius: 20px;
            cursor: pointer;
            padding-top: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
            transition: .4s;
           

        }

      
        .imgClass {
            width: 200px;
            height: 200px;
            text-align: center;
            margin: 0 auto;
            display: block;
        }

        .pClass {
            text-align: center;
            color: #b2bec3;
            padding-top: 0 8px;
        }

        .hClass {
            font-size: 26px;
            text-align: center;
            color: #222f3e;
            margin: 0;
        }

        .ulClass {
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-left: 0px;
        }

        .liClass {
            padding-top: 5px;
        }

        .fa {
            font-size: 26px;
            transition: .4s;
            margin: 3px;

        }

        .checked {
            color: #ff9f43;
        }

        .fa:hover {
            transform: scale(1.3);
            transition: .6s;

        }

        .buttonClass {
            text-align: center;
            font-size: 24px;
            color: #fff;
            width: 100%;
            padding: 15px;
            border: 0;
            outline: none;
            cursor: pointer;
            margin-top: 5px;
            border-bottom-right-radius: 20px;
            border-bottom-left-radius: 20px;
        }
        .buttonClass:hover {
            background: #fbdddd;/* Color change on hover */
}
        .buy-1 {
            background-color: #7367f0;
        }

        .buy-2 {
            background-color: #3b3e6e;
        }

        .buy-3 {
            background-color: #0b0b0b;
        }

        .buy-4 {
            background-color: #ff9f43;
        }

        @media (max-width:1000px) {
            .content-product {
                width: 45%;
            }
        }

        @media(max-width:750px) {
            .content-product {
                width: 100%;
            }
        }


        .category.border {
            border: 2px solid #7367f0;

        }

        .arroww {
            font-size: 60px;
            padding-left: 1%;
        }
    </style>




    <div data-bs-spy="scroll" class="scrollspy-example">


        <!-- Useful Hero: Start -->
        @if ($home)
            <section id="hero-animation">
                <div id="landingHero" class="section-py landing-hero position-relative">
                    <div class="container">
                        <div class="hero-text-box text-center">
                            <h1 class="text-primary hero-title display-6 fw-bold">{{ $home->title ?? '' }}</h1>
                            <h2 class="hero-sub-title h6 mb-4 pb-1">
                                {{ $home->main_description ?? '' }}<br class="d-none d-lg-block" />
                                {{ $home->secondary_description ?? '' }}.
                            </h2>
                            <div class="landing-hero-btn d-inline-block position-relative">
                                <span class="hero-btn-item position-absolute d-none d-md-flex text-heading">Join community
                                    <img src="../../assets/img/front-pages/icons/Join-community-arrow.png"
                                        alt="Join community arrow" class="scaleX-n1-rtl" /></span>
                                <a href="#landingPricing" class="btn btn-primary btn-lg">{{ $home->button_text ?? '' }}</a>
                            </div>
                        </div>
                        <div id="heroDashboardAnimation" class="hero-animation-img">
                            <a href="#landingPricing" target="_blank">
                                <div id="heroAnimationImg" class="position-relative hero-dashboard-img">

                                    <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
                                        <img src="{{ explode('/', $home->image_link_dashboard)[0] === 'uploads' ? asset('storage/' . $home->image_link_dashboard) : asset($home->image_link_dashboard) }}"
                                            alt="hero dashboard" class="animation-img">


                                        <img src="{{ explode('/', $home->image_link_element)[0] === 'uploads' ? asset('storage/' . $home->image_link_element) : asset($home->image_link_element) }}"alt="hero elements"
                                            alt="hero elements"
                                            class="position-absolute hero-elements-img animation-img top-0 start-0" />
                                    </div>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="landing-hero-blank"></div>
            </section>
        @endif

        <!-- Hero: End -->


        <!-- Useful features: Start -->
        @if ($enter_auth === 'true')
            @if (auth()->check() &&
                    (auth()->user()->role == 'admin' ||
                        (auth()->user()->role == 'user' &&
                            ($subscription && in_array($subscription->plan_name, ['plan 1', 'plan 2', 'plan 3'])))))
                @if ($feature)
                    <section id="landingFeatures" class="section-py landing-features">
                        <div class="container">
                            <div class="text-center mb-3 pb-1">
                                <span class="badge bg-label-primary">{{ $feature->title ?? '' }}</span>
                            </div>
                            <h3 class="text-center mb-1">
                                <span class="section-title">{{ $feature->main_description ?? '' }}</span>
                                {{ $feature->secondary_description ?? '' }}
                            </h3>
                            <p class="text-center mb-3 mb-md-5 pb-3">
                                {{ $feature->tertiary_description ?? '' }}
                            </p>
                            @if ($feature_data)
                                <div class="features-icon-wrapper row gx-0 gy-4 g-sm-5">
                                    @foreach ($feature_data ?? [] as $item)
                                        <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                                            <div class="text-center mb-3">

                                                <img height="50" width="80"
                                                    src="{{ explode('/', $item['image'])[0] === 'uploads' ? asset('storage/' . $item['image']) ?? '' : asset('images/' . $item['image']) ?? '' }}"
                                                    alt="Icon" />
                                            </div>
                                            <h5 class="mb-3">{{ $item['title'] }}</h5>
                                            <p class="features-icon-description">
                                                {{ $item['description'] }}
                                            </p>
                                        </div>
                                    @endforeach

                                </div>
                            @endif
                        </div>
                    </section>
                @endif

            @endif
        @else
            @if ($feature)
                <section id="landingFeatures" class="section-py landing-features">
                    <div class="container">
                        <div class="text-center mb-3 pb-1">
                            <span class="badge bg-label-primary">{{ $feature->title ?? '' }}</span>
                        </div>
                        <h3 class="text-center mb-1">
                            <span class="section-title">{{ $feature->main_description ?? '' }}</span>
                            {{ $feature->secondary_description ?? '' }}
                        </h3>
                        <p class="text-center mb-3 mb-md-5 pb-3">
                            {{ $feature->tertiary_description ?? '' }}
                        </p>
                        @if ($feature_data)
                            <div class="features-icon-wrapper row gx-0 gy-4 g-sm-5">
                                @foreach ($feature_data ?? [] as $item)
                                    <div class="col-lg-4 col-sm-6 text-center features-icon-box card  shadow-lg  ">
                                        <div class="text-center mb-3">

                                            <img src="{{ explode('/', $item['image'])[0] === 'uploads' ? asset('storage/' . $item['image']) ?? '' : asset('images/' . $item['image']) ?? '' }}"
                                                alt="Icon" />
                                        </div>
                                        <h5 class="mb-3 title-text ">{{ $item['title'] }}</h5>
                                        <p class="features-icon-description description-text">
                                            {{ $item['sub_description'] }}
                                        </p>
                                        <a href="{{ route('appointment-page', $item['id'] ) }}" class="read-more-link">READ MORE</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </section>
            @endif

        @endif
        <!-- Useful features: End -->






        <!-- Useful Reviews: Start -->
        @if ($enter_auth === 'true')
            @if (auth()->check() &&
                    (auth()->user()->role == 'admin' ||
                        (auth()->user()->role == 'user' && ($subscription && in_array($subscription->plan_name, ['plan 3'])))))
                @if ($reviews)
                    <section id="landingReviews" class="section-py bg-body landing-reviews pb-0">
                        <!-- What people say slider: Start -->
                        <div class="container">
                            <div class="row align-items-center gx-0 gy-4 g-lg-5">
                                <div class="col-md-6 col-lg-5 col-xl-3">
                                    <div class="mb-3 pb-1">
                                        <span class="badge bg-label-primary">{{ $reviews->title ?? '' }}</span>
                                    </div>
                                    <h3 class="mb-1"><span
                                            class="section-title">{{ $reviews->first_description_review ?? '' }}</span>
                                    </h3>
                                    <p class="mb-3 mb-md-5">
                                        {{ $reviews->second_description_review ?? '' }}<br class="d-none d-xl-block" />
                                        {{ $reviews->tertiary_description_review ?? '' }}
                                    </p>
                                    <div class="landing-reviews-btns">
                                        <button id="reviews-previous-btn"
                                            class="btn btn-label-primary reviews-btn me-3 scaleX-n1-rtl" type="button">
                                            <i class="ti ti-chevron-left ti-sm"></i>
                                        </button>
                                        <button id="reviews-next-btn"
                                            class="btn btn-label-primary reviews-btn scaleX-n1-rtl" type="button">
                                            <i class="ti ti-chevron-right ti-sm"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-7 col-xl-9">
                                    <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
                                        <div class="swiper" id="swiper-reviews">
                                            @if ($review_data)
                                                <div class="swiper-wrapper">

                                                    @foreach ($review_data ?? [] as $key => $review)
                                                        <div class="swiper-slide">
                                                            <div class="card h-100">
                                                                <div
                                                                    class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                                    <div class="mb-3">
                                                                        <img src="{{ explode('/', $review['image'])[0] === 'uploads' ? asset('storage/' . $review['image']) ?? '' : asset($review['image']) ?? '' }}"
                                                                            alt="client logo"
                                                                            class="client-logo img-fluid" />
                                                                    </div>
                                                                    <p>
                                                                        {{ $review['description'] }}
                                                                    </p>
                                                                    <div class="text-warning mb-3">
                                                                        @for ($i = 1; $i <= 5; $i++)
                                                                            @if ($i <= $review['rating'])
                                                                                <i class="ti ti-star-filled ti-sm"></i>
                                                                            @else
                                                                                <i class="ti ti-star ti-sm"></i>
                                                                            @endif
                                                                        @endfor
                                                                    </div>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="avatar me-2 avatar-sm">
                                                                            <img src="{{ explode('/', $review['icon'])[0] === 'uploads' ? asset('storage/' . $review['icon']) ?? '' : asset($review['icon']) ?? '' }}"
                                                                                alt="Avatar" class="rounded-circle" />
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="mb-0">{{ $review['name'] }}</h6>
                                                                            <p class="small text-muted mb-0">
                                                                                {{ $review['position'] }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            @endif
                                            <div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- What people say slider: End -->
                        <hr class="m-0" />












                        <!-- Logo slider: Start -->
                        @if ($logosdata)
                            <div class="container">
                                <div class="swiper-logo-carousel py-4 my-lg-2">
                                    <div class="swiper" id="swiper-clients-logos">
                                        <div class="swiper-wrapper">

                                            @foreach ($logosdata ?? [] as $logo)
                                                <div class="swiper-slide">

                                                    <img src="{{ explode('/', $logo['image'])[0] === 'uploads' ? asset('storage/' . $logo['image']) ?? '' : asset($logo['image']) ?? '' }}"
                                                        alt="client logo" class="client-logo" />
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- Logo slider: End -->
                    </section>
                @endif

            @endif
        @else
            @if ($reviews)
                <section id="landingReviews" class="section-py bg-body landing-reviews pb-0">
                    <!-- What people say slider: Start -->
                    <div class="container">
                        <div class="row align-items-center gx-0 gy-4 g-lg-5">
                            <div class="col-md-6 col-lg-5 col-xl-3">
                                <div class="mb-3 pb-1">
                                    <span class="badge bg-label-primary">{{ $reviews->title ?? '' }}</span>
                                </div>
                                <h3 class="mb-1"><span
                                        class="section-title">{{ $reviews->first_description_review ?? '' }}</span>
                                </h3>
                                <p class="mb-3 mb-md-5">
                                    {{ $reviews->second_description_review ?? '' }}<br class="d-none d-xl-block" />
                                    {{ $reviews->tertiary_description_review ?? '' }}
                                </p>
                                <div class="landing-reviews-btns">
                                    <button id="reviews-previous-btn"
                                        class="btn btn-label-primary reviews-btn me-3 scaleX-n1-rtl" type="button">
                                        <i class="ti ti-chevron-left ti-sm"></i>
                                    </button>
                                    <button id="reviews-next-btn" class="btn btn-label-primary reviews-btn scaleX-n1-rtl"
                                        type="button">
                                        <i class="ti ti-chevron-right ti-sm"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-7 col-xl-9">
                                <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
                                    <div class="swiper" id="swiper-reviews">
                                        @if ($review_data)
                                            <div class="swiper-wrapper">

                                                @foreach ($review_data ?? [] as $key => $review)
                                                    <div class="swiper-slide">
                                                        <div class="card h-100">
                                                            <div
                                                                class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                                <div class="mb-3">
                                                                    <img src="{{ explode('/', $review['image'])[0] === 'uploads' ? asset('storage/' . $review['image']) ?? '' : asset($review['image']) ?? '' }}"
                                                                        alt="client logo" class="client-logo img-fluid" />
                                                                </div>
                                                                <p>
                                                                    {{ $review['description'] }}
                                                                </p>
                                                                <div class="text-warning mb-3">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $review['rating'])
                                                                            <i class="ti ti-star-filled ti-sm"></i>
                                                                        @else
                                                                            <i class="ti ti-star ti-sm"></i>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar me-2 avatar-sm">
                                                                        <img src="{{ explode('/', $review['icon'])[0] === 'uploads' ? asset('storage/' . $review['icon']) ?? '' : asset($review['icon']) ?? '' }}"
                                                                            alt="Avatar" class="rounded-circle" />
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-0">{{ $review['name'] }}</h6>
                                                                        <p class="small text-muted mb-0">
                                                                            {{ $review['position'] }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        @endif
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- What people say slider: End -->
                    <hr class="m-0" />












                    <!-- Logo slider: Start -->
                    @if ($logosdata)
                        <div class="container">
                            <div class="swiper-logo-carousel py-4 my-lg-2">
                                <div class="swiper" id="swiper-clients-logos">
                                    <div class="swiper-wrapper">

                                        @foreach ($logosdata ?? [] as $logo)
                                            <div class="swiper-slide">

                                                <img src="{{ explode('/', $logo['image'])[0] === 'uploads' ? asset('storage/' . $logo['image']) ?? '' : asset($logo['image']) ?? '' }}"
                                                    alt="client logo" class="client-logo" />
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Logo slider: End -->
                </section>
            @endif

        @endif

        <!-- Useful Reviews: End -->




        <!-- Useful Teams: Start -->
        @if ($enter_auth === 'true')
            @if (auth()->check() &&
                    (auth()->user()->role == 'admin' ||
                        (auth()->user()->role == 'user' &&
                            ($subscription && in_array($subscription->plan_name, ['plan 3', 'plan 2'])))))
                @if ($team)
                    <section id="landingTeam" class="section-py landing-team">
                        <div class="container">
                            <div class="text-center mb-3 pb-1">
                                <span class="badge bg-label-primary">{{ $team->title ?? '' }}</span>
                            </div>
                            <h3 class="text-center mb-1"><span class="section-title">{{ $team->first_text ?? '' }}</span>
                                {{ $team->second_text ?? '' }}</h3>
                            <p class="text-center mb-md-5 pb-3">{{ $team->tertiary_text ?? '' }}?</p>
                            @if ($team_data)
                                <div class="row gy-5 mt-2">

                                    @foreach ($team_data ?? [] as $data)
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="card mt-3 mt-lg-0 shadow-none">
                                                <div class="{{ $data['color_label'] }} position-relative team-image-box">
                                                    <img src="{{ explode('/', $data['image'])[0] === 'uploads' ? asset('storage/' . $data['image']) ?? '' : asset($data['image']) ?? '' }}"
                                                        class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                                        alt="human image" />
                                                </div>
                                                <div
                                                    class="card-body border border-top-0 {{ $data['color_border'] }} text-center">
                                                    <h5 class="card-title mb-0">{{ $data['name'] }}</h5>
                                                    <p class="text-muted mb-0">{{ $data['position'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            @endif
                        </div>
                    </section>
                @endif

            @endif
        @else
            @if ($team)
                <section id="landingTeam" class="section-py landing-team">
                    <div class="container">
                        <div class="text-center mb-3 pb-1">
                            <span class="badge bg-label-primary">{{ $team->title ?? '' }}</span>
                        </div>
                        <h3 class="text-center mb-1"><span class="section-title">{{ $team->first_text ?? '' }}</span>
                            {{ $team->second_text ?? '' }}</h3>
                        <p class="text-center mb-md-5 pb-3">{{ $team->tertiary_text ?? '' }}?</p>
                        @if ($team_data)
                            <div class="row gy-5 mt-2">

                                @foreach ($team_data ?? [] as $data)
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="card mt-3 mt-lg-0 shadow-none">
                                            <div class="{{ $data['color_label'] }} position-relative team-image-box">
                                                <img src="{{ explode('/', $data['image'])[0] === 'uploads' ? asset('storage/' . $data['image']) ?? '' : asset($data['image']) ?? '' }}"
                                                    class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                                    alt="human image" />
                                            </div>
                                            <div
                                                class="card-body border border-top-0 {{ $data['color_border'] }} text-center">
                                                <h5 class="card-title mb-0">{{ $data['name'] }}</h5>
                                                <p class="text-muted mb-0">{{ $data['position'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @endif
                    </div>
                </section>


            @endif

        @endif

        <!-- Useful Teams: End -->







        <!-- Useful  Pricing Plans: Start -->
        @if ($enter_auth === 'false')

            @if (auth()->check() &&
                    (auth()->user()->role == 'user' &&
                        ($subscription && in_array($subscription->plan_name, ['plan 1', 'plan 2', 'plan 3']))))

                <section id="landingPricing" class="section-py bg-body landing-pricing">
                    <div class="container">
                        <div class="text-center mb-3 pb-1">
                            <span class="badge bg-label-primary">{{ $plan->title ?? '' }}</span>
                        </div>
                        <h3 class="text-center mb-1"><span
                                class="section-title">{{ $plan->first_description ?? '' }}</span>
                            {{ $plan->second_description ?? '' }}</h3>
                        <p class="text-center mb-4 pb-3">
                            {{ $plan->tertiary_description ?? '' }}<br />
                            {{ $plan->four_description ?? '' }}

                        </p>
                        <div class="text-center mb-5">
                            <div class="position-relative d-inline-block pt-3 pt-md-0">
                                <label class="switch switch-primary me-0">
                                    <span class="switch-label">{{ $plan->text_switch_left ?? '' }}</span>
                                    <input type="checkbox" class="switch-input price-duration-toggler" checked />
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"></span>
                                        <span class="switch-off"></span>
                                    </span>
                                    <span class="switch-label">{{ $plan->text_switch_right ?? '' }}</span>
                                </label>
                                <div class="pricing-plans-item position-absolute d-flex">
                                    <img src="../../assets/img/front-pages/icons/pricing-plans-arrow.png"
                                        alt="pricing plans arrow" class="scaleX-n1-rtl" />
                                    <span class="fw-semibold mt-2 ms-1"> Save 25%</span>
                                </div>
                            </div>
                        </div>
                        <div class="row gy-4 pt-lg-3">
                            <!-- Basic Plan: Start -->
                            @foreach ($plan_pricing_data as $plan_data)
                                <div class="col-xl-4 col-lg-6">

                                    @if (optional($subscription)->plan_name === 'plan 1' && $plan_data->title === 'Basic')
                                        <div class="card   border border-primary shadow-lg">
                                            <div class="card-header">
                                                <div class="text-center">
                                                    <img src="{{ explode('/', $plan_data->image)[0] === 'uploads' ? asset('storage/' . $plan_data->image) ?? '' : asset($plan_data->image) ?? '' }}"
                                                        alt="paper airplane icon" class="mb-4 pb-2" />
                                                    <h4 class="mb-1">{{ $plan_data->title ?? '' }}</h4>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span
                                                            class="price-monthly h1 text-primary fw-bold mb-0">${{ $plan_data->monthly_price ?? '' }}</span>
                                                        <span
                                                            class="price-yearly h1 text-primary fw-bold mb-0 d-none">${{ $plan_data->yearly_price ?? '' }}</span>
                                                        <sub class="h6 text-muted mb-0 ms-1">/mo</sub>
                                                    </div>
                                                    <div class="position-relative pt-2">
                                                        <div class="price-yearly text-muted price-yearly-toggle d-none">$
                                                            {{ $plan_data->total_price ?? '' }} / year</div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="card-body">
                                                <ul class="list-unstyled">
                                                    @foreach ($plan_data->planLists ?? [] as $first)
                                                        <li>
                                                            <h5>
                                                                <span
                                                                    class="badge badge-center rounded-pill bg-primary p-0 me-2"><i
                                                                        class="ti ti-check ti-xs"></i></span>
                                                                {{ $first->content_list ?? '' }}
                                                            </h5>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                                <div class="d-grid mt-4 pt-3">
                                                    <a href="" class="btn btn-primary"
                                                        id="paymentPlan1">{{ $pricingPlan->button_pricing_one ?? '' }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif(optional($subscription)->plan_name === 'plan 2' && $plan_data->title === 'Team')
                                        <div class="card   border border-primary shadow-lg">
                                            <div class="card-header">
                                                <div class="text-center">
                                                    <img src="{{ explode('/', $plan_data->image)[0] === 'uploads' ? asset('storage/' . $plan_data->image) ?? '' : asset($plan_data->image) ?? '' }}"
                                                        alt="paper airplane icon" class="mb-4 pb-2" />
                                                    <h4 class="mb-1">{{ $plan_data->title ?? '' }}</h4>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span
                                                            class="price-monthly h1 text-primary fw-bold mb-0">${{ $plan_data->monthly_price ?? '' }}</span>
                                                        <span
                                                            class="price-yearly h1 text-primary fw-bold mb-0 d-none">${{ $plan_data->yearly_price ?? '' }}</span>
                                                        <sub class="h6 text-muted mb-0 ms-1">/mo</sub>
                                                    </div>
                                                    <div class="position-relative pt-2">
                                                        <div class="price-yearly text-muted price-yearly-toggle d-none">$
                                                            {{ $plan_data->total_price ?? '' }} / year</div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="card-body">
                                                <ul class="list-unstyled">
                                                    @foreach ($plan_data->planLists ?? [] as $first)
                                                        <li>
                                                            <h5>
                                                                <span
                                                                    class="badge badge-center rounded-pill bg-primary p-0 me-2"><i
                                                                        class="ti ti-check ti-xs"></i></span>
                                                                {{ $first->content_list ?? '' }}
                                                            </h5>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                                <div class="d-grid mt-4 pt-3">
                                                    <a href="" class="btn btn-primary"
                                                        id="paymentPlan1">{{ $pricingPlan->button_pricing_one ?? '' }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif(optional($subscription)->plan_name === 'plan 3' && $plan_data->title === 'Enterprise')
                                        <div class="card   border border-primary shadow-lg">
                                            <div class="card-header">
                                                <div class="text-center">
                                                    <img src="{{ explode('/', $plan_data->image)[0] === 'uploads' ? asset('storage/' . $plan_data->image) ?? '' : asset($plan_data->image) ?? '' }}"
                                                        alt="paper airplane icon" class="mb-4 pb-2" />
                                                    <h4 class="mb-1">{{ $plan_data->title ?? '' }}</h4>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span
                                                            class="price-monthly h1 text-primary fw-bold mb-0">${{ $plan_data->monthly_price ?? '' }}</span>
                                                        <span
                                                            class="price-yearly h1 text-primary fw-bold mb-0 d-none">${{ $plan_data->yearly_price ?? '' }}</span>
                                                        <sub class="h6 text-muted mb-0 ms-1">/mo</sub>
                                                    </div>
                                                    <div class="position-relative pt-2">
                                                        <div class="price-yearly text-muted price-yearly-toggle d-none">$
                                                            {{ $plan_data->total_price ?? '' }} / year</div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="card-body">
                                                <ul class="list-unstyled">
                                                    @foreach ($plan_data->planLists ?? [] as $first)
                                                        <li>
                                                            <h5>
                                                                <span
                                                                    class="badge badge-center rounded-pill bg-primary p-0 me-2"><i
                                                                        class="ti ti-check ti-xs"></i></span>
                                                                {{ $first->content_list ?? '' }}
                                                            </h5>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                                <div class="d-grid mt-4 pt-3">
                                                    <a href="" class="btn btn-primary"
                                                        id="paymentPlan1">{{ $pricingPlan->button_pricing_one ?? '' }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="card   ">
                                            <div class="card-header">
                                                <div class="text-center">
                                                    <img src="{{ explode('/', $plan_data->image)[0] === 'uploads' ? asset('storage/' . $plan_data->image) ?? '' : asset($plan_data->image) ?? '' }}"
                                                        alt="paper airplane icon" class="mb-4 pb-2" />
                                                    <h4 class="mb-1">{{ $plan_data->title ?? '' }}</h4>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <span
                                                            class="price-monthly h1 text-primary fw-bold mb-0">${{ $plan_data->monthly_price ?? '' }}</span>
                                                        <span
                                                            class="price-yearly h1 text-primary fw-bold mb-0 d-none">${{ $plan_data->yearly_price ?? '' }}</span>
                                                        <sub class="h6 text-muted mb-0 ms-1">/mo</sub>
                                                    </div>
                                                    <div class="position-relative pt-2">
                                                        <div class="price-yearly text-muted price-yearly-toggle d-none">$
                                                            {{ $plan_data->total_price ?? '' }} / year</div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="card-body">
                                                <ul class="list-unstyled">
                                                    @foreach ($plan_data->planLists ?? [] as $first)
                                                        <li>
                                                            <h5>
                                                                <span
                                                                    class="badge badge-center rounded-pill bg-label-primary p-0 me-2"><i
                                                                        class="ti ti-check ti-xs"></i></span>
                                                                {{ $first->content_list ?? '' }}
                                                            </h5>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                                <div class="d-grid mt-4 pt-3">
                                                    <a href="" class="btn btn-label-primary"
                                                        id="{{ $plan_data->id }}">{{ $plan_data->text_button ?? '' }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            @endforeach



                        </div>
                    </div>
                </section>
            @else
                <section id="landingPricing" class="section-py bg-body landing-pricing">
                    <div class="container">
                        <div class="text-center mb-3 pb-1">
                            <span class="badge bg-label-primary">Our Categories</span>
                        </div>
                        <h3 class="text-center mb-1"><span class="section-title"> Tailored pricing products </span>
                            displayed for you</h3>
                        <p class="text-center mb-4 pb-3">
                            {{ $plan->tertiary_description ?? '' }}<br />
                            {{ $plan->four_description ?? '' }}

                        </p>





                        <div class="content-cat">
                            @foreach ($categoryy as $category)
                                <div class="category  " style="background-color: #fbdddd"
                                    data-category-id="{{ $category->id }}">
                                    <div><i style="color: #7367f0" class="fa {{ $category->icon }}"></i></div>
                                    <div style="color: #7367f0" class="category-title">{{ $category->name }}</div>
                                </div>
                            @endforeach
                        </div>

                        <div class="gallery">

                        </div>



                    </div>
                </section>

            @endif


        @endif
        <!-- Pricing plans: End -->








        <!-- Useful  Fun Facts : Start -->
        @if ($enter_auth === 'true')
            @if (auth()->check() &&
                    (auth()->user()->role == 'admin' ||
                        (auth()->user()->role == 'user' &&
                            ($subscription && in_array($subscription->plan_name, ['plan 3', 'plan 2'])))))
                @if ($fun_data)
                    <section id="landingFunFacts" class="section-py landing-fun-facts">
                        <div class="container">
                            <div class="row gy-3">

                                @foreach ($fun_data ?? [] as $fun)
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card border {{ $fun['border_color'] }} shadow-none">
                                            <div class="card-body text-center">
                                                <img src="{{ explode('/', $fun['image'])[0] === 'uploads' ? asset('storage/' . $fun['image']) ?? '' : asset($fun['image']) ?? '' }}"
                                                    alt="laptop" class="mb-2" />
                                                <h5 class="h2 mb-1">{{ $fun['event'] }}</h5>
                                                <p class="fw-medium mb-0">
                                                    {{ $fun['title'] }}<br />
                                                    {{ $fun['text'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </section>

                @endif

            @endif
        @else
            @if ($fun_data)
                <section id="landingFunFacts" class="section-py landing-fun-facts">
                    <div class="container">
                        <div class="row gy-3">

                            @foreach ($fun_data ?? [] as $fun)
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card border {{ $fun['border_color'] }} shadow-none">
                                        <div class="card-body text-center">
                                            <img src="{{ explode('/', $fun['image'])[0] === 'uploads' ? asset('storage/' . $fun['image']) ?? '' : asset($fun['image']) ?? '' }}"
                                                alt="laptop" class="mb-2" />
                                            <h5 class="h2 mb-1">{{ $fun['event'] }}</h5>
                                            <p class="fw-medium mb-0">
                                                {{ $fun['title'] }}<br />
                                                {{ $fun['text'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </section>



            @endif

        @endif

        <!-- Fun Facts: End -->




        <!-- Useful  faq : Start -->
        @if ($faqs)
            <section id="landingFAQ" class="section-py bg-body landing-faq">
                <div class="container">
                    <div class="text-center mb-3 pb-1">

                        <span class="badge bg-label-primary">{{ $faqs->title ?? '' }}</span>
                    </div>
                    <h3 class="text-center mb-1">{{ $faqs->first_description ?? '' }} <span
                            class="section-title">{{ $faqs->second_description ?? '' }}</span></h3>
                    <p class="text-center mb-5 pb-3">{{ $faqs->tertiary_description ?? '' }}</p>
                    <div class="row gy-5">
                        <div class="col-lg-5">
                            <div class="text-center">
                                <img src="{{ explode('/', $faqs->image)[0] === 'uploads' ? asset('storage/' . $faqs->image) ?? '' : asset($faqs->image) ?? '' }}"
                                    alt="faq boy with logos" class="faq-image" />
                            </div>
                        </div>
                        @if ($faq)
                            <div class="col-lg-7">
                                <div class="accordion" id="accordionExample">
                                    @foreach ($faq ?? [] as $index => $faqsdynamic)
                                        <div class="card accordion-item {{ $index === 0 ? 'active' : '' }}">
                                            <h2 class="accordion-header" id="heading{{ $index }}">
                                                <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                                    data-bs-target="#accordion{{ $index }}" aria-expanded="true"
                                                    aria-controls="accordion{{ $index }}">
                                                    {{ $faqsdynamic['title'] }}
                                                </button>
                                            </h2>

                                            <div id="accordion{{ $index }}"
                                                class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    {{ $faqsdynamic['description'] }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif
        <!-- faq: End -->









        <!-- Contact Us: Start -->
        @if ($value)
            <section id="landingCTA" class="section-py landing-cta p-lg-0 pb-0">
                <div class="container">
                    <div class="row align-items-center gy-5 gy-lg-0">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h6 class="h2 text-primary fw-bold mb-1">{{ $value->title_cta ?? '' }}</h6>
                            <p class="fw-medium mb-4">{{ $value->description_cta ?? '' }}</p>
                            <a href="#landingPricing"
                                class="btn btn-lg btn-primary">{{ $value->button_text_cta ?? '' }}</a>
                        </div>
                        <div class="col-lg-6 pt-lg-5 text-center text-lg-end">
                            <img src="{{ explode('/', $value->image_cta)[0] === 'uploads' ? asset('storage/' . $value->image_cta) ?? '' : asset($value->image_cta) ?? '' }}"
                                alt="cta dashboard" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </section>
            <section id="landingContact" class="section-py bg-body landing-contact">
                <div class="container">
                    <div class="text-center mb-3 pb-1">
                        <span class="badge bg-label-primary">{{ $value->title_contact ?? '' }}</span>
                    </div>
                    <h3 class="text-center mb-1"><span
                            class="section-title">{{ $value->first_description_contact ?? '' }}</span>
                        {{ $value->second_description_contact ?? '' }}</h3>
                    <p class="text-center mb-4 mb-lg-5 pb-md-3">{{ $value->tertiary_description_contact ?? '' }}</p>
                    <div class="row gy-4">
                        <div class="col-lg-5">
                            <div class="contact-img-box position-relative border p-2 h-100">
                                <img src="{{ explode('/', $value->image_contact)[0] === 'uploads' ? asset('storage/' . $value->image_contact) ?? '' : asset($value->image_contact) ?? '' }}"
                                    alt="cta dashboard" alt="contact customer service"
                                    class="contact-img w-100 scaleX-n1-rtl" />
                                <div class="pt-3 px-4 pb-1">
                                    <div class="row gy-3 gx-md-4">
                                        <div class="col-md-6 col-lg-12 col-xl-6">
                                            <div class="d-flex align-items-center">
                                                <div class="badge bg-label-primary rounded p-2 me-2"><i
                                                        class="ti ti-mail ti-sm"></i></div>
                                                <div>
                                                    <p class="mb-0">Email</p>
                                                    <h5 class="mb-0">
                                                        <a href="mailto:example@gmail.com"
                                                            class="text-heading">{{ $value->email ?? '' }}</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-12 col-xl-6">
                                            <div class="d-flex align-items-center">
                                                <div class="badge bg-label-success rounded p-2 me-2">
                                                    <i class="ti ti-phone-call ti-sm"></i>
                                                </div>
                                                <div>
                                                    <p class="mb-0">Phone</p>
                                                    <h5 class="mb-0"><a href="tel:+1234-568-963"
                                                            class="text-heading">{{ $value->phone ?? '' }}</a></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-1">{{ $value->text_contact ?? '' }}</h4>
                                    <p class="mb-4">
                                        {{ $value->description_contact ?? '' }}<br class="d-none d-lg-block" />
                                        {{ $value->description_contact_two ?? '' }}
                                    </p>
                                    <form class="footer-form" id="contactForm"
                                        action="{{ route('send.message.contact') }}" method="post">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="contact-form-fullname">
                                                    Full Name</label>
                                                <input type="text" class="form-control" id="contact-form-fullname"
                                                    name="full_name" placeholder="john" required />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="contact-form-email">Email</label>
                                                <input type="text" id="contact-form-email" class="form-control"
                                                    placeholder="johndoe@gmail.com" name="email" required />
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="contact-form-message">Message</label>
                                                <textarea id="contact-form-message" class="form-control" name="message" rows="8"
                                                    placeholder="Write a message" required></textarea>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary" name="submit">Send
                                                    inquiry</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!-- Contact Us: End -->



        <div class="modal fade" id="subscribeModal" tabindex="-1" role="dialog" aria-labelledby="subscribeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="subscribeModalLabel">Subscribe Confirmation</h5>

                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to subscribe in this plan ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="proceedButton">Proceed</button>
                    </div>
                </div>
            </div>

        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>


        <script>
            var reload = {{ $reload ? 'true' : 'false' }};
            var reloaded = sessionStorage.getItem('reloaded');

            const aa = 123;

            if (reload && !reloaded) {
                location.reload();
                sessionStorage.setItem('reloaded', 'true');
            }
            $(document).ready(function() {
                const categories = document.querySelectorAll('.category');

                // Add event listener to each category element
                categories.forEach((category) => {
                    category.addEventListener('click', (e) => {
                        // Remove the active class from all categories
                        categories.forEach((cat) => cat.classList.remove('active'));

                        // Add the active class to the clicked category
                        category.classList.add('active');

                        // Get the category ID from the element
                        const categoryId = category.dataset.categoryId;

                        // Make an AJAX request to the controller
                        fetch(`/categories/${categoryId}`)
                            .then((response) => response.json())
                            .then((data) => {
                                // Display the data in the.gallery container
                                const galleryContainer = document.querySelector('.gallery');
                                galleryContainer.innerHTML = '';

                                // Add only the first 4 products to the gallery
                                for (let i = 0; i < data.length && i < 4; i++) {
                                    const product = data[i];
                                    const productHTML = `
                                    <div class="content-product" >
                        <a href="/productDetailsPage?id=${product.id}">   
                        <img class="imgClass" src="/images/${product.image}" alt="${product.title}">
                        <h3 class="hthree">${product.title}</h3>
                        <p class="pClass">${product.description}</p>
                        <h6 class="hClass">$${product.price}.00</h6>
                        <ul class="ulClass">
                            <li class="liClass"><i class="ti ti-star-filled checked ti-sm"></i></li>
                            <li class="liClass"><i class="ti ti-star-filled checked ti-sm"></i></li>
                            <li class="liClass"><i class="ti ti-star-filled checked ti-sm"></i></li>
                            <li class="liClass"><i class="ti ti-star-filled checked ti-sm"></i></li>
                            <li class="liClass"><i class="ti ti-star-filled checked ti-sm"></i></li>
                        </ul>  
                    </a>
                    <button class="buttonClass buy-1" data-product-id="${product.id}"     >ADD TO CART</button>
                    </div>
               
                        `;

                                    galleryContainer.innerHTML += productHTML;

                                    // Create a next button for the last product
                                    if (i === 3) {
                                        const nextButton =
                                            `<i class="fa-solid fa-circle-arrow-right arroww" data-category-id="${categoryId}"></i>`;
                                        galleryContainer.innerHTML += nextButton;
                                    }
                                    document.querySelectorAll('.buy-1').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const productId = this.getAttribute('data-product-id');
                    console.log("hi")
                    addToCart(productId);
                });
            });

                                }
                                function addToCart(productId) {
            fetch(`/add-to-cart/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        productId: productId
                    })
                })
                .then(response => {
                    if (response.ok) {
                        console.log("done");
                    } else {
                        console.error('Failed to add to cart');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

                                // Add event listener to the arrow button
                                const arrowButton = document.querySelector('.arroww');
                                arrowButton.addEventListener('click', (event) => {
                                    const clickedCategoryId = event.target.dataset
                                        .categoryId;
                                    // Redirect to another page with categoryId as query parameter
                                    window.location.href =
                                        `/productPage?categoryId=${clickedCategoryId}`;
                                });
                            })
                            .catch((error) => console.error(error));
                    });
                });

                // Add event listener to each category element to highlight the border
                categories.forEach((category) => {
                    category.addEventListener('click', (e) => {
                        // Remove the border from all categories
                        categories.forEach((cat) => cat.classList.remove('border'));

                        // Add the border to the clicked category
                        category.classList.add('border', 'border-primary', 'shadow-lg');
                    });
                });
            });





            






            $(document).ready(function() {
                $('#contactForm').submit(function(e) {
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
                            alert("send message Successfuly")

                        },
                        error: function(error) {
                            alert('Error Here when you send the message !');
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



    @endsection
