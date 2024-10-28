@extends('admin.layout.app')
@section('title')
    Dashboard
@endsection
@section('content')
<!-- CONTENT -->
<div class="container-fluid">
    <div class="container">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Bảng điều khiển</h1>
        </div>
        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 p-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    Số lượng mô hình</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">400+</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-box-seam fs-1 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 p-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-success text-uppercase mb-1">
                                    Tổng doanh thu năm</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">21.000.000 VNĐ</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-cash fs-1 text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 p-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-info text-uppercase mb-1">
                                    Số lượng đơn hàng</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">215+</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-clipboard-data fs-1 text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 p-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-warning text-uppercase mb-1">
                                    Yêu cầu hỗ trợ </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-chat-quote fs-1 text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Row -->
        <div class="row">
            <!-- Pie Chart -->
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card shadow mb-4 h-100">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Đơn hàng</h6>
                        <form action="">
                            <select class="form-select form-select-sm" name="" id="">
                                <option value="">Tháng 10</option>
                                <option value="">Tháng 9</option>
                                <option value="">Tháng 8</option>
                                <option value="">Tháng 7</option>
                                <option value="">Tháng 6</option>
                            </select>
                        </form>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body d-flex align-items-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="d-flex flex-column align-items-center bg-primary-subtle p-3 rounded-3">
                                        <i class="bi bi-box2-heart fs-1"></i>
                                        <div class="text-center">
                                            <h5 class="m-0">Tổng đơn hàng</h5>
                                            <p>0 đơn hàng mới</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex flex-column align-items-center bg-success-subtle p-3 rounded-3">
                                        <i class="bi bi-check-square fs-1"></i>
                                        <div class="text-center">
                                            <h5 class="m-0">Thành công</h5>
                                            <p>0 đơn hàng giao thành công</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex flex-column align-items-center bg-danger-subtle p-3 rounded-3">
                                        <i class="bi bi-x-square fs-1"></i>
                                        <div class="text-center">
                                            <h5 class="m-0">Đơn đã hủy</h5>
                                            <p>0 đơn hàng đã hủy</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Area Chart -->
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card shadow mb-4 h-100">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tổng doanh thu</h6>
                        <div class="dropdown no-arrow">
                            <form action="">
                                <select class="form-select form-select-sm" name="" id="">
                                    <option value="">Ngày</option>
                                    <option value="">Tháng</option>
                                    <option value="">Năm</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('admin') }}/vendor/chart.js/Chart.min.js"></script>
    <script src="{{ asset('admin') }}/js/demo/chart-area-demo.js"></script>
@endsection
