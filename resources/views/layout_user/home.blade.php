@include('layout_user.menu')
<div class="slider-area bg-3 bg-opacity-black-60 ptb-150 mb-80">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="slider-desc-3 slider-desc-4 text-center">
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                        <h1 class="slider2-title-2 cd-headline clip is-full-width">

                            <span class="cd-words-wrapper">
                                <b class="is-visible">Mô hình xe hơi</b>
                                <b>Mô hình máy bay</b>
                                <b>Mô hình tàu thủy</b>
                                <b>Mô hình nhân vật</b>
                                <b>Mô hình kiến trúc</b>
                            </span>
                        </h1>
                    </div>
                    <div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.5s">
                        <h2 class="slider2-title-3">Mô hình xe hơi thể thao</h2>
                    </div>
                    <div class="slider-button wow fadeInUp" data-wow-duration="1s" data-wow-delay="2.5s">
                        <a href="#" class="button extra-small button-white">
                            <span class="text-uppercase">Xem thêm</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SLIDER AREA -->

<!-- Start page content -->
<section id="page-content" class="page-wrapper">

    <!-- UP COMMING PRODUCT SECTION START -->
    <div class="up-comming-product-section mb-80">
        @yield('sanpham_discount')
    </div>
    <!-- UP COMMING PRODUCT SECTION END -->

    <!-- BY BRAND SECTION START-->
    <div class="by-brand-section mb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-left ">
                        <h2 class="uppercase">Danh Mục Sản Phẩm</h2>
                        <h6 class="mb-40"></h6>
                    </div>
                </div>
            </div>
            <div class="by-brand-product">
                <div class="row active-by-brand slick-arrow-2">
                    @yield('categories')

                </div>
            </div>
        </div>
    </div>
    <!-- BY BRAND SECTION END -->

    <!-- FEATURED PRODUCT SECTION START -->
    <div class="featured-product-section mb-50">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-left mb-40">
                        <h2 class="uppercase">Featured product</h2>
                        <h6>There are many variations of passages of brands available,</h6>
                    </div>
                </div>
            </div>
            <div class="featured-product">
                <div class="row active-featured-product slick-arrow-2">
                    @yield('products')

                </div>
            </div>
        </div>
    </div>
    <!-- FEATURED PRODUCT SECTION END -->

    <!-- BLOG SECTION START -->
    <div class="blog-section mb-50">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-left mb-40">
                        <h2 class="uppercase">Tin Tức Mới</h2>
                        <h6>Theo dõi các sự kiện mô hình lớn trong nước và quốc tế.</h6>
                    </div>
                </div>
            </div>
            <div class="blog">
                <div class="row active-blog">

                    @yield('blog')
                </div>
            </div>
        </div>
    </div>
    <div id="quickview-wrapper">
        <!-- Modal -->
        @yield('quickview')
        <!-- END Modal -->
    </div>
    <!-- BLOG SECTION END -->
</section>
@include('layout_user.footer')