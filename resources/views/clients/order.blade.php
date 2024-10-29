@extends('clients.layout.app')
@section('title')
Quản Lý Đơn Hàng
@endsection
@section('content')


<section id="page-content" class="page-wrapper">


    <div class="shop-section mb-80">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-10 col-xl-8">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-header px-4 py-5">
                            <h5 class="text-muted mb-0">Theo dõi đơn hàng</h5>
                        </div>
                        <div class="card-body p-4">
                            @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
                            @if ($data->isEmpty())
                            <div class="alert alert-info" style="margin-top: 10%; margin-bottom: 10%">
                                Chưa có đơn hàng nào.
                            </div>
                            @else
                            @foreach ($data as $order)
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="lead fw-normal mb-0" style="color: #a8729a;">Tất cả đơn hàng</p>

                            </div>

                            <div class="card shadow-0 border mb-4">
                                <div class="row" >
                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center" style="border-right: 1px solid #e0e0e0;">
                                        <p class="text-muted mb-0"> Ma don hang</p>
                                    </div>
                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center" style="border-right: 1px solid #e0e0e0;">
                                        <p class="text-muted mb-0">Ngay</p>
                                    </div>

                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center" style="border-right: 1px solid #e0e0e0;">
                                        <p class="text-muted mb-0 ">Trang thai</p>
                                    </div>
                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center" style="border-right: 1px solid #e0e0e0;">
                                        <p class="text-muted mb-0 ">Tong tien</p>
                                    </div>
                                    <div class="col-md-4 text-center d-flex justify-content-center align-items-center" >
                                        <p class="text-muted mb-0">Thao tac</p>
                                    </div>

                                </div>
                                <div class="card-body border">

                                    <div class="row">
                                        <div class="col-md-2 " >
                                            <p>{{ $order->invoice_code }}</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0">{{ $order->created_at }}</p>
                                        </div>

                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center" >
                                            <p class="text-muted mb-0 small">{{ $order->status }}</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center" >
                                            <p class="text-muted mb-0 small">{{ number_format($order->total, 2) }} đ</p>
                                        </div>
                                        <div class="col-md-4 text-center d-flex justify-content-center align-items-center">
                                            @if ($order->status !== 5)
                                            <!-- Kiểm tra trạng thái đơn hàng -->
                                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Hủy đơn hàng</button>
                                            </form>
                                            @endif
                                        </div>

                                    </div>
                                    <!-- <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-2">
                                            <p class="text-muted mb-0 small">Track Order</p>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="progress" style="height: 6px; border-radius: 16px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: 65%; border-radius: 16px; background-color: #a8729a;" aria-valuenow="65"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="d-flex justify-content-around mb-1">
                                                <p class="text-muted mt-1 mb-0 small ms-xl-5">Out for delivary</p>
                                                <p class="text-muted mt-1 mb-0 small ms-xl-5">Delivered</p>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <!-- <div class="card shadow-0 border mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/1.webp"
                                                class="img-fluid" alt="Phone">
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0">iPad</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">Pink rose</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">Capacity: 32GB</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">Qty: 1</p>
                                        </div>
                                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                            <p class="text-muted mb-0 small">$399</p>
                                        </div>
                                    </div>
                                    <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-md-2">
                                            <p class="text-muted mb-0 small">Track Order</p>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="progress" style="height: 6px; border-radius: 16px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: 20%; border-radius: 16px; background-color: #a8729a;" aria-valuenow="20"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="d-flex justify-content-around mb-1">
                                                <p class="text-muted mt-1 mb-0 small ms-xl-5">Out for delivary</p>
                                                <p class="text-muted mt-1 mb-0 small ms-xl-5">Delivered</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="d-flex justify-content-between pt-2">
                                <p class="fw-bold mb-0">Order Details</p>
                                <p class="text-muted mb-0"><span class="fw-bold me-4">Total</span> $898.00</p>
                            </div>

                            <div class="d-flex justify-content-between pt-2">
                                <p class="text-muted mb-0">Invoice Number : 788152</p>
                                <p class="text-muted mb-0"><span class="fw-bold me-4">Discount</span> $19.00</p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p class="text-muted mb-0">Invoice Date : 22 Dec,2019</p>
                                <p class="text-muted mb-0"><span class="fw-bold me-4">GST 18%</span> 123</p>
                            </div>

                            <div class="d-flex justify-content-between mb-5">
                                <p class="text-muted mb-0">Recepits Voucher : 18KU-62IIK</p>
                                <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> Free</p>
                            </div> -->
                            @endforeach
                            @endif
                        </div>
                        <div class="card-footer border-0 px-4 py-5"
                            style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <!-- <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
                                paid: <span class="h2 mb-0 ms-2">$1040</span></h5> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOP SECTION END -->

</section>


@endsection
