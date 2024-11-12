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
                                <div class="d-flex flex-column align-items-center justify-content-center border rounded-3 p-3 bg-gray-100">
                                    <i class="fa-solid fa-user fa-2x mb-2"></i>
                                    <h6 class="m-0 mb-1">Đang online</h6>
                                    <h5 class="m-0">{{ number_format($access['online' ?? ''], 0, '.', '.') }}</h5>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-xl-3 mb-3">
                                <div class="d-flex flex-column align-items-center justify-content-center border rounded-3 p-3 bg-gray-100">
                                    <i class="fa-solid fa-user-group fa-2x mb-2"></i>
                                    <h6 class="m-0 mb-1">Truy cập tuần này</h6>
                                    <h5 class="m-0">{{ number_format($access['access_week' ?? ''], 0, '.', '.') }}</h5>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-xl-3 mb-3">
                                <div class="d-flex flex-column align-items-center justify-content-center border rounded-3 p-3 bg-gray-100">
                                    <i class="fa-solid fa-users fa-2x mb-2"></i>
                                    <h6 class="m-0 mb-1">Truy cập tháng {{ \Carbon\Carbon::now()->format('m-Y') }}</h6>
                                    <h5 class="m-0">{{ number_format($access['access_month' ?? ''], 0, '.', '.') }}</h5>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-xl-3 mb-3">
                                <div class="d-flex flex-column align-items-center justify-content-center border rounded-3 p-3 bg-gray-100">
                                    <i class="fa-solid fa-chart-simple fa-2x mb-2"></i>
                                    <h6 class="m-0 mb-1">Tổng lượng truy cập</h6>
                                    <h5 class="m-0">{{ number_format($access['access_total' ?? ''], 0, '.', '.') }}</h5>
                                </div>
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
                        <h6 class="m-0 font-weight-bold text-primary">Lượt truy cập tháng {{ \Carbon\Carbon::now()->format('m') }}</h6>                    
                    </div>
                    <!-- Card Body -->
                    <div class="card-body align-content-center">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 col-sm-12 col-md-8 col-xl-8">
                                <canvas id="visited"></canvas>
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
                                    <select class="form-select form-select-sm" name="productTop" onchange="updateProductTop()">
                                        <option value="5" {{ request()->productTop === '5' ? 'selected' : '' }}>Top 5</option>
                                        <option value="10" {{ request()->productTop === '10' ? 'selected' : '' }}>Top 10</option>
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
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tổng doanh thu</h6>
                        <div class="dropdown no-arrow">
                            <form id="filterRevenueForm" method="GET">
                                <div class="d-flex">
                                    <select class="form-select form-select-sm" name="chartOrder" onchange="updateRevenue()">
                                        <option value="month" {{ request()->chartOrder === 'month' ? 'selected' : '' }}>Tháng</option>
                                        <option value="year" {{ request()->chartOrder === 'year' ? 'selected' : '' }}>Năm</option>
                                    </select>
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
        <div class="row mb-3">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                <div class="card shadow mb-4 h-100">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Đơn hàng</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body align-content-center">
                        <div class="row d-flex justify-content-center">
                            <div class="col-8">
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
        }
    });
</script>
<script style='text/javascript'>
	var requestAnimationFrame=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||window.msRequestAnimationFrame;var transforms=["transform","msTransform","webkitTransform","mozTransform","oTransform"];var transformProperty=getSupportedPropertyName(transforms);var snowflakes=[];var browserWidth;var browserHeight;var numberOfSnowflakes=15;var resetPosition=false;function setup(){window.addEventListener("DOMContentLoaded",generateSnowflakes,false);window.addEventListener("resize",setResetFlag,false)}setup();function getSupportedPropertyName(b){for(var a=0;a<b.length;a++){if(typeof document.body.style[b[a]]!="undefined"){return b[a]}}return null}function Snowflake(b,a,d,e,c){this.element=b;this.radius=a;this.speed=d;this.xPos=e;this.yPos=c;this.counter=0;this.sign=Math.random()<0.5?1:-1;this.element.style.opacity=0.5+Math.random();this.element.style.fontSize=4+Math.random()*10+"px"}Snowflake.prototype.update=function(){this.counter+=this.speed/5000;this.xPos+=this.sign*this.speed*Math.cos(this.counter)/40;this.yPos+=Math.sin(this.counter)/40+this.speed/30;setTranslate3DTransform(this.element,Math.round(this.xPos),Math.round(this.yPos));if(this.yPos>browserHeight){this.yPos=-50}};function setTranslate3DTransform(a,c,b){var d="translate3d("+c+"px, "+b+"px, 0)";a.style[transformProperty]=d}function generateSnowflakes(){var b=document.querySelector(".snowflake");var h=b.parentNode;browserWidth=document.documentElement.clientWidth;browserHeight=document.documentElement.clientHeight;for(var d=0;d<numberOfSnowflakes;d++){var j=b.cloneNode(true);h.appendChild(j);var e=getPosition(50,browserWidth);var a=getPosition(50,browserHeight);var c=5+Math.random()*40;var g=4+Math.random()*10;var f=new Snowflake(j,g,c,e,a);snowflakes.push(f)}h.removeChild(b);moveSnowflakes()}function moveSnowflakes(){for(var b=0;b<snowflakes.length;b++){var a=snowflakes[b];a.update()}if(resetPosition){browserWidth=document.documentElement.clientWidth;browserHeight=document.documentElement.clientHeight;for(var b=0;b<snowflakes.length;b++){var a=snowflakes[b];a.xPos=getPosition(50,browserWidth);a.yPos=getPosition(50,browserHeight)}resetPosition=false}requestAnimationFrame(moveSnowflakes)}function getPosition(b,a){return Math.round(-1*b+Math.random()*(a+2*b))}function setResetFlag(a){resetPosition=true};
</script>

@endsection

