@extends('layouts/layoutFront')
@section('contentFront')

<section class="section-py bg-body first-section-pt">
    <div class="container">
        <!--/ Checkout Wizard -->
        <!-- Checkout Wizard -->
        <div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example mb-5">
            <div class="bs-stepper-header m-auto border-0 py-4">
                <div class="step" data-target="#checkout-cart">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-icon">
                            <svg viewBox="0 0 58 54">
                                <use xlink:href="../../assets/svg/icons/wizard-checkout-cart.svg#wizardCart"></use>
                            </svg>
                        </span>
                        <span class="bs-stepper-label">Cart</span>
                    </button>
                </div>
                <div class="line">
                    <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#checkout-address">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-icon">
                            <svg viewBox="0 0 54 54">
                                <use
                                    xlink:href="../../assets/svg/icons/wizard-checkout-address.svg#wizardCheckoutAddress">
                                </use>
                            </svg>
                        </span>
                        <span class="bs-stepper-label">Information</span>
                    </button>
                </div>
                <div class="line">
                    <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#checkout-payment">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-icon">
                            <svg viewBox="0 0 58 54">
                                <use xlink:href="../../assets/svg/icons/wizard-checkout-payment.svg#wizardPayment">
                                </use>
                            </svg>
                        </span>
                        <span class="bs-stepper-label">Payment</span>
                    </button>
                </div>
                <div class="line">
                    <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#checkout-confirmation">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-icon">
                            <svg viewBox="0 0 58 54">
                                <use xlink:href="../../assets/svg/icons/wizard-checkout-confirmation.svg#wizardConfirm">
                                </use>
                            </svg>
                        </span>
                        <span class="bs-stepper-label">Confirmation</span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content border-top">
                <form id="wizard-checkout-form" method="POST" onSubmit="return false">
                    @csrf
                    <input type="hidden" name="items" value="{{ json_encode($carts) }}">
                    <!-- Cart -->
                    <div id="checkout-cart" class="content">
                        <div class="row">
                            <!-- Cart left -->
                            <div class="col-xl-8 mb-3 mb-xl-0">

                                @php
                                    $totalPrice = 0;
                                @endphp

                                <!-- Shopping bag -->
                                <h5>My Shopping Bag : ( {{ count($carts) }} Items)</h5>
                             
                                <ul class="list-group mb-3">
                                    <!-- here put the foreach -->
                                    @foreach ($carts as $cart)
                                        @php
                                            $totalPrice += $cart['price'] * $cart['quantity'];
                                        @endphp
                                        <li class="list-group-item p-4">
                                            <div class="d-flex gap-3">
                                                <div class="flex-shrink-0 d-flex align-items-center">
                                                    <img src="{{ asset('images/' . $cart['image']) }}" alt="google home"
                                                        class="w-px-100" />
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <p class="me-3">
                                                                <a href="javascript:void(0)"
                                                                    class="text-body">{{ $cart['title'] }} </a>
                                                            </p>
                                                            <div class="text-muted mb-2 d-flex flex-wrap">
                                                                <span class="me-1">categories of:</span>
                                                                <a href="javascript:void(0)" class="me-3">
                                                                    {{ $cart['category_name'] }}
                                                                </a>
                                                                <span class="badge bg-label-success">In Stock</span>
                                                            </div>
                                                            <div class="read-only-ratings mb-3"
                                                                data-rateyo-read-only="true"></div>
                                                            <input type="number"
                                                                class="form-control form-control-sm w-px-100 mt-2"
                                                                value="{{ $cart['quantity'] }}" min="1"
                                                                max="5" />
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="text-md-end">
                                                                <button type="button" class="btn-close btn-pinned"
                                                                    aria-label="Close"></button>
                                                                <div class="my-2 my-md-4 mb-md-5">
                                                                    <span class="text-primary">$
                                                                        {{ $cart['price'] }}</span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>

                                <!-- Wishlist -->

                            </div>

                            <!-- Cart right -->
                            <div class="col-xl-4">
                                <div class="border rounded p-4 mb-3 pb-3">


                                    <!-- Price Details -->
                                    <h6>Price Details</h6>
                                    <hr class="mx-n4" />
                                    <dl class="row mb-0">
                                        <dt class="col-6 fw-normal text-heading">Bag Total</dt>
                                        <dd class="col-6 text-end">${{ number_format($totalPrice, 2) }}</dd>

                                        <dt class="col-sm-6 fw-normal">Coupon Discount</dt>
                                        <dd class="col-sm-6 text-end"><a href="javascript:void(0)">Apply Coupon</a>
                                        </dd>

                                        <dt class="col-6 fw-normal text-heading">Order Total</dt>
                                        <dd class="col-6 text-end">${{ number_format($totalPrice, 2) }}</dd>

                                        <dt class="col-6 fw-normal text-heading">Delivery Charges</dt>
                                        <dd class="col-6 text-end">
                                            <s class="text-muted">$5.00</s> <span
                                                class="badge bg-label-success ms-1">Free</span>
                                        </dd>
                                    </dl>

                                    <hr class="mx-n4" />
                                    <dl class="row mb-0">
                                        <dt class="col-6 text-heading">Total</dt>
                                        <dd class="col-6 fw-medium text-end text-heading mb-0">
                                            ${{ number_format($totalPrice, 2) }}</dd>
                                    </dl>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-next">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <!-- Address -->
                    <div id="checkout-address" class="content">
                        <div class="row">
                            <!-- Address left -->
                            <div class="col-xl-8 col-xxl-9 mb-3 mb-xl-0">
                                <!-- Select address -->



                                <!-- Choose Delivery -->
                                <p>Choose Delivery Speed</p>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md mb-md-0 mb-3">
                                            <div class="form-check custom-option custom-option-icon">
                                                <label class="form-check-label custom-option-content"
                                                    for="customRadioHome">
                                                    <span class="custom-option-body">
                                                        <svg width="41" height="40" viewBox="0 0 41 40"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M24.25 33.75V23.75H16.75V33.75H6.75002V18.0469C6.7491 17.8733 6.78481 17.7015 6.85482 17.5426C6.92482 17.3838 7.02754 17.2415 7.15627 17.125L19.6563 5.76562C19.8841 5.5559 20.1825 5.43948 20.4922 5.43948C20.8019 5.43948 21.1003 5.5559 21.3281 5.76562L33.8438 17.125C33.9696 17.2438 34.0703 17.3866 34.1401 17.5449C34.2098 17.7032 34.2472 17.8739 34.25 18.0469V33.75H24.25Z"
                                                                fill="currentColor" opacity="0.2" />
                                                            <path
                                                                d="M33.25 33.75C33.25 34.3023 33.6977 34.75 34.25 34.75C34.8023 34.75 35.25 34.3023 35.25 33.75H33.25ZM34.25 18.0469H35.25C35.25 18.0415 35.25 18.0361 35.2499 18.0307L34.25 18.0469ZM33.8437 17.125L34.5304 16.398C34.5256 16.3934 34.5207 16.389 34.5158 16.3845L33.8437 17.125ZM21.3281 5.76562L20.6509 6.50143L20.656 6.50611L21.3281 5.76562ZM19.6562 5.76562L20.3288 6.5057L20.3335 6.50141L19.6562 5.76562ZM7.15625 17.125L7.82712 17.8666L7.82878 17.8651L7.15625 17.125ZM6.75 18.0469H7.75001L7.74999 18.0416L6.75 18.0469ZM5.75 33.75C5.75 34.3023 6.19772 34.75 6.75 34.75C7.30228 34.75 7.75 34.3023 7.75 33.75H5.75ZM3 32.75C2.44772 32.75 2 33.1977 2 33.75C2 34.3023 2.44772 34.75 3 34.75V32.75ZM38 34.75C38.5523 34.75 39 34.3023 39 33.75C39 33.1977 38.5523 32.75 38 32.75V34.75ZM23.25 33.75C23.25 34.3023 23.6977 34.75 24.25 34.75C24.8023 34.75 25.25 34.3023 25.25 33.75H23.25ZM15.75 33.75C15.75 34.3023 16.1977 34.75 16.75 34.75C17.3023 34.75 17.75 34.3023 17.75 33.75H15.75ZM35.25 33.75V18.0469H33.25V33.75H35.25ZM35.2499 18.0307C35.2449 17.7243 35.1787 17.422 35.0551 17.1416L33.225 17.9481C33.2409 17.9844 33.2495 18.0235 33.2501 18.0631L35.2499 18.0307ZM35.0551 17.1416C34.9316 16.8612 34.7531 16.6084 34.5304 16.398L33.1571 17.852C33.1859 17.8792 33.209 17.9119 33.225 17.9481L35.0551 17.1416ZM34.5158 16.3845L22.0002 5.02514L20.656 6.50611L33.1717 17.8655L34.5158 16.3845ZM22.0053 5.02984C21.5929 4.6502 21.0528 4.43948 20.4922 4.43948V6.43948C20.551 6.43948 20.6076 6.46159 20.6509 6.50141L22.0053 5.02984ZM20.4922 4.43948C19.9316 4.43948 19.3915 4.6502 18.979 5.02984L20.3335 6.50141C20.3767 6.46159 20.4334 6.43948 20.4922 6.43948V4.43948ZM18.9837 5.02556L6.48371 16.3849L7.82878 17.8651L20.3288 6.50569L18.9837 5.02556ZM6.48538 16.3834C6.25236 16.5942 6.06642 16.8518 5.93971 17.1393L7.76988 17.9459C7.78318 17.9157 7.80268 17.8887 7.82712 17.8666L6.48538 16.3834ZM5.93971 17.1393C5.813 17.4269 5.74836 17.7379 5.75001 18.0521L7.74999 18.0416C7.74981 18.0087 7.75659 17.976 7.76988 17.9459L5.93971 17.1393ZM5.75 18.0469V33.75H7.75V18.0469H5.75ZM3 34.75H38V32.75H3V34.75ZM25.25 33.75V25H23.25V33.75H25.25ZM25.25 25C25.25 24.4033 25.013 23.831 24.591 23.409L23.1768 24.8232C23.2237 24.8701 23.25 24.9337 23.25 25H25.25ZM24.591 23.409C24.169 22.987 23.5967 22.75 23 22.75V24.75C23.0663 24.75 23.1299 24.7763 23.1768 24.8232L24.591 23.409ZM23 22.75H18V24.75H23V22.75ZM18 22.75C17.4033 22.75 16.831 22.9871 16.409 23.409L17.8232 24.8232C17.8701 24.7763 17.9337 24.75 18 24.75V22.75ZM16.409 23.409C15.9871 23.831 15.75 24.4033 15.75 25H17.75C17.75 24.9337 17.7763 24.8701 17.8232 24.8232L16.409 23.409ZM15.75 25V33.75H17.75V25H15.75Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <span class="custom-option-title">Home</span>
                                                        <small> Delivery time (9am – 9pm) </small>
                                                    </span>
                                                    <input name="customplace" class="form-check-input" type="radio"
                                                        value="home" id="customplace" checked />
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md mb-md-0 mb-3">
                                            <div class="form-check custom-option custom-option-icon">
                                                <label class="form-check-label custom-option-content"
                                                    for="customRadioOffice">
                                                    <span class="custom-option-body">
                                                        <svg width="41" height="40" viewBox="0 0 41 40"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M22.75 33.75V6.25C22.75 5.91848 22.6183 5.60054 22.3839 5.36612C22.1495 5.1317 21.8315 5 21.5 5H6.5C6.16848 5 5.85054 5.1317 5.61612 5.36612C5.3817 5.60054 5.25 5.91848 5.25 6.25V33.75"
                                                                fill="currentColor" fill-opacity="0.2" />
                                                            <path
                                                                d="M2.75 32.75C2.19772 32.75 1.75 33.1977 1.75 33.75C1.75 34.3023 2.19772 34.75 2.75 34.75V32.75ZM37.75 34.75C38.3023 34.75 38.75 34.3023 38.75 33.75C38.75 33.1977 38.3023 32.75 37.75 32.75V34.75ZM21.75 33.75C21.75 34.3023 22.1977 34.75 22.75 34.75C23.3023 34.75 23.75 34.3023 23.75 33.75H21.75ZM21.5 5V4V5ZM5.25 6.25H4.25H5.25ZM4.25 33.75C4.25 34.3023 4.69772 34.75 5.25 34.75C5.80228 34.75 6.25 34.3023 6.25 33.75H4.25ZM34.25 33.75C34.25 34.3023 34.6977 34.75 35.25 34.75C35.8023 34.75 36.25 34.3023 36.25 33.75H34.25ZM22.75 14C22.1977 14 21.75 14.4477 21.75 15C21.75 15.5523 22.1977 16 22.75 16V14ZM10.25 10.25C9.69772 10.25 9.25 10.6977 9.25 11.25C9.25 11.8023 9.69772 12.25 10.25 12.25V10.25ZM15.25 12.25C15.8023 12.25 16.25 11.8023 16.25 11.25C16.25 10.6977 15.8023 10.25 15.25 10.25V12.25ZM12.75 20.25C12.1977 20.25 11.75 20.6977 11.75 21.25C11.75 21.8023 12.1977 22.25 12.75 22.25V20.25ZM17.75 22.25C18.3023 22.25 18.75 21.8023 18.75 21.25C18.75 20.6977 18.3023 20.25 17.75 20.25V22.25ZM10.25 26.5C9.69772 26.5 9.25 26.9477 9.25 27.5C9.25 28.0523 9.69772 28.5 10.25 28.5V26.5ZM15.25 28.5C15.8023 28.5 16.25 28.0523 16.25 27.5C16.25 26.9477 15.8023 26.5 15.25 26.5V28.5ZM27.75 26.5C27.1977 26.5 26.75 26.9477 26.75 27.5C26.75 28.0523 27.1977 28.5 27.75 28.5V26.5ZM30.25 28.5C30.8023 28.5 31.25 28.0523 31.25 27.5C31.25 26.9477 30.8023 26.5 30.25 26.5V28.5ZM27.75 20.25C27.1977 20.25 26.75 20.6977 26.75 21.25C26.75 21.8023 27.1977 22.25 27.75 22.25V20.25ZM30.25 22.25C30.8023 22.25 31.25 21.8023 31.25 21.25C31.25 20.6977 30.8023 20.25 30.25 20.25V22.25ZM2.75 34.75H37.75V32.75H2.75V34.75ZM23.75 33.75V6.25H21.75V33.75H23.75ZM23.75 6.25C23.75 5.65326 23.5129 5.08097 23.091 4.65901L21.6768 6.07322C21.7237 6.12011 21.75 6.18369 21.75 6.25H23.75ZM23.091 4.65901C22.669 4.23705 22.0967 4 21.5 4V6C21.5663 6 21.6299 6.02634 21.6768 6.07322L23.091 4.65901ZM21.5 4H6.5V6H21.5V4ZM6.5 4C5.90326 4 5.33097 4.23705 4.90901 4.65901L6.32322 6.07322C6.37011 6.02634 6.4337 6 6.5 6V4ZM4.90901 4.65901C4.48705 5.08097 4.25 5.65326 4.25 6.25H6.25C6.25 6.1837 6.27634 6.12011 6.32322 6.07322L4.90901 4.65901ZM4.25 6.25V33.75H6.25V6.25H4.25ZM36.25 33.75V16.25H34.25V33.75H36.25ZM36.25 16.25C36.25 15.6533 36.013 15.081 35.591 14.659L34.1768 16.0732C34.2237 16.1201 34.25 16.1837 34.25 16.25H36.25ZM35.591 14.659C35.169 14.2371 34.5967 14 34 14V16C34.0663 16 34.1299 16.0263 34.1768 16.0732L35.591 14.659ZM34 14H22.75V16H34V14ZM10.25 12.25H15.25V10.25H10.25V12.25ZM12.75 22.25H17.75V20.25H12.75V22.25ZM10.25 28.5H15.25V26.5H10.25V28.5ZM27.75 28.5H30.25V26.5H27.75V28.5ZM27.75 22.25H30.25V20.25H27.75V22.25Z"
                                                                fill="currentColor" />
                                                        </svg>

                                                        <span class="custom-option-title"> Office </span>
                                                        <small> Delivery time (9am – 5pm) </small>
                                                    </span>
                                                    <input name="customplace" class="form-check-input" type="radio"
                                                        value="office" id="customplace" />
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalAddressFirstName">Full Name</label>
                                        <input type="text" id="customfullName" name="customfullName"
                                            class="form-control" placeholder="John" />
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalemail">Email</label>
                                        <input type="text" id="custommodalemail" name="custommodalemail"
                                            class="form-control" placeholder="@ example.com" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label" for="modalAddressLastName">Phone Number</label>
                                        <input type="phone" id="customphoneNumber" name="customphoneNumber"
                                            value="90-(164)-188-556" class="form-control" placeholder="Doe" />
                                    </div>
                                    <div class="col-12 col-md-6 ">
                                        <label class="form-label" for="modalAddressCountry">Country</label>
                                        <select id="modalAddressCountry" name="modalAddressCountry"
                                            class="select2 form-select" data-allow-clear="true">
                                            <option value="">Select</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Canada">Canada</option>
                                            <option value="China">China</option>
                                            <option value="France">France</option>
                                            <option value="Germany">Germany</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Korea">Korea, Republic of</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Russia">Russian Federation</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Libya">Libya</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Syria">Syria</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Yemen">Yemen</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea placeholder="country/state/city/landmark/street/district/building/floor " class="form-control"
                                        id="customaddress" name="customaddress" rows="4"> </textarea>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md mb-md-0 mb-2">
                                        <div
                                            class="form-check custom-option custom-option-icon position-relative checked">
                                            <label class="form-check-label custom-option-content"
                                                for="customRadioDelivery1">
                                                <span class="custom-option-body">
                                                    <i class="ti ti-users ti-lg"></i>
                                                    <span class="custom-option-title mb-1">Standard</span>
                                                    <span class="badge bg-label-success btn-pinned">FREE</span>
                                                    <small>Get your product in 1 Week.</small>
                                                </span>
                                                <input name="customdelivery" class="form-check-input" type="radio"
                                                    value="standard" id="customdelivery" checked="" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md mb-md-0 mb-2">
                                        <div class="form-check custom-option custom-option-icon position-relative">
                                            <label class="form-check-label custom-option-content"
                                                for="customRadioDelivery2">
                                                <span class="custom-option-body">
                                                    <i class="ti ti-crown ti-lg"></i>
                                                    <span class="custom-option-title mb-1">Express</span>
                                                    <span class="badge bg-label-secondary btn-pinned">$10</span>
                                                    <small>Get your product in 3-4 days.</small>
                                                </span>
                                                <input name="customdelivery" class="form-check-input" type="radio"
                                                    value="express" id="customdelivery" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-check custom-option custom-option-icon position-relative">
                                            <label class="form-check-label custom-option-content"
                                                for="customRadioDelivery3">
                                                <span class="custom-option-body">
                                                    <i class="ti ti-brand-telegram ti-lg"></i>
                                                    <span class="custom-option-title mb-1">Overnight</span>
                                                    <span class="badge bg-label-secondary btn-pinned">$15</span>
                                                    <small>Get your product in 0-1 days.</small>
                                                </span>
                                                <input name="customdelivery" class="form-check-input" type="radio"
                                                    value="overnight" id="customRadioDelivery3" />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Address right -->
                            <div class="col-xl-4 col-xxl-3">
                                <div class="border rounded p-4 pb-3 mb-3">
                                    @php
                                        $totalPriceInformation = 0;
                                    @endphp
                                    <!-- Estimated Delivery -->
                                    <h6>Estimated Delivery Date</h6>
                                    <ul class="list-unstyled">
                                        @foreach ($carts as $cart)
                                            @php
                                                $totalPriceInformation += $cart['price'] * $cart['quantity'];
                                            @endphp

                                            <li class="d-flex gap-3 align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset('images/' . $cart['image']) }}" alt="google home"
                                                        class="w-px-50" />
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="mb-0">
                                                        <a class="text-body" href="javascript:void(0)">{{ $cart['title'] }} </a>
                                                    </p>
                                                    <p class="fw-medium">Quantity : {{ $cart['quantity'] }}  </p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <hr class="mx-n4" />

                                    <!-- Price Details -->
                                    <h6>Price Details</h6>
                                    <dl class="row mb-0">
                                        <dt class="col-6 fw-normal text-heading">Order Total</dt>
                                        <dd class="col-6 text-end">${{ number_format($totalPriceInformation, 2) }}
                                        </dd>

                                        <dt class="col-6 fw-normal text-heading">Delivery Charges</dt>
                                        <dd class="col-6 text-end">
                                            <s class="text-muted">$5.00</s> <span
                                                class="badge bg-label-success ms-1">Free</span>
                                        </dd>
                                    </dl>
                                    <hr class="mx-n4" />
                                    <dl class="row mb-0">
                                        <dt class="col-6 text-heading">Total</dt>
                                        <dd class="col-6 fw-medium text-end text-heading mb-0">
                                            ${{ number_format($totalPriceInformation, 2) }}</dd>
                                    </dl>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-next">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment -->
                    <div id="checkout-payment" class="content">
                        <div class="row">
                            <!-- Payment left -->
                            <div class="col-xl-8 col-xxl-9 mb-3 mb-xl-0">
                                <!-- Payment Tabs -->
                                <div class="col-xxl-6 col-lg-8">
                                    <ul class="nav nav-pills card-header-pills mb-3" id="paymentTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-cc-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-cc" type="button" role="tab"
                                                aria-controls="pills-cc" aria-selected="true">
                                                On OMT
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-cod-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-cod" type="button" role="tab"
                                                aria-controls="pills-cod" aria-selected="false">
                                                Cash On Delivery
                                            </button>
                                        </li>

                                    </ul>
                                    <div class="tab-content px-0" id="paymentTabsContent">
                                        <!-- Credit card -->
                                        <div class="tab-pane fade show active" id="pills-cc" role="tabpanel"
                                            aria-labelledby="pills-cc-tab">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label class="form-label w-100" for="paymentCard">Full Name
                                                        Receiver
                                                    </label>
                                                    <div class="input-group input-group-merge">
                                                        <input id="fullnamereceiver" name="fullnamereceiver"
                                                            class="form-control " type="text" readonly />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label class="form-label" for="emailreceiver">Email
                                                        Receiver</label>
                                                    <input type="text" id="emailreceiver" name="emailreceiver"
                                                        class="form-control" readonly />
                                                </div>
                                                <div class="col-12">
                                                    <label class="switch">
                                                        <input type="checkbox" class="switch-input" id="onOmt"
                                                            name="onOmt" />
                                                        <span class="switch-toggle-slider">
                                                            <span class="switch-on"></span>
                                                            <span class="switch-off"></span>
                                                        </span>
                                                        <span class="switch-label">On OMT</span>
                                                    </label>
                                                </div>


                                                <div class="col-12">
                                                    <button type="submit"
                                                    id="submitButton"    class="btn btn-primary  me-sm-3 me-1">Confirmation Order</button>
                                                    <button type="reset"
                                                        class="btn btn-label-secondary">Cancel</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- COD -->
                                        <div class="tab-pane fade" id="pills-cod" role="tabpanel"
                                            aria-labelledby="pills-cod-tab">
                                            <div class="col-12">
                                                <label class="switch">
                                                    <input type="checkbox" class="switch-input" id="ondelevery"
                                                        name="ondelevery" />
                                                    <span class="switch-toggle-slider">
                                                        <span class="switch-on"></span>
                                                        <span class="switch-off"></span>
                                                    </span>
                                                    <span class="switch-label">On Delevery</span>
                                                </label>
                                            </div>


                                            <p style="margin-top: 20px;">
                                                Cash on Delivery is a type of payment method where the recipient make
                                                payment for the order
                                                at the time of delivery rather than in advance.
                                            </p>


                                            <button type="submit" id="deliveryButton"     class="btn btn-primary ">Confirmation Order</button>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <!-- Address right -->
                            <div class="col-xl-4 col-xxl-3">
                                <div class="border rounded p-4">
                                    <!-- Price Details -->
                                    <h6>Price Details</h6>
                                    <dl class="row">
                                        <dt class="col-6 fw-normal text-heading">Order Total</dt>
                                        <dd class="col-6 text-end">$1198.00</dd>

                                        <dt class="col-6 fw-normal text-heading">Delivery Charges</dt>
                                        <dd class="col-6 text-end">
                                            <s class="text-muted">$5.00</s> <span
                                                class="badge bg-label-success ms-1">Free</span>
                                        </dd>
                                    </dl>
                                    <hr class="mx-n4" />
                                    <dl class="row">
                                        <dt class="col-6 text-heading mb-3">Total</dt>
                                        <dd class="col-6 fw-medium text-end mb-0">$1198.00</dd>


                                    </dl>
                                    <!-- Address Details -->

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Confirmation -->
                    <div id="checkout-confirmation" class="content">
                        <div class="row mb-3">
                            <div class="col-12 col-lg-8 mx-auto text-center mb-3">
                                <h4 class="mt-2">Thank You! 😇</h4>
                                <p id="orderMessage">Your order <a href="javascript:void(0)">#1536548131</a> has been placed!</p>
                                <p>
                                    We sent an email to you
                                    with your order
                                    confirmation and receipt. If the email hasn't arrived within two minutes, please
                                    check your spam
                                    folder to see if the email was routed there.
                                </p>
                                <p>
                                    <span class="fw-medium"><i class="ti ti-clock me-1"></i> Time placed:&nbsp;</span>
                                    25/05/2020
                                    13:35pm
                                </p>
                            </div>
                            <!-- Confirmation details -->

                        </div>


                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
       
        function submitPaymentForm() {
        // Serialize the form data
        var formData = $('#wizard-checkout-form').serialize();
        
        // Send the Ajax request
        $.ajax({
            url: '{{ route("order.submit") }}',
            type: 'POST',
            data: formData,
            success: function(response){
                console.log('hii');
                console.log(response.status);
                // If the response indicates success, show the confirmation
                if(response.status === "success") {
                    showConfirmation();
                    var orderId = response.orderId;
                    $('p#orderMessage a').text('#' + orderId);
                }
            },
            error: function(xhr){
                // Handle error response
                console.log(xhr.responseText);
            }
        });
    }

    $(document).ready(function(){
        $('#submitButton, #deliveryButton').click(function(event){
            event.preventDefault(); // Prevent the default form submission
            
            // Call the function to submit form data via Ajax
            submitPaymentForm();
        });
    });
       

        function showConfirmation() {
            document.getElementById("checkout-payment").style.display = "none";
            document.getElementById("checkout-confirmation").style.display = "block";
        }

        // Event listener for payment form submission
       
    });
</script>
