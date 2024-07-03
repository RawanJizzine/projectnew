@php
    $user_id = Auth::id();
    $data = App\Models\AppData::where('user_id', $user_id)->first();
    $dashboardActive = Request::is('dashboard') || Request::is('dashboard/*');
    $ecommerceActive = Request::is('dashboard/ecommerce');
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="landing-page.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('images/' . $data->image) }}" style="width: 32px; height: 22px;">
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">{{ $data->title }}</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ $dashboardActive ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboards">Dashboards</div>
                <div class="badge bg-primary rounded-pill ms-auto">2</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ $ecommerceActive ? 'active' : '' }}">
                    <a href="{{ route('ecommerce-page') }}" class="menu-link">
                        <div data-i18n="eCommerce">eCommerce</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('dashboard/analytics') ? 'active' : '' }}">
                    <a href="dashboards-crm.html" class="menu-link">
                        <div data-i18n="Analytics">Analytics</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Front Pages -->
        @php
            $frontPagesActive = Request::is('home') || Request::is('feature') || 
                                Request::is('review') || Request::is('logos') || 
                                Request::is('team') || Request::is('pricing-plan') || 
                                Request::is('fun') || Request::is('faq') || 
                                Request::is('dashboard-contact');
        @endphp
        <li class="menu-item {{ $frontPagesActive ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-files"></i>
                <div data-i18n="Front Pages">Front Pages</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('home') ? 'active' : '' }}">
                    <a href="{{ route('dashboard-home-page') }}" class="menu-link" >
                        <div data-i18n="home">Home Section</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('feature') ? 'active' : '' }}">
                    <a href="{{ route('dashboard-feature-page') }}" class="menu-link" >
                        <div data-i18n="feature">Features Section</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('review') ? 'active' : '' }}">
                    <a href="{{ route('dashboard-review-page') }}" class="menu-link" >
                        <div data-i18n="review">Review Section</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('logos') ? 'active' : '' }}">
                    <a href="{{ route('dashboard-logo-page') }}" class="menu-link" >
                        <div data-i18n="slider">Slider Content</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('team') ? 'active' : '' }}">
                    <a href="{{ route('dashboard-team-page') }}" class="menu-link" >
                        <div data-i18n="team">Team Section</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('pricing-plan') ? 'active' : '' }}">
                    <a href="{{ route('dashboard-plan-page') }}" class="menu-link" >
                        <div data-i18n="team">Product Section</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('fun') ? 'active' : '' }}">
                    <a href="{{ route('dashboard-fun-page') }}" class="menu-link" >
                        <div data-i18n="team">Fun Section</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('faq') ? 'active' : '' }}">
                    <a href="{{ route('dashboard-faq-page') }}" class="menu-link" >
                        <div data-i18n="team">FAQ Section</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('contact') ? 'active' : '' }}">
                    <a href="{{ route('dashboard-contact-page') }}" class="menu-link" >
                        <div data-i18n="team">Contact Section</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text" data-i18n="Apps & Pages">Apps &amp; Pages</span>
        </li>
        <li class="menu-item {{ Request::is('appointment-dashboard') ? 'active' : '' }}">
            <a href="{{route('appointment-dashboard-page')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Users">Appointments</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('orderDashboard') ? 'active' : '' }}">
            <a href="{{ route('order-page') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                <div data-i18n="eCommerce">Order</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('productDashboardPage') ? 'active' : '' }}">
            <a href="{{route('product-page-dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                <div data-i18n="eCommerce">Products</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('allpatientData') ? 'active' : '' }}">
            <a href="{{ route('all-patient-data') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-id"></i>
                <div data-i18n="Cards">Patient Data</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('newsletter') ? 'active' : '' }}">
            <a href="{{ route('new-letter') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-mail"></i>
                <div data-i18n="Email">Email</div>
            </a>
        
        </li>
    </ul>
</aside>