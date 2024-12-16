@extends('admin.layouts.main')

@section('main-section')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4 class="text-primary font-weight-bold">Edit Expense</h4>
                        </div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent p-0 mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('expenses.index') }}">Expenses</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Expense</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a href="{{ route('expenses.index') }}" class="btn btn-outline-primary">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="card shadow-lg rounded-lg border-0 mt-4">
                <div class="card-header text-center">
                    <h4>Edit Expense</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name" class="font-weight-bold">Name</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{ old('name', $expense->name) }}" required placeholder="Enter expense name">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="amount" class="font-weight-bold">Amount</label>
                                <input type="number" name="amount" class="form-control"
                                       value="{{ old('amount', $expense->amount) }}" required placeholder="Enter expense amount">
                                @error('amount')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="description" class="font-weight-bold">Description</label>
                                <textarea name="description" class="form-control" rows="4"
                                          placeholder="Enter description">{{ old('description', $expense->description) }}</textarea>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block font-weight-bold" style="font-size: 18px;">
                            Update Expense
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
