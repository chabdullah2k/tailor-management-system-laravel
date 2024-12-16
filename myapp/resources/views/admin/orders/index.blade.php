@extends('admin.layouts.main')

@section('main-section')

<div class="main-container">
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Orders</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Orders</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">

                        <a href="{{ route('orders.create') }}" class="btn btn-outline-primary" style="min-width: 150px;">
                            <i class="fa fa-plus"></i> Create Order
                        </a>
                        <a href="{{ route('orders.restore.view') }}" class="btn btn-outline-secondary" style="min-width: 150px;">
                            <i class="fa fa-undo"></i> Restore
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Orders Table</h4>
                </div>
                <div class="table-responsive" style="overflow-x: auto;">
                    <table class="table table-striped table-hover data-table">
                        <thead>
                            <tr>
                                {{-- <th>#</th> --}}
                                <th>Customer</th>
                                <th>Assigned Staff</th>
                                <th>Service</th>
                                <th>Total Price</th>
                                <th>Order Date</th>
                                <th>Delivery Date</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                {{-- <td>{{ $order->id }}</td> --}}
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->service->name }}</td>
                                <td>{{ number_format($order->total_price, 2) }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->delivery_date }}</td>
                                <td>
                                    <span
                                        class="badge"
                                        style="background-color:
                                        {{ strtolower($order->status) === 'completed' ? '#28a745' :
                                           (strtolower($order->status) === 'canceled' ? '#dc3545' : '#6c757d') }};
                                        color: white;">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="{{ route('orders.edit', $order->id) }}">
                                                <i class="dw dw-edit2"></i> Edit
                                            </a>

                                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to move to trash this orders?')">
                                                    <i class="dw dw-delete-3"></i> Move Trash
                                                </button>
                                            </form>
                                            <form action="{{ route('orders.force-delete', $order->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to permanently delete this orders?')">
                                                    <i class="fa fa-trash"></i> Force Delete
                                                </button>
                                            </form>



                                        </div>
                                    </div>
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
