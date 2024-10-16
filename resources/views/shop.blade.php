@extends('layout_user.shop')
@section('list_sanpham')

@if($products->isEmpty())
    <div class="col-md-12">
        <p style="font-size: 18px; font-weight: bold; color: #ff6600;">
            Không có sản phẩm nào phù hợp với tìm kiếm của bạn.
        </p>
    </div>
@else
    @foreach ($products as $product)
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="product-item">
                <div class="product-img">
                    <a href="single-product.html">
                        <img style="width:270px; height:270px" src="{{$product->image}}" alt="" />
                    </a>
                </div>
                <div class="product-info">
                    <h6 class="product-title">
                        <a href="single-product.html">{{$product->name}} </a>
                    </h6>
                    <div class="pro-rating">
                        <a href="#"><i class="zmdi zmdi-star"></i></a>
                        <a href="#"><i class="zmdi zmdi-star"></i></a>
                        <a href="#"><i class="zmdi zmdi-star"></i></a>
                        <a href="#"><i class="zmdi zmdi-star-half"></i></a>
                        <a href="#"><i class="zmdi zmdi-star-outline"></i></a>
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
@endif

@endsection
@section('quickview')
@foreach ($products as $product)
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
                                    <img style="width:270px; height:270px" alt="{{$product->name}}" src="{{$product->image}}">
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
@section('san_pham_ngang')
@if($products->isEmpty())
    <div class="col-md-12">
        <p style="font-size: 18px; font-weight: bold; color: #ff6600;">
            Không có sản phẩm nào phù hợp với tìm kiếm của bạn.
        </p>
    </div>
@else
    @foreach ($products as $product)
        <div class="col-md-12">
            <div class="shop-list product-item">
                <div class="product-img">
                    <a href="single-product.html">
                        <img src="{{$product->image}}" alt="" />
                    </a>
                </div>
                <div class="product-info">
                    <div class="clearfix">
                        <h6 class="product-title f-left">
                            <a href="single-product.html">{{$product->name}}</a>
                        </h6>
                        <div class="pro-rating f-right">
                            <a href="#"><i class="zmdi zmdi-star"></i></a>
                            <a href="#"><i class="zmdi zmdi-star"></i></a>
                            <a href="#"><i class="zmdi zmdi-star"></i></a>
                            <a href="#"><i class="zmdi zmdi-star-half"></i></a>
                            <a href="#"><i class="zmdi zmdi-star-outline"></i></a>
                        </div>
                    </div>
                    <h6 class="brand-name mb-30">{{ $product->ProductCategory->name }}</h6>
                    <del><span class="old-price">{{ number_format($product->price, 0, ',', '.') }} VND</span></del>
                    <h3 class="pro-price">
                        {{ number_format($product->price - $product->price * $product->discount / 100, 0, ',', '.') }} VND
                    </h3>
                    <p>{{$product->description}}</p>
                    <ul class="action-button">
                        <li>
                            <a href="#" title="Danh sách yêu thích"><i class="zmdi zmdi-favorite"></i></a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#product-{{$product->id}}" title="Xem nhanh"><i
                                    class="zmdi zmdi-zoom-in"></i></a>
                        </li>
                        <li>
                            <a href="#" title="So sánh"><i class="zmdi zmdi-refresh"></i></a>
                        </li>
                        <li>
                            <a href="#" title="Thêm vào giỏ hàng"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    @endforeach
@endif
@endsection
@section('san_pham_moi')
@foreach ($newProducts as $product)
    <!-- product-item start -->
    <div class="product-item">
        <div class="product-img">
            <a href="single-product.html">
                <img src="{{$product->image}}" alt="" />
            </a>
        </div>
        <div class="product-info">
            <h6 class="product-title">
                <a href="single-product.html">{{$product->name}}</a>
            </h6>
            <h3 class="pro-price">
                {{ number_format($product->price - $product->price * $product->discount / 100, 0, ',', '.') }} VND
            </h3>
        </div>
    </div>
    <!-- product-item end -->
@endforeach
@endsection
@section('danh_muc')
<li class="{{ request('category_id') === null ? 'open' : 'closed' }}">
    <a href="{{ route('products.index', ['category_id' => null, 'sort_by' => request('sort_by')]) }}">Tất cả</a>
</li>
@foreach ($categories as $category)
    <li class="{{ request('category_id') == $category->id ? 'open' : 'closed' }}">
        <a
            href="{{ route('products.index', ['category_id' => $category->id, 'sort_by' => request('sort_by')]) }}">{{ $category->name }}</a>
    </li>
@endforeach
@endsection