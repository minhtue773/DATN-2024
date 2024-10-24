@include('layout_user.menu')
<div id="page-content" class="page-wrapper">

    <!-- LOGIN SECTION START -->
    <div class="login-section mb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="my-account-content" id="accordion2">
                        <!-- My Personal Information -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion2"
                                        href="#personal_info">Thông Tin Cá Nhân</a>
                                </h4>
                            </div>
                            @if(session('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">
                                    <strong>{{ session('success') }}</strong>
                                </button>
                            </div>
                            @endif
                            <div id="personal_info" class="panel-collapse collapse in" role="tabpanel">
                                <div class="panel-body">
                                    <form action="{{ route('account.update') }}" method="POST">
                                        @csrf
                                        <div class="new-customers">
                                            <div class="p-30">
                                                <div class="row">
                                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" required placeholder="Họ và Tên">
                                                    <input type="text" class="form-control" name="phone" value="{{ $user->phone_number }}" required placeholder="Số điện thoại">
                                                    <input type="text" class="form-control" name="address" value="{{ $user->address }}" required placeholder="Địa chỉ cụ thể">
                                                    <input type="text" class="form-control" name="email" value="{{ $user->email }}" required placeholder="Email">
                                                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Xác nhận mật khẩu">
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
                                                        <button class="submit-btn-1 mt-20 btn-hover-1"
                                                            type="submit">Cập Nhật</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button class="submit-btn-1 mt-20 btn-hover-1 f-right"
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
                                        href="#My_order_info">Thông tin đơn hàng của tôi</a>
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
                        <!-- Payment Method -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion2"
                                        href="#My_payment_method">Phương thức thanh toán</a>
                                </h4>
                            </div>
                            <div id="My_payment_method" class="panel-collapse collapse" role="tabpanel">
                                <div class="panel-body">
                                    <form action="#">
                                        <div class="new-customers p-30">
                                            <select class="custom-select">
                                                <option value="defalt">Loại thẻ</option>
                                                <option value="c-1">Thẻ MasterCard</option>
                                                <option value="c-2">Paypal</option>
                                                <option value="c-3">Visa</option>
                                                <option value="c-4">American Express</option>
                                            </select>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="Số thẻ">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="Mã bảo mật thẻ">
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="custom-select">
                                                        <option value="defalt">Tháng</option>
                                                        <option value="c-1">Tháng 1</option>
                                                        <option value="c-2">Tháng 2</option>
                                                        <option value="c-3">Tháng 3</option>
                                                        <option value="c-4">Tháng 4</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="custom-select">
                                                        <option value="defalt">Năm</option>
                                                        <option value="c-4">2017</option>
                                                        <option value="c-1">2016</option>
                                                        <option value="c-2">2015</option>
                                                        <option value="c-3">2014</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <button class="submit-btn-1 mt-20 btn-hover-1" type="submit"
                                                        value="register">Thanh toán ngay</button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="submit-btn-1 mt-20 btn-hover-1" type="submit"
                                                        value="register">Hủy đơn hàng</button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="submit-btn-1 mt-20 f-right btn-hover-1"
                                                        type="submit" value="register">Tiếp tục</button>
                                                </div>
                                            </div>
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
@include('layout_user.footer')
