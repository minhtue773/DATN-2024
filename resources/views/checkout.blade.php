@include('layout_user.menu')

@section('tieude')
Cart
@endsection

<div class="breadcrumbs-section plr-200 mb-80">
    <div class="breadcrumbs overlay-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-inner">
                        <h1 class="breadcrumbs-title">Thanh toán</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="/">Trang chủ</a></li>
                            <li>Thanh toán</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="page-content" class="page-wrapper">
    <div class="shop-section mb-80" ng-controller="siteController">
        <div class="container">
            <div class="row" ng-if="cart.length>0">
                <div class="col-md-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="checkout">
                            <div class="checkout-content box-shadow p-30">
                                <form action="{{ route('checkout.order') }}" method="POST"> <!-- Chỉ định route -->
                                    @csrf <!-- Thêm token CSRF -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="billing-details pr-10">
                                                <h6 class="widget-title border-left mb-20">Thông tin thanh toán</h6>
                                                <input type="text" name="name" placeholder="Họ và tên" value="{{ $user->name ?? '' }}" required>
                                                <input type="email" name="email" placeholder="Email" value="{{ $user->email ?? '' }}" required>
                                                <input type="text" name="sdt" placeholder="Số điện thoại" value="{{ $user->phone_number ?? '' }}" required>
                                                <textarea class="custom-textarea" name="diachi" placeholder="Địa chỉ của bạn..." required>{{ $user->address ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="payment-details pl-10 mb-50">
                                                <h6 class="widget-title border-left mb-20">Đơn hàng của chúng tôi</h6>
                                                <table>
                                                    @php
                                                        $total = 0;
                                                    @endphp
                                                    @foreach($cart as $item)
                                                        <tr>
                                                            <td class="td-title-1">{{ $item['name'] }} x{{ $item['soluong'] }}</td>
                                                            <td class="td-title-2">{{ number_format($item['price'] * $item['soluong'], 0, ',', '.') }} VNĐ</td>
                                                        </tr>
                                                        @php
                                                            $total += $item['price'] * $item['soluong'];
                                                        @endphp
                                                    @endforeach
                                                    <tr>
                                                        <td class="td-title-1">Tổng giá trị sản phẩm</td>
                                                        <td class="td-title-2">{{ number_format($total, 0, ',', '.') }} VNĐ</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="order-total">Tổng đơn hàng</td>
                                                        <td class="order-total-price">{{ number_format($total + 15.00, 2, ',', '.') }} VNĐ</td> <!-- Tổng cộng bao gồm phí vận chuyển -->
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="payment-method">
                                                <h6 class="widget-title border-left mb-20">Phương thức thanh toán</h6>
                                                <div id="accordion">
                                                    <select id="payment-options" onchange="updatePaymentContent()">
                                                        <option value="" disabled selected>Chọn phương thức thanh toán</option>
                                                        <option value="bank-transfer">Thanh toán bằng tiền mặt</option>
                                                        <option value="paypal">Thanh toán bằng Momo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <button class="submit-btn-1 mt-30 btn-hover-1" type="submit">Đặt hàng</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layout_user.footer')
