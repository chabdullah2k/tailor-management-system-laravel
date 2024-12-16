@extends('admin.layouts.main')
@section('main-section')

<div class="main-container">

    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4 class="text-primary font-weight-bold">Create Service</h4>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent p-0 mb-0">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create Service</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a href="{{ route('services.index') }}" class="btn btn-outline-primary">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="card shadow-lg rounded-lg border-0 mt-4">
                <div class="card-header text-center ">
                    <h4>Create Service</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('services.store') }}" method="POST">
                        @csrf
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="name" class="font-weight-bold">Name</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{ old('name') }}" required placeholder="Enter service name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="code" class="font-weight-bold">Code</label>
                                <input type="text" name="code" class="form-control"
                                       value="{{ old('code') }}" required placeholder="Enter service code">
                                @error('code')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="price" class="font-weight-bold">Price</label>
                                <input type="number" name="price" class="form-control"
                                       value="{{ old('price') }}" required placeholder="Enter price">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description" class="font-weight-bold">Description</label>
                                <textarea name="description" class="form-control" rows="4"
                                          placeholder="Enter description">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="active" class="form-check-input" value="1" id="activeCheck" checked>
                            <label for="activeCheck" class="form-check-label font-weight-bold">Active</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block font-weight-bold" style="font-size: 18px;">
                            Create Service
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
