<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/asset/src/styles/order.css') }}">
</head>
<body>
    <div class="header">
        <h1>Create Order</h1>
        <a href="{{ route('index') }}" class="btn btn-light">Dashboard</a>
    </div>

    <div class="container mt-3">
        <!-- Search Customer Section -->
        <div class="mb-3">
            <label for="customer-search">Search Customer:</label>
            <input type="text" id="customer-search" class="form-control" placeholder="Enter name or phone">
            <div id="customer-list" class="dropdown-menu"></div>
        </div>

        <!-- Service Selection -->
        <div class="mb-3">
            <label for="service-list">Select Service:</label>
            <select id="service-list" class="form-select" required>
                <option selected disabled>Select a Service</option>
            </select>
        </div>

        <!-- Order Form -->
        <form id="order-form" action="{{ route('mainorder.store') }}" method="POST">
            @csrf
            <input type="hidden" name="customer_id" id="customer_id">
            <input type="hidden" name="service_id" id="selected_service_id">

            <!-- Dynamic Measurement Fields -->
            <div id="measurement-fields" class="mt-3"></div>

            <input type="hidden" name="measurement_fields[1][field_name]" value="Field Name">

            <!-- Other Fields -->
            <div class="mt-3">
                <label for="total_price">Total Price:</label>
                <input type="number" name="total_price" class="form-control" required>
            </div>
            <div class="mt-3">
                <label for="order_date">Order Date:</label>
                <input type="date" name="order_date" class="form-control" required>
            </div>
            <div class="mt-3">
                <label for="delivery_date">Delivery Date:</label>
                <input type="date" name="delivery_date" class="form-control" required>
            </div>
            <div class="mt-3">
                <label for="status">Status:</label>
                <select name="status" class="form-select" required>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="canceled">Canceled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Create Order</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            // Fetch services on page load
            $.post("{{ route('mainorder.services') }}", { _token: "{{ csrf_token() }}" }, function (services) {
                services.forEach(service => {
                    $("#service-list").append(`<option value="${service.id}">${service.name}</option>`);
                });
            });

            // Search customers by name or phone
            $("#customer-search").on("input", function () {
                const query = $(this).val();
                if (query.length > 1) {
                    $.post("{{ route('mainorder.searchCustomer') }}", { phone: query, _token: "{{ csrf_token() }}" }, function (customers) {
                        const dropdown = $("#customer-list");
                        dropdown.empty();
                        if (customers.length) {
                            customers.forEach(customer => {
                                dropdown.append(`<button class="dropdown-item" data-id="${customer.id}">${customer.name} (${customer.mobile})</button>`);
                            });
                            dropdown.addClass("show");
                        } else {
                            dropdown.removeClass("show");
                        }
                    });
                } else {
                    $("#customer-list").removeClass("show");
                }
            });

            // Select customer from dropdown
            $("#customer-list").on("click", ".dropdown-item", function () {
                const customerId = $(this).data("id");
                $("#customer_id").val(customerId);
                $("#customer-search").val($(this).text());
                $("#customer-list").removeClass("show");
            });

           // Fetch measurement fields based on service
$("#service-list").on("change", function () {
    const serviceId = $(this).val();
    $("#selected_service_id").val(serviceId);
    $.post("{{ route('mainorder.measurements') }}", { service_id: serviceId, _token: "{{ csrf_token() }}" }, function (fields) {
        const container = $("#measurement-fields");
        container.empty();
        fields.forEach(field => {
            container.append(`
                <div class="mb-3">
                    <label>${field.fieldname}</label>
                    <input type="hidden" name="measurement_fields[${field.id}][field_id]" value="${field.id}">
                    <input type="hidden" name="measurement_fields[${field.id}][field_name]" value="${field.fieldname}"> <!-- Add field_name -->
                    <input type="text" name="measurement_fields[${field.id}][value]" class="form-control" placeholder="Enter ${field.fieldname}" required>
                </div>
            `);
        });
    });
});
});

    </script>
</body>
</html>
