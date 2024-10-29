@extends('clients.layout.app')
@section('title')
Trang chủ
@endsection
@section('content')
<div id="header-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">

        @foreach ($banners as $index => $banner)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="height: 410px;">
            <img class="img-fluid" src="{{ asset(  $banner->image) }}" alt="{{ $banner->name }}">
            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                <div class="p-3" style="max-width: 700px;">
                    <h4 class="text-light text-uppercase font-weight-medium mb-3">{{ $banner->content }}</h4>
                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">{{ $banner->name }}</h3>
                    <a href="{{ $banner->link }}" class="btn btn-light py-2 px-3">Xem thêm</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
        <div class="btn btn-dark" style="width: 45px; height: 45px;">
            <span class="carousel-control-prev-icon mb-n2"></span>
        </div>
    </a>
    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
        <div class="btn btn-dark" style="width: 45px; height: 45px;">
            <span class="carousel-control-next-icon mb-n2"></span>
        </div>
    </a>
</div>
<!-- Featured Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->


<!-- Categories Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        @foreach ($categoriess as $category)
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">{{ $category->products->count() }}</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="{{ asset('img/product/' . $category->image) }}" alt="{{ $category->name }}">
                </a>
                <h5 class="font-weight-semi-bold m-0">{{ $category->name }}</h5>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Categories End -->


<!-- Offer Start -->
<div class="container-fluid offer pt-5">
    <div class="row px-xl-5">
        @foreach($topDiscountedProducts as $product)
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-{{ $loop->first ? 'right' : 'left' }} text-white mb-2 py-5 px-5">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">{{ $product->discount }}% off the all order</h5>
                    <h1 class="mb-4 font-weight-semi-bold">{{ $product->name }}</h1>
                    <a href="{{ route('product.detail', $product->id) }}" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Offer End -->


<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">SẢN PHẨM MỚI</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach ($latestProducts as $product)
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="{{ asset( $product->image ) }}" alt="{{ $product->name }}">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                    <div class="d-flex justify-content-center">
                        <h6>{{ number_format($product->price, 2) }} $</h6>
                        @if($product->discount > 0)
                        <h6 class="text-muted ml-2"><del>{{ number_format($product->price + ($product->price * $product->discount / 100), 2) }} $</del></h6>
                        @endif
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="{{ url('product/' . $product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem</a>
                    @auth
                    <a href="#" class="wishlist-toggle btn btn-sm text-dark p-0 {{ Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'favorited' : '' }}" data-product-id="{{ $product->id }}" title="{{ Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'Bỏ thích' : 'Thích' }}">
                        <i class="fas fa-heart {{ Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'text-danger' : 'text-primary' }} mr-1"></i>{{ Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'Bỏ thích' : 'Thích' }}
                    </a>
                    @endauth
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Products End -->


<!-- Subscribe Start -->
<div class="container-fluid bg-secondary my-5">
    <div class="row justify-content-md-center py-5 px-xl-5">
        <div class="col-md-6 col-12 py-5">
            <div class="text-center mb-2 pb-2">
                <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Stay Updated</span></h2>
                <p>Amet lorem at rebum amet dolores. Elitr lorem dolor sed amet diam labore at justo ipsum eirmod duo labore labore.</p>
            </div>
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here">
                    <div class="input-group-append">
                        <button class="btn btn-primary px-4">Subscribe</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Subscribe End -->


<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Sản phẩm nhiều view</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach ($topViewedProducts as $product)
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="{{ asset( $product->image )}}" alt="{{ $product->name }}">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                    <div class="d-flex justify-content-center">
                        <h6>{{ number_format($product->price, 2) }} $</h6>
                        @if($product->discount > 0)
                        <h6 class="text-muted ml-2"><del>{{ number_format($product->price + ($product->price * $product->discount / 100), 2) }} $</del></h6>
                        @endif
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="{{ url('product/' . $product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem chi tiết</a>
                    @auth
                    <a href="#" class="wishlist-toggle btn btn-sm text-dark p-0 {{ Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'favorited' : '' }}" data-product-id="{{ $product->id }}" title="{{ Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'Bỏ thích' : 'Thích' }}">
                        <i class="fas fa-heart {{ Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'text-danger' : 'text-primary' }} mr-1"></i>{{ Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'Bỏ thích' : 'Thích' }}
                    </a>
                    @endauth
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ hàng</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
<!-- Products End -->


<!-- Vendor Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                @foreach ($categories as $category)
                <div class="vendor-item border p-4 text-center">
                    <img src="{{ asset('img/product/' . $category->image) }}" alt="{{ $category->name }}">
                    <h6 class="mt-2">{{ $category->name }}</h6> <!-- Add the category name here -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->
@endsection