@php
$containerNav = (isset($configData['contentLayout']) && $configData['contentLayout'] === 'compact') ? 'container-xxl' : 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');
@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
  @endif
  @if(isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
      @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(isset($navbarFull))
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
        <a href="{{url('/')}}" class="app-brand-link gap-2">
          <span class="app-brand-logo demo">
            @include('_partials.macros',["height"=>20])
          </span>
          <span class="app-brand-text demo menu-text fw-bold">{{config('variables.templateName')}}</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
          <i class="ti ti-x ti-sm align-middle"></i>
        </a>
      </div>
      @endif

      <!-- ! Not required for layout-without-menu -->
      @if(!isset($navbarHideToggle))
      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
          <i class="ti ti-menu-2 ti-sm"></i>
        </a>
      </div>
      @endif


     
      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
      
        
          <h2 style="margin-top: 1%" >Hello Dear!</h2>
       
       
        <ul class="navbar-nav flex-row align-items-center ms-auto">
         
        

        
          <!-- Search -->
           
          <!-- /Search -->
       
          @if($configData['hasCustomizer'] == true)
          <!-- Style Switcher -->
          <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
              <i class='ti ti-md'></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                  <span class="align-middle"><i class='ti ti-sun me-2'></i>Light</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                  <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                  <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
                </a>
              </li>
            </ul>
          </li>
          <!--/ Style Switcher -->
          @endif

          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="{{ Auth::user() ? Auth::user()->image : asset('assets/img/avatars/1.png') }}" alt class="h-auto rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <h6 class="dropdown-header">Profile</h6>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>


              <li style="display: flex; justify-content: center; align-items: center;">
                <div>
                    <div class="avatar avatar-online">
                        <img src="{{ Auth::user() ? Auth::user()->image : asset('assets/img/avatars/1.png') }}" alt class="h-auto rounded-circle">
                    </div>
                </div>
            </li>
           {{--                                                  --}}   
            
             
              
          
            
           
              <li>
                <a class="dropdown-item" >
                  <h6 class="align-middle">Name:</h6>
                  <span class="align-middle">{{Auth::user()->username}}</span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" >
                  <h6 class="align-middle">Email:</h6>
                  <span class="align-middle">{{Auth::user()->email}}</span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" >
                  <h6 class="align-middle">Role:</h6>
                  <span class="align-middle">{{Auth::user()->role}}</span>
                </a>
              </li>
           
             
             
            
            
             
              {{--                                                  --}}   
              {{-- Below commented code read by artisan command while installing jetstream. !! Do not remove if you want to use jetstream. --}}

              {{-- <x-switchable-team :team="$team" /> --}}
              {{-- @endforeach --}}
              {{-- @endif --}}
              {{-- @endif --}}
              <li>
                <div class="dropdown-divider"></div>
              </li>
              {{-- @if (Auth::check()) --}}
              <li>
                <a class="dropdown-item" href="{{ auth()->user()->super_admin_setting == 'yes' ? route('logout-dashboard-admin') : route('logout-dashboard') }}">
                  <i class='ti ti-logout me-2'></i>
                  <span class="align-middle">Logout</span>
              </a>
              
              </li>
              {{-- <form method="POST" id="logout-form" action="#">
                @csrf
              </form> --}}
              {{-- @else
              <li>
                <a class="dropdown-item" href="{{ Route::has('login') ? route('login') : url('auth/login-basic') }}">
                  <i class='ti ti-login me-2'></i>
                  <span class="align-middle">Login</span>
                </a>
              </li> --}}
              {{-- @endif --}}
            </ul>
          </li>
          <!--/ User -->
        </ul>
      </div>

      <!-- Search Small Screens -->
     
      @if(isset($navbarDetached) && $navbarDetached == '')
    
    </div>
    @endif
  </nav>
  <!-- / Navbar -->
