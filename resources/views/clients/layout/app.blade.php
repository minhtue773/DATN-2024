<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('uploads/favicon/favicon.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('uploads/favicon/favicon.ico') }}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('client') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('client/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('client/css/blog.css') }}" rel="stylesheet">

</head>

<body ng-app="myApp">
    <div class="containers" ng-controller="mainController">
        @php
        // Chuyển đổi $websiteSettings thành một mảng cho dễ sử dụng
        $settingsArray = $websiteSettings->keyBy('setting_key')->toArray();
        @endphp
        <!-- Topbar Start -->
        <div class="container-fluid">
            <div class="row bg-secondary py-2 px-xl-5">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-dark mr-3" href=""><i class="fa fa-phone mr-2"></i> {{ $settingsArray['phone']['setting_value'] ?? '+012 345 67890' }}</a>
                        <a class="text-dark" href=""><i class="fas fa-envelope mr-2"></i> {{ $settingsArray['email']['setting_value'] ?? '+012 345 67890' }}</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-dark px-2" href="{{ $settingsArray['facebook']['setting_value'] ?? '/'}} ">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="{{ $settingsArray['twitter']['setting_value'] ?? '/'}}">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="{{ $settingsArray['linkedin']['setting_value'] ?? '/'}}">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="{{ $settingsArray['instagram']['setting_value'] ?? '/'}}">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-dark pl-2" href="{{ $settingsArray['youtube']['setting_value'] ?? '/'}}">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center py-3 px-xl-5">
                <div class="col-lg-3 d-none d-flex">
                    <a href="/" class="text-decoration-none text-center">
                        <img src="{{ asset('client/img/logo/logo.png') }}" alt="Logo" class="img-fluid w-75">
                    </a>
                </div>

                <div class="col-lg-6 col-6 text-left">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm sản phẩm" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-6 text-right">
                    <a href="/" class="btn border">
                        <i class="fas fa-heart text-primary"></i>
                        <span class="badge">{{ $favoriteCount }}</span> <!-- Hiển thị số lượng sản phẩm yêu thích -->
                    </a>
                    <a href="/cart" class="btn border">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        <span ng-cloak class="badge">%% countTotalProducts() %%</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Topbar End -->
        @include('clients.layout.nav')
        @yield('content')
        @include('clients.layout.footer')