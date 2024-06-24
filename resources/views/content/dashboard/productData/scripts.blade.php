<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $("#open_modal_button").click(function() {
            console.log("hi");
            $("#add_product_modal").modal("show");
        });
    });


    $(document).ready(function() {
        $('#submitFormBtn').click(function(e) {
            e.preventDefault();

            var selectedCategories = $('#select2Primary').val();

            if (selectedCategories == null) {
                alert('Please select at least one category.');
                return;
            }

            $.ajax({
                type: 'POST',
                url: '{{ route('save-category') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    categories: selectedCategories
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('imageInput').addEventListener('change', function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
                var blobUrl = URL.createObjectURL(input.files[0]);
                window.open(blobUrl, '_blank');
            }
        });
    });


    $(document).ready(function() {
        var itemCount = 0;
        $('#saveProductBtn').on('click', function() {
            var form = document.getElementById('createProductForm');
            var formData = new FormData(form);

            $.ajax({
                url: form.action,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(data) {
                    console.log(data);
                    alert('Data created successfully');
                    var product = data.product;
                    itemCount++;
                    var newRow = '<tr>' +
                        '<td><img src="{{ asset('images/') }}/' + product.image +
                        '" alt="Image" style="max-width: 100px; max-height: 100px;"></td>' +
                        '<td><input type="text" value="' + product.category +
                        '" name="category" class="form-control" readonly></td>' +
                        '<td><input type="text" value="' + product.title +
                        '" name="title" class="form-control" readonly></td>' +
                        '<td><input type="number" value="' + product.barcode +
                        '" name="barcode" class="form-control" readonly></td>' +
                        '<td><input type="number" value="' + product.sky +
                        '" name="sky" class="form-control" readonly></td>' +
                        '<td><input type="number" value="' + product.quantity +
                        '" name="quantity" class="form-control" readonly></td>' +
                        '<td><input type="number" value="' + product.price +
                        '" name="price" class="form-control" readonly></td>' +
                        '<td>' +
                        '<a href="" class="btn btn-sm btn-primary">Edit</a>' +
                        ' ' +
                        '<a href="" class="btn btn-sm btn-warning">Delete</a>' +
                        '</td>' +
                        '</tr>';

                    $('table tbody').append(newRow);
                    form.reset();
                    $('#previewImage').attr('src', '');

                    $('#add_product_modal').modal('hide');
                    $('#createProductForm')[0].reset();
                },
                error: function(error) {
                    console.error('Error:', error);
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
                    }
                    alert('Error Here!')
                }
            });
        });

        $('.closebut').on('click', function() {
            $('#add_product_modal').modal('hide');
            $('#createProductForm')[0].reset();
            $('.validation-errors').remove();
        });

        function displayValidationErrors(errors) {
            // Clear any existing error messages
            $('.validation-errors').remove();

            // Display new error messages
            $.each(errors, function(field, messages) {
                var input = $('[name="' + field + '"]');
                var container = input.closest('.form-group');

                // Display each error message
                $.each(messages, function(index, message) {
                    container.append('<p class="text-danger validation-errors">' + message +
                        '</p>');
                });
            });
        }
    });

    $(document).ready(function() {
        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            var image = $(this).data('image');
            var title = $(this).data('title');
            var description = $(this).data('description');
            var price = $(this).data('price');
            var quantity = $(this).data('quantity');
            var sku = $(this).data('sku');

            var barcode = $(this).data('barcode');
            var category = $(this).data('category');
            var categoryId = category.id;

            $('#category_edit').val(categoryId);


            $('#editProductForm').attr('action', '/updateproduct/' + id);
            $('#previewImageEdit').attr('src', '{{ asset('images/') }}/' + image);
            $('#title_edit').val(title);
            $('#description_edit').val(description);
            $('#price_edit').val(price);
            $('#sku_edit').val(sku);
            $('#barcode_edit').val(barcode);
            $('#quantity_edit').val(quantity);



        });

        $('#updateProductBtn').click(function() {
            var form = document.getElementById('editProductForm');
            var formData = new FormData(form);

            $.ajax({
                type: 'POST', // Use POST here
                url: $('#editProductForm').attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('.validation-errors').remove();
                    alert('Data updated successfully')
                    $('#editProduct').modal('hide');
                    location.reload();
                },
                error: function(error) {

                    console.error('Error:', error);
                    if (error.responseJSON && error.responseJSON.errors) {
                        displayValidationErrors(error.responseJSON.errors);
                    }
                    alert('Error Here!')
                }
            });

            function displayValidationErrors(errors) {
                // Clear any existing error messages
                $('.validation-errors').remove();

                // Display new error messages
                $.each(errors, function(field, messages) {
                    var input = $('[name="' + field + '"]');
                    var container = input.closest('.form-group');

                    // Display each error message
                    $.each(messages, function(index, message) {
                        container.append('<p class="text-danger validation-errors">' +
                            message +
                            '</p>');
                    });
                });
            }
        });

        document.getElementById('imageInputEdit').addEventListener('change', function(event) {
            var input = event.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Set the preview image source
                    document.getElementById('previewImageEdit').src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    });

    $(document).ready(function() {
        $(".delete-btn").on("click", function() {
            var $rowToDelete = $(this).closest('tr');
            var id = $(this).data('id');
            var url = '/product/' + id;
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(data) {
                        console.log(data);
                        $rowToDelete.remove();
                        alert('Data deleted successfully');
                    },
                    error: function(error) {
                        alert('Error Here!')
                        console.error('Error:', error);
                    }
                });
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var input = document.getElementById('searchInput');
            var filter = input.value.toLowerCase();
            var table = document.getElementById('productsTable');
            var tr = table.getElementsByTagName('tr');

            for (var i = 0; i < tr.length; i++) {
                var tdProduct = tr[i].getElementsByTagName('td')[0];
                var tdCategory = tr[i].getElementsByTagName('td')[1].getElementsByTagName('input')[0];
                var tdName = tr[i].getElementsByTagName('td')[2].getElementsByTagName('input')[0];
                var tdBarcode = tr[i].getElementsByTagName('td')[3].getElementsByTagName('input')[0];
                var tdSky = tr[i].getElementsByTagName('td')[4].getElementsByTagName('input')[0];
                var tdQty = tr[i].getElementsByTagName('td')[5].getElementsByTagName('input')[0];
                var tdPrice = tr[i].getElementsByTagName('td')[6].getElementsByTagName('input')[0];

                if (tdProduct || tdCategory || tdName || tdBarcode || tdSky || tdQty || tdPrice) {
                    var textValue = (tdProduct.textContent || tdProduct.alt) + " " +
                        (tdCategory.value || tdCategory.innerText) + " " +
                        (tdName.value || tdName.innerText) + " " +
                        (tdBarcode.value || tdBarcode.innerText) + " " +
                        (tdSky.value || tdSky.innerText) + " " +
                        (tdQty.value || tdQty.innerText) + " " +
                        (tdPrice.value || tdPrice.innerText);

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
