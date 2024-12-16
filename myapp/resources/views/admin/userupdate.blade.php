@extends('admin.layouts.main')
@section('main-section')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4 class="text-primary font-weight-bold">Edit User</h4>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent p-0 mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a href="{{ route('user.index') }}" class="btn btn-outline-primary">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="card shadow-lg rounded-lg border-0 mt-4">
                <div class="card-header text-center">
                    <h4>Edit User</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name" class="font-weight-bold">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" class="font-weight-bold">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="username" class="font-weight-bold">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password" class="font-weight-bold">Password (Optional)</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="salary" class="font-weight-bold">Salary</label>
                                <input type="number" name="salary" class="form-control" value="{{ $user->salary }}" required>
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="active" class="form-check-input" value="1" id="activeCheck" {{ $user->active ? 'checked' : '' }}>
                            <label for="activeCheck" class="form-check-label font-weight-bold">Active</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block font-weight-bold">
                            Update User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
