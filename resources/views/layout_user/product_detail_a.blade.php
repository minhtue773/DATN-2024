@if (isset($sp))
    <style>
        .fade {
            transition: opacity 1s ease-out;
            /* Thời gian mờ dần */
            opacity: 1;
        }

        .fade-out {
            opacity: 0;
            /* Khi thêm lớp này, phần tử sẽ mờ dần */
        }
    </style>
    <div class="breadcrumbs-section plr-200 mb-80">
        <div class="breadcrumbs overlay-bg">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="breadcrumbs-inner">
                            <h1 class="breadcrumbs-title">Single Product</h1>
                            <ul class="breadcrumb-list">
                                <li><a href="index.html">Home</a></li>
                                <li>Single Product</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="page-content" class="page-wrapper" ng-controller="siteController">


        <!-- SHOP SECTION START -->
        <div class="shop-section mb-80" ng-init="currentUserId={{ Auth::id() }}">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-xs-12">
                        <!-- single-product-area start -->
                        <div class="single-product-area mb-80">
                            <div class="row">
                                <!-- imgs-zoom-area start -->
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <div class="imgs-zoom-area">
                                        @if ($sp->discount > 0)
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
                                                {{-- <div id="gallery_01" class="carousel-btn slick-arrow-3 mt-30">
                                                    @foreach ($images as $hinh)
                                                    <div class="p-c">
                                                        <a href="#" data-image="{{ asset($hinh->image) }}"
                                                            data-zoom-image="{{ asset($hinh->image) }}">
                                                            <img class="zoom_03" src="{{ asset($hinh->image) }}"
                                                                alt="Product Image">
                                                        </a>
                                                    </div>
                                                    @endforeach
                                                </div> --}}
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
                                                <a href="#" tabindex="0"><i
                                                        class="zmdi zmdi-star-outline"></i></a>
                                                <span class="text-black-5">(%% totalComments %% Đánh giá)</span>
                                            </div>
                                        </div>
                                        <!-- hr -->
                                        <hr>
                                        <!-- plus-minus-pro-action -->
                                        <div class="plus-minus-pro-action clearfix">
                                            <div class="sin-plus-minus f-left clearfix">
                                                <p class="color-title f-left">Số lượng</p>
                                                <div class="f-left">
                                                    <button class="dec qtybutton" ng-click="decreaseQty()">-</button>
                                                    <input type="number" name="qtybutton" class="cart-plus-minus-box"
                                                        min="1" max="{{ $sp->stock }}" ng-model="quantity">
                                                    <button class="inc qtybutton" ng-click="increaseQty()">+</button>
                                                </div>
                                            </div>
                                            <div class="sin-pro-action f-right">
                                                <ul class="action-button">
                                                    <li>
                                                        <a href="#" title="Danh sách yêu thích" tabindex="0"><i
                                                                class="zmdi zmdi-favorite"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#product-{{ $sp->id }}"
                                                            title="Xem nhanh" tabindex="0"><i
                                                                class="zmdi zmdi-zoom-in"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="So sánh" tabindex="0"><i
                                                                class="zmdi zmdi-refresh"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" title="Thêm vào giỏ hàng"
                                                            tabindex="0"
                                                            ng-click="addToCart({{ $sp->id }}, quantity)"><i
                                                                class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <!-- plus-minus-pro-action end -->
                                        <!-- hr -->
                                        <hr>
                                        <!-- single-product-price -->
                                        @if ($sp->discount > 0)
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
                                        <!--  hr -->
                                        <hr>
                                        <div>
                                            @if ($sp->stock > 0)
                                                <div>
                                                    <a href="javascript:void(0);"
                                                        class="button extra-small button-black" tabindex="-1"
                                                        ng-click="addToCart2({{ $sp->id }}, quantity)">
                                                        <span class="text-uppercase">Mua ngay</span>
                                                    </a>
                                                </div>
                                            @else
                                                <div>
                                                    <a href="#" class="button extra-small button-black"
                                                        tabindex="-1">
                                                        <span class="text-uppercase">Hết Hàng</span>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- Phần thông báo -->



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
                                                <p>Có rất nhiều biến thể của các đoạn văn Lorem Ipsum có sẵn, nhưng
                                                    phần lớn đã bị thay đổi theo một cách nào đó, bằng cách tiêm
                                                    thêm những yếu tố hài hước hoặc sự ngẫu nhiên mà không thể tin
                                                    tưởng được. Nếu bạn sẽ sử dụng một đoạn văn Lorem Ipsum.</p>
                                                <p>Các vấn đề về đau khổ của những điều bất bình thường, sự đáng
                                                    kính đã được thực hiện và chịu đựng những điều tốt đẹp, không có
                                                    sự thực hành nào.</p>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="information">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem,
                                                    neque fugit inventore quo dignissimos est iure natus quis nam
                                                    illo officiis, deleniti consectetur non, aspernatur.</p>
                                                <p>Các vấn đề về đau khổ của những điều bất bình thường, sự đáng
                                                    kính đã được thực hiện và chịu đựng những điều tốt đẹp, không có
                                                    sự thực hành nào.</p>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="reviews">

                                                <div class="reviews-tab-desc">

                                                    <div class="media mt-30" ng-repeat="bl in dsBL">

                                                        <div class="media-body">
                                                            {{-- <div class="clearfix">
                                                                <div class="name-commenter pull-left" >

                                                                    <h6 class="media-heading"><a href="javascript:void(0);">%%
                                                                            bl.user_fullname %%</a></h6>
                                                                    <p class="mb-10">%% bl.created_at | date:
                                                                        'dd/MM/yyyy HH:mm:ss' %%
                                                                    </p>
                                                                </div>

                                                            </div> --}}

                                                            <div class="pull-right" style="margin-top: 10px">
                                                                <ul class="reply-delate">
                                                                    <li>
                                                                        <h6><a href="javascript:void(0);">%%
                                                                                bl.user_fullname %%</a></h6>
                                                                    </li>
                                                                    <li>/</li>
                                                                    <li>
                                                                        <p>%% bl.created_at | date:
                                                                            'dd/MM/yyyy HH:mm:ss' %%
                                                                        </p>
                                                                    </li>
                                                                    <li>/</li>
                                                                    <li ng-if="bl.user_id == currentUserId">
    <a href="javascript:void(0);" ng-click="deleteComment(bl.id)">Xóa</a>
</li>
                                                                </ul>


                                                            </div>


                                                            <div class="pro-rating sin-pro-rating f-right">
                                                                <a tabindex="0" ng-show="bl.rating_stars >= 1"><i
                                                                        class="zmdi zmdi-star"></i></a>
                                                                <a tabindex="0" ng-show="bl.rating_stars >= 2"><i
                                                                        class="zmdi zmdi-star"></i></a>
                                                                <a tabindex="0" ng-show="bl.rating_stars >= 3"><i
                                                                        class="zmdi zmdi-star"></i></a>
                                                                <a tabindex="0" ng-show="bl.rating_stars >= 4"><i
                                                                        class="zmdi zmdi-star"></i></a>
                                                                <a tabindex="0" ng-show="bl.rating_stars >= 5"><i
                                                                        class="zmdi zmdi-star"></i></a>
                                                                {{-- <a href="#" tabindex="0"><i class="zmdi zmdi-star-half"></i></a> --}}
                                                                <a tabindex="0" ng-show="bl.rating_stars < 5"><i
                                                                        class="zmdi zmdi-star-outline"></i></a>
                                                                <a tabindex="0" ng-show="bl.rating_stars < 4"><i
                                                                        class="zmdi zmdi-star-outline"></i></a>
                                                                <a tabindex="0" ng-show="bl.rating_stars < 3"><i
                                                                        class="zmdi zmdi-star-outline"></i></a>
                                                                <a tabindex="0" ng-show="bl.rating_stars < 2"><i
                                                                        class="zmdi zmdi-star-outline"></i></a>
                                                                <a tabindex="0" ng-show="bl.rating_stars < 1"><i
                                                                        class="zmdi zmdi-star-outline"></i></a>

                                                            </div>
                                                            <p class="mb-0"><b>%% bl.content %%</b></p>


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

                        <div class="related-product-area">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-title text-left mb-40">
                                        <h2 class="uppercase">Sản phẩm liên quan</h2>
                                        <h6>Có nhiều biến thể của các thương hiệu có sẵn,</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="active-related-product">


                                    @foreach ($relatedProducts as $product)
                                        <div class="col-xs-12">
                                            <div class="product-item">
                                                <div class="product-img">
                                                    <a href="{{ route('product.detail', ['id' => $product->id]) }}">

                                                        <img src="{{ asset($product->image) }}"
                                                            alt="{{ $product->name }}" />

                                                    </a>
                                                </div>
                                                <div class="product-info">
                                                    <h6 class="product-title">
                                                        <a
                                                            href="{{ route('product.detail', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                                    </h6>
                                                    <div class="pro-rating">
                                                        <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                        <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                        <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                        <a href="#"><i class="zmdi zmdi-star-half"></i></a>
                                                        <a href="#"><i class="zmdi zmdi-star-outline"></i></a>
                                                    </div>
                                                    <h3 class="pro-price">
                                                        {{ number_format($product->price, 0, ',', '.') }} đ
                                                    </h3>
                                                    <ul class="action-button">
                                                        <li>
                                                            <a href="#" title="Danh sách yêu thích"><i
                                                                    class="zmdi zmdi-favorite"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#product-{{ $product->id }}"
                                                                title="Xem nhanh"><i
                                                                    class="zmdi zmdi-zoom-in"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#" title="So sánh"><i
                                                                    class="zmdi zmdi-refresh"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" title="Thêm vào giỏ hàng" ng-click="addToCart({{ $product->id }}, 1)"><i
                                                                    class="zmdi zmdi-shopping-cart-plus"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="quickview-wrapper">
                        <div id="productModal">
                            <div class="modal fade" id="product-{{ $sp->id }}" tabindex="0" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div style="top:100px;" class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close" name="btn-close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="modal-product clearfix">
                                                <div class="product-images">
                                                    <div class="main-image images">
                                                        <img style="width:270px; height:270px"
                                                            alt="{{ $sp->name }}" src="{{ asset($sp->image) }}">
                                                    </div>
                                                </div><!-- .product-images -->

                                                <div class="product-info">
                                                    <h1>{{ $sp->name }}</h1>
                                                    <div class="price-box-3">
                                                        <div class="s-price-box">
                                                            <span
                                                                class="new-price">{{ number_format($sp->price - ($sp->price * $sp->discount) / 100, 0, ',', '.') }}
                                                                VND</span>
                                                            <span
                                                                class="old-price">{{ number_format($sp->price, 0, ',', '.') }}
                                                                VND</span>
                                                        </div>
                                                    </div>
                                                    <a href="single-product-left-sidebar.html"
                                                        style="text-decoration: none; color: black;" class="see-all"
                                                        onmouseover="this.style.color='blue'"
                                                        onmouseout="this.style.color='black'">
                                                        xem thêm sản phẩm
                                                    </a>
                                                    <div class="quick-add-to-cart">
                                                        <form method="post" class="cart">
                                                            <div class="numbers-row">
                                                                {{-- <button class="dec qtybutton" ng-click="decreaseQty()">-</button> --}}
                                                                <input type="number" name="qtybutton" class="cart-plus-minus-box"
                                                                    min="1" max="{{ $sp->stock }}" ng-model="quantity">
                                                                {{-- <button class="inc qtybutton" ng-click="increaseQty()">+</button> --}}
                                                            </div>
                                                            <button class="single_add_to_cart_button"
                                                                type="submit"  ng-click="addToCart2({{ $sp->id }}, quantity)">Thêm vào
                                                                giỏ
                                                                hàng</button>
                                                        </form>
                                                    </div>
                                                    <div class="quick-desc">
                                                        {{ $sp->description }}
                                                    </div>
                                                    <div class="social-sharing">
                                                        <div class="widget widget_socialsharing_widget">
                                                            <h3 class="widget-title-modal">Share this product</h3>
                                                            <ul class="social-icons clearfix">
                                                                <li>
                                                                    <a class="facebook" href="#"
                                                                        target="_blank" title="Facebook">
                                                                        <i class="zmdi zmdi-facebook"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="google-plus" href="#"
                                                                        target="_blank" title="Google +">
                                                                        <i class="zmdi zmdi-google-plus"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="twitter" href="#" target="_blank"
                                                                        title="Twitter">
                                                                        <i class="zmdi zmdi-twitter"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="pinterest" href="#"
                                                                        target="_blank" title="Pinterest">
                                                                        <i class="zmdi zmdi-pinterest"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="rss" href="#" target="_blank"
                                                                        title="RSS">
                                                                        <i class="zmdi zmdi-rss"></i>
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- SHOP SECTION END -->
                        @foreach ($relatedProducts as $product)
                            <div id="productModal">
                                <div class="modal fade" id="product-{{ $product->id }}" tabindex="0"
                                    role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div style="top:100px;" class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="modal-product clearfix">
                                                    <div class="product-images">
                                                        <div class="main-image images">
                                                            <img style="width:270px; height:270px"
                                                                alt="{{ $product->name }}"
                                                                src="{{ asset($product->image) }}">
                                                        </div>
                                                    </div><!-- .product-images -->

                                                    <div class="product-info">
                                                        <h1>{{ $product->name }}</h1>
                                                        <div class="price-box-3">
                                                            <div class="s-price-box">
                                                                <span
                                                                    class="new-price">{{ number_format($product->price - ($product->price * $product->discount) / 100, 0, ',', '.') }}
                                                                    VND</span>
                                                                <span
                                                                    class="old-price">{{ number_format($product->price, 0, ',', '.') }}
                                                                    VND</span>
                                                            </div>
                                                        </div>
                                                        <a href="single-product-left-sidebar.html"
                                                            style="text-decoration: none; color: black;"
                                                            class="see-all" onmouseover="this.style.color='blue'"
                                                            onmouseout="this.style.color='black'">
                                                            xem thêm sản phẩm
                                                        </a>
                                                        <div class="quick-add-to-cart">
                                                            <form method="post" class="cart">
                                                                <div class="numbers-row">
                                                                    {{-- <button class="dec qtybutton" ng-click="decreaseQty()">-</button> --}}
                                                                    <input type="number" name="qtybutton" class="cart-plus-minus-box"
                                                                        min="1" max="{{ $product->stock }}" ng-model="quantity">
                                                                    {{-- <button class="inc qtybutton" ng-click="increaseQty()">+</button> --}}
                                                                </div>
                                                                <button class="single_add_to_cart_button"
                                                                    type="submit"  ng-click="addToCart2({{ $product->id }}, quantity)">Thêm vào
                                                                    giỏ
                                                                    hàng</button>
                                                            </form>
                                                        </div>
                                                      

                                                        <div class="quick-desc">
                                                            {{ $product->description }}
                                                        </div>
                                                        <div class="social-sharing">
                                                            <div class="widget widget_socialsharing_widget">
                                                                <h3 class="widget-title-modal">Share this product</h3>
                                                                <ul class="social-icons clearfix">
                                                                    <li>
                                                                        <a class="facebook" href="#"
                                                                            target="_blank" title="Facebook">
                                                                            <i class="zmdi zmdi-facebook"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="google-plus" href="#"
                                                                            target="_blank" title="Google +">
                                                                            <i class="zmdi zmdi-google-plus"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="twitter" href="#"
                                                                            target="_blank" title="Twitter">
                                                                            <i class="zmdi zmdi-twitter"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="pinterest" href="#"
                                                                            target="_blank" title="Pinterest">
                                                                            <i class="zmdi zmdi-pinterest"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="rss" href="#"
                                                                            target="_blank" title="RSS">
                                                                            <i class="zmdi zmdi-rss"></i>
                                                                        </a>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <!-- widget-search -->
                        <aside class="widget-search mb-30">
                            <form action="{{ route('products.index') }}" method="GET">
                                <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..."
                                    value="{{ request('search') }}">
                                <button type="submit"><i class="zmdi zmdi-search"></i></button>
                            </form>
                        </aside>
                        <!-- widget-categories -->
                        <aside class="widget widget-categories box-shadow mb-30">
                            <h6 class="widget-title border-left mb-20">Danh mục</h6>
                            <div id="cat-treeview" class="product-cat">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li class="{{ request('category_id') == $category->id ? 'open' : 'closed' }}">
                                            <a
                                                href="{{ route('products.index', ['category_id' => $category->id, 'sort_by' => request('sort_by')]) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>

                        <aside class="widget widget-product box-shadow">
                            <h6 class="widget-title border-left mb-20">Sản phẩm mới</h6>
                            @foreach ($newProducts as $product)
                                <!-- product-item start -->
                                <div class="product-item">
                                    <div class="product-img">
                                        <a href="{{ url('product/' . $product->id) }}">
                                            <img src="{{ asset($product->image) }}" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-title">
                                            <a href="{{ url('product/' . $product->id) }}">{{ $product->name }}</a>
                                        </h6>
                                        <h3 class="pro-price">
                                            {{ number_format($product->price - ($product->price * $product->discount) / 100, 0, ',', '.') }}
                                            VND
                                        </h3>
                                    </div>
                                </div>
                                <!-- product-item end -->
                            @endforeach
                        </aside>
                    </div>
                </div>
                <div class="leave-comment">

                    @auth
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="blog-section-title border-left mb-30">để lại bình luận của bạn</h4>
                            </div>
                            <!-- Thông báo thành công -->
                            <!-- Thông báo thành công -->
                            <div ng-if="successMessage" ng-class="{'fade': true, 'fade-out': fadeOutSuccess}"
                                class="alert alert-success col-md-6">
                                %% successMessage %%
                            </div>

                            <!-- Thông báo lỗi -->
                            <div ng-if="errorMessage" ng-class="{'fade': true, 'fade-out': fadeOutError}"
                                class="alert alert-danger col-md-6">
                                %% errorMessage %%
                            </div>
                        </div>

                        <div class="row">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Tên của bạn <span>*</span></label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="Nhập tên của bạn..." value="{{ Auth::user()->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="userRating">Sao đánh giá</label>
                                    <select ng-model="rating" class="form-control" id="rating">
                                        <option value="5">5 sao</option>
                                        <option value="4">4 sao</option>
                                        <option value="3">3 sao</option>
                                        <option value="2">2 sao</option>
                                        <option value="1">1 sao</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userComment">Nội dung</label>
                            <textarea ng-model="content" class="form-control" id="content" rows="3"
                                placeholder="Nhập nội dung bình luận" required></textarea>
                        </div>
                        <button class="btn btn-primary" ng-click="sendComment()">Gửi bình luận</button>
                    @endauth
                    @guest
                        <h3 class="blog-section-title border-left mb-30"><a href="/login">Đăng Nhập</a> Để Bình Luận</h3>
                    @endguest

                </div>
            </div>

        </div>

        <!-- SHOP SECTION END -->

    </section>




    @section('viewFunction')
        <script>
            viewFunction = function($scope, $http) {
                $scope.quantity = 1; // Giá trị mặc định ban đầu
                $scope.successMessage = ''; // Biến để lưu thông báo
                $scope.errorMessage = ''; // Biến để lưu thông báo lỗi

                // Hàm tăng số lượng
                $scope.increaseQty = function() {
                    if ($scope.quantity < {{ $sp->stock }}) {
                        $scope.quantity++;
                    }
                };

                // Hàm giảm số lượng
                $scope.decreaseQty = function() {
                    if ($scope.quantity > 1) {
                        $scope.quantity--;
                    }
                };

                $scope.dsBL = [];
                $scope.getComment = function() {
                    $http.get('/api/comments/product/{{ $sp->id }}').then(
                        function(res) { // Thành công
                            $scope.dsBL = res.data.data; // Danh sách bình luận
                            $scope.totalComments = res.data.total_comments; // Số lượng bình luận
                            console.log($scope.dsBL);
                            console.log("Tổng số bình luận: ", $scope.totalComments); // In ra số lượng bình luận
                        },
                        function(res) { // Thất bại
                            console.error('Lỗi khi lấy dữ liệu từ API', res);
                        }
                    );
                };


                $scope.getComment();

                $scope.sendComment = function() {
                    $http.post('/api/comments', {
                        'product_id': {{ $sp->id }},
                        'content': $scope.content,
                        'rating': $scope.rating,
                    }).then(
                        function(res) {
                            if (res.data.status) {
                                $scope.successMessage = res.data.message; // Gán thông báo thành công
                                $scope.content = '';
                                $scope.rating = 5;
                                $scope.getComment();
                                $scope.fadeOutSuccess = false; // Đặt thành false trước khi mờ dần

                                // Đặt timeout để thông báo tự động mờ dần và biến mất sau 3 giây
                                setTimeout(function() {
                                    $scope.$apply(function() {
                                        $scope.fadeOutSuccess = true; // Bắt đầu hiệu ứng mờ dần
                                    });

                                    // Thực hiện thêm một timeout nữa để xóa thông báo sau khi mờ dần
                                    setTimeout(function() {
                                        $scope.$apply(function() {
                                            $scope.successMessage = '';
                                            $scope.fadeOutSuccess =
                                                false; // Đặt lại để có thể sử dụng lại
                                        });
                                    }, 500); // Thời gian mờ dần (0.5 giây)
                                }, 2500); // Thời gian hiển thị thông báo trước khi bắt đầu mờ dần
                            }
                        },
                        function(error) {
                            console.error('Error posting comment:', error);
                            $scope.errorMessage = 'Có lỗi xảy ra khi gửi bình luận!'; // Thông báo lỗi
                            $scope.fadeOutError = false; // Đặt thành false trước khi mờ dần

                            // Đặt timeout để thông báo lỗi tự động mờ dần và biến mất sau 3 giây
                            setTimeout(function() {
                                $scope.$apply(function() {
                                    $scope.fadeOutError = true; // Bắt đầu hiệu ứng mờ dần
                                });

                                // Thực hiện thêm một timeout nữa để xóa thông báo sau khi mờ dần
                                setTimeout(function() {
                                    $scope.$apply(function() {
                                        $scope.errorMessage = '';
                                        $scope.fadeOutError =
                                            false; // Đặt lại để có thể sử dụng lại
                                    });
                                }, 500); // Thời gian mờ dần (0.5 giây)
                            }, 2500); // Thời gian hiển thị thông báo trước khi bắt đầu mờ dần
                        }
                    );
                };

                $scope.deleteComment = function(commentId) {

                    if (confirm("Bạn có chắc chắn muốn xóa bình luận này?")) { // Xác nhận trước khi xóa
                        $http.delete('/api/comments/' + commentId).then(
                            function(res) {
                                if (res.data.status) {
                                    $scope.successMessage = res.data.message; // Hiển thị thông báo thành công
                                    $scope.getComment(); // Lấy lại danh sách bình luận sau khi xóa

                                    // Thêm timeout để thông báo biến mất
                                    setTimeout(function() {
                                        $scope.$apply(function() {
                                            $scope.successMessage = '';
                                        });
                                    }, 3000);
                                }
                            },
                            function(error) {
                                console.error('Error deleting comment:', error);
                                $scope.errorMessage = 'Có lỗi xảy ra khi xóa bình luận!'; // Hiển thị thông báo lỗi

                                // Thêm timeout để thông báo lỗi biến mất
                                setTimeout(function() {
                                    $scope.$apply(function() {
                                        $scope.errorMessage = '';
                                    });
                                }, 3000);
                            }
                        );
                    }
                };



            };
        </script>
    @endsection
@endif
