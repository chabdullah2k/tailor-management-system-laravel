@extends('admin.layouts.main')
@section('main-section')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4 class="text-primary font-weight-bold">Create Measurement Field</h4>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent p-0 mb-0">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create Measurement Field</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a href="{{ route('measurement_fields.index') }}" class="btn btn-outline-primary">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="card shadow-lg rounded-lg border-0 mt-4">
                <div class="card-header text-center">
                    <h4>Create Measurement Field</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('measurement_fields.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="fieldname" class="font-weight-bold">Field Name</label>
                                <input type="text" name="fieldname" id="fieldname" class="form-control"
                                       value="{{ old('fieldname') }}" required placeholder="Enter field name">
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="order" class="font-weight-bold">Order</label>
                                <input type="number" name="order" id="order" class="form-control"
                                       value="{{ old('order') }}" placeholder="Enter display order">
                                @error('order')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="type" class="font-weight-bold">Type</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text</option>
                                    <option value="select" {{ old('type') == 'select' ? 'selected' : '' }}>Select</option>
                                    <option value="textarea" {{ old('type') == 'textarea' ? 'selected' : '' }}>Textarea</option>
                                    <option value="checkbox" {{ old('type') == 'checkbox' ? 'selected' : '' }}>Checkbox</option>
                                    <option value="radio" {{ old('type') == 'radio' ? 'selected' : '' }}>Radio</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="service_id" class="font-weight-bold">Service</label>
                                <select name="service_id" id="service_id" class="form-control">
                                    <option value="">Select a Service</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description" class="font-weight-bold">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter description">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-check mb-4">
                            <input type="hidden" name="is_required" value="0">
                            <input type="checkbox" name="is_required" id="is_required" class="form-check-input" value="1" {{ old('is_required') ? 'checked' : '' }}>
                            <label for="is_required" class="form-check-label font-weight-bold">This field is required</label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block font-weight-bold" style="font-size: 18px;">
                            Create Measurement Field
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection




