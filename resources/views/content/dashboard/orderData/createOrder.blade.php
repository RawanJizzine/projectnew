@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>

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
</script>
