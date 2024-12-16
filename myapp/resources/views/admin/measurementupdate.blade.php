@extends('admin.layouts.main')

@section('main-section')

<div class="main-container">
    <div class="card shadow-lg rounded-lg border-0 mt-4">
        <div class="card-header text-center">
            <h4>Edit Measurement</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('measurements.update', $measurement->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="customer_id" class="font-weight-bold">Customer</label>
                        <select name="customer_id" id="customer_id" class="form-control" required>
                            <option value="">Select a Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $customer->id == $measurement->customer_id ? 'selected' : '' }}>
                                    {{ $customer->name }}--{{ $customer->mobile }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="service_id" class="font-weight-bold">Service</label>
                        <select name="service_id" id="service_id" class="form-control" required>
                            <option value="">Select a Service</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ $service->id == $measurement->service_id ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div id="measurement_fields_container">
                    @foreach($measurement->measurementValues as $field)
                        <div class="form-group">
                            <label>{{ $field->fieldname }}</label>
                            <input type="text" name="measurement_fields[{{ $field->fieldname }}]" class="form-control" value="{{ $field->value }}">
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="type_name">Type Name</label>
                    <input type="text" name="type_name" class="form-control" value="{{ $measurement->type_name }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ $measurement->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block font-weight-bold" style="font-size: 18px;">
                    Update Measurement
                </button>
            </form>
        </div>
    </div>
</div>

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
                            // Avoiding PHP in JavaScript: Set old value in a JavaScript-compatible way
                            var oldValue = @json(old('measurement_fields', []));
                            var value = oldValue[field.fieldname] || '';

                            $('#measurement_fields_container').append(
                                `<div class="form-group">
                                    <label>${field.fieldname}</label>
                                    <input type="text" name="measurement_fields[${field.fieldname}]" class="form-control" value="${value}">
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

        $('#service_id').trigger('change');
    });
</script>

@endsection
