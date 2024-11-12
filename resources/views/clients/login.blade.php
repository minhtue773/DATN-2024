<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('client/css/login.css')}}"> -->
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
                                <img src="{{ asset('uploads/images/transformer.png') }}"
                                    alt="login form" class="img-fluid h-100 w-100" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    @if ($message= Session::get('error'))
                                    <div class="alert alert-danger alert-block">
                                        {{$message}}
                                    </div>
                                    @endif
                                    <form action="{{route('login')}}" method="POST">
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
                                        <h5 class="fw-normal mb-3" style="letter-spacing: 1px;">Đăng nhập vào tài khoản</h5>
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
                                        <div class="form-outline mb-3 remember">
                                            <input type="checkbox" name="remember" id="remember">Ghi nhớ đăng nhập
                                        </div>
                                        <div class="pt-1 mb-3">
                                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit">Đăng nhập</button>
                                        </div>

                                        <a class="small text-muted mb-2" href="{{route('forgot-password')}}">Quên mật khẩu?</a>
                                        <p class="mb-3 pb-lg-2" style="color: #393f81;">Chưa có tài khoản? <a href="{{route('register')}}"
                                                style="color: #393f81;">Đăng ký ngay</a></p>

                                        <a href="{{ url('auth/google') }}" class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;color:#ffff;text-decoration:none;"><i class="fab fa-google me-2"></i> Đăng nhập bằng google</a>

                                        <a href="{{ url('auth/facebook') }}" class="btn btn-lg btn-block btn-primary " style="color:#ffff;text-decoration:none;background-color: #3b5998;"><i class="fab fa-facebook-f me-2"></i> Đăng nhập bằng facebook</a>

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
<script>
     @if (Session::has('success'))
         Swal.fire('Thành công!', '{{ Session::get('success') }}', 'success');
     @elseif (Session::has('error'))
         Swal.fire('Lỗi!', '{{ Session::get('error') }}', 'error');
     @elseif (Session::has('qes'))
     Swal.fire({
         icon: "question",
         title: "Bạn chưa đăng nhập!!!",
         showConfirmButton: false,
         html: '<a href="{{ route('login') }}">Đăng nhập ngay?</a>',
     });
     @endif
 </script>
