@extends('clients.layout.app')
@section('title')
Thanh toán
@endsection
@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">@yield('title')</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">@yield('title')</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <div>

        <div class="row px-xl-5">
            <!-- Form nhập mã giảm giá -->
            <form class="mb-5 mr-5" action="/checkout/apply-discount" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" name="discount_code" class="form-control p-4" placeholder="Mã Giảm Giá">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Nhập Mã Giảm Giá</button>
                    </div>
                </div>
            </form>

            <!-- Hiển thị danh sách mã giảm giá đã áp dụng -->
            @if(session('applied_discounts'))
            <h5 class="font-weight-medium mb-3">Mã Giảm Giá Đã Áp Dụng: </h5>
            @foreach(session('applied_discounts') as $appliedDiscount)
            <div class="d-flex justify-content-between mx-2">
                <p>{{ $appliedDiscount['code'] }}</p>
                <p>({{ number_format($appliedDiscount['discount'], 0, ',', '.') }} đ)
                <form action="/checkout/remove-discount" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="discount_code" value="{{ $appliedDiscount['code'] }}">
                    <button type="submit" class="btn btn-link p-0">Xóa</button>
                </form>
                </p>
            </div>
            @endforeach
            @endif
        </div>
        <form action="{{ route('checkout.order') }}" method="POST" class="row px-xl-5">
            @csrf
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Thông tin thanh toán</h4>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Họ và tên</label>
                            <input name="name" value="{{ $user->name ?? '' }}" class="form-control" type="text" placeholder="Bùi Công Nghĩa">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input name="email" value="{{ $user->email ?? '' }}" class="form-control" type="emai" placeholder="hobbyzone@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Số điện thoại</label>
                            <input name="phone" value="{{ $user->phone ?? '' }}" class="form-control" type="text" placeholder="+0367 775 413">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Địa chỉ</label>
                            <input name="address" value="{{ $user->address ?? '' }}" class="form-control" type="text" placeholder="FPT Polytechnic">
                        </div>
                        <!-- <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="newaccount">
                                <label class="custom-control-label" for="newaccount">Create an account</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="shipto">
                                <label class="custom-control-label" for="shipto"  data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="collapse mb-4" id="shipping-address">
                    <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" placeholder="John">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" placeholder="Doe">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" placeholder="example@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="+123 456 789">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="custom-select">
                                <option selected>United States</option>
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" placeholder="123">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Tổng đơn hàng</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Sản phẩm</h5>
                        @php
                        $total = 0;
                        @endphp
                        @foreach($cart as $item)
                        <div class="d-flex justify-content-between">
                            <p>{{ $item['name'] }} x{{ $item['soluong'] }}</p>
                            <p>{{ number_format($item['price'] * $item['soluong'], 0, ',', '.') }} đ</p>
                        </div>
                        @php
                        $total += $item['price'] * $item['soluong'];
                        @endphp
                        @endforeach
                        <!-- Tính toán lại tổng thanh toán -->
                        @php
                        $totalDiscount = array_sum(array_column(session('applied_discounts', []), 'discount'));
                        $finalTotal = $total - $totalDiscount;
                        @endphp
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Tổng tiền hàng</h6>
                            <h6 class="font-weight-medium">{{ number_format($total, 0, ',', '.') }} đ</h6>
                        </div>
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Giảm giá</h6>
                            <h6 class="font-weight-medium">{{ number_format($totalDiscount, 0, ',', '.') }} đ</h6>
                        </div>
                        <!-- <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Phí vận chuyển</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div> -->
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h5 class="font-weight-bold">Tổng thanh toán</h5>
                            <h5 class="font-weight-bold">{{ number_format($finalTotal, 0, ',', '.') }} đ</h5>
                            <input type="hidden" name="total" value="{{ $finalTotal }}">
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Phương thức thanh toán</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="cash" value="cash" checked>
                                <label class="custom-control-label" for="cash">Thanh toán khi nhận hàng</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="momo" value="momo">
                                <label class="custom-control-label" for="momo">Momo</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="vnpay" value="vnpay">
                                <label class="custom-control-label" for="vnpay">VNPAY</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout End -->
@endsection