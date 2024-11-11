<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('admin/img/icon/favicon.png') }}" type="image/png">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('admin') }}/css/style-admin-2.css" rel="stylesheet">
</head>
<body class="background-banner">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center" style="height:100vh;">
            <div class="col-6">
                <div class="card border-0">
                    <div class="card-body p-0">
                        <div class="row d-flex justify-content-center">
                            <div class="col-8">
                                <div class="py-5 px-3">
                                    <div class="text-center">
                                        <img class="img-fluid mb-3" src="{{ asset('admin/img/logo.png') }}" alt="">
                                        <h1 class="h4 text-gray-900 mb-4">Đăng nhập Admin</h1>
                                    </div>
                                    <form class="user" action="{{ route('admin.postLogin') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user mb-1" name="email"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Nhập email..." value="{{ old('email') }}" >
                                            @error('email')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password"
                                                id="exampleInputPassword" placeholder="Password">
                                            @error('password')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Đăng nhập
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('admin.layout.toast')
</html>