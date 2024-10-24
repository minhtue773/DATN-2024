<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Hobby Zone</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/icon/favicon.png') }}">


    <!-- All CSS Files -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/css/nivo-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shortcode/shortcodes.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/color/color-core.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
</head>

<body ng-app="myApp">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Body main wrapper start -->
    <div class="wrapper" ng-controller="mainController">

        <!-- START HEADER AREA -->
        <header class="header-area header-wrapper">
            <!-- Thanh trên cùng của tiêu đề -->
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
                                        <a href="/my_account">
                                            <i class="zmdi zmdi-account"></i>
                                            {{Auth::user()->name}}
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
                                            <i class="zmdi zmdi-lock-open"></i>
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
            <!-- Khu vực giữa của tiêu đề -->
            <div id="sticky-header" class="header-middle-area plr-185">
                <div class="container-fluid">
                    <div class="full-width-mega-dropdown">
                        <div class="row">
                            <!-- logo -->
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <div class="logo">
                                    <a href="index.html">
                                        <img style="height: 32px; width: 191px;" src="{{ asset('img/logo/logo.png') }}"
                                            alt="logo chính">

                                    </a>
                                </div>
                            </div>
                            <!-- Menu chính -->
                            <div class="col-md-8 hidden-sm hidden-xs">
                                <nav id="primary-menu">
                                    <ul class="main-menu text-center">
                                        <li><a href="/"><i class="fas fa-home"></i> Trang chủ</a></li>
                                        <li class="mega-parent">
                                            <a href="/products"><i class="fas fa-box"></i> Mô hình</a>
                                            <div class="mega-menu-area clearfix">
                                                <div class="mega-menu-link f-left">
                                                    @foreach($categories as $category)
                                                    <ul class="single-mega-item">
                                                        <li><a href="#">{{ $category->name }}</a></li>


                                                    </ul>
                                                    @endforeach
                                                </div>
                                                <div class="mega-menu-photo f-left">
                                                    <a href="/">
                                                        <img src="{{ asset('img/icon/favicon.png') }}" alt="hình ảnh mega menu">
                                                    </a>
                                                </div>
                                            </div>
                                        </li>

                                        <li><a href="/blogs"><i class="fas fa-blog"></i> Bài viết</a>
                                            <ul class="dropdwn">
                                                @foreach($categoriespost as $postCategory)
                                                <li>
                                                    <a href="{{ route('blogs', ['idCataPost' =>  $postCategory->id]) }}">{{ $postCategory->name }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="/about"><i class="fas fa-info-circle"></i> Giới thiệu</a></li>
                                        <li><a href="/contact"><i class="fas fa-envelope"></i> Liên hệ</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- Tìm kiếm và giỏ hàng -->
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <div class="search-top-cart f-right">
                                    <!-- Tìm kiếm -->
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
                                    <!-- Giỏ hàng -->
                                    <div class="total-cart f-left">
                                        <div class="total-cart-in">
                                            <div class="cart-toggler">
                                                <a href="/cart">
                                                    <span class="cart-quantity">[ %% countTotalProducts() %%
                                                        ]</span><br>
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
                                                        <!-- Sản phẩm trong giỏ -->
                                                        <div class="single-cart clearfix" ng-repeat="sp in cart">
                                                            <div class="cart-img f-left" style="width: 30%;">
                                                                <a href="/product/%% sp.id %%">
                                                                    <img ng-src="{{ asset('%% sp.hinh %%') }}"
                                                                        alt="Mô hình đồ chơi trong giỏ" style="width: 100%;">
                                                                </a>
                                                                <div class="del-icon">
                                                                    <a href="javascript:void(0)" ng-click="removeFromCart($index)">
                                                                        <i class="zmdi zmdi-close"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="cart-info f-left">
                                                                <h6 class="text-capitalize">
                                                                    <a href="/product/%% sp.id %%"> %% sp.name %%</a>
                                                                </h6>
                                                                <p><span>Thương hiệu <strong>:</strong></span>%% sp.category_name %%
                                                                </p>

                                                            </div>
                                                        </div>
                                                        <!-- Sản phẩm trong giỏ -->
                                                        {{-- <div class="single-cart clearfix">
                                                            <div class="cart-img f-left">
                                                                <a href="#">
                                                                    <img src="img/cart/2.jpg"
                                                                        alt="Mô hình Gundam trong giỏ">
                                                                </a>
                                                                <div class="del-icon">
                                                                    <a href="#">
                                                                        <i class="zmdi zmdi-close"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="cart-info f-left">
                                                                <h6 class="text-capitalize">
                                                                    <a href="#">Gundam RX-78-2</a>
                                                                </h6>
                                                                <p><span>Thương hiệu <strong>:</strong></span> Bandai
                                                                </p>
                                                                <p><span>Loại <strong>:</strong></span> High Grade 1:144
                                                                </p>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="top-cart-inner subtotal">
                                                        <h4 class="text-uppercase gill">Tổng phụ :</h4>
                                                        <h4 class="text-uppercase gill">Tổng cộng : %% totalCartMoney()|customNumber:0 %% đ</h4>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="top-cart-inner view-cart">
                                                        <h6>
                                                            <a href="/cart">Xem giỏ hàng</a>
                                                        </h6>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="top-cart-inner check-out">
                                                        <h6>
                                                            <a href="#">Thanh toán</a>
                                                        </h6>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hết tìm kiếm và giỏ hàng -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hết khu vực giữa của tiêu đề -->
        </header>
        <!-- END HEADER AREA -->

        <!-- START MOBILE MENU AREA -->
        <div class="mobile-menu-area hidden-lg hidden-md">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="mobile-menu">
                            <nav id="dropdown">
                                <ul>
                                    <li><a href="index.html">Trang Chủ</a>
                                    </li>
                                    <li>
                                        <a href="/products">Sản Phẩm</a>
                                    </li>
                                    <li><a href="blog.html">Blog</a>
                                        <ul>
                                            <li>
                                                <a href="blog.html">Blog</a>
                                            </li>
                                            <li>
                                                <a href="blog-left-sidebar.html">Blog Thanh Bên Trái</a>
                                            </li>
                                            <li>
                                                <a href="blog-right-sidebar.html">Blog Thanh Bên Phải</a>
                                            </li>
                                            <li>
                                                <a href="blog-2.html">Blog Kiểu 2</a>
                                            </li>
                                            <li>
                                                <a href="blog-2-left-sidebar.html">Blog 2 Thanh Bên Trái</a>
                                            </li>
                                            <li>
                                                <a href="blog-2-right-sidebar.html">Blog 2 Thanh Bên Phải</a>
                                            </li>
                                            <li>
                                                <a href="single-blog.html">Chi Tiết Blog</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="about.html">Về Chúng Tôi</a>
                                    </li>
                                    <li>
                                        <a href="contact.html">Liên Hệ</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>