@extends('admin.layouts.main')
@section('main-section')

<div class="main-container">
    <div class="card shadow-lg rounded-lg border-0 mt-4">
        <div class="card-header text-center">
            <h4>Create Measurement</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('measurements.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="customer_id" class="font-weight-bold">Customer</label>
                        <select name="customer_id" id="customer_id" class="form-control" required>
                            <option value="">Select a Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}--{{ $customer->mobile }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="service_id" class="font-weight-bold">Service</label>
                        <select name="service_id" id="service_id" class="form-control" required>
                            <option value="">Select a Service</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div id="measurement_fields_container"></div>

                <div class="form-group">
                    <label for="type_name">Type Name</label>
                    <input type="text" name="type_name" class="form-control" required placeholder="Enter type name">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Enter description"></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block font-weight-bold" style="font-size: 18px;">
                    Create Measurement
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#service_id').on('change', function () {
            var serviceId = $(this).val();
            $('#measurement_fields_container').empty();

            if (serviceId) {
                $.ajax({
                    url: '/measurement-fields/' + serviceId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function (index, field) {
                            $('#measurement_fields_container').append(
                                `<div class="form-group">
                                    <label>${field.fieldname}</label>
                                    <input type="${field.type}" name="measurement_fields[${field.fieldname}]" class="form-control">
                                </div>`
                            );
                        });
                    },
                    error: function () {
                        alert('Failed to load measurement fields. Please try again.');
                    }
                });
            }
        });
    });
</script>

@endsection
