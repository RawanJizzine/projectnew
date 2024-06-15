@section('title', 'Landing Page ')

@extends('layouts/layoutFront')
@section('contentFront')

    <section class="section-py bg-body first-section-pt">
        <div class="container mt-2">
            <div class="card px-3">

                <div class="col-xl-4 col-lg-6 mx-auto ">
                    <div class="card   border border-primary shadow-lg">
                        <div class="card-header">
                            <div class="text-center">
                                <img  src="{{asset('storage/'.$plan_pricing_data->image ?? '')}}"   alt="paper airplane icon" class="mb-4 pb-2" />
                                <h4 class="mb-1">{{ $plan_pricing_data->title ?? '' }}</h4>
                                <div class="d-flex align-items-center justify-content-center">
                                    <span
                                        class="price-monthly h1 text-primary fw-bold mb-0">${{ $plan_pricing_data->monthly_price ?? '' }}</span>
                                    <span
                                        class="price-yearly h1 text-primary fw-bold mb-0 d-none">${{ $plan_pricing_data->yearly_price ?? '' }}</span>
                                    <sub class="h6 text-muted mb-0 ms-1">/mo</sub>
                                </div>
                                <div class="position-relative pt-2">
                                    <div class="price-yearly text-muted price-yearly-toggle d-none">$
                                        {{ $plan_pricing_data->price_total_one ?? '' }} / year</div>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <ul class="list-unstyled">
                                @foreach ($plan_pricing_data->planLists ?? [] as $first)
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"><i
                                                    class="ti ti-check ti-xs"></i></span>
                                            {{ $first['content_list'] ?? '' }}
                                        </h5>
                                    </li>
                                @endforeach

                            </ul>
                            <div class="d-grid mt-4 pt-3">
                                <a href="" class="btn btn-label-primary"
                                    id="paymentPlan1">{{ $plan_pricing_data->text_button ?? '' }}</a>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">

                    <div class="col-lg-5 card-body border-end">
                        <h4 class="mb-2">Checkout</h4>
                        <p class="mb-0">
                            All plans include 40+ advanced tools and features to boost your product. <br />
                            Choose the best plan to fit your needs.
                        </p>
                        <div class="row py-4 my-2">

                            <div class="col-md mb-md-0 mb-2">
                                <div class="form-check custom-option custom-option-basic">
                                    <label
                                        class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center"
                                        for="customRadioPaypal">
                                        <input name="customRadioTemp" class="form-check-input" type="radio" value="paypal"
                                            id="customRadioPaypal" checked />
                                        <span class="custom-option-body">
                                            <img src="../../assets/img/icons/payments/paypal-light.png" alt="paypal"
                                                width="58" data-app-light-img="icons/payments/paypal-light.png"
                                                data-app-dark-img="icons/payments/paypal-dark.png" />
                                            <span class="ms-3">Paypal</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <h4 class="mt-2 mb-4">Billing Details</h4>
                        <form id="subscriptionForm" method="POST" action="{{ route('process-subscription') }}">
                            @csrf
                            <div class="row g-3">
                                <input type="hidden" name="plan_name" id="billings-plan-name"
                                    value="{{ $plan_select }}" />
                                <input type="hidden" name="monthly_payment" id="plan-name"
                                    value="{{ $plan_pricing_data->monthly_price }}" />
                                <input type="hidden" name="total_payment" id="total_payment"
                                    value="{{ 4.99 + 59.99 + $plan_pricing_data->monthly_price }}" />

                                <div class="col-md-6">
                                    <label class="form-label" for="billings-email">Email Address</label>
                                    <input type="text" name="email" id="billings-email" class="form-control" required
                                        placeholder="john.doe@gmail.com" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="billings-password">Password</label>
                                    <input type="password" name="password" id="billings-password" class="form-control"
                                        required placeholder="Password" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="billings-country">Country</label>
                                    <select id="billings-country" name="country" class="form-select"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Canada">Canada</option>
                                        <option value="China">China</option>
                                        <option value="France">France</option>
                                        <option value="Germany">Germany</option>
                                        <option value="India">India</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="billings-zip">Billing Zip / Postal Code</label>
                                    <input type="text" id="billings-zip" class="form-control billings-zip-code"
                                        name="zip" placeholder="Zip / Postal Code" />
                                </div>
                            </div>
                            <div class="d-grid mt-3">
                                <button type="submit" name="submit" class="btn btn-success">
                                    <span class="me-2">Proceed with Payment</span>
                                    <i class="ti ti-arrow-right scaleX-n1-rtl"></i>
                                </button>
                            </div>
                        </form>

                    </div>
                    <div class="col-lg-5 card-body">
                        <h4 class="mb-2">Order Summary</h4>
                        <p class="pb-2 mb-0">
                            It can help you manage and service orders before,<br />
                            during and after fulfilment.
                        </p>
                        <div class="bg-lighter p-4 rounded mt-4">
                            <p class="mb-1">A simple start for everyone</p>
                            <div class="d-flex align-items-center">
                                <h1 class="text-heading display-5 mb-1">$59.99</h1>
                                <sub>/month</sub>
                            </div>

                        </div>
                        <div>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <p class="mb-0">Subtotal</p>


                                <h6 class="mb-0">${{ 59.99 + $plan_pricing_data->monthly_price }}</h6>

                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <p class="mb-0">Tax</p>
                                <h6 class="mb-0">$4.99</h6>
                            </div>
                            <hr />
                            <div class="d-flex justify-content-between align-items-center mt-3 pb-1">

                                <p class="mb-0">Total</p>

                                <h6 class="mb-0">${{ 4.99 + 59.99 + $plan_pricing_data->monthly_price }}</h6>

                            </div>


                            <p class="mt-4 pt-2">
                                By continuing, you accept to our Terms of Services and Privacy Policy. Please note that
                                payments are
                                non-refundable.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>


<script>
    $(document).ready(function() {
        $('#subscriptionForm').submit(function(e) {
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
                    alert("save Data Successfuly")
                    var frontPageUrl = "{{ route('front-page') }}";
                    window.open(frontPageUrl);
                },
                error: function(error) {
                    alert('Error Here!');
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
