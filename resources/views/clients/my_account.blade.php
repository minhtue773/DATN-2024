@extends('clients.layout.app')
<link rel="stylesheet" href="{{asset('client/css/my_account.css')}}">
@section('content')

<div id="page-content" class="page-wrapper">

    <!-- LOGIN SECTION START -->
    <div class="login-section mb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-md-offset-2">
                    <div class="my-account-content" id="accordion2">
                        <!-- My Personal Information -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion2"
                                        href="#personal_info" style="text-decoration: none;">Thông Tin Cá Nhân</a>
                                </h4>
                            </div>

                            <div id="personal_info" class="panel-collapse collapse in" role="tabpanel">
                                <div class="panel-body">
                                    <form action="{{ route('account.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="text-center">
                                            <img class="img-account-profile rounded-circle mb-2" src="{{asset('storage/' . $user->image)}}">
                                            <input type="file" name="image" class="form-control mb-3">
                                        </div>
                                        <div class="new-customers">
                                            <div class="p-30">
                                                <div class="row">
                                                    <input type="text" class="form-control mb-3" name="name" value="{{ $user->name ?? null }}" required placeholder="Họ và Tên">
                                                    <input type="text" class="form-control mb-3" name="phone_number" value="{{ $user->phone_number ?? null }}" required placeholder="Số điện thoại">
                                                    <input type="text" class="form-control mb-3" name="address" value="{{ $user->address ?? null }}" required placeholder="Địa chỉ cụ thể">
                                                    <input type="text" class="form-control mb-3" name="email" value="{{ $user->email ?? null }}" required placeholder="Email">
                                                    <!-- <input type="password" class="form-control mb-3" name="password" placeholder="Mật khẩu">
                                                    <input type="password" class="form-control mb-3" name="password_confirmation" placeholder="Xác nhận mật khẩu"> -->
                                                </div>

                                                <div class="checkbox">
                                                    <label>
                                                        <small>
                                                            <input type="checkbox" name="signup">Tôi đã đọc và
                                                            đồng ý với <a href="#">Chính Sách Bảo Mật</a>.
                                                        </small>
                                                    </label>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button class="submit-btn-1 bg-warning mt-20 btn-hover-1"
                                                            type="submit">Cập Nhật</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button class="submit-btn-1 bg-warning mt-20 btn-hover-1 f-right"
                                                            type="reset">Xóa</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- My shipping address -->


                        <!-- My Order info -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion2"
                                        href="#My_order_info" style="text-decoration: none;">Thông tin đơn hàng của tôi</a>
                                </h4>
                            </div>
                            <div id="My_order_info" class="panel-collapse collapse" role="tabpanel">
                                <div class="panel-body">
                                    <form action="#">
                                        <!-- Thông tin đơn hàng -->
                                        <div class="payment-details p-30">
                                            <table>
                                                <tr>
                                                    <td class="td-title-1">Tên sản phẩm giả x 2</td>
                                                    <td class="td-title-2">1855.00 USD</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-title-1">Tên sản phẩm giả</td>
                                                    <td class="td-title-2">555.00 USD</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-title-1">Tổng giá trước thuế</td>
                                                    <td class="td-title-2">2410.00 USD</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-title-1">Phí vận chuyển và xử lý</td>
                                                    <td class="td-title-2">15.00 USD</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-title-1">Thuế VAT</td>
                                                    <td class="td-title-2">0.00 USD</td>
                                                </tr>
                                                <tr>
                                                    <td class="order-total">Tổng đơn hàng</td>
                                                    <td class="order-total-price">2425.00 USD</td>
                                                </tr>
                                            </table>
                                            <button class="submit-btn-1 mt-20 btn-hover-1" type="submit"
                                                value="register">Lưu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- LOGIN SECTION END -->
</div>

@endsection
