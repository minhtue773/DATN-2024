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
            <h1 class="h3 mb-0 text-gray-800">Thống kê</h1>
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
        <div class="row mb-4">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card shadow mb-4 h-100">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Đơn hàng</h6>
                        <form method="GET">
                            <div class="d-flex">
                                <input type="text" class="form-control form-control-sm">
                                <button class="btn btn-outline-dark btn-sm ms-2">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>                        
                    </div>
                    <!-- Card Body -->
                    <div class="card-body align-content-center">
                        <div class="row d-flex justify-content-center">
                            <div class="col-8">
                                <canvas id="order"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="card shadow mb-4 h-100">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tổng doanh thu</h6>
                        <div class="dropdown no-arrow">
                            <form method="GET">
                                <div class="d-flex">
                                    <select class="form-select form-select-sm" name="chartOrder">
                                        <option value="month" {{ request()->chartOrder === 'month' ? 'selected' : '' }}>Tháng</option>
                                        <option value="year" {{ request()->chartOrder === 'year' ? 'selected' : '' }}>Năm</option>
                                    </select>
                                    <button class="btn btn-outline-dark btn-sm ms-2">
                                        <i class="fa-solid fa-magnifying-glass-dollar"></i>
                                    </button>
                                </div>
                            </form>                            
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body align-content-center">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12">
                                <canvas id="revenue"></canvas>
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
    const ctx = document.getElementById('revenue');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chartOrder['labels']??''),
            datasets: [{
                label: 'Tổng doanh thu (VNĐ)',
                data: @json($chartOrder['data']??''),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('vi-VN') + ' VNĐ'; // Định dạng giá trị với dấu phẩy và thêm VNĐ
                        }
                    }
                }
            }
        }
    });
</script>

