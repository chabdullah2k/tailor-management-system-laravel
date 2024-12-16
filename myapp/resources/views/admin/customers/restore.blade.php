@extends('admin.layouts.main')

@section('main-section')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4 class="text-primary font-weight-bold">Restore Orders</h4>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a href="{{ route('customers.index') }}" class="btn btn-outline-primary">
                            <i class="fa fa-arrow-left"></i> Back to Customers
                        </a>
                    </div>
                </div>
            </div>

            <div class="card shadow-lg rounded-lg border-0 mt-4">
                <div class="card-header text-center">
                    <h4>Deleted Orders</h4>
                </div>
                <div class="card-body p-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->id }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->mobile }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>

                                        <form action="{{ route('customers.restore', $customer->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-undo"></i>Restore</button>
                                        </form>


                                        <form action="{{ route('customers.force-delete', $customer->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Force Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No deleted orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
