@include('layout_user.menu')
<!-- Slider Container -->
<div class="slider-area bg-3 bg-opacity-black-60 ptb-150 mb-80">
    <div class="container">
        <div class="slides">
            <!-- Slide 1 -->
            <div class="slide active" style="background-image: url('image1.jpg');">
                <div class="slider-content text-center">
                    <h1 class="slider2-title-2">Mô hình xe hơi</h1>
                    <h2 class="slider2-title-3">Mô hình xe hơi thể thao</h2>
                    <a href="#" class="button extra-small button-white">
                        <span class="text-uppercase">Xem thêm</span>
                    </a>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="slide" style="background-image: url('image2.jpg');">
                <div class="slider-content text-center">
                    <h1 class="slider2-title-2">Mô hình máy bay</h1>
                    <h2 class="slider2-title-3">Mô hình máy bay chiến đấu</h2>
                    <a href="#" class="button extra-small button-white">
                        <span class="text-uppercase">Xem thêm</span>
                    </a>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="slide" style="background-image: url('image3.jpg');">
                <div class="slider-content text-center">
                    <h1 class="slider2-title-2">Mô hình tàu thủy</h1>
                    <h2 class="slider2-title-3">Mô hình tàu thủy mini</h2>
                    <a href="#" class="button extra-small button-white">
                        <span class="text-uppercase">Xem thêm</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Navigation arrows -->
        <a class="prev" onclick="moveSlide(-1)">&#10094;</a>
        <a class="next" onclick="moveSlide(1)">&#10095;</a>
    </div>
</div>


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