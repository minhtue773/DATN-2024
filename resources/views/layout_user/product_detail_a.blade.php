@section('tieude')
{{ $sp->name }}
@endsection
@include('layout_user.menu')
<div class="breadcrumbs-section plr-200 mb-80">
    <div class="breadcrumbs overlay-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-inner">
                        <h1 class="breadcrumbs-title">Login / Register</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="index.html">Home</a></li>
                            <li>Login / Register</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (isset($sp))
    <section id="page-content" class="page-wrapper" ng-controller="siteController">

        <!-- SHOP SECTION START -->
        <div class="shop-section mb-80">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <!-- single-product-area start -->
                        <div class="single-product-area mb-80">
                            <div class="row">
                                <!-- imgs-zoom-area start -->
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <div class="imgs-zoom-area">
                                        @if($sp->discount > 0)
                                            <div class="sale-notice"
                                                style="position: absolute; top: 10px; left: 10px; background: red; color: white; padding: 5px; border-radius: 3px;">
                                                Sale {{ $sp->discount }}%
                                            </div>
                                        @endif
                                        <img id="zoom_03" src="{{ asset("{$sp->image}") }}"
                                            data-zoom-image="{{ asset("{$sp->image}") }}" alt="">

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div id="gallery_01" class="carousel-btn slick-arrow-3 mt-30">
                                                    <div class="p-c">
                                                        <a href="#" data-image="{{ asset($sp->image) }}"
                                                            data-zoom-image="{{ asset($sp->image) }}">
                                                            <img class="zoom_03" src="{{ asset($sp->image) }}"
                                                                alt="Product Image">
                                                        </a>
                                                    </div>
                                                    @foreach ($images as $hinh)
                                                        <div class="p-c">
                                                            <a href="#" data-image="{{ asset($hinh->image) }}"
                                                                data-zoom-image="{{ asset($hinh->image) }}">
                                                                <img class="zoom_03" src="{{ asset($hinh->image) }}"
                                                                    alt="Product Image">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- imgs-zoom-area end -->
                                <!-- single-product-info start -->
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div class="single-product-info">
                                        <h3 class="text-black-1">{{ $sp->name }}</h3>
                                        <h6 class="brand-name-2">{{ $categoryName }}</h6>
                                        <!--  hr -->
                                        <hr>
                                        <!-- single-pro-color-rating -->
                                        <div class="single-pro-color-rating clearfix">
                                            <div class="sin-pro-color f-left">
                                                <p class="color-title f-left">Màu sắc</p>
                                                <div class="widget-color f-left">
                                                    <ul>
                                                        <li class="color-1"><a href="#"></a></li>
                                                        <li class="color-2"><a href="#"></a></li>
                                                        <li class="color-3"><a href="#"></a></li>
                                                        <li class="color-4"><a href="#"></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="pro-rating sin-pro-rating f-right">
                                                <a href="#" tabindex="0"><i class="zmdi zmdi-star"></i></a>
                                                <a href="#" tabindex="0"><i class="zmdi zmdi-star"></i></a>
                                                <a href="#" tabindex="0"><i class="zmdi zmdi-star"></i></a>
                                                <a href="#" tabindex="0"><i class="zmdi zmdi-star-half"></i></a>
                                                <a href="#" tabindex="0"><i class="zmdi zmdi-star-outline"></i></a>
                                                <span class="text-black-5">(27 Đánh giá)</span>
                                            </div>
                                        </div>
                                        <!-- hr -->
                                        <hr>
                                        <!-- plus-minus-pro-action -->
                                        <div class="plus-minus-pro-action clearfix">
                                            <div class="sin-plus-minus f-left clearfix">
                                                <p class="color-title f-left">Số lượng</p>
                                                <div class="cart-plus-minus f-left">
                                                    <input type="number" value="1" name="qtybutton"
                                                        class="cart-plus-minus-box" min="1" max="{{ $sp->stock }}"
                                                        ng-model="quantity" ng-init="quantity = 1">
                                                </div>

                                            </div>
                                            <div class="sin-pro-action f-right">
                                                <ul class="action-button">
                                                    <li>
                                                        <a href="#" title="Danh sách yêu thích" tabindex="0"><i
                                                                class="zmdi zmdi-favorite"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" data-toggle="modal" data-target="#productModal"
                                                            title="Xem nhanh" tabindex="0"><i
                                                                class="zmdi zmdi-zoom-in"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="So sánh" tabindex="0"><i
                                                                class="zmdi zmdi-refresh"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="Thêm vào giỏ hàng" tabindex="0"><i
                                                                class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- plus-minus-pro-action end -->
                                        <!-- hr -->
                                        <hr>
                                        @if($sp->discount > 0)
                                            <h3 class="pro-price" style="text-decoration: line-through;">
                                                {{ number_format($sp->price, 0, ',', '.') }} đ
                                            </h3>
                                            <h3 class="pro-price">
                                                {{ number_format($salePrice, 0, ',', '.') }} đ
                                            </h3>
                                        @else
                                            <h3 class="pro-price">
                                                {{ number_format($sp->price, 0, ',', '.') }} đ
                                            </h3>
                                        @endif
                                        <hr>

                                        @if ($sp->stock > 0)
                                            <div>
                                                <a href="#" class="button extra-small button-black" tabindex="-1"
                                                    ng-click="addToCart({{ $sp->id }}, quantity)">
                                                    <span class="text-uppercase">Mua ngay</span>
                                                </a>
                                            </div>
                                        @else
                                            <div>
                                                <a href="#" class="button extra-small button-black" tabindex="-1">
                                                    <span class="text-uppercase">Hết Hàng</span>
                                                </a>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <!-- single-product-info end -->
                            </div>
                            <!-- single-product-tab -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- hr -->
                                    <hr>
                                    <div class="single-product-tab">
                                        <ul class="reviews-tab mb-20">
                                            <li class="active"><a href="#description" data-toggle="tab">Mô tả</a>
                                            </li>
                                            <li><a href="#information" data-toggle="tab">Thông tin</a></li>
                                            <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="description">
                                                <p>{{ $sp->description }}</p>

                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="information">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem,
                                                    neque fugit inventore quo dignissimos est iure natus quis nam
                                                    illo officiis, deleniti consectetur non, aspernatur.</p>

                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="reviews">
                                                <!-- reviews-tab-desc -->
                                                <div class="reviews-tab-desc">
                                                    <!-- bình luận đơn -->
                                                    <div class="media mt-30">
                                                        <div class="media-left">
                                                            <a href="#"><img class="media-object" src="img/author/1.jpg"
                                                                    alt="#"></a>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="clearfix">
                                                                <div class="name-commenter pull-left">
                                                                    <h6 class="media-heading"><a href="#">Gerald
                                                                            Barnes</a></h6>
                                                                    <p class="mb-10">27 Tháng 6, 2016 lúc 2:30 chiều
                                                                    </p>
                                                                </div>
                                                                <div class="pull-right">
                                                                    <ul class="reply-delate">
                                                                        <li><a href="#">Phản hồi</a></li>
                                                                        <li>/</li>
                                                                        <li><a href="#">Xóa</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur
                                                                adipiscing elit. Integer accumsan egestas.</p>
                                                        </div>
                                                    </div>
                                                    <!-- bình luận đơn -->
                                                    <div class="media mt-30">
                                                        <div class="media-left">
                                                            <a href="#"><img class="media-object" src="img/author/2.jpg"
                                                                    alt="#"></a>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="clearfix">
                                                                <div class="name-commenter pull-left">
                                                                    <h6 class="media-heading"><a href="#">Gerald
                                                                            Barnes</a></h6>
                                                                    <p class="mb-10">27 Tháng 6, 2016 lúc 2:30 chiều
                                                                    </p>
                                                                </div>
                                                                <div class="pull-right">
                                                                    <ul class="reply-delate">
                                                                        <li><a href="#">Phản hồi</a></li>
                                                                        <li>/</li>
                                                                        <li><a href="#">Xóa</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur
                                                                adipiscing elit. Integer accumsan egestas.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  hr -->
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <!-- single-product-area end -->
                        <div class="related-product-area">
                            <div class="row col-12">
                                <div class="col-md-12">
                                    <div class="section-title text-left mb-40">
                                        <h2 class="uppercase">Sản phẩm liên quan</h2>
                                        <h6>Có nhiều biến thể của các thương hiệu có sẵn,</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-12">

                                @yield('san_pham_lien_quan')




                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="quickview-wrapper">
            <!-- SHOP SECTION END -->
            @yield('san_pham_model')
            
        </div>
    </section>
    <!-- End page content -->
@endif
@include('layout_user.footer')