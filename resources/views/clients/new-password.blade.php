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
    <title>Đặt lại mật khẩu mới</title>
    <!--Made with love by Mutiullah Samim -->

    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('client/img/icon/favicon.png')}}">
    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->

</head>

<body>
    @php
    // Chuyển đổi $websiteSettings thành một mảng cho dễ sử dụng
    $settingsArray = $websiteSettings->keyBy('setting_key')->toArray();
    @endphp
    <section class="d-flex justify-content-center align-items-center" style="background: linear-gradient(135deg, #f5f5f5, #8f8b95);height: 100%;">
        <div class="container ">
            <div class="row d-flex justify-content-center align-items-center ">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="{{asset('uploads/images/transformer.png')}}"
                                    alt="login form" class="img-fluid h-100 w-100" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    @if ($message= Session::get('error'))
                                    <div class="alert alert-danger alert-block">
                                        {{$message}}
                                    </div>
                                    @endif
                                    <form action="{{route('reset.password.post')}}" method="POST">
                                        @csrf
                                        <input type="text" name="token" hidden value="{{ $token }}">
                                        <div class="d-flex justify-content-center align-items-center mb-2">
                                            <div class="row">

                                                <!-- logo -->
                                                <div class="col-md-2 col-sm-6 col-xs-12">
                                                    <div class="logo ">
                                                        <a href="/">
                                                            <img style="height: 52px; width: 270px;" src="{{ asset('uploads/images/logo/' . $settingsArray['img_logo']['setting_value']) }}" alt="logo chính">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="fw-normal mb-3" style="letter-spacing: 1px;">Khôi phục mật khẩu tài khoản</h3>
                                        <div data-mdb-input-init class="input-group form-outline mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="email" id="form2Example17" name="email" class="form-control form-control-lg" placeholder="Email tài khoản" />
                                        </div>
                                        @error('email')
                                        <div class="error-message">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div data-mdb-input-init class="input-group mb-3 form-outline ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Mật khẩu" />
                                            <div class="input-group-append">
                                                <span class="input-group-text" onclick="togglePassword('password', 'eyeIcon1')">
                                                    <i id="eyeIcon1" class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                        @error('password')
                                        <div class="error-message">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div data-mdb-input-init class="input-group mb-3 form-outline ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg" placeholder="Xác nhận mật khẩu" />
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

                                        <div class="pt-1 mb-3">
                                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit">Đặt lại mật khẩu</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
