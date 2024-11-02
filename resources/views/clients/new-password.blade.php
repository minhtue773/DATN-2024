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
    <title>Đăng ký</title>
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
                    <h3>Sign In</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <span><i class="fab fa-facebook-square"></i></span>
                        <span><i class="fab fa-google-plus-square"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('reset.password.post') }}" method="POST">
                        @csrf
                        <input type="text" name="token" hidden value="{{ $token }}">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="Email đăng ký">

                        </div>
                        @error('email')
                        <div class="error-message">
                            {{$message}}
                        </div>
                        @enderror
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu">
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="togglePassword('password', 'eyeIcon1')">
                                    <i id="eyeIcon1" class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        @error('password')
                        <div class="error-message">
                            {{$message}}
                        </div>
                        @enderror
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu">
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="togglePassword('password_confirmation', 'eyeIcon2')">
                                    <i id="eyeIcon2" class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        @error('password_confirmation')
                        <div class="error-message">
                            {{$message}}
                        </div>
                        @enderror
                        <div class="form-group">
                            <button type="submit" class="btn float-right login_btn">Đặt lại mật khẩu</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</body>

</html>
<script>
    function togglePassword(fieldId, eyeIconId) {
        const passwordField = document.getElementById(fieldId);
        const eyeIcon = document.getElementById(eyeIconId);

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
