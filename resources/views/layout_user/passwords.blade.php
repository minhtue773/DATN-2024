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
                @if ($errors->any())
                <div class="col-12">
                    @foreach ($errors->all() as $error )
                    <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                </div>
                @endif

                @if (session()->has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
                @endif

                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="col-md-6">
                    <div class="registered-customers">
                        <h2>Quên mật khẩu</h2>

                        <form action="{{ route('password.email') }}" method="POST">
                            <p>Chúng tôi sẽ gửi link đến email của bạn, sử dụng link đó để đặt lại mật khẩu</p>
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" required>
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
