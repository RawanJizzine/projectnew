@section('title', 'Product Data')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .image {
        height: 80px;
        width: 80px;
    }
</style>

@section('content')

    <x-card>
        <x-slot name="title">
            Ads Category of Product
        </x-slot>

        <x-slot name="body">
            <form id="addCategory" action="{{ route('save-category') }}" method="POST">
                @csrf
                <div class="col-md-6 mb-4">
                    <label for="select2Primary" class="form-label">Primary</label>
                    <div class="select2-primary">
                        <select id="select2Primary" class="select2 form-select" multiple>
                            @foreach ($categories as $category)
                                @php
                                    // Check if the category is associated with the user
                                    $isSelected = $user->categories->contains('id', $category->id);
                                @endphp
                                <option value="{{ $category->name }}" {{ $isSelected ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="submit" id="submitFormBtn">submit</button>

                </div>
            </form>
        </x-slot>
    </x-card>

    <div class="d-flex justify-content-between">
        <h3>Add a new Product</h3>
        <button type="button" class="btn btn-primary" style="width: 170px; height: 40px;" data-target="#add_product_modal"
            data-toggle="modal">
            Create New Product
        </button>
    </div>
    <div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="addProoductModalLabel">Create New Product</h1>
                </div>
                <form id="createProductForm" action="{{ route('create-product-data') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="Image" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" accept="image/png,image/jpeg"
                                id="imageInput" required>
                        </div>
                        <div class="form-group">
                            <img class="uploaded-image" style="max-width: 100px; max-height: 100px;" id="previewImage">
                        </div>
                        <div class="form-group">
                            <x-input type="text" label="Name" placeholder="Product title" name="title"
                                class="form-control" required="true" />
                        </div>
                       
                        <div class="form-group">
                            <label class="form-label" for="category">Category</label>
                            <select name="category_id" class="form-control" id="category">
                                @foreach ($user->categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label"> Description</label>
                            <textarea name="description" placeholder="Product Description" class="form-control" rows="6" required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="ecommerce-product-price">Price</label>
                            <input type="number" class="form-control" id="price" placeholder="Product Price"
                                name="price" aria-label="Product Price" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="ecommerce-product-qty">QTY</label>
                            <input type="number" class="form-control" id="quantity" placeholder="Product Quantity"
                                name="quantity" aria-label="Product Quantity" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="ecommerce-product-sku">SKU</label>
                            <input type="number" class="form-control" id="sku" placeholder="Product SKU"
                                name="sku" aria-label="Product SKU" />
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="barcode">Barcode</label>
                            <input type="text" class="form-control" id="barcode" placeholder="0123-4567"
                                name="barcode" aria-label="Product barcode" />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="saveProductBtn">Save</button>
                        <button type="button" class="btn btn-secondary closebut" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-card>
        <x-slot name="body">
            <div class="table-responsive ml-md-3">
                <div class="mb-3">
                    <input id="searchInput" type="text" class="form-control" placeholder="Search for products...">
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>PRODUCT</th>
                            <th>CATEGORY</th>
                            <th>NAME</th>
                            <th>BARCODE</th>
                            <th>SKY</th>
                            <th>QTY</th>
                            <th>PRICE</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productsTable">
                        @foreach ($products_data ?? [] as $index => $data)
                        <tr>
                            <td>
                                <img src="{{ asset('images/' . $data->image) }}" class="image" alt="Image">
                            </td>
                            <td>
                                <input type="text" value="{{ $data->category->name }}" name="category" class="form-control" readonly>
                            </td>
                            <td>
                                <input type="text" value="{{ $data->title }}" name="title" class="form-control" readonly>
                            </td>
                            <td>
                                <input type="number" value="{{ $data->barcode }}" name="barcode" class="form-control" readonly>
                            </td>
                            <td>
                                <input type="number" value="{{ $data->sku }}" name="sky" class="form-control" readonly>
                            </td>
                            <td>
                                <input type="text" value="{{ $data->quantity }}" name="quantity" class="form-control">
                            </td>
                            <td>
                                <input type="number" value="{{ $data->price }}" name="price" class="form-control" readonly>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary edit-btn" data-toggle="modal" data-target="#editProduct" data-id="{{ $data->id }}" data-image="{{ $data->image }}" data-title="{{ $data->title }}" data-barcode="{{ $data->barcode }}" data-category="{{ $data->category }}" data-sku="{{ $data->sku }}" data-quantity="{{ $data->quantity }}" data-price="{{ $data->price }}" data-description="{{ $data->description }}">Edit</a>
                                <a href="#" data-id="{{ $data->id }}" data-target="#deleteProductModal" class="btn btn-sm btn-warning delete-btn">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel">Edit Product</h5>
                        </div>
                        <form id="editProductForm" action="" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="image_edit" class="form-label">Image</label>
                                    <input type="file" name="image_edit" class="form-control"
                                        accept="image/png,image/jpeg" id="imageInputEdit" required>
                                </div>
                                <div class="form-group">
                                    <img class="uploaded-image-edit" style="max-width: 100px; max-height: 100px;"
                                        id="previewImageEdit">
                                </div>
                                <div class="form-group">
                                    <x-input type="text" label="Name" id="title_edit" name="title_edit"
                                        class="form-control" required="true" />
                                </div>
                                <div class="form-group">
                                    <label for="description_edit" class="form-label">Description</label>
                                    <textarea name="description_edit" id="description_edit" class="form-control" rows="6" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="category_edit">Category</label>
                                    <select name="category_edit" class="form-control" id="category_edit">
                                        @foreach (auth()->user()->categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="price_edit">Price</label>
                                    <input type="number" class="form-control" id="price_edit"
                                        placeholder="Product Price" name="price_edit" aria-label="Product Price" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="quantity_edit">QTY</label>
                                    <input type="number" class="form-control" id="quantity_edit"
                                        placeholder="Product Quantity" name="quantity_edit"
                                        aria-label="Product Quantity" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="sku_edit">SKU</label>
                                    <input type="number" class="form-control" id="sku_edit" placeholder="Product SKU"
                                        name="sku_edit" aria-label="Product SKU" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="barcode_edit">Barcode</label>
                                    <input type="text" class="form-control" id="barcode_edit" placeholder="0123-4567"
                                        name="barcode_edit" aria-label="Product barcode" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="updateProductBtn">Update</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>








        </x-slot>
    </x-card>





@endsection
@include('content.dashboard.productData.scripts')
