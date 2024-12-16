@extends('admin.layouts.main')
@section('main-section')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4 class="text-primary font-weight-bold">Create Order</h4>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent p-0 mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create Order</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="card shadow-lg rounded-lg border-0 mt-4">
                <div class="card-header text-center">
                    <h4>Create Order</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="customer_id" class="font-weight-bold">Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control" required>
                                    <option value="" disabled {{ !isset($selectedCustomer) ? 'selected' : '' }}>Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"
                                            {{ isset($selectedCustomer) && $selectedCustomer->id == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }} -- {{ $customer->mobile }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user_id" class="font-weight-bold">Assigned Staff</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    <option value="" disabled selected>Select Staff</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="service_id" class="font-weight-bold">Service</label>
                                <select name="service_id" id="service_id" class="form-control" required>
                                    <option value="" disabled selected>Select Service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="total_price" class="font-weight-bold">Total Price</label>
                                <input type="number" name="total_price" id="total_price" class="form-control"
                                    value="{{ old('total_price') }}" required placeholder="Enter Total Price">
                                @error('total_price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="order_date" class="font-weight-bold">Order Date</label>
                                <input type="date" name="order_date" id="order_date" class="form-control"
                                    value="{{ old('order_date') }}" required>
                                @error('order_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="delivery_date" class="font-weight-bold">Delivery Date </label>
                                <input type="date" name="delivery_date" id="delivery_date" class="form-control"
                                    value="{{ old('delivery_date') }}" required>
                                @error('delivery_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="status" class="font-weight-bold">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                    <option value="canceled">Canceled</option>
                                </select>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block font-weight-bold" style="font-size: 18px;">
                            Create Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


<select name="customer_id" id="customer_id" class="form-control" required>
    <option value="" disabled {{ !isset($selectedCustomer) ? 'selected' : '' }}>Select Customer</option>
    @foreach ($customers as $customer)
        <option value="{{ $customer->id }}"
            {{ isset($selectedCustomer) && $selectedCustomer->id == $customer->id ? 'selected' : '' }}>
            {{ $customer->name }} -- {{ $customer->mobile }}
        </option>
    @endforeach
</select>
