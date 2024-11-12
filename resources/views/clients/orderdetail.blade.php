@extends('clients.layout.app')
@section('title')
    Chi Tiết Đơn Hàng
@endsection
@section('content')
    <section id="page-content" class="page-wrapper">
        <div class="shop-section mb-80">
            <div class="container py-5">
                <div class="card" style="border-radius: 10px;">
                    <div class="card-header px-4 py-5">
                        <h5 class="text-muted mb-0">Chi tiết đơn hàng #{{ $order->invoice_code }}</h5>
                    </div>
                    <div class="card-body p-4">
                        <p>Tên người nhận: {{ $order->recipient_name }}</p>
                        <p>Số điện thoại người nhận: {{ $order->recipient_phone }}</p>
                        <p>Địa chỉ nhận hàng: {{ $order->recipient_address }}</p>
                        @if (!empty($order->applied_discount_code))
                            <p>Mã giảm giá đã áp dụng: {{ $order->applied_discount_code }}</p>
                        @endif

                        <h6 class="text-muted">Danh sách sản phẩm:</h6>
                        <div style="max-height: 600px; overflow-y: auto;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($order->orderDetails as $detail)
                                        <tr>
                                            <td>{{ $index1++ }}</td>
                                            <td>
                                                <a href="/product/{{ $detail->product->slug }}">
                                                    <img src="{{ asset('uploads/images/product/' . $detail->product->image) }}"
                                                        alt="Hình ảnh sản phẩm" style="width: 50px;">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="/product/{{ $detail->product->slug }}">
                                                    {{ $detail->product->name }}
                                                </a>
                                            </td> <!-- Giả sử tên sản phẩm là `name` -->
                                            <td>{{ $detail->quantity }}</td>
                                            <td>{{ number_format($detail->price, 0, ',', '.') }} đ</td>
                                            <td>{{ number_format($detail->quantity * $detail->price, 0, ',', '.') }} đ</td>


                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                        <p class="text-end"><strong>Tổng cộng:</strong> {{ number_format($order->total, 0, ',', '.') }} đ
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
