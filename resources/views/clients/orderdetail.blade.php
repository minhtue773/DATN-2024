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
                    <p>Ngày đặt hàng: {{ $order->created_at }}</p>
                    <p>Trạng thái: 
                        {{ $order->status == 0 ? 'Đang Chờ Xác Nhận' : ($order->status == 5 ? 'Đã Hủy' : 'Đã Xử Lý') }}
                    </p>
                    <h6 class="text-muted">Danh sách sản phẩm:</h6>
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
                                        <img src="{{ asset('client/' . $detail->product->image) }}" alt="Hình ảnh sản phẩm" style="width: 50px;">
                                    </td>
                                    <td>{{ $detail->product->name }}</td> <!-- Giả sử tên sản phẩm là `name` -->
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ number_format($detail->price, 2) }} đ</td>
                                    <td>{{ number_format($detail->quantity * $detail->price, 2) }} đ</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="text-end"><strong>Tổng cộng:</strong> {{ number_format($order->total, 2) }} đ</p>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection
