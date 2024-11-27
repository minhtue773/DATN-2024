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
                            <div class="row align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-3 col-xl-3 mb-3">
                                    <div
                                        class="d-flex flex-column align-items-center justify-content-center border rounded-3 p-3 bg-gray-100">
                                        <i class="fa-solid fa-user-group fa-2x mb-2"></i>
                                        <h6 class="m-0 mb-1">Truy cập tuần này</h6>
                                        <h5 class="m-0">{{ number_format($access['access_week' ?? ''], 0, '.', '.') }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-3 col-xl-3 mb-3">
                                    <div
                                        class="d-flex flex-column align-items-center justify-content-center border rounded-3 p-3 bg-gray-100">
                                        <i class="fa-solid fa-users fa-2x mb-2"></i>
                                        <h6 class="m-0 mb-1">Truy cập tháng {{ \Carbon\Carbon::now()->format('m-Y') }}</h6>
                                        <h5 class="m-0">{{ number_format($access['access_month' ?? ''], 0, '.', '.') }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-3 col-xl-3 mb-3">
                                    <div
                                        class="d-flex flex-column align-items-center justify-content-center border rounded-3 p-3 bg-gray-100">
                                        <i class="fa-solid fa-chart-simple fa-2x mb-2"></i>
                                        <h6 class="m-0 mb-1">Tổng lượng truy cập</h6>
                                        <h5 class="m-0">{{ number_format($access['access_total' ?? ''], 0, '.', '.') }}
                                        </h5>
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
                                        <select class="form-select form-select-sm" name="chartOrder"
                                            onchange="updateRevenue()">
                                            <option value="month"
                                                {{ request()->chartOrder === 'month' ? 'selected' : '' }}>Tháng</option>
                                            <option value="year" {{ request()->chartOrder === 'year' ? 'selected' : '' }}>
                                                Năm</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body align-content-center">
                            <div class="row d-flex justify-content-center">
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8">
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
                                        <select class="form-select form-select-sm" name="productTop"
                                            onchange="updateProductTop()">
                                            <option value="5" {{ request()->productTop === '5' ? 'selected' : '' }}>Top
                                                5</option>
                                            <option value="10" {{ request()->productTop === '10' ? 'selected' : '' }}>
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
            const productTopSelect = document.querySelector('select[name="productTop"]');
            const chartOrderSelect = document.querySelector('select[name="chartOrder"]');

            function updateProductTop() {
                const limit = productTopSelect.value;
                fetch(`{{ route('admin.filterProductTop') }}?productTop=${limit}`)
                    .then(response => response.json())
                    .then(data => {
                        productTopChart.data.labels = data.labels;
                        productTopChart.data.datasets[0].data = data.data;
                        productTopChart.update();
                    });
            }

            function updateRevenue() {
                const filterBy = chartOrderSelect.value;
                fetch(`{{ route('admin.filterRevenue') }}?chartOrder=${filterBy}`)
                    .then(response => response.json())
                    .then(data => {
                        revenueChart.data.labels = data.labels;
                        revenueChart.data.datasets[0].data = data.data;
                        revenueChart.update();
                    });
            }

            productTopSelect.addEventListener('change', updateProductTop);
            chartOrderSelect.addEventListener('change', updateRevenue);

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

            const revenueChart = new Chart(document.getElementById('revenue'), {
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
                                    return value.toLocaleString('vi-VN') + ' VNĐ';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    <script>
        const visited = new Chart(document.getElementById('visited'), {
            type: 'line',
            data: {
                labels: @json($monthVisit['labels']),
                datasets: [{
                    label: 'Lượt truy cập',
                    data: @json($monthVisit['data']),
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            }
        });
        const orderStatus = new Chart(document.getElementById('orderStatus'), {
            type: 'pie',
            data: {
                labels: @json($orderStatus['labels']),
                datasets: [{
                    data: @json($orderStatus['data']),
                    backgroundColor: [
                        'rgb(72, 187, 120)',
                        'rgb(247, 104, 120)', // Màu danger nhạt hơn
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 2,
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            loadNotifications();
        });
        function timeAgo(date) {
            const now = new Date();
            const seconds = Math.floor((now - date) / 1000);
            const minutes = Math.floor(seconds / 60);
            const hours = Math.floor(minutes / 60);
            const days = Math.floor(hours / 24);
            const weeks = Math.floor(days / 7);

            if (seconds < 60) {
                return `${seconds} giây trước`;
            } else if (minutes < 60) {
                return `${minutes} phút trước`;
            } else if (hours < 24) {
                return `${hours} giờ trước`;
            } else if (days < 7) {
                return `${days} ngày trước`;
            } else {
                return `${weeks} tuần trước`;
            }
        }
        function loadNotifications() {
            const notificationContainer = document.querySelector('#notification');
            fetch('/admin/notification')
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        notificationContainer.innerHTML = '';
                        data.forEach(notification => {
                            const parsedData = JSON.parse(notification.data);
                            const date = new Date(notification.created_at);
                            const formattedDate = date.toLocaleDateString();
                            const notificationContent = notification.type.includes('OrderPlacedNotification') ?
                                `Đơn hàng mới (#${parsedData.invoice_code}) từ khách hàng ${parsedData.customer_name} vừa được đặt. <small class="text-primary">(Xem chi tiết)</small>` :
                                `Yêu cầu hủy đơn hàng (#${parsedData.invoice_code}) từ khách hàng ${parsedData.customer_name}. <small class="text-primary">(Xem chi tiết)</small>`;
                            const orderDetail = '/admin/notification/read/' + notification.id
                            const formattedTimeAgo = timeAgo(date);
                            notificationContainer.innerHTML += `
                                <div class="card shadow border-left-${notification.type.includes('OrderPlacedNotification') ? 'danger' : 'warning'} mb-2 notification-item">
                                    <a href="${orderDetail}" class="text-decoration-none">
                                        <div class="card-body p-2">
                                            <div class="notification d-flex align-items-center">
                                                <div class="notification-list_img me-3">
                                                    <i class="fa-solid ${notification.type.includes('OrderPlacedNotification') ? 'fa-cart-flatbed-suitcase text-danger' : 'fa-circle-question text-warning'} fa-2x"></i>
                                                </div>
                                                <div class="notification-list_detail w-100">
                                                    <div class="d-flex justify-content-between mb-1">
                                                        <span class="text-muted m-0"><small>${formattedTimeAgo}</small></span>
                                                        <span class="text-muted m-0"><small>${formattedDate}</small></span>
                                                    </div>
                                                    <p class="text-muted m-0">${notificationContent}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>`;
                        });
                    } else {
                        notificationContainer.innerHTML =
                            '<p class="text-muted text-center">Không có thông báo mới nào!</p>';
                    }
                })
                .catch(error => console.error('Error fetching notifications:', error));
        };
    </script>
@endsection
