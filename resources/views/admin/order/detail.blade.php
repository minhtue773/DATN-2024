@extends('admin.layout.app')
@section('title')
    Đơn hàng #123123
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}">Đơn hàng</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mã đơn #123123</li>
                </ol>
            </nav>
            <div class="row d-flex justify-content-center align-items-center h-100 mb-4">
                <div class="col-12">
                    <div class="card card-stepper border-top-purple" style="border-radius: 16px;">
                        <div class="card-body p-5">
                            <ul id="progressbar-2" class="d-flex justify-content-between mx-0 mt-0 mb-5 px-0 pt-0 pb-2">
                                <li class="step0 active text-center" id="step1"></li>
                                <li class="step0 active text-center" id="step2"></li>
                                <li class="step0 active text-center" id="step3"></li>
                                <li class="step0 text-muted text-end" id="step4"></li>
                            </ul>
                            <div class="d-flex justify-content-between">
                                <div class="d-lg-flex align-items-center">
                                    <i class="fas fa-clipboard-list fa-3x me-3 mb-3 mb-lg-0"></i>
                                    <p class="mb-0">Chờ xác nhận</p>
                                </div>
                                <div class="d-lg-flex align-items-center">
                                    <i class="fas fa-box-open fa-3x me-3 mb-3 mb-lg-0"></i>
                                    <p class="mb-0">Đang chuẩn bị</p>
                                </div>
                                <div class="d-lg-flex align-items-center">
                                    <i class="fas fa-shipping-fast fa-3x me-3 mb-3 mb-lg-0"></i>
                                    <p class="mb-0">Giao hàng</p>
                                </div>
                                <div class="d-lg-flex align-items-center">
                                    <i class="fas fa-home fa-3x me-3 mb-3 mb-lg-0"></i>
                                    <p class="mb-0">Thành công</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-8">
                    <div class="card border-top-warning h-100">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Đơn hàng: #123123</h4>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Mô hình</th>
                                            <th>Số lượng</th>
                                            <th class="text-end">Giá</th>
                                            <th class="text-end">Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>The Military Duffle Bag</td>
                                            <td>3</td>
                                            <td class="text-end">520.000 đ</td>
                                            <td class="text-end">1.560.000 đ</td>
                                        </tr>
                                        <tr>
                                            <td>Mountain Basket Ball</td>
                                            <td>1</td>
                                            <td class="text-end">330.000 đ</td>
                                            <td class="text-end">330.000 đ</td>
                                        </tr>
                                        <tr>
                                            <td>Wavex Canvas Messenger Bag</td>
                                            <td>5</td>
                                            <td class="text-end">480.000 đ</td>
                                            <td class="text-end">2.400.000 đ</td>
                                        </tr>
                                        <tr>
                                            <td>The Utility Shirt</td>
                                            <td>2</td>
                                            <td class="text-end">380.000 đ</td>
                                            <td class="text-end">760.000 đ</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-top-warning h-100">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Thanh toán</h4>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th></th>
                                            <th class="text-end">Giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tổng cộng:</td>
                                            <td class="text-end">5.050.000 đ</td>
                                        </tr>
                                        <tr>
                                            <td>Phí vận chuyển:</td>
                                            <td class="text-end">23.000 đ</td>
                                        </tr>
                                        <tr>
                                            <td>Thuế: </td>
                                            <td class="text-end">0 đ</td>
                                        </tr>
                                        <tr>
                                            <th>Thành tiền :</th>
                                            <th class="text-end">5.073.000 đ</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-4">
                    <div class="card h-100 border-left-primary">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Thông tin giao hàng</h4>
                            <h5 class="mb-3">Nguyễn Minh Tuệ</h5>
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <p class="mb-2"><i class="fa-solid fa-house-user me-2"></i>36 đường B, Phú Thạnh, Tân Phú, HCM</p>
                                    <p class="mb-2"><i class="fa-solid fa-phone me-2"></i>0899384048</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card h-100 border-left-info">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Thông tin thanh toán</h4>
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <p class="mb-2"><span class="fw-bold me-2">Loại thanh toán:</span>Credit Card</p>
                                    <p class="mb-2"><span class="fw-bold me-2">Provider:</span>Visa ending in 2851</p>
                                    <p class="mb-2"><span class="fw-bold me-2">Valid Date:</span>02/2020</p>
                                    <p class="mb-0"><span class="fw-bold me-2">CVV:</span>xxx</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card h-100 border-left-success">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Tóm tắt</h4>
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <p class="mb-2"><span class="fw-bold me-2">Tình trạng:</span>Đang giao hàng</p>
                                    <p class="mb-2"><span class="fw-bold me-2">Thanh toán:</span>Đã thanh toán</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
