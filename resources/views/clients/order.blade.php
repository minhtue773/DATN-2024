@extends('clients.layout.app')
@section('title')
    Quản Lý Đơn Hàng
@endsection

@section('content')

    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">ĐƠN HÀNG</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Đơn hàng</p>
            </div>
        </div>
    </div>
    <div id="page-content" class="page-wrapper">


        <div class="shop-section mb-80">
            <link rel="stylesheet" href="{{ asset('client/css/orders.css') }}">
            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <div class="container-fluid px-4 mt-4">
                        <!-- Account page navigation-->
                        <nav class="nav nav-borders">
                            <a class="nav-link ms-0" href="{{ route('my_account') }}">Thông tin cá nhân</a>
                            <a class="nav-link active" href="{{ route('orders') }}">Đơn hàng của tôi</a>

                        </nav>
                        <hr class="mt-0 mb-4">

                        <!-- Billing history card-->
                        <div class="card mb-4">
                            <div class="card-header">Danh Sách Đơn Hàng</div>
                            <div class="card-body p-0">
                                <!-- Billing history table-->
                                <div class="table-responsive table-billing-history" style="max-height: 600px; overflow-y: auto;">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-gray-200" scope="col">Mã đơn hàng</th>
                                                <th class="border-gray-200" scope="col">Ngày đặt</th>
                                                <th class="border-gray-200" scope="col">Phương thức</th>
                                                <th class="border-gray-200" scope="col">Trạng thái</th>
                                                <th class="border-gray-200" scope="col">Tổng tiền</th>
                                                <th class="border-gray-200" scope="col">Trạng thái thanh toán</th>
                                                <th class="border-gray-200" scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($data->isEmpty())
                                                <div class="alert alert-info" style="margin-top: 10%; margin-bottom: 10%">
                                                    Chưa có đơn hàng nào.
                                                </div>
                                            @else
                                                @foreach ($data as $order)
                                                    <tr>
                                                        <td><a href="{{ route('order.details', ['id' => $order->id]) }}"
                                                                class="text-muted mb-0 small">{{ $order->invoice_code }}</a>
                                                        </td>
                                                        <td>{{ $order->created_at }}</td>
                                                        <td>
                                                            @if (($order->status == 0 || $order->status == 1) && $order->payment_status == 0)
                                                                <form id="changePaymentMethodForm"
                                                                    action="{{ route('orders.changePaymentMethod', $order->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="col-10 mb-3">
                                                                        <select class="form-control form-control-sm"
                                                                            id="payment_method" name="payment_method"
                                                                            onchange="this.form.submit()">
                                                                            <option value="vnpay"
                                                                                {{ $order->payment_method == 'vnpay' ? 'selected' : '' }}>
                                                                                VNPay</option>
                                                                            <option value="momo"
                                                                                {{ $order->payment_method == 'momo' ? 'selected' : '' }}>
                                                                                Momo</option>
                                                                            <option value="cash"
                                                                                {{ $order->payment_method == 'cash' ? 'selected' : '' }}>
                                                                                Cash</option>
                                                                            <!-- Thêm các phương thức thanh toán khác -->
                                                                        </select>
                                                                    </div>
                                                                </form>
                                                            @else
                                                            <div class="col-10 mb-3">
                                                                <select class="form-control form-control-sm" name="" id="" disabled>
                                                                    <option>{{ $order->payment_method }}</option>
                                                                </select>
                                                                
                                                            </div>
                                                           
                                                         
                                                           
                                                               
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($order->status == 0)
                                                                <span class="badge badge-info rounded-pill d-inline text-white p-1">Đang Chờ Xác Nhận</span>
                                                            @elseif ($order->status == 5)
                                                                <span class="badge badge-danger rounded-pill d-inline text-white p-1 px-2">Đã Hủy</span>
                                                            @elseif ($order->status == 4)
                                                                <span class="badge badge-warning rounded-pill d-inline text-white p-1">Yêu cầu hủy</span>
                                                            @elseif ($order->status == 1)
                                                                <span class="badge badge-primary rounded-pill d-inline text-white p-1">Đang xử lý</span>
                                                            @elseif ($order->status == 2)
                                                                <span class="badge badge-primary rounded-pill d-inline text-white p-1">Đang giao hàng</span>
                                                            @elseif ($order->status == 3)
                                                                <span class="badge badge-success rounded-pill d-inline text-white p-1">Hoàn thành</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ number_format($order->total, 0, ',', '.') }}
                                                            đ</td>
                                                        <td>
                                                            @if ($order->payment_status == 0)
                                                                <p class="text-muted mb-0 small">Chưa thanh toán</p>


                                                                <!-- Modal cho việc thay đổi phương thức thanh toán -->
                                                                <!-- Modal cho việc thay đổi phương thức thanh toán -->
                                                            @elseif ($order->payment_status == 1)
                                                                <p class="text-muted mb-0 small">Đã thanh toán</p>
                                                            @endif

                                                        </td>
                                                        <td>

                                                            @if ($order->status == 0 || $order->status == 1)
                                                                <!-- Kiểm tra trạng thái đơn hàng -->
                                                                <form action="{{ route('orders.cancel', $order->id) }}"
                                                                    method="POST" style="display:inline;" id="cancelForm">
                                                                    @csrf
                                                                    <button type="button" onclick="openCancelModal()"
                                                                        class="btn btn-danger btn-sm">Hủy đơn</button>
                                                                </form>


                                                                <!-- Modal for cancel reason -->
                                                                <div class="modal fade" id="cancelModal" tabindex="-1"
                                                                    aria-labelledby="cancelModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="cancelModalLabel">Nhập
                                                                                    lý do hủy đơn hàng</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-dismiss="modal" aria-label="Close">
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <textarea id="cancelReason" class="form-control" rows="4" placeholder="Nhập lý do hủy đơn hàng (ít nhất 3 ký tự)"></textarea>
                                                                                <!-- Thông báo lỗi -->
                                                                                <small id="error-message"
                                                                                    class="text-danger"
                                                                                    style="display:none;">Lý do hủy phải có
                                                                                    ít nhất
                                                                                    3 ký tự.</small>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-danger btn-sm"
                                                                                    id="confirmCancelBtn">Hủy đơn</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($order->status == 4)
                                                                <!-- Kiểm tra trạng thái đơn hàng để khôi phục -->
                                                                <form action="{{ route('orders.restore', $order->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success btn-sm">Khôi
                                                                        phục</button>
                                                                </form>
                                                            @endif

                                                        </td>
                                                        @if (in_array($order->payment_method, ['vnpay', 'momo']) && ($order->status == 0 || $order->status == 1))
                                                            <td>
                                                                <!-- Kiểm tra phương thức thanh toán là vnpay hoặc momo và trạng thái là chưa thanh toán -->
                                                                <form action="" method="POST"
                                                                    style="display:inline;">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-sm">Thanh
                                                                        toán</button>
                                                                </form>
                                                            </td>
                                                        @endif

                                                        </td>
                                                    </tr>
                                                @endforeach

                                                <script>
                                                    // Mở modal
                                                    function openCancelModal() {
                                                        // Reset lý do hủy
                                                        document.getElementById('cancelReason').value = '';

                                                        // Mở modal
                                                        var cancelModal = new bootstrap.Modal(document.getElementById('cancelModal'));
                                                        cancelModal.show();
                                                    }

                                                    // Xử lý khi nhấn nút "Hủy đơn" trong modal
                                                    // Xử lý khi nhấn nút "Hủy đơn" trong modal
                                                    document.getElementById('confirmCancelBtn').addEventListener('click', function() {
                                                        var reason = document.getElementById('cancelReason').value.trim();
                                                        var errorMessage = document.getElementById('error-message');
                                                        // Kiểm tra nếu lý do hủy ít nhất 3 ký tự
                                                        if (reason.length < 3) {
                                                            errorMessage.style.display = 'block';
                                                        } else {
                                                            // Gửi lý do vào form và submit
                                                            var form = document.getElementById('cancelForm');
                                                            var inputReason = document.createElement('input');
                                                            inputReason.type = 'hidden';
                                                            inputReason.name = 'cancel_reason';
                                                            inputReason.value = reason;
                                                            form.appendChild(inputReason);

                                                            // Submit form
                                                            form.submit();
                                                        }
                                                    });
                                                </script>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
