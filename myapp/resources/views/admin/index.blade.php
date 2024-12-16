@extends('admin.layouts.main')
@section('main-section')

<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Dashboard</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            January 2018
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Export List</a>
                            <a class="dropdown-item" href="#">Policies</a>
                            <a class="dropdown-item" href="#">View Assets</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row clearfix progress-box">
            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <div class="progress-box text-center">
                        <input type="text" class="knob" value="{{ $totalEarnings ?? 0 }}" data-width="120" data-height="120" readonly>
                        <h5 class="text-blue padding-top-10 h5">Total Earnings</h5>
                        <span class="d-block">${{ number_format($totalEarnings, 2) }} <i class="fa fa-line-chart text-blue"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <div class="progress-box text-center">
                        <input type="text" class="knob" value="{{ $totalOrders ?? 0 }}" data-width="120" data-height="120" readonly>
                        <h5 class="text-light-green padding-top-10 h5">Total Orders</h5>
                        <span class="d-block">{{ $totalOrders }} Orders <i class="fa fa-line-chart text-light-green"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <div class="progress-box text-center">
                        <input type="text" class="knob" value="{{ $pendingOrders ?? 0 }}" data-width="120" data-height="120" readonly>
                        <h5 class="text-light-orange padding-top-10 h5">Pending Orders</h5>
                        <span class="d-block">{{ $pendingOrders }} Orders <i class="fa fa-line-chart text-light-orange"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <div class="progress-box text-center">
                        <input type="text" class="knob" value="{{ $completedOrders ?? 0 }}" data-width="120" data-height="120" readonly>
                        <h5 class="text-light-purple padding-top-10 h5">Completed Orders</h5>
                        <span class="d-block">{{ $completedOrders }} Orders <i class="fa fa-line-chart text-light-purple"></i></span>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row clearfix progress-box">
            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <div class="progress-box text-center">
                        <input type="text" class="knob dial1" value="{{ $totalEarnings ?? 0 }}"
                        data-width="120" data-height="120" data-linecap="round" data-thickness="0.12"
                        data-bgColor="#fff" data-fgColor="#1b00ff" data-angleOffset="180"
                        data-max="{{ $totalEarnings > 100 ? $totalEarnings : 100 }}" readonly>

                        <h4 class="text-blue padding-top-10 h4">کل آمدنی</h4>
                        <span class="d-block">{{ number_format($totalEarnings, 2) }} <i class="fa fa-line-chart text-blue"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <div class="progress-box text-center">
                        <input type="text" class="knob dial2" value="{{ $totalOrders ?? 0 }}"
                               data-width="120" data-height="120" data-linecap="round" data-thickness="0.12"
                               data-bgColor="#fff" data-fgColor="#00e091" data-angleOffset="180" readonly>
                        <h4 class="text-light-green padding-top-10 h4">کل آرڈرز</h4>
                        <span class="d-block">{{ $totalOrders }} Orders <i class="fa fa-line-chart text-light-green"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <div class="progress-box text-center">
                        <input type="text" class="knob dial3" value="{{ $pendingOrders ?? 0 }}"
                               data-width="120" data-height="120" data-linecap="round" data-thickness="0.12"
                               data-bgColor="#fff" data-fgColor="#f56767" data-angleOffset="180" readonly>
                        <h4 class="text-light-orange padding-top-10 h4">زیر التواء آرڈرز</h4>
                        <span class="d-block">{{ $pendingOrders }} Orders <i class="fa fa-line-chart text-light-orange"></i></span>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <div class="progress-box text-center">
                        <input type="text" class="knob dial4" value="{{ $completedOrders ?? 0 }}"
                               data-width="120" data-height="120" data-linecap="round" data-thickness="0.12"
                               data-bgColor="#fff" data-fgColor="#a683eb" data-angleOffset="180" readonly>
                        <h5 class="text-light-purple padding-top-10 h5">مکمل آرڈرز</h5>
                        <span class="d-block">{{ $completedOrders }} Orders <i class="fa fa-line-chart text-light-purple"></i></span>
                    </div>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 pt-10 height-100-p">
                    <h2 class="mb-30 h4">Browser Visit</h2>
                    <div class="browser-visits">
                        <ul>
                            <li class="d-flex flex-wrap align-items-center">
                                <div class="icon"><img src="vendors/images/chrome.png" alt=""></div>
                                <div class="browser-name">Google Chrome</div>
                                <div class="visit"><span class="badge badge-pill badge-primary">50%</span></div>
                            </li>
                            <li class="d-flex flex-wrap align-items-center">
                                <div class="icon"><img src="vendors/images/firefox.png" alt=""></div>
                                <div class="browser-name">Mozilla Firefox</div>
                                <div class="visit"><span class="badge badge-pill badge-secondary">40%</span></div>
                            </li>
                            <li class="d-flex flex-wrap align-items-center">
                                <div class="icon"><img src="vendors/images/safari.png" alt=""></div>
                                <div class="browser-name">Safari</div>
                                <div class="visit"><span class="badge badge-pill badge-success">40%</span></div>
                            </li>
                            <li class="d-flex flex-wrap align-items-center">
                                <div class="icon"><img src="vendors/images/edge.png" alt=""></div>
                                <div class="browser-name">Microsoft Edge</div>
                                <div class="visit"><span class="badge badge-pill badge-warning">20%</span></div>
                            </li>
                            <li class="d-flex flex-wrap align-items-center">
                                <div class="icon"><img src="vendors/images/opera.png" alt=""></div>
                                <div class="browser-name">Opera Mini</div>
                                <div class="visit"><span class="badge badge-pill badge-info">20%</span></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 pt-10 height-100-p">
                    <h2 class="mb-30 h4">World Map</h2>
                    <div id="browservisit" style="width:100%!important; height:380px"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 col-md-12 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <h4 class="mb-30 h4">Compliance Trend</h4>
                    <div id="compliance-trend" class="compliance-trend"></div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12 mb-30">
                <div class="card-box pd-30 height-100-p">
                    <h4 class="mb-30 h4">Records</h4>
                    <div id="chart" class="chart"></div>
                </div>
            </div>
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp For Tailor Shop
        </div>
    </div>
</div>

@endsection



 </script>
