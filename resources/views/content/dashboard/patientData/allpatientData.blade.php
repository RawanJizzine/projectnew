@section('title', 'Dashboard')
@extends('layouts.layoutMaster')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }
</style>

@section('content')
    <div style="padding-top: 4%;" class="d-flex justify-content-between">
        <h4>All Patient Data </h4>
        <form action="{{ route('create-patient-data') }}" method="GET" style="display: inline;">
            <button type="submit" class="btn btn-primary" style="width: 170px; height: 40px;">
                Create Patient Data
            </button>
        </form>
    </div>
    <x-card>
        <x-slot name="body">
            <div class="table-responsive ml-md-3">
                <div class="mb-3">
                    <input id="searchInput" type="text" class="form-control" placeholder="Search for patient data...">
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Patient Name </th>
                            <th>Phone Number</th>
                            <th>Date of Birth</th>
                            <th>Sex</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="patientsTable">
                       
                        @foreach ($patients as $patient)
                       
                            <tr data-patient-id="{{ $patient->id }}">
                                <td>{{ $patient->fullname }}</td>
                                <td>{{ $patient->phonenumber }}</td>
                                <td>{{ $patient->dateofbirth }}</td>
                                <td>{{ $patient->sex }}</td>



                                <td>
                                    <i class="fas fa-trash-alt" style="font-size: 24px;" data-id="{{ $patient->id }}"></i>
                                    <i class="fas fa-edit" style="font-size: 24px;" data-id="{{ $patient->id }}"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-card>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
   

    $(document).ready(function() {
        document.querySelectorAll('.fa-edit').forEach(function(element) {
            element.addEventListener('click', function(event) {
                const patientId = event.target.dataset.id;
                // Redirect to another page with the categoryId in the URL
                //https://www.aladinandsaria.com/?https://www.aladinandsaria.com&gclid=CjwKCAjwyJqzBhBaEiwAWDRJVINPiXfgSUC8fzfe3ponxdb7OvFvbfYfttj5be9JnOAgX4dvx7i6xhoCZSQQAvD_BwE
                window.location.href = `{{ route('patient-data-page') }}?patientId=${patientId}`;
            });
        });
    });
    $(document).ready(function() {
        $('.fas.fa-trash-alt').click(function() {
            var orderId = $(this).data('id');
            var url = '/order-dashboard-delete/' + orderId;

            if (confirm('Are you sure you want to delete this order?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.message) {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert(response.error);
                        }
                    },
                    error: function(response) {
                        alert('An error occurred. Please try again.');
                    }
                });
            }
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
