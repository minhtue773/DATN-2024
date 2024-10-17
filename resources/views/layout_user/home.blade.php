@include('layout_user.menu')
<!-- Slider Container -->
<div class="banner">
    <div class="slides">
        @yield('banner')
    </div>
    <!-- Navigation arrows -->
    <a class="prev" onclick="moveSlide(-1)">&#10094;</a>
    <a class="next" onclick="moveSlide(1)">&#10095;</a>
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