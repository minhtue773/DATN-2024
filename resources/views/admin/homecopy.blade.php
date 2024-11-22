@extends('admin.layout.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <!-- CONTENT -->
    <div class="container-fluid">
        <div id='snowflakeContainer'>
            <p class='snowflake'>❄</p>
        </div>
        <div class="container">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Thống kê</h1>
            </div>
            <div class="row mb-3">
                <div class="col-xl-12 col-md-12 mb-4">
                    <div class="card border-top-success shadow h-100 p-2 bg-success-subtle">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-12 col-md-3 col-xl-3 mb-3">
                                    <div
                                        class="d-flex flex-column align-items-center justify-content-center border rounded-3 p-3 bg-gray-100">
                                        <i class="fa-solid fa-user fa-2x mb-2"></i>
                                        <h6 class="m-0 mb-1">Đang online</h6>
                                        <h5 class="m-0"></h5>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-3 col-xl-3 mb-3">
                                    <div
                                        class="d-flex flex-column align-items-center justify-content-center border rounded-3 p-3 bg-gray-100">
                                        <i class="fa-solid fa-user-group fa-2x mb-2"></i>
                                        <h6 class="m-0 mb-1">Truy cập tuần này</h6>
                                        <h5 class="m-0"></h5>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-3 col-xl-3 mb-3">
                                    <div
                                        class="d-flex flex-column align-items-center justify-content-center border rounded-3 p-3 bg-gray-100">
                                        <i class="fa-solid fa-users fa-2x mb-2"></i>
                                        <h6 class="m-0 mb-1">Truy cập tháng {{ \Carbon\Carbon::now()->format('m-Y') }}</h6>
                                        <h5 class="m-0"></h5>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-3 col-xl-3 mb-3">
                                    <div
                                        class="d-flex flex-column align-items-center justify-content-center border rounded-3 p-3 bg-gray-100">
                                        <i class="fa-solid fa-chart-simple fa-2x mb-2"></i>
                                        <h6 class="m-0 mb-1">Tổng lượng truy cập</h6>
                                        <h5 class="m-0"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                    <div class="card shadow mb-4 h-100">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Lượt truy cập tháng
                                {{ \Carbon\Carbon::now()->format('m') }}</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body align-content-center">
                            <div class="row d-flex justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-xl-12">
                                    <canvas id="visited"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                    <div class="card shadow mb-4 h-100">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Thông báo mới</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body align-content-center" style="max-height: 350px; overflow-y: auto;">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-xl-12" id="notification">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4">
                    <div class="card shadow mb-4 h-100">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Tổng doanh thu</h6>
                            <div class="dropdown no-arrow">
                                <form id="filterRevenueForm" method="GET">
                                    <div class="d-flex">
                                        <select class="form-select form-select-sm" name="fillter"
                                            onchange="updateRevenue()">
                                            <option value="month"
                                                {{ request()->fillter === 'month' ? 'selected' : '' }}>Tháng</option>
                                            <option value="year" {{ request()->fillter === 'year' ? 'selected' : '' }}>
                                                Năm</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body align-content-center">
                            <div class="row d-flex justify-content-center">
                                <div class="col-8">
                                    <canvas id="revenue"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                    <div class="card shadow mb-4 h-100">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Top sản phẩm bán chạy</h6>
                            <div class="dropdown no-arrow">
                                <form id="filterProductTopForm" method="GET">
                                    <div class="d-flex">
                                        <select class="form-select form-select-sm" name="limit"
                                            onchange="updateProductTop()">
                                            <option value="5" {{ request()->limit === '5' ? 'selected' : '' }}>Top
                                                5</option>
                                            <option value="10" {{ request()->limit === '10' ? 'selected' : '' }}>
                                                Top 10</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body align-content-center">
                            <div class="row d-flex justify-content-center">
                                <div class="col-12">
                                    <canvas id="productTop"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                    <div class="card shadow mb-4 h-100">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Đơn hàng</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body align-content-center">
                            <div class="row d-flex justify-content-center">
                                <div class="col-12 d-flex justify-content-center">
                                    <canvas id="orderStatus"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            

            const productTopChart = new Chart(document.getElementById('productTop'), {
                type: 'bar',
                data: {
                    labels: @json($productTop['labels']),
                    datasets: [{
                        label: 'Số lượng mô hình bán ra',
                        data: @json($productTop['data']),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                }
            });
        });
    </script>
@endsection
