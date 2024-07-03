<style>
    .dropdown-menu {
        display: none;
    }

    .dropdown-menu.show {
        display: block;
    }

    .cart-container {
        position: relative;
        display: inline-block;
    }

    .cart-container .fa-cart-shopping {
        font-size: 2em;
    }

    .cart-container .badge {
        position: absolute;
        top: -10px;
        right: -10px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 5px 10px;
        font-size: 0.8em;
    }

    .nav-item.mega-dropdown .dropdown-menu {
        width: 200px;
        /* Adjust the width as needed */
    }

    .nav-item.mega-dropdown .dropdown-menu .row {
        height: auto;
        /* Adjust the height as needed */
    }

    .nav-item.mega-dropdown .dropdown-menu.p-4 {
        padding: 8px;
        /* Adjust the padding as needed */
    }

    .nav-link.active {
        font-weight: bold;
        color: #007bff;
        /* or any other color/style to highlight the active link */
    }
</style>
<nav class="layout-navbar shadow-none py-0">
    <div class="container">
        <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4">
            <!-- Menu logo wrapper: Start -->
            <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
                <!-- Mobile menu toggle: Start -->
                <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="ti ti-menu-2 ti-sm align-middle"></i>
                </button>
                <!-- Mobile menu toggle: End -->
                @php
                 $user_id = Auth::id();
                 
                $data = App\Models\AppData::where('user_id', '1')->first();
               
            @endphp
                <a href="landing-page.html" class="app-brand-link">
                   
                    @if($data && $data->image)
                    <img src="{{ asset('images/' . $data->image) }}" style="width=32px; height:22px;">
                @else
                    <img src="{{ asset('images/default.png') }}" style="width=32px; height:22px;">
                @endif
                   
                @if($data && $data->title)
                <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">{{ $data->title }}</span>
            @else
                <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">Default Title</span>
            @endif
                  </a>
            </div>
            <!-- Menu logo wrapper: End -->
            <!-- Menu wrapper: Start -->
            <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                    type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti ti-x ti-sm"></i>
                </button>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-medium" aria-current="page"
                            href="{{ route('front-page') }}#landingHero">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="{{ route('front-page') }}#landingFeatures">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="{{ route('front-page') }}#landingTeam">Team</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="{{ route('front-page') }}#landingFAQ">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="{{ route('front-page') }}#landingContact">Contact us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="{{ route('product-page') }}" id="product-link">Product</a>
                    </li>
                    <li class="nav-item mega-dropdown">
                        <a href="javascript:void(0);"
                            class="nav-link dropdown-toggle navbar-ex-14-mega-dropdown mega-dropdown fw-medium"
                            aria-expanded="false" data-bs-toggle="mega-dropdown" data-trigger="hover">
                            <span data-i18n="Pages">Pages</span>
                        </a>
                        <div class="dropdown-menu p-4">
                            <div class="row gy-4">
                                <div class="col-12 col-lg">
                                    <div class="h6 d-flex align-items-center mb-2 mb-lg-3">
                                        <div class="avatar avatar-sm flex-shrink-0 me-2">
                                            <span class="avatar-initial rounded bg-label-primary">
                                                <i class="ti ti-layout-grid"></i>
                                            </span>
                                        </div>
                                        <span class="ps-1">Other</span>
                                    </div>
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link mega-dropdown-link {{ request()->routeIs('product-page') ? 'active' : '' }}"
                                                href="{{ route('product-page') }}">
                                                <i class="ti ti-circle me-1"></i>
                                                <span data-i18n="Pricing">Product</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mega-dropdown-link {{ request()->routeIs('product-cart-page') ? 'active' : '' }}"
                                                href="{{ route('product-cart-page') }}">
                                                <i class="ti ti-circle me-1"></i>
                                                <span data-i18n="Checkout">Checkout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium" href="" id="admin-link">Admin</a>
                    </li>
                </ul>
            </div>
            <!-- Menu wrapper: End -->
            <!-- Toolbar: Start -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- navbar button: Start -->
               
                    <li class="nav-item navbar-dropdown dropdown-user">
                      
                    </li>
                
                   

                @php
                    $carts = session('carts', []);
                @endphp

                @if (count($carts) > 0)
                    <a href="{{ route('product-cart-page') }}" class="cart-link">
                        <div class="cart-container">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="badge">{{ count($carts) }}</span>
                        </div>
                    </a>
                @else
                    <a href="{{ route('product-cart-page') }}" class="cart-link">
                        <div class="cart-container">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="badge">0</span>
                        </div>
                    </a>
                @endif
                <!-- navbar button: End -->
            </ul>
            <!-- Toolbar: End -->
        </div>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    
    $(document).ready(function() {     
        $("#userDropdown").on("click", function() {
            $(".dropdownuser").toggleClass("show");
        });

        $(document).on("click", function(event) {
            var $trigger = $("#userDropdown");
            if ($trigger !== event.target && !$trigger.has(event.target).length) {
                $(".dropdownuser").removeClass("show");
            }
        });
    });
    
    document.getElementById('admin-link').addEventListener('click', function(event) {
        event.preventDefault();
        var isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
        if (isAuthenticated) {

            $.ajax({
                url: '/dashboard/ecommerce',
                method: 'GET',
                success: function(response) {

                    window.location.href = '/dashboard/ecommerce';
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        } else {
            $.ajax({
                url: '/login-admin',
                method: 'GET',
                success: function(response) {

                    window.location.href = '/login-admin';
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
           
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('a[href^="#"]');
        for (const link of links) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        }
    });
    
</script>
