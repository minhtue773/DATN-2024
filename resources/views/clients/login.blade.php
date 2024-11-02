<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head>
    <title>Đăng nhập</title>
    <!--Made with love by Mutiullah Samim -->

    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('client/img/icon/favicon.png')}}">
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="{{asset('client/css/login.css')}}">
</head>

<body>
    <div id="" class="header-middle-area plr-185" style="background-color:white; position: fixed;top: 0;width: 100%;">
        <div class="container-fluid">
            <div class="full-width-mega-dropdown">

                <div class="row">

                    <!-- logo -->
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="logo " style="height: 75px;">
                            <a href="/">
                                <img style="height: 32px; width: 191px;" src="img/logo/logo.png" alt="logo chính">
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Đăng nhập</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <span><a href="{{ route('auth.facebook') }}" style="color:#a0ffe5;"><i class="fab fa-facebook-square"></i></a></span>
                        <span><a href="{{ url('auth/google') }}" style="color:#a0ffe5;"><i class="fab fa-google-plus-square"></i></a></span>
                        <!-- <span><i class="fab fa-twitter-square"></i></span> -->
                    </div>
                </div>
                <div class="card-body">
                    @if ($message= Session::get('error'))
                    <div class="alert alert-danger alert-block">
                            {{$message}}
                    </div>
                    @endif
                    <form method="POST" action="{{route('login')}}">
                        @csrf
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="Tài khoản email">

                        </div>
                        @error('email')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu">
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="togglePassword()">
                                    <i id="eyeIcon" class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        @error('password')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="row align-items-center remember">
                            <input type="checkbox" name="remember" id="remember">Ghi nhớ đăng nhập
                        </div>
                        <div class=" form-group">
                            <a href="{{route('forgot-password')}}" style="color:#ffea00; font-size:1em; text-decoration:none;">Quên mật khẩu?</a>
                        </div>
                        <button type="submit" class="btn float-right login_btn">Đăng nhập</button>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Tạo tài khoản?<a href="{{route('register')}}" style="color:#ffea00; font-size:1em; text-decoration:none;">Đăng ký</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const eyeIcon = document.getElementById("eyeIcon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash"); // Đổi biểu tượng sang "ẩn mật khẩu"
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye"); // Đổi biểu tượng về "hiển thị mật khẩu"
        }
    }
</script>
