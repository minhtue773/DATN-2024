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
            <div class="roư" style="display: flex; justify-content: center; align-items: center;">
                <div class="col-md-6">
                    <div class="registered-customers">
                        <h6 class="widget-title border-left mb-50">ĐÃ ĐĂNG KÝ</h6>
                        @if ($message= Session::get('error'))
                        <div class="alert alert-dangers alert-block">
                            <button type="button" class="close" data-dismiss="alert">
                                <strong>{{$message}}</strong>
                            </button>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf



                            <div class="login-account p-30 box-shadow">
                                <p>Nếu bạn đã có tài khoản với chúng tôi, vui lòng đăng nhập.</p>
                                <input type="text" name="email" placeholder="Địa chỉ Email" required>
                                <input type="password" name="password" placeholder="Mật khẩu" required>
                                <p><small><a href="#">Quên mật khẩu của bạn?</a></small></p>
                                <p><small><a href="/register">Tạo tài khoản</a></small></p>
                                <button class="submit-btn-1 btn-hover-1" type="submit">Đăng nhập</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- khách hàng mới -->

            </div>
        </div>
    </div>
    <!-- PHẦN ĐĂNG NHẬP KẾT THÚC -->

</div>
@include('layout_user.footer')
