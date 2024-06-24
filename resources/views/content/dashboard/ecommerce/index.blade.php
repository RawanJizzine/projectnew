@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
   
</style>

@section('content')

    <div class="col-xl-12 mb-4 col-lg-7 col-12">
        <div class="card ">
            <div class="card-header">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="card-title mb-0">Statistics</h5>
                    <small class="text-muted">
                        <select id="timeFrameSelect" name="statics" class="form-select" data-allow-clear="true">
                            <option value="today">Today</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>



                    </small>
                </div>
            </div>
            <div class="card-body">
                <div class="row gy-5">

                    <div class="col-md-2 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                <i class="ti ti-chart-pie-2 ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0"> <span id="totalOrders"> {{ $totalorderprice }}</span><span>$</span></h5>
                                <small>Amount Orders</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-success me-3 p-2">
                                <i class="ti ti-currency-dollar ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0"> <span id="earningsorder">
                                        {{ $earnings->total_initial_price }}0</span><span>$</span></h5>
                                <small>Revenue Orders</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                <i class="ti ti-credit-card ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0"> <span id="pageview"> 0</span><span></span></h5>
                                <small>Page Views</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                <i class="ti-md ti ti-checks text-body"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0"> <span id="ordercompleted"> {{ $orderscompleted }}</span><span>$</span>
                                </h5>
                                <small>Order Completed</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                                <i class="ti ti-users ti-sm"></i>
                            </div>
                            <div class="card-info">
                               
                                <h5 class="mb-0" id="customer">{{ $customer }}</h5>
                                <small>New Customers</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                <i class="ti ti-shopping-cart ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0" id="productnumber">{{ $countproduct }}</h5>
                                <small>Products</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                <i class="ti ti-shopping-cart ti-sm"></i>
                            </div>
                            <div class="card-info">
                                <h5 class="mb-0" id="totalappointment">{{ $countapp }} </h5>
                                <small>Total Appointments</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6">
                        <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                <i class="ti ti-shopping-cart ti-sm"></i>
                            </div>
                            <div class="card-info">

                                <h5 class="mb-0"> <span id="amountapp">{{ $amountapp }}</span><span>$</span></h5>
                                <small>Amount Appointments</small>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
    <div class="col-xl-12 mb-4 col-lg-7 col-12">
        <div class="card ">
            <div class="card-header">
                <div class="d-flex  mb-3">
                    <h5 style="margin-top: 0.4%;" class="card-title mb-0">Appointment Information</h5>
                    <small style="margin-left: 1.5%;" class="text-muted">
                        <input  type="date" id="date" name="date" class="form-control">



                    </small>
                </div>
            </div>
            <div class="card-body">
                <div  class="row gy-5">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name Of Patient</th>
                                    <th>Name Of Session</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Time</th>

                                </tr>
                            </thead>
                            <tbody id="appointmentTableBody"    >
                                @foreach ($appointmenttable ?? [] as $index => $data)
                                    <tr>

                                        <td>
                                            <input type="text" value="{{ $data->name }}" name="title"
                                                class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" value="{{ $data->session_name }}" name="title"
                                                class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" value="{{ $data->location }}" name="location"
                                                class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" value="{{ $data->date }}" name="date"
                                                class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" value="{{ $data->time }}" name="time"
                                                class="form-control" readonly>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>

            </div>
        </div>

    </div>
    <div class="col-xl-12 mb-4 col-lg-7 col-12">
        <div class="card ">
            <div class="card-header">
                <div class="d-flex  mb-3">
                    <h5 style="margin-top: 0.4%;" class="card-title mb-0">Order Information</h5>
                    <small style="margin-left: 1.5%;" class="text-muted">
                        <input  type="date" id="dateorder" name="dateorder" class="form-control">



                    </small>
                </div>
            </div>
            <div class="card-body">
                <div  class="row gy-5">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name Of Customer</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Price</th>
                                    <th>Customer Type</th>

                                </tr>
                            </thead>
                            <tbody id="orderTableBody"    >
                                @foreach ($orderstable ?? [] as $index => $data)
                                    <tr>

                                        <td>
                                            <input type="text" value="{{ $data->customfullName }}" name="title"
                                                class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" value="{{ $data->customphoneNumber }}" name="title"
                                                class="form-control" readonly>
                                        </td>
                                        <td>
                                            <textarea id="orderDetails" class="form-control" value="{{$data->customaddress   }}"  rows="4" readonly></textarea>
                                        </td>
                                        <td>
                                            <input type="text" value="{{ $data->total_price }}" name="date"
                                                class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" value="{{ $data->customer_type}}" name="time"
                                                class="form-control" readonly>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>

            </div>
        </div>

    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#timeFrameSelect').on('change', function() {
            var timeFrame = $(this).val();

            $.ajax({
                url: '/get-statics-info',
                type: 'POST',
                data: {
                    time_frame: timeFrame,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#totalOrders').text(response.total_amount || 0);
                $('#earningsorder').text(response.earnings || 0);
                $('#ordercompleted').text(response.completed_order || 0);
                $('#pageview').text(response.pageview || 0);
                $('#customer').text(response.customer || 0);
                $('#productnumber').text(response.productnumber || 0);
                $('#totalappointment').text(response.totalappointment || 0);
                $('#amountapp').text(response.amountappointment || 0);
                },
                error: function(error) {
                    alert('An error occurred');
                }
            });
        });
    });




    $(document).ready(function() {
        const today = new Date();

        // Format the date as YYYY-MM-DD
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        const dd = String(today.getDate()).padStart(2, '0');

        // Set the value of the date input to today's date
        const formattedDate = `${yyyy}-${mm}-${dd}`;
        document.getElementById('date').value = formattedDate;

    })
    $(document).ready(function() {
        const today = new Date();

        // Format the date as YYYY-MM-DD
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        const dd = String(today.getDate()).padStart(2, '0');

        // Set the value of the date input to today's date
        const formattedDate = `${yyyy}-${mm}-${dd}`;
        document.getElementById('dateorder').value = formattedDate;

    })

   //////
   document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('date');

    dateInput.addEventListener('change', function() {
        const date = this.value;
        fetchAppointments(date);
    });

    function fetchAppointments(date) {
        fetch(`/appointmentsdate/${date}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('No appointments found');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    updateTable(data.appointments);
                } else {
                    clearTable();
                  
                }
            })
            .catch(error => {
                clearTable();
               
            });
    }

    function updateTable(appointments) {
        const tbody = document.getElementById('appointmentTableBody');
        tbody.innerHTML = '';

        appointments.forEach(appointment => {
            const row = document.createElement('tr');

            row.innerHTML = `
                <td><input type="text" value="${appointment.name}" class="form-control" readonly></td>
                <td><input type="text" value="${appointment.session_name}" class="form-control" readonly></td>
                <td><input type="text" value="${appointment.location}" class="form-control" readonly></td>
                <td><input type="text" value="${appointment.date}" class="form-control" readonly></td>
                <td><input type="text" value="${appointment.time}" class="form-control" readonly></td>
            `;

            tbody.appendChild(row);
        });
    }

    function clearTable() {
        const tbody = document.getElementById('appointmentTableBody');
        tbody.innerHTML = '';
    }
});
/////////////order
  document.addEventListener('DOMContentLoaded', function() {
    const dateInputorder = document.getElementById('dateorder');

    dateInputorder.addEventListener('change', function() {
        const dateorder = this.value;
        fetchorder(dateorder);
    });

    function fetchorder(date) {
        fetch(`/orderdate/${date}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('No orders found');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    updateTableorder(data.orders);
                } else {
                    clearTableorder();
                  
                }
            })
            .catch(error => {
                clearTableorder();
               
            });
    }

    function updateTableorder(appointments) {
        const tbodyorder = document.getElementById('orderTableBody');
        tbodyorder.innerHTML = '';

        appointments.forEach(appointment => {
            const row = document.createElement('tr');

            row.innerHTML = `
                <td><input type="text" value="${appointment.customfullName}" class="form-control" readonly></td>
                <td><input type="text" value="${appointment.customphoneNumber}" class="form-control" readonly></td>
                <td><textarea class="form-control" rows="4" readonly>${appointment.customaddress}</textarea></td>
                <td><input type="text" value="${appointment.total_price}" class="form-control" readonly></td>
                <td><input type="text" value="${appointment.customer_type}" class="form-control" readonly></td>
            `;

            tbodyorder.appendChild(row);
        });
    }

    function clearTableorder() {
        const tbodyorder = document.getElementById('orderTableBody');
        tbodyorder.innerHTML = '';
    }
});
</script>
