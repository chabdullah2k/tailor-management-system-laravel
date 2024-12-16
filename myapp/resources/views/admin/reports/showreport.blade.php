@extends('admin.layouts.main')
@section('main-section')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header mb-4">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4 class="text-primary font-weight-bold">{{ $type }}</h4>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent p-0 mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}" class="text-primary">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('reports.index') }}" class="text-primary">Reports</a></li>
                                <li class="breadcrumb-item active" aria-current="page">View Report</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="card shadow-lg rounded-lg border-0">
                <div class="card-body p-4">
                    @if(is_object($data))
                        <div class="report-header text-center mb-4">
                            <h3 class="text-dark">Report Details</h3>
                        </div>

                        <div class="row">
                            @if($type === 'User Report')
                                <div class="col-md-6">
                                    <div class="info-box shadow-sm p-3 rounded bg-light mb-3">
                                        <strong>Name:</strong>
                                        <span>{{ $data->name ?? 'N/A' }}</span>
                                    </div>
                                    <div class="info-box shadow-sm p-3 rounded bg-light mb-3">
                                        <strong>Email:</strong>
                                        <span>{{ $data->email ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-box shadow-sm p-3 rounded bg-light mb-3">
                                        <strong>Mobile:</strong>
                                        <span>{{ $data->phone ?? 'N/A' }}</span>
                                    </div>
                                    <div class="info-box shadow-sm p-3 rounded bg-light mb-3">
                                        <strong>Salary:</strong>
                                        <span>${{ number_format($data->salary ?? 0, 2) }}</span>
                                    </div>
                                </div>
                            @endif

                            @if($type === 'Customer Report')
                                <div class="col-md-6">
                                    <div class="info-box shadow-sm p-3 rounded bg-light mb-3">
                                        <strong>Name:</strong>
                                        <span>{{ $data->name ?? 'N/A' }}</span>
                                    </div>
                                    <div class="info-box shadow-sm p-3 rounded bg-light mb-3">
                                        <strong>Email:</strong>
                                        <span>{{ $data->email ?? 'N/A' }}</span>
                                    </div>
                                    <div class="info-box shadow-sm p-3 rounded bg-light mb-3">
                                        <strong>Opening Balance:</strong>
                                        <span>{{ number_format($data->opening_balance ?? 0, 2) }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-box shadow-sm p-3 rounded bg-light mb-3">
                                        <strong>Mobile:</strong>
                                        <span>{{ $data->mobile ?? 'N/A' }}</span>
                                    </div>
                                    <div class="info-box shadow-sm p-3 rounded bg-light mb-3">
                                        <strong>Total Orders:</strong>
                                        <span>{{ $data->orders_count ?? 0 }}</span>
                                    </div>
                                    <div class="info-box shadow-sm p-3 rounded bg-light mb-3">
                                        <strong>Total Price:</strong>
                                        <span>{{ number_format($data->orders_sum_total_price ?? 0, 2) }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <p>{{ $data }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
