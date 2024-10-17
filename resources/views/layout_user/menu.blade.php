<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Hobby Zone</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/icon/favicon.png') }}">

    <!-- All CSS Files -->
    <!-- Bootstrap framework main css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/css/nivo-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shortcode/shortcodes.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/color/color-core.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <!-- Font Awesome and AngularJS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
</head>

<body>

    <!-- Body main wrapper start -->
    <div class="wrapper">

        <!-- START HEADER AREA -->
        <header class="header-area header-wrapper">
            <div class="header-top-bar plr-185">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 hidden-xs">
                            <div class="call-us">
                                <p class="mb-0 roboto">(+84) 396-121-783</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="top-link clearfix">
                                <ul class="link f-right">
                                    @if(Auth::check())
                                        <li>
                                            <a href="my-account.html">
                                                <i class="zmdi zmdi-account"></i>
                                                {{ Auth::user()->name }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="wishlist.html">
                                                <i class="zmdi zmdi-favorite"></i>
                                                Danh sách yêu thích (0)
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/logout">
                                                <i class="bi bi-box-arrow-right"></i>
                                                Đăng xuất
                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="wishlist.html">
                                                <i class="zmdi zmdi-favorite"></i>
                                                Danh sách yêu thích (0)
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('login') }}">
                                                <i class="zmdi zmdi-lock"></i>
                                                Đăng nhập
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('register') }}">
                                                <i class="zmdi zmdi-account-add"></i>
                                                Đăng ký
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="sticky-header" class="header-middle-area plr-185">
                <div class="container-fluid">
                    <div class="full-width-mega-dropdown">
                        <div class="row">
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <div class="logo">
                                    <a href="/">
                                        <img style="height: 32px; width: 191px;" src="{{ asset('img/logo/logo.png') }}"
                                            alt="logo chính">
                                    </a>
                                </div>
                            </div>

                            <!-- Main Menu -->
                            <div class="col-md-8 hidden-sm hidden-xs">
                                <nav id="primary-menu">
                                    <ul class="main-menu text-center">
                                        <li><a href="/"><i class="fas fa-home"></i> Trang chủ</a></li>
                                        <li class="mega-parent">
                                            <a href="/products"><i class="fas fa-box"></i> Mô hình</a>
                                            <div class="mega-menu-area clearfix">
                                                <div class="mega-menu-link f-left">
                                                    <ul class="single-mega-item">
                                                        <li class="menu-title">Mô hình tĩnh</li>
                                                        <li><a href="#">Mô hình xe cộ</a></li>
                                                        <li><a href="#">Mô hình quân sự</a></li>
                                                        <li><a href="#">Mô hình máy bay</a></li>
                                                        <li><a href="#">Mô hình tàu thuyền</a></li>
                                                        <li><a href="#">Mô hình nhân vật</a></li>
                                                    </ul>
                                                    <ul class="single-mega-item">
                                                        <li class="menu-title">Mô hình lắp ráp</li>
                                                        <li><a href="#">Gundam</a></li>
                                                        <li><a href="#">Mô hình máy bay lắp ráp</a></li>
                                                        <li><a href="#">Mô hình xe lắp ráp</a></li>
                                                        <li><a href="#">Phụ kiện mô hình</a></li>
                                                    </ul>
                                                    <ul class="single-mega-item">
                                                        <li class="menu-title">Dụng cụ và vật liệu</li>
                                                        <li><a href="#">Keo dán</a></li>
                                                        <li><a href="#">Màu sơn</a></li>
                                                        <li><a href="#">Dụng cụ cắt gọt</a></li>
                                                        <li><a href="#">Bàn làm mô hình</a></li>
                                                    </ul>
                                                </div>
                                                <div class="mega-menu-photo f-left">
                                                    <a href="/">
                                                        <img src="{{ asset('img/icon/favicon.png') }}"
                                                            alt="hình ảnh mega menu">
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li><a href="blog.html"><i class="fas fa-blog"></i> Blog</a>
                                            <ul class="dropdwn">
                                                <li><a href="blog-left-sidebar.html">Tin tức mô hình</a></li>
                                                <li><a href="blog-right-sidebar.html">Hướng dẫn lắp ráp</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="about.html"><i class="fas fa-info-circle"></i> Giới thiệu</a></li>
                                        <li><a href="contact.html"><i class="fas fa-envelope"></i> Liên hệ</a></li>
                                    </ul>
                                </nav>
                            </div>

                            <!-- Search and Cart -->
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <div class="search-top-cart f-right">
                                    <!-- Search -->
                                    <div class="header-search f-left">
                                        <div class="header-search-inner">
                                            <button class="search-toggle">
                                                <i class="zmdi zmdi-search"></i>
                                            </button>
                                            <form action="{{ route('products.index') }}" method="GET">
                                                <div class="top-search-box">
                                                    <input type="text" name="search" placeholder="Tìm kiếm mô hình..."
                                                        value="{{ request('search') }}">
                                                    <button type="submit">
                                                        <i class="zmdi zmdi-search"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Cart -->
                                    <div class="total-cart f-left">
                                        <div class="total-cart-in">
                                            <div class="cart-toggler">
                                                <a href="#">
                                                    <span class="cart-quantity">02</span><br>
                                                    <span class="cart-icon">
                                                        <i class="zmdi zmdi-shopping-cart-plus"></i>
                                                    </span>
                                                </a>
                                            </div>
                                            <ul>
                                                <li>
                                                    <div class="top-cart-inner your-cart">
                                                        <h5 class="text-capitalize">Giỏ hàng</h5>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="total-cart-pro">
                                                        <div class="single-cart clearfix">
                                                            <div class="cart-img f-left">
                                                                <a href="#">
                                                                    <img src="{{ asset('img/cart/1.jpg') }}"
                                                                        alt="Mô hình xe cộ trong giỏ hàng">
                                                                </a>
                                                                <div class="del-icon">
                                                                    <a href="#">
                                                                        <i class="zmdi zmdi-close"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="cart-info f-left">
                                                                <h6><a href="#">Mô hình xe cộ</a></h6>
                                                                <p>1x - <span class="price">230.000 đ</span></p>
                                                            </div>
                                                        </div>
                                                        <div class="single-cart clearfix">
                                                            <div class="cart-img f-left">
                                                                <a href="#">
                                                                    <img src="{{ asset('img/cart/2.jpg') }}"
                                                                        alt="Mô hình quân sự trong giỏ hàng">
                                                                </a>
                                                                <div class="del-icon">
                                                                    <a href="#">
                                                                        <i class="zmdi zmdi-close"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="cart-info f-left">
                                                                <h6><a href="#">Mô hình quân sự</a></h6>
                                                                <p>1x - <span class="price">210.000 đ</span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="top-cart-inner subtotal">
                                                        <h5 class="text-uppercase">Tổng tiền = 440.000 đ</h5>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="top-cart-inner view-cart">
                                                        <h5 class="text-uppercase">
                                                            <a href="/cart">Xem giỏ hàng</a>
                                                        </h5>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="top-cart-inner check-out">
                                                        <h5 class="text-uppercase">
                                                            <a href="/checkout">Thanh toán</a>
                                                        </h5>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Cart -->
                        </div>
                    </div>
                </div>
            </div>
        </header>