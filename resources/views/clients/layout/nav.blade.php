<!-- Navbar Start -->
<div class="container-fluid">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0 text-white">DANH MỤC</h6>
                <i class="fa fa-angle-down text-white"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light"
                id="navbar-vertical" style="width: calc(100% - 30px); z-index: 69;">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">

                    @foreach ($categories as $category)
                    <div class="category-item">
                        <a href="{{ route('products.index', ['category_id' => $category->id, 'sort_by' => request('sort_by')]) }}"
                            class="nav-item nav-link">
                            {{ $category->name }} ({{ $category->products->count() }})
                        </a>
                    </div>
                    @endforeach
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <div class="d-flex align-items-center">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <img src="{{ asset('uploads/images/logo/' . $settingsArray['img_logo']['setting_value']) }}" alt="" class="img-fluid w-50">
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="/" class="nav-item nav-link {{ $index1 == 1 ? 'active' : '' }}">Trang chủ</a>
                        <a href="/products" class="nav-item nav-link {{ $index1 == 2 ? 'active' : '' }}">Cửa hàng</a>

                        <a href="/posts" class="nav-link {{ $index1 == 3 ? 'active' : '' }}">Bài viết</a>


                        <a href="{{ route('about') }}" class="nav-item nav-link {{ $index1 == 4 ? 'active' : '' }}">Giới
                            thiệu</a>
                        <a href="{{ route('contact.index') }}"
                            class="nav-item nav-link {{ $index1 == 5 ? 'active' : '' }}">Liên hệ</a>

                    </div>
                    @if (Auth::check())
                    <div class="navbar-nav ml-auto py-0">
                        <a href="{{ route('my_account') }}"
                            class="nav-item nav-link {{ $index1 == 0 ? 'active' : '' }}"><i
                                class="zmdi zmdi-lock"></i>
                            <i class="zmdi zmdi-account"></i>
                            {{ Auth::user()->name }}</a>
                        <a href="/logout" class="nav-item nav-link"><i class="zmdi zmdi-account-add"></i>
                            <i class="zmdi zmdi-lock-open"></i>
                            Đăng xuất</a>
                    </div>
                    @else
                    <div class="navbar-nav ml-auto py-0">
                        <a href="{{ route('login') }}" class="nav-item nav-link"><i class="zmdi zmdi-lock"></i>
                            Login</a>
                        <a href="{{ route('register') }}" class="nav-item nav-link"><i
                                class="zmdi zmdi-account-add"></i>
                            Register</a>
                    </div>
                    @endif


                </div>
            </nav>
        </div>
    </div>
</div>
