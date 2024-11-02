@extends('clients.layout.app')
<link rel="stylesheet" href="{{asset('client/css/my_account.css')}}">
@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Thông tin tài khoản</p>
        </div>
    </div>
</div>
<div id="page-content" class="page-wrapper">

    <!-- LOGIN SECTION START -->
    <div class="login-section mb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-md-offset-2">
                    <div class="my-account-content" id="accordion2">
                        <!-- My Personal Information -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion2"
                                        href="#personal_info" style="text-decoration: none;">Thông Tin Cá Nhân</a>
                                </h4>
                            </div>

                            <div id="personal_info" class="panel-collapse collapse in" role="tabpanel">
                                <div class="panel-body">
                                    <form action="{{ route('account.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="text-center">
                                            <img class="img-account-profile rounded-circle mb-2" src="{{asset('storage/' . $user->image)}}">
                                            <input type="file" name="image" class="form-control mb-3">
                                        </div>
                                        <div class="new-customers">
                                            <div class="p-30">
                                                <div class="row">
                                                    <input type="text" class="form-control mb-3" name="name" value="{{ $user->name ?? null }}" required placeholder="Họ và Tên">
                                                    <input type="text" class="form-control mb-3" name="phone_number" value="{{ $user->phone_number ?? null }}" required placeholder="Số điện thoại">
                                                    <input type="text" class="form-control mb-3" name="address" value="{{ $user->address ?? null }}" required placeholder="Địa chỉ cụ thể">
                                                    <input type="text" class="form-control mb-3" name="email" value="{{ $user->email ?? null }}" required placeholder="Email">
                                                    <!-- <input type="password" class="form-control mb-3" name="password" placeholder="Mật khẩu">
                                                    <input type="password" class="form-control mb-3" name="password_confirmation" placeholder="Xác nhận mật khẩu"> -->
                                                </div>

                                                <div class="checkbox">
                                                    <label>
                                                        <small>
                                                            <input type="checkbox" name="signup">Tôi đã đọc và
                                                            đồng ý với <a href="#">Chính Sách Bảo Mật</a>.
                                                        </small>
                                                    </label>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button class="submit-btn-1 bg-warning mt-20 btn-hover-1"
                                                            type="submit">Cập Nhật</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button class="submit-btn-1 bg-warning mt-20 btn-hover-1 f-right"
                                                            type="reset">Xóa</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- My shipping address -->


                        <!-- My Order info -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion2"
                                        href="#My_order_info" style="text-decoration: none;">Thông tin đơn hàng của tôi</a>
                                </h4>
                            </div>
                            <div id="My_order_info" class="panel-collapse collapse" role="tabpanel">
                                <div class="panel-body">
                                    <form action="#">
                                        <!-- Thông tin đơn hàng -->
                                        <div class="payment-details p-30">
                                            <table>
                                                <tr>
                                                    <td class="td-title-1">Tên sản phẩm giả x 2</td>
                                                    <td class="td-title-2">1855.00 USD</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-title-1">Tên sản phẩm giả</td>
                                                    <td class="td-title-2">555.00 USD</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-title-1">Tổng giá trước thuế</td>
                                                    <td class="td-title-2">2410.00 USD</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-title-1">Phí vận chuyển và xử lý</td>
                                                    <td class="td-title-2">15.00 USD</td>
                                                </tr>
                                                <tr>
                                                    <td class="td-title-1">Thuế VAT</td>
                                                    <td class="td-title-2">0.00 USD</td>
                                                </tr>
                                                <tr>
                                                    <td class="order-total">Tổng đơn hàng</td>
                                                    <td class="order-total-price">2425.00 USD</td>
                                                </tr>
                                            </table>
                                            <button class="submit-btn-1 mt-20 btn-hover-1" type="submit"
                                                value="register">Lưu</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($favoriteProducts as $product)
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
                        <a href="{{ url('product/' . $product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem </a>
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
        <ul class="shop-pagination box-shadow text-center ptblr-10-30">
            {{ $favoriteProducts->links('vendor.pagination.custom-pagination') }}
        </ul>
    </div>
    <!-- LOGIN SECTION END -->
</div>

@endsection