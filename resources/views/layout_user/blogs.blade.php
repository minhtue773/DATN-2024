@include('layout_user.menu')
<!-- BREADCRUMBS SETCTION START -->
<div class="breadcrumbs-section plr-200 mb-80">
    <div class="breadcrumbs overlay-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-inner">
                        <h1 class="breadcrumbs-title">Bài viết</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="/">Trang Chủ</a></li>
                            <li>Bài viết</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMBS SETCTION END -->

<!-- Start page content -->
<div id="page-content" class="page-wrapper">

    <!-- BLOG SECTION START -->
    <div class="blog-section mb-50">
        <div class="container">
            <div class="row">
                <!-- blog-option start -->
                <div class="col-md-12">
                    <div class="blog-option box-shadow mb-30  clearfix">
                        <!-- categories -->
                        <div class="dropdown f-left">
                            <button class="option-btn">
                                Danh mục
                                <i class="zmdi zmdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu dropdown-width mt-30">
                                <aside class="widget widget-categories box-shadow">
                                    <div id="cat-treeview" class="product-cat">
                                        <ul>
                                            <li class="closed"><a href="/blogs">Tất cả</a>
                                            </li>
                                            @foreach ($post_cate_arr as $post_cate)
                                                <li class="closed"><a
                                                        href="{{ route('blogs', ['idCataPost' => $post_cate->id]) }}">{{$post_cate->name}}</a>
                                                </li>
                                            @endforeach
                                            <!-- <li class="open"><a href="#">Mô hình máy bay</a>
                                                <ul>
                                                    <li><a href="#">Mô hình máy bay thương mại</a></li>
                                                    <li><a href="#">Mô hình máy bay quân sự</a></li>
                                                    <li><a href="#">Mô hình trực thăng</a></li>
                                                </ul>
                                            </li> -->
                                        </ul>
                                    </div>
                                </aside>
                            </div>
                        </div>
                        <!-- recent-product -->
                        <div class="dropdown f-left">
                            <button class="option-btn">
                                Bài viết gần đây
                                <i class="zmdi zmdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu dropdown-width mt-30">
                                <aside class="widget widget-product box-shadow">
                                    <h6 class="widget-title border-left mb-20">sản phẩm gần đây</h6>
                                    <!-- sản phẩm-item bắt đầu -->
                                    <div class="product-item">
                                        <div class="product-img">
                                            <a href="single-product.html">
                                                <img src="img/cart/4.jpg" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="product-title multi-line mt-10">
                                                <a href="single-product.html">Tên Blog Giả</a>
                                            </h6>
                                        </div>
                                    </div>
                                    <!-- sản phẩm-item kết thúc -->
                                    <!-- sản phẩm-item bắt đầu -->
                                    <div class="product-item">
                                        <div class="product-img">
                                            <a href="single-product.html">
                                                <img src="img/cart/5.jpg" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="product-title multi-line mt-10">
                                                <a href="single-product.html">Tên Blog Giả</a>
                                            </h6>
                                        </div>
                                    </div>
                                    <!-- sản phẩm-item kết thúc -->
                                    <!-- sản phẩm-item bắt đầu -->
                                    <div class="product-item">
                                        <div class="product-img">
                                            <a href="single-product.html">
                                                <img src="img/cart/6.jpg" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="product-title multi-line mt-10">
                                                <a href="single-product.html">Tên Blog Giả</a>
                                            </h6>
                                        </div>
                                    </div>
                                    <!-- sản phẩm-item kết thúc -->
                                </aside>
                            </div>
                        </div>
                        <!-- Tags -->
                        <div class="dropdown f-left">
                            <button class="option-btn">
                                Thẻ
                                <i class="zmdi zmdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu dropdown-width mt-30">
                                <aside class="widget widget-tags box-shadow">
                                    <h6 class="widget-title border-left mb-20">Thẻ</h6>
                                    <ul class="widget-tags-list">
                                        <li><a href="#">Bleckgerry ios</a></li>
                                        <li><a href="#">Symban</a></li>
                                        <li><a href="#">IOS</a></li>
                                        <li><a href="#">Bleckgerry</a></li>
                                        <li><a href="#">Windows Phone</a></li>
                                        <li><a href="#">Windows Phone</a></li>
                                        <li><a href="#">Androids</a></li>
                                    </ul>
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- blog-option end -->
            </div>
            <div class="row">
                <!-- blog-item start -->
                @yield('blogs')
                <!-- blog-item end -->
                <!-- shop-pagination start -->

                <!-- shop-pagination end -->
            </div>
            <ul class="shop-pagination box-shadow text-center ptblr-10-30">
                {{ $posts->links('vendor.pagination.custom-pagination') }}
            </ul>
        </div>
    </div>
    <!-- BLOG SECTION END -->
</div>
<!-- End page content -->
@include('layout_user.footer')