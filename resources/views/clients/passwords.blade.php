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
                                    <form action="{{route('password.email')}}" method="POST">
                                        @csrf
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
                                        <h3 class="fw-normal mb-3" style="letter-spacing: 1px;">Quên mật khẩu</h3>
                                        <div data-mdb-input-init class="input-group form-outline mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="email" id="form2Example17" name="email" class="form-control form-control-lg" placeholder="Email khôi phục mật khẩu" />
                                        </div>
                                        @error('email')
                                        <div class="error-message">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                        <div class="pt-1 mb-3">
                                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit">Gửi mã xác nhận</button>
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
