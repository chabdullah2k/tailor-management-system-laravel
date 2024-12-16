@extends('admin.layouts.main')
@section('main-section')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4 class="text-primary font-weight-bold">Create Customer</h4>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent p-0 mb-0">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create Customer</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a href="{{ route('customers.index') }}" class="btn btn-outline-primary">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="card shadow-lg rounded-lg border-0 mt-4">
                <div class="card-header text-center ">
                    <h4>Create Customer</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('customers.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name" class="font-weight-bold">Name</label>
                                <input type="text" name="name" class="form-control"
                                value="{{ old('name') }}" required placeholder="Enter customer name">


                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"  placeholder="Enter customer email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mobile" class="font-weight-bold">Mobile</label>
                                <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}" placeholder="Enter mobile number">
                                @error('mobile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="opening_balance" class="font-weight-bold">Opening Balance</label>
                                <input type="number" name="opening_balance" class="form-control"
                                value="{{ old('opening_balance') }}" placeholder="Enter opening balance">

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="description" class="font-weight-bold">Description</label>
                                <textarea name="description" class="form-control" rows="4"
                                          placeholder="Enter description">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="address" class="font-weight-bold">Address</label>
                                <textarea name="address" class="form-control" rows="4"
                                          placeholder="Enter address">{{ old('address') }}</textarea>
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary btn-block font-weight-bold" style="font-size: 18px;">
                            Create Customer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
