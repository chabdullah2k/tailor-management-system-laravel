@extends('admin.layouts.main')
@section('main-section')

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4 class="text-primary font-weight-bold">Create Reports</h4>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent p-0 mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create Reports</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="card shadow-lg rounded-lg border-0 mt-4">
                <div class="card-header text-center">
                    <h4>Create Reports</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('reports.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="reports_id" class="font-weight-bold">Reports</label>
                                <select name="reports_id" id="reports_id" class="form-control" required>
                                    <option value="" disabled selected>Select Reports</option>
                                    <option value="1">User</option>
                                    <option value="2">Customer</option>
                                    <option value="3">General</option>
                                </select>
                            </div>
                        </div>

                        <div class="row" id="user-field" style="display: none;">
                            <div class="form-group col-md-6">
                                <label for="user_id" class="font-weight-bold">User</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="" disabled selected>Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row" id="customer-field" style="display: none;">
                            <div class="form-group col-md-6">
                                <label for="customer_id" class="font-weight-bold">Customer</label>
                                <select name="customer_id" id="customer_id" class="form-control">
                                    <option value="" disabled selected>Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}--{{ $customer->mobile }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="start_date" class="font-weight-bold">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    value="{{ old('start_date') }}" required>
                                @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="end_date" class="font-weight-bold">End Date </label>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    value="{{ old('end_date') }}" required>
                                @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <button type="submit" class="btn btn-primary btn-block font-weight-bold">
                            Create Reports
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('reports_id').addEventListener('change', function () {
        const selectedValue = this.value;
        document.getElementById('user-field').style.display = selectedValue === "1" ? "block" : "none";
        document.getElementById('customer-field').style.display = selectedValue === "2" ? "block" : "none";
    });
</script>

@endsection
