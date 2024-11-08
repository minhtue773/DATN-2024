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
        <div class="row mb-4">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card shadow mb-4 h-100">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Đơn hàng</h6>
                        <div class="dropdown no-arrow">
                            <form method="GET">
                                <div class="d-flex">
                                    <!-- Input cho khoảng thời gian tháng -->
                                    <input type="text" id="monthRange" name="monthRange" 
                                    class="form-control form-control-sm" 
                                    placeholder="Chọn khoảng tháng">
                                    <button class="btn btn-outline-dark btn-sm ms-2">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>            
                            </form>                            
                        </div>                       
                    </div>
                    <!-- Card Body -->
                    <div class="card-body align-content-center">
                        <div class="row d-flex justify-content-center">
                            <div class="col-8">
                                <canvas id="statusOrder"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
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
    
</script>
<script>
    const sorder = document.getElementById('statusOrder');
    new Chart(sorder, {
        type: 'pie',
        data: {
            labels: ['Đơn hàng thành công','Đơn hàng đã hủy'],
            datasets: [{
                data: [300, 50],
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        }
    });
</script>
<script>
    const ctx = document.getElementById('revenue');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($revenue['labels']),
            datasets: [{
                label: 'Tổng doanh thu (VNĐ)',
                data: @json($revenue['data']),
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
@endsection

