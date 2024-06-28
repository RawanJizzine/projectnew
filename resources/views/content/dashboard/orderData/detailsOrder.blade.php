@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
  @media (max-width: 767px) {
    .price-details-section {
        padding-left: 0 !important;
        padding-top: 20px !important;
    }

    .comment-section {
        padding-top: 20px !important;
    }
}
    .accordion-button .fa-circle-chevron-up {
        transition: transform 0.2s ease-in-out;
    }

    .rotate {
        transform: rotate(180deg);
    }

    .accordion-button {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
    }

    .accordion-title {
        font-size: 1.5rem;
        /* Adjust the font size as needed */
        margin: 0;
        flex-grow: 1;
    }

    .accordion-button i {
        font-size: 30px;
        padding-left: 20px;
        /* Adjust padding if needed */
    }

    .title-container {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        margin: 0;
    }

    .title-left {
        margin: 0;
        margin-right: 40%;
        padding: 0;
        font-size: 22px;
        flex: 1 1 100%;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .title-right {
        margin: 0;
        padding: 0;
        margin-right: 15%;
        font-size: 22px;
        flex: 1 1 100%;
    }

    .info-row {
        display: flex;
        align-items: center;
        margin-top: 5px;
        font-size: 16px;
    }

    .info-label {
        font-weight: 500;
    }

    .info-value {
        margin-left: 10px;
        /* Adjust the margin as needed */
    }

    @media (min-width: 700px) {
        .title-container {
            flex-wrap: nowrap;
        }

        .title-left {
            flex: 1 1 auto;

        }

        .title-right {
            flex: 1 1 auto;


        }

    }

    @media (max-width: 699px) {

        .title-left,
        .title-right {
            flex: 1 1 100%;
            margin-right: 0;
            margin-top: 12px;
        }

    }

    .row-cart {
        display: flex;
        align-items: center;
        margin-top: 5px;
        font-size: 16px;
    }

    @media (max-width: 768px) {

        .comment-section,
        .price-details-section {
            padding-top: 20px !important;
        }

        .price-details-section {
            padding-left: 0 !important;
        }
    }

    .modal#statusSuccessModal .modal-content,
    .modal#statusErrorsModal .modal-content,
    .modal#deleteSuccessModal .modal-content,
    .modal#deleteErrorModal .modal-content,
    .modal#deleteConfirmationModal .modal-content {
        border-radius: 30px;
    }

    .modal#statusSuccessModal .modal-content svg,
    .modal#statusErrorsModal .modal-content svg,
    .modal#deleteSuccessModal .modal-content svg,
    .modal#deleteErrorModal .modal-content svg,
    .modal#deleteConfirmationModal .modal-content svg {
        width: 100px;
        display: block;
        margin: 0 auto;
    }

    .modal#statusSuccessModal .modal-content .path,
    .modal#statusErrorsModal .modal-content .path,
    .modal#deleteSuccessModal .modal-content .path,
    .modal#deleteErrorModal .modal-content .path,
    .modal#deleteConfirmationModal .modal-content .path {
        stroke-dasharray: 1000;
        stroke-dashoffset: 0;
    }

    .modal#statusSuccessModal .modal-content .path.circle,
    .modal#statusErrorsModal .modal-content .path.circle,
    .modal#deleteSuccessModal .modal-content .path.circle,
    .modal#deleteErrorModal .modal-content .path.circle,
    .modal#deleteConfirmationModal .modal-content .path.circle {
        -webkit-animation: dash 0.9s ease-in-out;
        animation: dash 0.9s ease-in-out;
    }

    .modal#statusSuccessModal .modal-content .path.line,
    .modal#statusErrorsModal .modal-content .path.line,
    .modal#deleteSuccessModal .modal-content .path.line,
    .modal#deleteErrorModal .modal-content .path.line,
    .modal#deleteConfirmationModal .modal-content .path.line {
        stroke-dashoffset: 1000;
        -webkit-animation: dash 0.95s 0.35s ease-in-out forwards;
        animation: dash 0.95s 0.35s ease-in-out forwards;
    }

    .modal#statusSuccessModal .modal-content .path.check,
    .modal#statusErrorsModal .modal-content .path.check,
    .modal#deleteSuccessModal .modal-content .path.check,
    .modal#deleteErrorModal .modal-content .path.check,
    .modal#deleteConfirmationModal .modal-content .path.check {
        stroke-dashoffset: -100;
        -webkit-animation: dash-check 0.95s 0.35s ease-in-out forwards;
        animation: dash-check 0.95s 0.35s ease-in-out forwards;
    }

    @-webkit-keyframes dash {
        0% {
            stroke-dashoffset: 1000;
        }

        100% {
            stroke-dashoffset: 0;
        }
    }

    @keyframes dash {
        0% {
            stroke-dashoffset: 1000;
        }

        100% {
            stroke-dashoffset: 0;
        }
    }

    @-webkit-keyframes dash-check {
        0% {
            stroke-dashoffset: -100;
        }

        100% {
            stroke-dashoffset: 900;
        }
    }

    @keyframes dash-check {
        0% {
            stroke-dashoffset: -100;
        }

        100% {
            stroke-dashoffset: 900;
        }
    }


</style>

@section('content')

    <div class="col-md">
        <h4 class=" fw-medium">Order #{{ $order->id }}</h4>
        <div id="accordionIcon" class="accordion mt-3 accordion-without-arrow">
            <div class="accordion-item card">
                <h1 class="accordion-header text-body d-flex justify-content-between align-items-center"
                    id="accordionIconOne">
                    <button type="button"
                        class="accordion-button collapsed d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#accordionIcon-1" aria-controls="accordionIcon-1">
                        <span class="accordion-title">Order and Account</span>
                        <i class="fa-solid fa-circle-chevron-down"></i>
                    </button>
                </h1>
                <div id="accordionIcon-1" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
                    <div style="margin-top: 2%;" class="accordion-body">
                        <hr>
                        <div class="title-container">

                            <div class="title-left">
                                <h3>Order Information</h3>
                                <div class="info-row">
                                    <span class="info-label">Order Date</span><span
                                        style="margin-left:25px;">{{ $order->created_at }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Order Status</span><span class="info-value">Order
                                        {{ $order->status }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Address</span><span style="margin-left:50px;">
                                        <textarea name="description" class="form-control" cols="70" rows="7" required>{{ $order->customaddress }} </textarea>
                                    </span>
                                </div>
                            </div>

                            <div class="title-right">
                                <h3>Account Information</h3>
                                <div class="info-row">
                                    <span class="info-label">Customer Name </span><span
                                        style="margin-left:25px;">{{ $order->customfullName }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Email</span><span style="margin-left:110px;"
                                        class="info-value">{{ $order->custommodalemail }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Channel</span><span style="margin-left:90px;"
                                        class="info-value">{{ $order->modalAddressCountry }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="accordionIconTwo" class="accordion mt-3 accordion-without-arrow">
            <div class="accordion-item card">
                <h1 class="accordion-header text-body d-flex justify-content-between align-items-center"
                    id="accordionIconTwo">
                    <button type="button"
                        class="accordion-button collapsed d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#accordionIcon-2" aria-controls="accordionIcon-2">
                        <span class="accordion-title">Payment</span>
                        <i class="fa-solid fa-circle-chevron-down"></i>
                    </button>
                </h1>
                <div id="accordionIcon-2" class="accordion-collapse collapse" data-bs-parent="#accordionIconTwo">
                    <div style="margin-top: 2%;" class="accordion-body">
                        <hr>
                        <div class="title-container">

                            <div class="title-left">
                                <h3>Order Payment</h3>
                                <div class="info-row">
                                    <span class="info-label">On OMT</span><span
                                        style="margin-left:47px;">{{ $order->switchonOmt == 1 ? 'YES' : 'NO' }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">On Delivery</span><span
                                        style="margin-left:25px;">{{ $order->switchondelivery == 1 ? 'YES' : 'NO' }}</span>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="accordionIconThree" class="accordion mt-3 accordion-without-arrow">
            <div class="accordion-item card">
                <h1 class="accordion-header text-body d-flex justify-content-between align-items-center"
                    id="accordionIconThree">
                    <button type="button"
                        class="accordion-button collapsed d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#accordionIcon-3" aria-controls="accordionIcon-3">
                        <span class="accordion-title">Products Ordered</span>
                        <i class="fa-solid fa-circle-chevron-down"></i>
                    </button>
                </h1>
                <div id="accordionIcon-3" class="accordion-collapse collapse" data-bs-parent="#accordionIconThree">
                    <div style="margin-top: 2%;" class="accordion-body">
                        <hr>
                        <div class="title-container">

                            <div class="table-wrapper">



                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>SKU</th>
                                            <th>Barcode</th>
                                            <th>Product Name </th>
                                            <th>Unit Price</th>
                                            <th>Subtotal</th>
                                            <th>Discount Amount</th>
                                            <th>Tax Amount</th>
                                            <th>Grand Total</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders ?? [] as $index => $data)
                                            <tr>

                                                @if ($data->product)
                                                    <td>{{ $data->product->sku }} </td>
                                                    <td>{{ $data->product->barcode }} </td>
                                                    <td>{{ $data->product->title }} </td>
                                                    <td>{{ $data->product->price }} </td>
                                                    <td>{{ $data->product->price * $data->quantity }}</td>
                                                    <td>0.00 </td>
                                                    <td>0.00 </td>
                                                    <td>{{ $data->product->price * $data->quantity }} </td>
                                                @else
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>



                                </table>






                            </div>


                        </div>

                        <div class="container mt-4">
                          <div class="row">
                              <div class="col-12 col-lg-6 comment-section" style="padding-top: 50px;">
                                  <form id="commentForm" method="POST">
                                      @csrf
                                      <label style="font-size: 20px;" class="form-label">Comment</label>
                                      <textarea name="description" class="form-control" cols="70" rows="7" required></textarea>
                                      <input type="hidden" name="orderEmail" value="{{ $order->custommodalemail }}">
                                      <button style="margin-top: 20px; width: 100%; height: 50px;" type="submit" class="btn btn-primary">Submit Comment</button>
                                  </form>
                              </div>
                      
                              <div class="col-12 col-lg-6 price-details-section ms-auto" style="padding-left: 10px; padding-top: 50px;">
                                  <div class="border rounded p-4 mb-3 pb-3">
                                      <!-- Price Details -->
                                      <h6>Price Details</h6>
                                      <hr class="mx-n4" />
                                      <dl class="row mb-0">
                                          <dt class="col-6 fw-normal text-heading">Bag Total</dt>
                                          <dd class="col-6 text-end">${{ $order->total_price }}</dd>
                      
                                          <dt class="col-6 fw-normal">Coupon Discount</dt>
                                          <dd class="col-6 text-end">$0.00</dd>
                      
                                          <dt class="col-6 fw-normal text-heading">Order Total</dt>
                                          <dd class="col-6 text-end">${{ $order->total_price }}</dd>
                      
                                          <dt class="col-6 fw-normal text-heading">Delivery Charges</dt>
                                          <dd class="col-6 text-end">
                                              <s class="text-muted">$5.00</s> <span class="badge bg-label-success ms-1">Free</span>
                                          </dd>
                                      </dl>
                                      <hr class="mx-n4" />
                                      <dl class="row mb-0">
                                          <dt class="col-6 text-heading">Total</dt>
                                          <dd class="col-6 fw-medium text-end text-heading mb-0">${{ $order->total_price }}</dd>
                                      </dl>
                                  </div>
                              </div>
                          </div>
                      </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="statusErrorsModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-lg-4">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#db3646" stroke-width="6"
                            stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round"
                            stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3" />
                        <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round"
                            stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2" />
                    </svg>
                    <h4 class="text-danger mt-3">Error!</h4>
                    <p class="mt-3">An error occurred while saving data.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-danger" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="statusSuccessModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-lg-4">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#198754" stroke-width="6"
                            stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <polyline class="path check" fill="none" stroke="#198754" stroke-width="6"
                            stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                    </svg>
                    <h4 class="text-success mt-3">Oh Yeah!</h4>
                    <p class="mt-3">You have successfully saved data.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal"
                        id="SuccessOkBtn">Ok</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@include('content.dashboard.appointments.scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var accordionButtons = document.querySelectorAll('#accordionIcon .accordion-button');

        accordionButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var icon = this.querySelector('i');
                var allIcons = document.querySelectorAll('#accordionIcon i');

                allIcons.forEach(function(ic) {
                    ic.classList.remove('fa-circle-chevron-up');
                    ic.classList.add('fa-circle-chevron-down');
                });

                if (this.classList.contains('collapsed')) {
                    icon.classList.remove('fa-circle-chevron-up');
                    icon.classList.add('fa-circle-chevron-down');
                } else {
                    icon.classList.remove('fa-circle-chevron-down');
                    icon.classList.add('fa-circle-chevron-up');
                }
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        var accordionButtons = document.querySelectorAll('#accordionIconTwo .accordion-button');

        accordionButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var icon = this.querySelector('i');
                var allIcons = document.querySelectorAll('#accordionIconTwo i');

                allIcons.forEach(function(ic) {
                    ic.classList.remove('fa-circle-chevron-up');
                    ic.classList.add('fa-circle-chevron-down');
                });

                if (this.classList.contains('collapsed')) {
                    icon.classList.remove('fa-circle-chevron-up');
                    icon.classList.add('fa-circle-chevron-down');
                } else {
                    icon.classList.remove('fa-circle-chevron-down');
                    icon.classList.add('fa-circle-chevron-up');
                }
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        var accordionButtons = document.querySelectorAll('#accordionIconThree .accordion-button');

        accordionButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var icon = this.querySelector('i');
                var allIcons = document.querySelectorAll('#accordionIconThree i');

                allIcons.forEach(function(ic) {
                    ic.classList.remove('fa-circle-chevron-up');
                    ic.classList.add('fa-circle-chevron-down');
                });

                if (this.classList.contains('collapsed')) {
                    icon.classList.remove('fa-circle-chevron-up');
                    icon.classList.add('fa-circle-chevron-down');
                } else {
                    icon.classList.remove('fa-circle-chevron-down');
                    icon.classList.add('fa-circle-chevron-up');
                }
            });
        });
    });
    $(document).ready(function() {
        $('#commentForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = $(this).serialize(); // Serialize the form data

            $.ajax({
                url: "{{ route('submit.comment.order') }}", // Use the route URL
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Handle the success response here
                    $('#statusSuccessModal').modal('show');
                    // Optionally, clear the form or update the UI
                    $('#commentForm')[0].reset();
                },
                error: function(xhr) {
                    // Handle the error response here
                    $('#statusErrorsModal').modal('show');
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
