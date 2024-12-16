    @extends('admin.layouts.main')

    @section('main-section')

    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Measurements</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Measurements</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <a href="{{ route('measurements.create') }}" class="btn btn-outline-primary" style="min-width: 150px;">
                                <i class="fa fa-plus"></i> Create Measurement
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Measurement Table</h4>
                    </div>
                    <div class="table-responsive" style="overflow-x: auto;">
                        <table class="table table-striped table-hover data-table">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Service</th>
                                    <th>Type Name</th>
                                    <th>Description</th>
                                    <th>Fields</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($measurements as $measurement)
                                <tr>
                                    <td>{{ $measurement->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $measurement->service->name ?? 'N/A' }}</td>
                                    <td>{{ $measurement->type_name }}</td>
                                    <td>{{ Str::limit($measurement->description, 30) }}</td>
                                    <td>
                                        @foreach($measurement->measurementValues as $field)
                                            <div>{{ $field->fieldname }}: {{ $field->value }}</div>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <a class="dropdown-item" href="{{ route('measurements.edit', $measurement) }}">
                                                    <i class="dw dw-edit2"></i> Edit
                                                </a>
                                                <form action="{{ route('measurements.destroy', $measurement) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this measurement?')">
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
                </div>
            </div>
        </div>
    </div>

    @endsection
