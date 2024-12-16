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
                            <h4>Measurement Fields</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Measurement Fields</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <a href="{{ route('measurement_fields.create') }}" class="btn btn-outline-primary" style="min-width: 150px;">
                            <i class="fa fa-plus"></i> Create Field
                        </a>
                    </div>

                </div>
            </div>

            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Measurement Fields Table</h4>
                </div>
                <div class="table-responsive" style="overflow-x: auto;">
                    <table class="table table-striped table-hover data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Order</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Required</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($measurementFields as $field)
                            <tr>
                                <td>{{ $field->fieldname }}</td>
                                <td>{{ $field->order }}</td>
                                <td>{{ ucfirst($field->type) }}</td>
                                <td>{{ Str::limit($field->description, 30) }}</td>
                                <td>
                                    <span class="badge" style="background-color: {{ $field->is_required ? '#28a745' : '#6c757d' }}; color: white;">
                                        {{ $field->is_required ? 'Yes' : 'No' }}
                                    </span>
                                </td>


                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="{{ route('measurement_fields.edit', $field) }}">
                                                <i class="dw dw-edit2"></i> Edit
                                            </a>
                                            <form action="{{ route('measurement_fields.destroy', $field) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this field?')">
                                                    <i class="dw dw-delete-3"></i> Delete
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
                {{-- <div class="d-flex justify-content-center mt-3">{{ $measurementFields->links() }}</div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
