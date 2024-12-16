@extends('admin.layouts.main')
@section('main-section')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <!-- Page Header -->
            <div class="page-header" style="margin-bottom: 20px;">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4 style="font-size: 24px; font-weight: bold; color: #007bff;">Customer Details</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation" style="margin-top: 10px;">
                            <ol class="breadcrumb" style="background-color: transparent; padding: 0; margin: 0;">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('index') }}" style="text-decoration: none; color: #007bff;">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('customers.index') }}" style="text-decoration: none; color: #007bff;">Customers</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page" style="color: #6c757d;">Details</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a href="{{ route('customers.edit', $customer->id) }}"
                            class="btn btn-primary btn-sm"
                            style="background-color: #007bff; border-color: #007bff; color: white; padding: 8px 16px; font-size: 14px; border-radius: 4px; min-width: 150px; margin-right: 10px;">
                            <i class="fa fa-edit"></i> Edit Customer
                        </a>
                        <a href="{{ route('customers.index') }}"
                            class="btn btn-secondary btn-sm"
                            style="background-color: #6c757d; border-color: #6c757d; color: white; padding: 8px 16px; font-size: 14px; border-radius: 4px; min-width: 150px;">
                            <i class="fa fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>

            <!-- Customer Details Card -->
            <div class="card"
                style="box-shadow: 0 4px 8px rgba(0,0,0,0.1); border: 1px solid #ddd; border-radius: 8px; margin-bottom: 30px;">
                <div class="card-header"
                    style="background-color: #007bff; color: white; padding: 15px; text-align: center; border-bottom: 1px solid #ddd; font-size: 18px;">
                    Customer Details
                </div>
                <div class="card-body" style="padding: 20px;">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6" style="margin-bottom: 20px;">
                            <p style="margin-bottom: 10px; font-size: 16px; color: #333;">
                                <strong><i class="fa fa-user" style="color: #007bff;"></i> Name:</strong> {{ $customer->name }}
                            </p>
                            <p style="margin-bottom: 10px; font-size: 16px; color: #333;">
                                <strong><i class="fa fa-phone" style="color: #007bff;"></i> Mobile:</strong> {{ $customer->mobile ?? 'N/A' }}
                            </p>
                            <p style="margin-bottom: 10px; font-size: 16px; color: #333;">
                                <strong><i class="fa fa-envelope" style="color: #007bff;"></i> Email:</strong> {{ $customer->email }}
                            </p>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6" style="margin-bottom: 20px;">
                            <p style="margin-bottom: 10px; font-size: 16px; color: #333;">
                                <strong><i class="fa fa-wallet" style="color: #007bff;"></i> Opening Balance:</strong> {{ number_format($customer->opening_balance, 2) }}
                            </p>
                            <p style="margin-bottom: 10px; font-size: 16px; color: #333;">
                                <strong><i class="fa fa-align-left" style="color: #007bff;"></i> Description:</strong> {{ $customer->description ?? 'No description provided.' }}
                            </p>
                            <p style="margin-bottom: 10px; font-size: 16px; color: #333;">
                                <strong><i class="fa fa-map-marker" style="color: #007bff;"></i> Address:</strong> {{ $customer->address ?? 'No address provided.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card"
                style="box-shadow: 0 4px 8px rgba(0,0,0,0.1); border: 1px solid #ddd; border-radius: 8px;">
                <div class="card-header"
                    style="background-color: #007bff; color: white; padding: 15px; text-align: center; border-bottom: 1px solid #ddd; font-size: 18px;">
                    Customer Orders
                </div>
                <div class="card-body" style="padding: 20px;">
                    @if($orders->isEmpty())
                        <p style="font-size: 16px; color: #6c757d;">No orders found for this customer.</p>
                    @else
                        <table class="table table-striped table-bordered" style="width: 100%;">
                            <thead>
                                <tr style="background-color: #f8f9fa;">
                                    <th>#</th>
                                    <th>Order Date</th>
                                    <th>Delivery Date</th>
                                    <th>Status</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>{{ $order->delivery_date }}</td>
                                        <td>{{ ucfirst($order->status) }}</td>
                                        <td>${{ number_format($order->total_price, 2) }}</td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
