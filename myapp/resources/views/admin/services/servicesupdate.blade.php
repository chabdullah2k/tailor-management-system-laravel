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
                            <h4>Edit Service</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Service</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 d-flex justify-content-end">
                        <a href="{{ route('services.index') }}" class="btn btn-outline-primary">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box shadow-lg rounded" style="width: 100%; background-color: #ffffff; border: 1px solid #e2e6ea; padding: 20px;">
                <div class="d-flex justify-content-center align-items-center pb-3 mb-3" style="border-bottom: 1px solid #e2e6ea;">
                    <h4 style="color: #007bff; font-weight: 600; margin: 0;">Edit Service</h4>
                </div>
                <div class="pb-3">
                    <form action="{{ route('services.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-6" style="margin-bottom: 16px; margin-top: 16px;">
                                <label class="font-weight-bold" style="display: block; margin-bottom: 8px; font-size: 16px; color: #333;">Name</label>
                                <input type="text" name="name" class="form-control border rounded" value="{{ $service->name }}" required style="width: 100%; padding: 10px; font-size: 14px; border: 1px solid #ced4da; border-radius: 8px;">
                            </div>

                            <div class="form-group col-md-6" style="margin-bottom: 16px; margin-top: 16px;">
                                <label class="font-weight-bold" style="display: block; margin-bottom: 8px; font-size: 16px; color: #333;">Code</label>
                                <input type="text" name="code" class="form-control border rounded" value="{{ $service->code }}" required style="width: 100%; padding: 10px; font-size: 14px; border: 1px solid #ced4da; border-radius: 8px;">
                                @error('code')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-md-6" style="margin-bottom: 16px;">
                                <label class="font-weight-bold" style="display: block; margin-bottom: 8px; font-size: 16px; color: #333;">Price</label>
                                <input type="number" name="price" class="form-control border rounded" value="{{ $service->price }}" required style="width: 100%; padding: 10px; font-size: 14px; border: 1px solid #ced4da; border-radius: 8px;">
                            </div>

                            <div class="form-group col-md-6" style="margin-bottom: 16px;">
                                <label class="font-weight-bold" style="display: block; margin-bottom: 8px; font-size: 16px; color: #333;">Description</label>
                                <textarea name="description" class="form-control border rounded" rows="4" style="width: 100%; padding: 10px; font-size: 14px; border: 1px solid #ced4da; border-radius: 8px;">{{ $service->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-check" style="margin-bottom: 16px;">
                            <input type="checkbox" name="active" class="form-check-input" value="1" {{ $service->active ? 'checked' : '' }} style="margin-top: 6px;">
                            <label class="form-check-label font-weight-bold" style="font-size: 16px; color: #333;">Active</label>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 16px; background-color: #007bff; color: #fff; border: none; border-radius: 8px;">Update Service</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
