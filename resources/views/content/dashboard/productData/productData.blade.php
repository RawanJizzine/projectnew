@section('title', 'Product Data')
@extends('layouts.layoutMaster')



<style>
    .image {
        height: 80px;
        width: 80px;
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
                            <label class="form-label" for="initial_price">Initial Price</label>
                            <input type="number" class="form-control" id="initial_price"
                                placeholder="Product Price" name="initial_price" aria-label="Product Price" />
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
                                <input type="text" value="{{ $data->quantity }}" name="quantity" class="form-control"  readonly  >
                            </td>
                            <td>
                                <input type="number" value="{{ $data->price }}" name="price" class="form-control" readonly>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary edit-btn" data-toggle="modal" data-target="#editProduct" data-id="{{ $data->id }}" data-image="{{ $data->image }}" data-title="{{ $data->title }}" data-barcode="{{ $data->barcode }}" data-category="{{ $data->category }}" data-sku="{{ $data->sku }}" data-quantity="{{ $data->quantity }}" data-price="{{ $data->price }}" data-initialprice="{{ $data->initial_price }}"        data-description="{{ $data->description }}">Edit</a>
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
                                    <label class="form-label" for="initial_price_edit">Initial Price</label>
                                    <input type="number" class="form-control" id="initial_price_edit"
                                        placeholder="Product Price" name="initial_price_edit" aria-label="Product Price" />
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

    <div class="modal fade" id="statusErrorsModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-lg-4">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#db3646" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3" />
                        <line class="path line" fill="none" stroke="#db3646" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2" />
                    </svg>
                    <h4 class="text-danger mt-3">Error!</h4>
                    <p class="mt-3">An error occurred while saving data.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-danger" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="statusSuccessModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"> 
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document"> 
            <div class="modal-content"> 
                <div class="modal-body text-center p-lg-4"> 
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#198754" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <polyline class="path check" fill="none" stroke="#198754" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " /> 
                    </svg> 
                    <h4 class="text-success mt-3">Oh Yeah!</h4> 
                    <p class="mt-3">You have successfully saved data.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal" id="SuccessOkBtn">Ok</button> 
                </div> 
            </div> 
        </div> 
    </div>
    <div class="modal fade" id="deleteSuccessModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-lg-4">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#198754" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <polyline class="path check" fill="none" stroke="#198754" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                    </svg>
                    <h4 class="text-success mt-3">Deleted!</h4>
                    <p class="mt-3">Data has been successfully deleted.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteErrorModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-lg-4">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#dc3545" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <line class="path line" fill="none" stroke="#dc3545" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="65.1" y1="40" x2="65.1" y2="80" />
                        <line class="path line" fill="none" stroke="#dc3545" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="65.1" y1="90" x2="65.1" y2="100" />
                    </svg>
                    <h4 class="text-danger mt-3">Deletion Failed!</h4>
                    <p class="mt-3">There was an error deleting the data. Please try again.</p>
                    <button type="button" class="btn btn-sm btn-danger mt-3" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Error Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-lg-4">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#ffc107" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <line class="path line" fill="none" stroke="#ffc107" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="65.1" y1="30" x2="65.1" y2="80" />
                        <line class="path line" fill="none" stroke="#ffc107" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="65.1" y1="90" x2="65.1" y2="100" />
                    </svg>
                    <h4 class="text-warning mt-3">Are you sure?</h4>
                    <p class="mt-3">Do you really want to delete this data?</p>
                    <button type="button" class="btn btn-sm btn-danger mt-3" id="confirmDeleteBtn">Delete</button>
                    <button type="button" class="btn btn-sm btn-secondary mt-3" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>



@endsection
@include('content.dashboard.productData.scripts')
