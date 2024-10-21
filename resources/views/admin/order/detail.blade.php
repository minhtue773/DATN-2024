@extends('admin.layout.app')
@section('title')
    Đơn hàng #{{ $order->invoice_code }}
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}">Đơn hàng</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mã đơn #{{ $order->invoice_code }}</li>
                </ol>
            </nav>
            <div class="row d-flex justify-content-center align-items-center h-100 mb-4">
                <div class="col-12">
                    <div class="card 
                        @if($order->status == 3)
                        border-top-success
                        @elseif($order->status == 4)
                        border-top-warning
                        @elseif($order->status == 5)
                        border-top-danger
                        @else
                        border-top-primary
                        @endif ">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    @switch($order->status)
                                        @case(0)
                                            <span class="lead fw-normal">(*) Đơn hàng chưa được xác nhận!</span>
                                        @break
                                        @case(1)
                                            <span class="lead fw-normal">(*) Đơn hàng đang được chuẩn bị!</span>
                                        @break
                                        @case(2)
                                            <span class="lead fw-normal">(*) Đơn hàng đang trên đường vận chuyển!</span>
                                        @break
                                        @case(3)
                                            <span class="lead fw-normal text-success">(*) Đơn hàng đã được giao thành công</span>
                                        @break
                                        @case(4)
                                            <span class="lead fw-normal text-warning">(*) Yêu cầu hủy đơn hàng #{{ $order->invoice_code }}</span>
                                            <span class="text-muted small">Lý do của khách hàng: Tôi muốn thay đổi địa chỉ nhận hàng.</span>
                                        @break
                                        @case(5)
                                            <span class="lead fw-normal text-danger">(*) Đơn hàng đã bị hủy!</span>
                                        @break
                                        @default
                                    @endswitch
                                </div>
                                <div>
                                    @switch($order->status)
                                        @case(0)
                                            <a href="javascrip:void(0)" class="btn btn-primary btn-sm animate__animated animate__pulse animate__infinite" onclick="confirmStatus('{{ route('admin.order.updateStatus',$order) }}')">Xác nhận đơn hàng</a>
                                        @break
                                        @case(1)
                                            <a href="{{ route('admin.order.updateStatus',$order) }}" class="btn btn-primary btn-sm animate__animated animate__pulse animate__infinite">Giao hàng</a>
                                        @break
                                        @case(2)
                                            <a href="{{ route('admin.order.updateStatus',$order) }}" class="btn btn-outline-success btn-sm">Xác nhận đã giao</a>
                                        @break
                                        @case(3)
                                            <a href="javascrip:void(0)" class="btn btn-outline-danger btn-sm" onclick="confirmStatusDel('{{ route('admin.order.updateStatus',$order) }}')">Xóa đơn hàng</a>
                                        @break
                                        @case(4)
                                            <a href="javascrip:void(0)" class="btn btn-warning btn-sm animate__animated animate__pulse animate__infinite" onclick="confirmStatusCancel('{{ route('admin.order.updateStatus',$order) }}')">Xác nhận hủy</a>
                                        @break
                                        @case(5)
                                            <a href="javascrip:void(0)" class="btn btn-outline-danger btn-sm" onclick="confirmStatusDel('{{ route('admin.order.updateStatus',$order) }}')">Xóa đơn hàng</a>
                                        @break
                                        @default
                                    @endswitch
                                </div>                                
                            </div>
                            <hr class="my-4">
                            <div class="d-flex flex-row justify-content-between align-items-center align-content-center text-gray-100">
                                @switch($order->status)
                                @case(0)
                                <span class="d-flex justify-content-center align-items-center big-dot bg-primary"><i class="fa-solid fa-hourglass-half text-white"></i></span>
                                <hr class="flex-fill track-line">
                                <span class="dot"></span>  
                                <hr class="flex-fill track-line ">
                                <span class="dot"></span>    
                                <hr class="flex-fill track-line ">
                                <span class="dot"></span>
                                @break
                                @case(1)
                                <span class="dot bg-primary"></span>
                                <hr class="flex-fill track-line bg-primary">
                                <span class="d-flex justify-content-center align-items-center big-dot bg-primary "><i class="fa-solid fa-dolly text-white"></i></span>
                                <hr class="flex-fill track-line ">
                                <span class="dot"></span>    
                                <hr class="flex-fill track-line ">
                                <span class="dot"></span>
                                @break
                                @case(2)
                                <span class="dot bg-primary"></span>
                                <hr class="flex-fill track-line bg-primary">
                                <span class="dot bg-primary"></span>    
                                <hr class="flex-fill track-line bg-primary">
                                <span class="d-flex justify-content-center align-items-center big-dot bg-primary"><i class="fa-solid fa-truck-fast text-white"></i></span>
                                <hr class="flex-fill track-line ">
                                <span class="dot"></span>
                                @break
                                @case(3)
                                <span class="dot bg-success"></span>
                                <hr class="flex-fill track-line bg-success">
                                <span class="dot bg-success"></span>    
                                <hr class="flex-fill track-line bg-success">
                                <span class="dot bg-success"></span>
                                <hr class="flex-fill track-line bg-success">
                                <span class="d-flex justify-content-center align-items-center big-dot bg-success"><i class="fa fa-check text-white"></i></span>
                                @break
                                @case(4)
                                <span class="dot bg-warning"></span>
                                <hr class="flex-fill track-line bg-warning">
                                <span class="dot bg-warning"></span>    
                                <hr class="flex-fill track-line bg-warning">
                                <span class="d-flex justify-content-center align-items-center big-dot bg-warning"><i class="fa-solid fa-question text-white"></i></span>
                                <hr class="flex-fill track-line ">
                                <span class="dot"></span>
                                @break
                                @case(5)
                                <span class="dot bg-danger"></span>
                                <hr class="flex-fill track-line bg-danger">
                                <span class="dot bg-danger"></span>    
                                <hr class="flex-fill track-line bg-danger">
                                <span class="dot bg-danger"></span>
                                <hr class="flex-fill track-line bg-danger">
                                <span class="d-flex justify-content-center align-items-center big-dot bg-danger"><i class="fa fa-check text-white"></i></span>
                                @break
                                @default  
                                @endswitch
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <span>Chờ xác nhận</span>
                                <span>Đang gói hàng</span>
                                @if ($order->status >= 4)
                                    <span>Yêu cầu hủy</span>
                                    <span>Đã hủy</span>
                                @else
                                    <span>Đang giao</span>
                                    <span>Thành công</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-8">
                    <div class="card border-top-warning h-100">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Chi tiết đơn hàng: #{{ $order->invoice_code }}</h4>
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Mô hình</th>
                                            <th class="text-center">Số lượng</th>
                                            <th class="text-end">Giá</th>
                                            <th class="text-end">Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderDetails as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->product->name }}</td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-end">{{ number_format($item->price, 0, '.', '.') }} đ</td>
                                                <td class="text-end">
                                                    {{ number_format($item->quantity * $item->price, 0, '.', '.') }} đ</td>
                                            </tr>
                                        @endforeach
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
                                            <td class="text-end">{{ number_format($order->total, 0, '.', '.') }} đ</td>
                                        </tr>
                                        <tr>
                                            <td>Phí vận chuyển:</td>
                                            <td class="text-end">23.000 đ</td>
                                        </tr>
                                        <tr>
                                            <th>Thành tiền :</th>
                                            <th class="text-end">{{ number_format($order->total, 0, '.', '.') }} đ</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-8">
                    <div class="card h-100 border-left-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="header-title mb-3">Thông tin giao hàng</h4>
                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            <p class="mb-2"><span class="fw-bold me-2">Tên người nhận:</span>{{ $order->recipient_name ?? $order->user->name }}</p>
                                            <p class="mb-2"><i
                                                    class="fa-solid fa-house-user me-2"></i>{{ $order->recipient_address }}
                                            </p>
                                            <p class="mb-2"><i
                                                    class="fa-solid fa-phone me-2"></i>{{ $order->recipient_phone }}</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <h4 class="header-title mb-3">Thông tin thanh toán</h4>
                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            @switch($order->payment_method)
                                                @case('cash')
                                                    <p class="mb-2"><span class="fw-bold me-2">Loại thanh toán:</span>Thanh toán khi nhận hàng</p>
                                                    <p class="mb-2"><span class="fw-bold me-2">Trạng thái:</span><span class="badge bg-secondary">Chưa thanh toán</span></p>
                                                    @break
                                                @case('vnpay')
                                                    <p class="mb-2"><span class="fw-bold me-2">Mã hóa đơn:</span><a href="#">#923173617</a></p>
                                                    <p class="mb-2"><span class="fw-bold me-2">Loại thanh toán:</span>Vnpay</p>
                                                    <p class="mb-2"><span class="fw-bold me-2">Trạng thái:</span><span class="badge bg-success">Đã thanh toán</span></p>
                                                    @break
                                                @case('momo')
                                                    <p class="mb-2"><span class="fw-bold me-2">Mã hóa đơn:</span><a href="#">#923173617</a></p>
                                                    <p class="mb-2"><span class="fw-bold me-2">Loại thanh toán:</span>Momo</p>
                                                    <p class="mb-2"><span class="fw-bold me-2">Trạng thái:</span><span class="badge bg-success">Đã thanh toán</span></p>
                                                    @break
                                                @default
                                                    <p class="mb-2">Không có thông tin thanh toán khả dụng.</p>
                                            @endswitch
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card h-100 border-left-primary">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Ghi chú từ khách hàng</h4>
                            <p class="mb-2">- {{ $order->note ?? 'Không có!!!' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
    function confirmStatus(urlPath) {
        Swal.fire({
            title: 'Thông báo',
            text: 'Bạn có muốn xác nhận đơn hàng này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xác nhận',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = urlPath;
            }
        });
    }
    function confirmStatusCancel(urlPath) {
        Swal.fire({
            title: 'Thông báo',
            text: 'Bạn muốn hủy đơn hàng này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xác nhận hủy',
            cancelButtonText: 'Hủy!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = urlPath;
            }
        });
    }
    function confirmStatusDel(urlPath) {
        Swal.fire({
            title: 'Thông báo',
            text: 'Bạn muốn xóa đơn hàng này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa đơn',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = urlPath;
            }
        });
    }
    </script>
@endsection
