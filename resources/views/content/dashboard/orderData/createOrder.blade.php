@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
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


    <div class="text-center mb-4">
        <h3 class="address-title mb-2">Add New Order</h3>
        <p class="text-muted address-subtitle">Add new order for your business</p>
    </div>
    <form action="{{ route('orders.store.dashboard') }}" method="POST" id="addNewOrderForm" class="row g-3">
        @csrf
        <div class="col-12">
            <label class="form-label" for="modalFullName">Customer Full Name</label>
            <input type="text" id="modalFullName" name="customer_name" class="form-control" placeholder="John"
                required />
        </div>

        <div class="product-group-container">
            <x-card>
                <x-slot name="title"></x-slot>
                <x-slot name="body">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalAddressLastName">Categories</label>
                            <select id="categori0" name="products[0][categori]" class="select2 form-select category-select"
                                data-allow-clear="true" required>
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalProduct">Products</label>
                            <select id="products0" name="products[0][id]" class="select2 form-select product-select"
                                data-allow-clear="true" required>
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="priceperunit">Price Per Unit</label>
                            <input type="text" id="priceperunit0" name="products[0][price]"
                                class="form-control price-per-unit" readonly required />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="quantity">Quantity</label>
                            <input type="number" id="quantity0" name="products[0][quantity]" class="form-control"
                                min="1" required />
                        </div>
                    </div>
                </x-slot>
            </x-card>
        </div>

        <div id="products-container"></div>
        <div class="col-12 text-center">
            <button type="button" id="add-product" class="btn btn-secondary">Add Another Product</button>
        </div>
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Add Order</button>
        </div>
    </form>

    <div class="modal fade" id="statusErrorsModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-lg-4">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#db3646" stroke-width="6" stroke-miterlimit="10"
                            cx="65.1" cy="65.1" r="62.1" />
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
        let productIndex = 1;

        function updateProductSelects() {
            $('.category-select').off('change').on('change', function() {
                let categoryId = $(this).val();
                let categoryName = $(this).find('option:selected').text();
                let productSelectId = $(this).attr('id').replace('categori', 'products');

                if (categoryId) {
                    $.ajax({
                        url: `/product-category/${categoryId}`,
                        type: 'GET',
                        success: function(data) {
                            let productsSelect = $(`#${productSelectId}`);
                            productsSelect.empty();
                            productsSelect.append('<option value="">Select</option>');
                            data.forEach(function(product) {
                                productsSelect.append(
                                    `<option value="${product.id}">${product.title}</option>`
                                );
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Failed to fetch products:', error);
                        }
                    });

                    // Make selected category the first option
                    $(this).prepend(`<option value="${categoryId}" selected>${categoryName}</option>`);
                    $(this).find('option[value=""]').remove();
                } else {
                    $(`#${productSelectId}`).empty();
                    $(`#${productSelectId}`).append('<option value="">Select</option>');
                }
            });

            $('.product-select').off('change').on('change', function() {
                let productId = $(this).val();
                let priceInputId = $(this).attr('id').replace('products', 'priceperunit');
                if (productId) {
                    $.ajax({
                        url: `/get-product-price/${productId}`,
                        type: 'GET',
                        success: function(data) {
                            $(`#${priceInputId}`).val(data.price);
                        },
                        error: function(xhr, status, error) {
                            console.error('Failed to fetch product price:', error);
                        }
                    });
                } else {
                    $(`#${priceInputId}`).val('');
                }
            });
        }

        updateProductSelects();

        $('#add-product').click(function() {
            $('#products-container').append(`
                <x-card>
                    <x-slot name="title"></x-slot>
                    <x-slot name="body">
                        <div class="product-group row g-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="products[${productIndex}][categori]">Categories</label>
                                <select id="categori${productIndex}" name="products[${productIndex}][categori]" class="select2 form-select category-select" data-allow-clear="true" required>
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="products[${productIndex}][id]">Products</label>
                                <select id="products${productIndex}" name="products[${productIndex}][id]" class="select2 form-select product-select" data-allow-clear="true" required>
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="products[${productIndex}][price]">Price Per Unit</label>
                                <input type="text" id="priceperunit${productIndex}" name="products[${productIndex}][price]" class="form-control price-per-unit" readonly required/>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="products[${productIndex}][quantity]">Quantity</label>
                                <input type="number" id="quantity${productIndex}" name="products[${productIndex}][quantity]" class="form-control" min="1" required/>
                            </div>
                        </div>
                    </x-slot>
                </x-card>
            `);

            // Reinitialize select2 for new selects
            $(`#categori${productIndex}, #products${productIndex}`).select2();

            // Update event handlers
            updateProductSelects();

            productIndex++;
        });
    });
    $(document).ready(function() {
        $('#addNewOrderForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            var formData = $(this).serialize(); // Serialize the form data

            $.ajax({
                url: $(this).attr('action'), // Use the form's action attribute as the URL
                method: $(this).attr(
                'method'), // Use the form's method attribute as the HTTP method
                data: formData,
                success: function(response) {
                    // Show success modal
                    $('#statusSuccessModal').modal('show');
                },
                error: function(xhr, status, error) {
                    // Show error modal
                    $('#statusErrorsModal').modal('show');

                }
            });
        });
    });
</script>
