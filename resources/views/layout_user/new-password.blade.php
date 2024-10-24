@include('layout_user.menu')

<!-- BREADCRUMBS SETCTION START -->
<div class="breadcrumbs-section plr-200 mb-80">
    <div class="breadcrumbs overlay-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-inner">
                        <h1 class="breadcrumbs-title">Forgot Password</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="/">Home</a></li>
                            <li>Forgot Password</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="page-content" class="page-wrapper">


    <div class="login-section mb-80">
        <div class="container">
            <div class="row" style="display: flex; justify-content: center; align-items: center;">
                @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <div class="col-md-6">
                    <div class="registered-customers">
                        <h2>Đặt lại mật khẩu</h2>
                        <form action="{{ route('reset.password.post') }}" method="POST">
                            @csrf
                            <input type="text" name="token" hidden value="{{ $token }}">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Nhập mật khẩu mới</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Nhập lại mật khẩu mới</label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                            </div>
                            <button type="submit" class="btn submit-btn-1 btn-hover-1">Đặt lại mật khẩu</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@include('layout_user.footer')
