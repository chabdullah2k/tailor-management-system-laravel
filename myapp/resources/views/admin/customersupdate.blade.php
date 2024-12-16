@extends('admin.layouts.main')
@section('main-section')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Edit Customer</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Customer</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex justify-content-end">
                        <a href="{{ route('customers.index') }}" class="btn btn-outline-primary">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box shadow-lg rounded" style="background-color: #ffffff; border: 1px solid #e2e6ea; padding: 20px;">
                <div class="d-flex justify-content-center align-items-center pb-3 mb-3" style="border-bottom: 1px solid #e2e6ea;">
                    <h4 style="color: #007bff; font-weight: 600; margin: 0;">Edit Customer</h4>
                </div>
                <div class="pb-3">
                    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="form-group col-md-6" style="margin-bottom: 16px;">
                                <label class="font-weight-bold" style="font-size: 16px; color: #333;">Name</label>
                                <input type="text" name="name" class="form-control border rounded" value="{{ $customer->name }}" required style="padding: 10px; font-size: 14px;">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6" style="margin-bottom: 16px;">
                                <label class="font-weight-bold" style="font-size: 16px; color: #333;">Email</label>
                                <input type="email" name="email" class="form-control border rounded" value="{{ $customer->email }}"  style="padding: 10px; font-size: 14px;">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6" style="margin-bottom: 16px;">
                                <label class="font-weight-bold" style="font-size: 16px; color: #333;">Mobile</label>
                                <input type="text" name="mobile" class="form-control border rounded" value="{{ $customer->mobile }}" style="padding: 10px; font-size: 14px;">
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6" style="margin-bottom: 16px;">
                                <label class="font-weight-bold" style="font-size: 16px; color: #333;">Opening Balance</label>
                                <input type="number" name="opening_balance" class="form-control border rounded" value="{{ $customer->opening_balance }}" required style="padding: 10px; font-size: 14px;">
                                @error('opening_balance')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 16px;">
                            <label class="font-weight-bold" style="font-size: 16px; color: #333;">Description</label>
                            <textarea name="description" class="form-control border rounded" rows="4" style="padding: 10px; font-size: 14px;">{{ $customer->description }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group" style="margin-bottom: 16px;">
                            <label class="font-weight-bold" style="font-size: 16px; color: #333;">Address</label>
                            <textarea name="address" class="form-control border rounded" rows="4" style="padding: 10px; font-size: 14px;">{{ $customer->address }}</textarea>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 16px; background-color: #007bff; color: #fff; border-radius: 8px;">Update Customer</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
