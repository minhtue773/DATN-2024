@extends('clients.layout.app')
@section('title')

@endsection
@section('banner')

@endsection
@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shop</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12 mb-4">
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Tìm kiếm theo danh mục</h5>
                <ul class="list-unstyled category-list">
                    <li class="{{ request('category_id') === null ? 'open' : 'closed' }}">
                        <a href="{{ route('products.index', ['category_id' => null, 'sort_by' => request('sort_by')]) }}" class="filter-link">Tất cả</a>
                    </li>
                    @foreach ($categories as $category)
                    <li class="{{ request('category_id') == $category->id ? 'open' : 'closed' }}">
                        <a href="{{ route('products.index', ['category_id' => $category->id, 'sort_by' => request('sort_by')]) }}" class="filter-link">
                            {{ $category->name }}
                            <span class="product-count">({{ $category->products->count() }})</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Tìm kiếm theo giá</h5>
                <div id="cat-treeview" class="product-cat">
                    <ul class="list-unstyled price-list">
                        <li class="{{ request('price_range') == 'under_1m' ? 'open' : 'closed' }}">
                            <a href="{{ route('products.index', ['price_range' => 'under_1m', 'category_id' => request('category_id'), 'sort_by' => request('sort_by')]) }}" class="filter-link">Dưới 1.000.000 VND</a>
                        </li>
                        <li class="{{ request('price_range') == '1m_to_2m' ? 'open' : 'closed' }}">
                            <a href="{{ route('products.index', ['price_range' => '1m_to_2m', 'category_id' => request('category_id'), 'sort_by' => request('sort_by')]) }}" class="filter-link">Từ 1.000.000 đến 2.000.000 VND</a>
                        </li>
                        <li class="{{ request('price_range') == '2m_to_5m' ? 'open' : 'closed' }}">
                            <a href="{{ route('products.index', ['price_range' => '2m_to_5m', 'category_id' => request('category_id'), 'sort_by' => request('sort_by')]) }}" class="filter-link">Từ 2.000.000 đến 5.000.000 VND</a>
                        </li>
                        <li class="{{ request('price_range') == '5m_to_10m' ? 'open' : 'closed' }}">
                            <a href="{{ route('products.index', ['price_range' => '5m_to_10m', 'category_id' => request('category_id'), 'sort_by' => request('sort_by')]) }}" class="filter-link">Từ 5.000.000 đến 10.000.000 VND</a>
                        </li>
                        <li class="{{ request('price_range') == 'above_10m' ? 'open' : 'closed' }}">
                            <a href="{{ route('products.index', ['price_range' => 'above_10m', 'category_id' => request('category_id'), 'sort_by' => request('sort_by')]) }}" class="filter-link">Trên 10.000.000 VND</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Price End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="{{ route('products.index') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên sản phẩm" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="dropdown ml-4">
                            <span>Sắp xếp theo:</span>
                            <select id="sort-select" onchange="changeSort()">
                                <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Sản phẩm
                                    mới nhất</option>
                                <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>
                                    Giá từ thấp đến cao</option>
                                <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>
                                    Giá từ cao đến thấp</option>
                                <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Tên
                                    A-Z</option>
                                <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>
                                    Tên Z-A</option>
                            </select>
                        </div>
                    </div>
                </div>
                @if($products->isEmpty())
                <div class="col-md-12">
                    <p style="font-size: 18px; font-weight: bold; color: #ff6600;">
                        Không có sản phẩm nào phù hợp với tìm kiếm của bạn.
                    </p>
                </div>
                @else
                @foreach ($products as $product)
                <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="{{ asset($product->image) }}" alt="{{ $product->name }}">
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
                            <a href="" class="wishlist-toggle btn btn-sm text-dark p-0 {{ Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'favorited' : '' }}" data-product-id="{{ $product->id }}">
                                <i class="fas fa-heart text-primary mr-1"></i>Thích
                            </a>
                            @endauth
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <ul class="shop-pagination box-shadow text-center ptblr-10-30">
                {{ $products->links('vendor.pagination.custom-pagination') }}
            </ul>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
@endsection