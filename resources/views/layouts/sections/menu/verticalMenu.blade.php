@php
 $userId = Auth::id();
$subscription = \App\Models\SubscriptionPlan::where('user_id', $userId )->first();;
@endphp
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      @php
                 $user_id = Auth::id();
                $data = App\Models\AppData::where('user_id', $user_id)->first();
               
            @endphp
                <a href="landing-page.html" class="app-brand-link">
                  <span class="app-brand-logo demo">
                        <img  src="{{ asset('images/' . $data->image) }}"
                        style="width=32px; height:22px;"      ></span>
                   
                    <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">{{$data->title}}</span>
                  </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
    
       
      <li class="menu-item">
        <a href="{{route('dashboard-home-page')}}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div data-i18n=" Ads Home Data">Ads Home Data </div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('appointment-section')}}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div data-i18n=" Ads Home Data">Ads Appointment Data </div>
        </a>
      </li>
        <li class="menu-item">
            <a href="{{route('dashboard-feature-page')}}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-files"></i>
              <div data-i18n=" Ads Home Data">Ads Feature Data </div>
            </a>
          </li>
          @if (auth()->check() &&
                    (auth()->user()->role == 'admin' ||
                        (auth()->user()->role == 'user' && ($subscription && in_array($subscription->plan_name, ['plan 3'])))))
          <li class="menu-item">
            <a href="{{route('dashboard-review-page')}}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-book"></i>
              <div data-i18n=" Ads Review Data">Ads Review Data </div>
            </a>
          </li>
          
          <li class="menu-item">
            <a href="{{route('dashboard-logo-page')}}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-brand-tabler"></i>
              <div data-i18n=" Ads Logo Data">Ads Logo Data </div>
            </a>
          </li>
          @endif
          @if (auth()->check() &&
          (auth()->user()->role == 'admin' ||
              (auth()->user()->role == 'user' &&
                  ($subscription && in_array($subscription->plan_name, ['plan 3', 'plan 2'])))))
          <li class="menu-item">
            <a href="{{route('dashboard-team-page')}}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-users"></i>
              <div data-i18n=" Ads Team Data">Ads Team Data </div>
            </a>
          </li>
          @endif
          @if (auth()->check() &&
          (auth()->user()->role == 'admin' 
             ))
          <li class="menu-item">
            <a href="{{route('dashboard-plan-page')}}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-file-dollar"></i>
              <div data-i18n=" Ads Plan Data">Ads Plan Data </div>
            </a>
          </li>
          @endif
          @if (auth()->check() &&
          (auth()->user()->role == 'admin' ||
              (auth()->user()->role == 'user' &&
                  ($subscription && in_array($subscription->plan_name, ['plan 3', 'plan 2'])))))
          <li class="menu-item">
            <a href="{{route('dashboard-fun-page')}}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-color-swatch"></i>
              <div data-i18n=" Ads Fun Data">Ads Fun Data </div>
            </a>
          </li>
          @endif

          <li class="menu-item">
            <a href="{{route('dashboard-faq-page')}}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-id"></i>
              <div data-i18n=" Ads Fun Data">Ads Faq Data </div>
            </a>
          </li>

          <li class="menu-item">
            <a href="{{route('dashboard-contact-page')}}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-messages"></i>
              <div data-i18n=" Ads Fun Data">Ads CTA & Contacts </div>
            </a>
          </li>
         

          <li class="menu-item">
            <a href="{{route('new-letter')}}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-mail"></i>
              <div data-i18n=" Ads Fun Data">Ads News Letter </div>
            </a>
          </li>

          <li class="menu-item">
            <a href="{{route('appointment-dashboard-page')}}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-mail"></i>
              <div data-i18n=" Ads Fun Data">Appointments </div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{route('product-page-dashboard')}}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-mail"></i>
              <div data-i18n=" products">Products </div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{route('order-page')}}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-mail"></i>
              <div data-i18n=" products">Orders </div>
            </a>
          </li>
          <li class="menu-item">
            <a href="{{route('create-order-dashboard')}}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-mail"></i>
              <div data-i18n=" products">Orders </div>
            </a>
          </li>

          <li class="menu-item">
            <a href="{{route('patient-data-page')}}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-mail"></i>
              <div data-i18n=" products">Patient Data </div>
            </a>
          </li>
      
      
     
     
    </ul>
  </aside>


