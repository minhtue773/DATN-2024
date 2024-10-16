@extends('layout_user.home')
@section('banner')
@section('banner')
@foreach($categories_dn as $index => $category_dn)
    <b {{ $index === 0 ? 'class="is-visible"' : '' }}>{{ $category_dn->name }}</b><br>
@endforeach
@endsection

@endsection
@section('sanpham_discount')
<div class="container">
    <div class="row">
        <!-- sản phẩm giảm giá cao nhất -->
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="up-comming-pro gray-bg clearfix">
                <div class="up-comming-pro-img f-left">
                    <a href="">
                        <img style="width:368px; height:350px;" src="{{ $topDiscountedProduct->image }}"
                            alt="{{ $topDiscountedProduct->name }}">
                    </a>
                </div>
                <div class="up-comming-pro-info f-left">
                    <h3><a href="">{{ $topDiscountedProduct->name }}</a></h3>
                    <p>{{ $topDiscountedProduct->description }}</p>
                    <div class="up-comming-time">
                        <div data-countdown="2024/10/15"></div> <!-- Thay đổi ngày ra mắt sản phẩm -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 hidden-sm col-xs-12">
            <div class="banner-item banner-1">
                <div class="ribbon-price">
                    <span>${{ number_format($topDiscountedProduct->price - $topDiscountedProduct->discount, 2) }}</span>
                    <!-- Giá sau giảm giá -->
                </div>
                <div class="banner-img">
                    <a href="#"><img src="img/banner/1.jpg" alt=""></a> <!-- Bạn có thể thay đổi hình ảnh banner -->
                </div>
                <div class="banner-info">
                    <h3><a href="#">{{ $topDiscountedProduct->name }}</a></h3>
                    <ul class="banner-featured-list">
                        <li>
                            <i class="zmdi zmdi-check"></i><span>Chất liệu cao cấp</span>
                        </li>
                        <li>
                            <i class="zmdi zmdi-check"></i><span>Thiết kế chi tiết</span>
                        </li>
                        <li>
                            <i class="zmdi zmdi-check"></i><span>Dễ dàng lắp ráp</span>
                        </li>
                        <li>
                            <i class="zmdi zmdi-check"></i><span>Mô hình chính xác 1:48</span>
                        </li>
                        <li>
                            <i class="zmdi zmdi-check"></i><span>Hướng dẫn lắp ráp chi tiết</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('categories')
<!-- single-brand-product start -->
@foreach ($categories as $category)
    <div class="col-xs-12">
        <div class="single-brand-product">
            <a href="{{ route('products.index', ['category_id' => $category->id, 'sort_by' => request('sort_by')]) }}"><img src="{{ asset('img/product/' . $category->image) }}"
                    alt="{{ $category->name }}"></a>
            <h3 class="brand-title text-gray">
                <a href="{{ route('products.index', ['category_id' => $category->id, 'sort_by' => request('sort_by')]) }}">{{ $category->name }}</a>
            </h3>
        </div>
    </div>
@endforeach
<!-- single-brand-product end -->
@endsection
@section('products')
<!-- product-item start -->
@foreach ($topViewedProducts as $product)
    <div class="col-xs-12">
        <div class="product-item">
            <div class="product-img">
                <a href="{{ url('product/' . $product->id) }}">
                    <img src="{{  $product->image }}" alt="{{ $product->name }}" />
                </a>
            </div>
            <div class="product-info">
                <h6 class="product-title">
                    <a href="{{ url('product/' . $product->id) }}">{{ $product->name }}</a>
                </h6>
                <div class="pro-rating">
                    <!-- Tạo ra hệ thống đánh giá động, ví dụ: 4 sao -->
                    @for ($i = 0; $i < 5; $i++)
                        <a href="#"><i class="zmdi {{ $i < 4 ? 'zmdi-star' : 'zmdi-star-outline' }}"></i></a>
                    @endfor
                </div>
                <del><span class="old-price">{{ number_format($product->price, 0, ',', '.') }} VND</span></del>
                <h3 class="pro-price">
                    {{ number_format($product->price - $product->price * $product->discount / 100, 0, ',', '.') }} VND
                </h3>
                <ul class="action-button">
                    <li>
                        <a href="#" title="Wishlist"><i class="zmdi zmdi-favorite"></i></a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#product-{{$product->id}}" title="Quickview"><i
                                class="zmdi zmdi-zoom-in"></i></a>
                    </li>
                    <li>
                        <a href="#" title="Compare"><i class="zmdi zmdi-refresh"></i></a>
                    </li>
                    <li>
                        <a href="#" title="Add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endforeach
<!-- product-item end -->
@endsection
@section('quickview')
@foreach ($topViewedProducts as $product)
    <div id="productModal">
        <div class="modal fade" id="product-{{$product->id}}" tabindex="0" role="dialog">
            <div class="modal-dialog" role="document">
                <div style="top:100px;" class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-product clearfix">
                            <div class="product-images">
                                <div class="main-image images">
                                    <img alt="{{$product->name}}" src="{{$product->image}}">
                                </div>
                            </div><!-- .product-images -->

                            <div class="product-info">
                                <h1>{{$product->name}}</h1>
                                <div class="price-box-3">
                                    <div class="s-price-box">
                                        <span
                                            class="new-price">{{ number_format($product->price - $product->price * $product->discount / 100, 0, ',', '.') }}
                                            VND</span>
                                        <span class="old-price">{{ number_format($product->price, 0, ',', '.') }} VND</span>
                                    </div>
                                </div>
                                <a href="single-product-left-sidebar.html" style="text-decoration: none; color: black;"
                                    class="see-all" onmouseover="this.style.color='blue'"
                                    onmouseout="this.style.color='black'">
                                    xem thêm sản phẩm
                                </a>
                                <div class="quick-add-to-cart">
                                    <form method="post" class="cart">
                                        <div class="numbers-row">
                                            <input type="number" id="french-hens" min="1" value="1">
                                        </div>
                                        <button class="single_add_to_cart_button" type="submit">Thêm vào giỏ hàng</button>
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
                                                <a class="facebook" href="#" target="_blank" title="Facebook">
                                                    <i class="zmdi zmdi-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="google-plus" href="#" target="_blank" title="Google +">
                                                    <i class="zmdi zmdi-google-plus"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="twitter" href="#" target="_blank" title="Twitter">
                                                    <i class="zmdi zmdi-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="pinterest" href="#" target="_blank" title="Pinterest">
                                                    <i class="zmdi zmdi-pinterest"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="rss" href="#" target="_blank" title="RSS">
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
@endsection
@section('blog')

@foreach ($latestPosts as $post)
    
    <div class="col-xs-12">
        <div class="blog-item">
            <img src="{{$post->image}}" alt="">
            <div class="blog-desc">
                <h5 class="blog-title"><a href="single-model.html">{{$post->title}}</a></h5>
                <p>{{ \Illuminate\Support\Str::limit($post->description, 50) }}</p>
                <div class="read-more">
                    <a href="single-model.html">Xem thêm</a>
                </div>
                <ul class="blog-meta">
                    <li>
                        <a href="#"><i class="zmdi zmdi-favorite"></i>89 Thích</a>
                    </li>
                    <li>
                        <a href="#"><i class="zmdi zmdi-comments"></i>59 Bình luận</a>
                    </li>
                    <li>
                        <a href="#"><i class="zmdi zmdi-share"></i>29 Chia sẻ</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endforeach


@endsection