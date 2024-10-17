@include('layout_user.menu')
<!-- BREADCRUMBS SETCTION START -->
<div class="breadcrumbs-section plr-200 mb-80">
    <div class="breadcrumbs overlay-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-inner">
                        <h1 class="breadcrumbs-title">Login / Register</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="index.html">Home</a></li>
                            <li>Login / Register</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMBS SETCTION END -->

<!-- Start page content -->
<div id="page-content" class="page-wrapper">

    <!-- PHẦN ĐĂNG NHẬP BẮT ĐẦU -->
    <div class="login-section mb-80">
        <div class="container">
            <div class="row justify-content-center" style="display: flex; justify-content: center; align-items: center;">
                <!-- khách hàng mới -->
                <div class="col-md-6">
                    <div class="new-customers">
                        <form method="POST" action="{{ route('register') }}">
                            <h6 class="widget-title border-left mb-50">Tạo Tài Khoản</h6>
                            <div class="login-account p-30 box-shadow">
                                @csrf
                                <input type="text" name="name" placeholder="Họ và tên" value="{{ old('name') }}">

                                <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>

                                <input type="password" name="password" placeholder="Mật khẩu" required>

                                <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" required>

                                <input type="text" name="phone_number" placeholder="Số điện thoại" value="{{ old('phone_number') }}">

                                <textarea name="address" placeholder="Địa chỉ">{{ old('address') }}</textarea>

                                <select name="gender">
                                    <option value="" disabled selected>Chọn giới tính</option>
                                    <option value="male">Nam</option>
                                    <option value="female">Nữ</option>
                                    <option value="other">Khác</option>
                                </select>

                                <input type="date" name="birthday" placeholder="Ngày sinh" value="{{ old('birthday') }}">
                                <p><small><a href="/login">Đã có tài khoản</a></small></p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="submit-btn-1 mt-20 btn-hover-1" type="submit">Đăng ký</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="submit-btn-1 mt-20 btn-hover-1 f-right"
                                            type="reset">Xóa</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PHẦN ĐĂNG NHẬP KẾT THÚC -->

</div>
@include('layout_user.footer')
