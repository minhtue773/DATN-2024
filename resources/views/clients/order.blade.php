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
                                            <p class="lead fw-normal mb-0" style="color: #ce95d7;">Tất cả đơn hàng</p>

                                        </div>

                                        <div class="card shadow-0 border mb-4">
                                            <div class="row">
                                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center"
                                                    style="border-right: 1px solid #e0e0e0;">
                                                    <p class="text-muted mb-0">Mã Đơn Hàng</p>
                                                </div>
                                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center"
                                                    style="border-right: 1px solid #e0e0e0;">
                                                    <p class="text-muted mb-0">Ngày</p>
                                                </div>

                                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center"
                                                    style="border-right: 1px solid #e0e0e0;">
                                                    <p class="text-muted mb-0 ">Trạng Thái</p>
                                                </div>
                                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center"
                                                    style="border-right: 1px solid #e0e0e0;">
                                                    <p class="text-muted mb-0 ">Tổng Tiền</p>
                                                </div>
                                                <div
                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0">Thao Tác</p>
                                                </div>
                                                <div
                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                    <p class="text-muted mb-0">Xem</p>
                                                </div>

                                            </div>
                                            <div class="card-body border">

                                                <div class="row">
                                                    <div class="col-md-2 ">
                                                        <p>{{ $order->invoice_code }}</p>
                                                    </div>
                                                    <div
                                                        class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                        <p class="text-muted mb-0">{{ $order->created_at }}</p>
                                                    </div>

                                                    <div
                                                        class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                        @if ($order->status == 0)
                                                            <p class="text-muted mb-0 small">Đang Chờ Xác Nhận</p>
                                                        @elseif ($order->status == 5)
                                                            <p class="text-muted mb-0 small">Đã Hủy</p>
                                                        @endif


                                                    </div>
                                                    <div
                                                        class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                        <p class="text-muted mb-0 small">
                                                            {{ number_format($order->total, 2) }} đ</p>
                                                    </div>
                                                    <div
                                                        class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                        @if ($order->status !== 5)
                                                            <!-- Kiểm tra trạng thái đơn hàng -->
                                                            <form action="{{ route('orders.cancel', $order->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">Hủy đơn
                                                                    hàng</button>
                                                            </form>
                                                        @endif
                                                    </div>

                                                    <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                        <a href="{{ route('order.details', ['id' => $order->id]) }}" class="text-muted mb-0 small">Chi tiết</a>
                                                    </div>
                                                    
                                                    

                                                </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="card-footer border-0 px-4 py-5"
                                style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>


@endsection
