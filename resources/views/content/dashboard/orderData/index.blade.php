@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .table-wrapper {
        width: 100%;
        overflow-x: auto;
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
    <div style="padding-top: 4%;" class="d-flex justify-content-between">
        <h4>Orders</h4>
        <button id="createNewOrderBtn" type="button" class="btn btn-primary" style="width: 170px; height: 40px;">
            Create New Order
        </button>
    </div>
    <x-card>
        <x-slot name="body">
            <div class="table-responsive ml-md-3">
                <div class="mb-3">
                    <input id="searchInput" type="text" class="form-control" placeholder="Search for orders...">
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <th>Country</th>
                            <th>Order Address</th>
                            <th>Status</th>
                            <th>Customer Type</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="ordersTable">
                        @foreach ($orders as $order)
                            <tr data-order-id="{{ $order->id }}">
                                <td>{{ $order->customfullName }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->modalAddressCountry }}</td>
                                <td>{{ $order->customaddress }}</td>
                                <td id="status-{{ $order->id }}">
                                    <button type="button" class="btn btn-sm"
                                        style="width: 80px; height: 40px; background: {{ $order->status === 'pending' ? 'red' : 'green' }}; color: white;"
                                        onclick="markAsCompleted({{ $order->id }})">{{ $order->status }}</button>
                                </td>
                                <td>{{ $order->customer_type }}</td>
                                <td>{{ $order->created_by }}</td>
                                <td>
                                    <i class="fas fa-trash-alt" style="font-size: 24px;" data-id="{{ $order->id }}"></i>
                                    <i class="fas fa-eye" style="font-size: 24px;" data-id="{{ $order->id }}"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-card>
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
                        <circle class="path circle" fill="none" stroke="#198754" stroke-width="6" stroke-miterlimit="10"
                            cx="65.1" cy="65.1" r="62.1" />
                        <polyline class="path check" fill="none" stroke="#198754" stroke-width="6" stroke-linecap="round"
                            stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                    </svg>
                    <h4 class="text-success mt-3">Oh Yeah!</h4>
                    <p class="mt-3">You have successfully saved data.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal"
                        id="SuccessOkBtn">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteSuccessModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
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
                    <h4 class="text-success mt-3">Deleted!</h4>
                    <p class="mt-3">Data has been successfully deleted.</p>
                    <button type="button" class="btn btn-sm mt-3 btn-success" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteErrorModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-lg-4">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#dc3545" stroke-width="6"
                            stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <line class="path line" fill="none" stroke="#dc3545" stroke-width="6" stroke-linecap="round"
                            stroke-miterlimit="10" x1="65.1" y1="40" x2="65.1" y2="80" />
                        <line class="path line" fill="none" stroke="#dc3545" stroke-width="6" stroke-linecap="round"
                            stroke-miterlimit="10" x1="65.1" y1="90" x2="65.1" y2="100" />
                    </svg>
                    <h4 class="text-danger mt-3">Deletion Failed!</h4>
                    <p class="mt-3">There was an error deleting the data. Please try again.</p>
                    <button type="button" class="btn btn-sm btn-danger mt-3" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Error Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-lg-4">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                        <circle class="path circle" fill="none" stroke="#ffc107" stroke-width="6"
                            stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                        <line class="path line" fill="none" stroke="#ffc107" stroke-width="6" stroke-linecap="round"
                            stroke-miterlimit="10" x1="65.1" y1="30" x2="65.1" y2="80" />
                        <line class="path line" fill="none" stroke="#ffc107" stroke-width="6" stroke-linecap="round"
                            stroke-miterlimit="10" x1="65.1" y1="90" x2="65.1" y2="100" />
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var button = document.getElementById('createNewOrderBtn');
        if (button) {
            button.addEventListener('click', function() {
                window.location.href =
                '{{ route('create-order-dashboard') }}'; // Blade directive to generate the URL for the named route
            });
        }
    });

    function markAsCompleted(orderId) {
        fetch(`/orderDashboardstatus/${orderId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token if not already included
                },
                body: JSON.stringify({})
            })
            .then(response => {
                if (response.ok) {
                    // Optionally, update UI to reflect the change
                    location.reload(); // Reload the page to see the updated status
                } else {
                    console.error('Failed to mark order as completed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    $(document).ready(function() {
        document.querySelectorAll('.fa-eye').forEach(function(element) {
            element.addEventListener('click', function(event) {
                const categoryId = event.target.dataset.id;
                // Redirect to another page with the categoryId in the URL
                //https://www.aladinandsaria.com/?https://www.aladinandsaria.com&gclid=CjwKCAjwyJqzBhBaEiwAWDRJVINPiXfgSUC8fzfe3ponxdb7OvFvbfYfttj5be9JnOAgX4dvx7i6xhoCZSQQAvD_BwE
                window.location.href = `{{ route('otherpage') }}?orderId=${categoryId}`;
            });
        });
    });
    $(document).ready(function() {
    let orderId;
    let $rowToDelete;
    let url;

    $('.fas.fa-trash-alt').on('click', function() {
        orderId = $(this).data('id');
        url = '/order-dashboard-delete/' + orderId;
        $rowToDelete = $(this).closest('tr');
        $('#deleteConfirmationModal').modal('show');
    });

    $('#confirmDeleteBtn').on('click', function() {
        if (orderId) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#deleteConfirmationModal').modal('hide');
                    $('#deleteSuccessModal').modal('show');
                    $rowToDelete.remove();
                },
                error: function(response) {
                    $('#deleteConfirmationModal').modal('hide');
                    $('#deleteErrorModal').modal('show');
                    console.error('Error:', response);
                }
            });
        }
    });

    $('#deleteSuccessOkBtn').on('click', function() {
        location.reload();
    });
});

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input = document.getElementById('searchInput');
            var filter = input.value.toLowerCase();
            var table = document.getElementById('ordersTable');
            var tr = table.getElementsByTagName('tr');

            for (var i = 0; i < tr.length; i++) {
                var tdCustomerName = tr[i].getElementsByTagName('td')[0];
                var tdTotalPrice = tr[i].getElementsByTagName('td')[1];
                var tdOrderDate = tr[i].getElementsByTagName('td')[2];
                var tdCountry = tr[i].getElementsByTagName('td')[3];
                var tdOrderAddress = tr[i].getElementsByTagName('td')[4];
                var tdStatus = tr[i].getElementsByTagName('td')[5];
                var tdCustomerType = tr[i].getElementsByTagName('td')[6];
                var tdCreatedBy = tr[i].getElementsByTagName('td')[7];

                if (tdCustomerName || tdTotalPrice || tdOrderDate || tdCountry || tdOrderAddress ||
                    tdStatus || tdCustomerType || tdCreatedBy) {
                    var textValue = (tdCustomerName.textContent || tdCustomerName.innerText) + " " +
                        (tdTotalPrice.textContent || tdTotalPrice.innerText) + " " +
                        (tdOrderDate.textContent || tdOrderDate.innerText) + " " +
                        (tdCountry.textContent || tdCountry.innerText) + " " +
                        (tdOrderAddress.textContent || tdOrderAddress.innerText) + " " +
                        (tdStatus.textContent || tdStatus.innerText) + " " +
                        (tdCustomerType.textContent || tdCustomerType.innerText) + " " +
                        (tdCreatedBy.textContent || tdCreatedBy.innerText);

                    if (textValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        });
    });
</script>
