@extends('admin.layout.app')
@section('title')
    Configuration
@endsection
@section('content')
<!-- CONTENT -->
<div class="container-fluid">
    <div class="container">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fa-solid fa-gears me-2"></i>Thiết lập chung</h1>
        </div>
        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0">Nội dung trang chủ</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <a href="{{ route('admin.banner.index') }}" class="text-decoration-none text-dark">
                                    <div class="d-flex align-items-center p-3 flex-grow-1">
                                        <i class="fa-solid fa-images fa-3x text-gray-800 me-4"></i>
                                        <div>
                                            <h6 class="m-0">Banner</h6>
                                            <p class="text-muted m-0">Thiết lập banner</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="{{ route('admin.promotion.index') }}" class="text-decoration-none text-dark">
                                    <div class="d-flex align-items-center p-3 flex-grow-1">
                                        <i class="fa-solid fa-percent fa-3x text-gray-800 me-4"></i>
                                        <div>
                                            <h6 class="m-0">khuyến mãi</h6>
                                            <p class="text-muted m-0">Thiết lập khuyến mãi</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="{{ route('admin.configuration.info') }}" class="text-decoration-none text-dark">
                                    <div class="d-flex align-items-center p-3 flex-grow-1">
                                        <i class="fa-solid fa-circle-info fa-3x text-gray-800 me-4"></i>
                                        <div>
                                            <h6 class="m-0">Thông tin website</h6>
                                            <p class="text-muted m-0">Thiết lập thông tin website</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0">Cài đặt chung</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <a href="#" class="text-decoration-none text-dark">
                                    <div class="d-flex align-items-center p-3 flex-grow-1">
                                        <i class="fa-solid fa-building-columns fa-3x text-gray-800 me-4"></i>
                                        <div>
                                            <h6 class="m-0">Cổng thanh toán</h6>
                                            <p class="text-muted m-0">Thiết lập cổng thanh toán</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="#" class="text-decoration-none text-dark">
                                    <div class="d-flex align-items-center p-3 flex-grow-1">
                                        <i class="fa-solid fa-earth-asia fa-3x text-gray-800 me-4"></i>
                                        <div>
                                            <h6 class="m-0">Ngôn ngữ</h6>
                                            <p class="text-muted m-0">Thiết lập ngôn ngữ</p>
                                        </div>
                                    </div>
                                </a>
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
@endsection