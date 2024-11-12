@extends('clients.layout.app')
@section('title')
Thanh toán
@endsection
<style>

</style>
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
                        <button type="submit" class="btn btn-primary text-white">Nhập Mã Giảm Giá</button>
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
                            <input name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control" type="text" placeholder="Bùi Công Nghĩa">
                            @error('name')
                            <span class="text-danger">(*){{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input name="email" value="{{ old('email', $user->email ?? '') }}" class="form-control" type="email" placeholder="hobbyzone@email.com">
                            @error('email')
                            <span class="text-danger">(*){{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Số điện thoại</label>
                            <input name="phone" value="{{ old('phone', $user->phone_number ?? '') }}" class="form-control" type="text" placeholder="+0367 775 413">
                            @error('phone')
                            <span class="text-danger">(*){{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label>Địa chỉ</label>
                        </div>
                        <div class="col-md-12 form-group">
                            <select class="css_select" id="tinh" name="tinh" title="Chọn Tỉnh Thành">
                                <option value="0">Tỉnh Thành</option>
                                @if(auth()->check() && isset($tinh) && $tinh !== '')
                                <option value="{{ $tinh }}" selected>{{ $tinh }}</option>
                                @endif
                            </select>
                            <select class="css_select" id="quan" name="quan" title="Chọn Quận Huyện">
                                <option value="0">Quận Huyện</option>
                                @if(auth()->check() && isset($quan) && $quan !== '')
                                <option value="{{ $quan }}" selected>{{ $quan }}</option>
                                @endif
                            </select>
                            <select class="css_select" id="phuong" name="phuong" title="Chọn Phường Xã">
                                <option value="0">Phường Xã</option>
                                @if(auth()->check() && isset($phuong) && $phuong !== '')
                                <option value="{{ $phuong }}" selected>{{ $phuong }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-12 form-group">
                            <input name="addressDetail" value="{{ old('addressDetail', $user->address ?? '') }}" class="form-control" type="text" placeholder="Số nhà, tên đường...">
                            @error('addressDetail')
                            <span class="text-danger">(*){{ $message }}</span>
                            @enderror
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
                    <div class="pt-5">
                        <div class="owl-carousel owl-theme">
                            <!-- Voucher Cards -->
                            @foreach ($vouchers as $discountCode)
                            <div class="card text-center" style="width: 18rem;">
                                <div class="card-header bg-primary text-white h6">
                                    Mã Giảm Giá
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title h6">
                                        @if ($discountCode->type == 'percentage')
                                        Giảm {{ $discountCode->discount }}%
                                        @elseif ($discountCode->type == 'fixed')
                                        Giảm {{ number_format($discountCode->discount, 2) }} VNĐ
                                        @else
                                        Giảm tối đa {{ number_format($discountCode->max_discount, 2) }} VNĐ
                                        @endif
                                    </h5>
                                    <input type="text" class="form-control text-center discount-code" value="{{ $discountCode->code }}" readonly>
                                    <button class="btn btn-outline-success mt-2 copy-btn">Sao chép mã</button>

                                    <!-- Show quantity and expiration date -->
                                    <div class="mt-3">
                                        <small class="text-muted">
                                            Số lượng còn lại: {{ max($discountCode->quantity - $discountCode->used_count, 0) }}
                                        </small>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-muted">
                                            Hạn sử dụng: {{ \Carbon\Carbon::parse($discountCode->expiry_date)->format('d/m/Y') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
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
<script src="https://esgoo.net/scripts/jquery.js"></script>
<style type="text/css">
    .css_select_div {
        text-align: center;
    }

    .css_select {
        display: inline-table;
        width: 25%;
        padding: 5px;
        margin: 5px 2%;
        border: solid 1px #686868;
        border-radius: 5px;
    }
</style>
<script>
    $(document).ready(function() {
        //Lấy tỉnh thành
        $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm', function(data_tinh) {
            if (data_tinh.error == 0) {
                $.each(data_tinh.data, function(key_tinh, val_tinh) {
                    $("#tinh").append('<option value="' + val_tinh.id + '">' + val_tinh.full_name + '</option>');
                });
                $("#tinh").change(function(e) {
                    var idtinh = $(this).val();
                    //Lấy quận huyện
                    $.getJSON('https://esgoo.net/api-tinhthanh/2/' + idtinh + '.htm', function(data_quan) {
                        if (data_quan.error == 0) {
                            $("#quan").html('<option value="0">Quận Huyện</option>');
                            $("#phuong").html('<option value="0">Phường Xã</option>');
                            $.each(data_quan.data, function(key_quan, val_quan) {
                                $("#quan").append('<option value="' + val_quan.id + '">' + val_quan.full_name + '</option>');
                            });
                            //Lấy phường xã
                            $("#quan").change(function(e) {
                                var idquan = $(this).val();
                                $.getJSON('https://esgoo.net/api-tinhthanh/3/' + idquan + '.htm', function(data_phuong) {
                                    if (data_phuong.error == 0) {
                                        $("#phuong").html('<option value="0">Phường Xã</option>');
                                        $.each(data_phuong.data, function(key_phuong, val_phuong) {
                                            $("#phuong").append('<option value="' + val_phuong.id + '">' + val_phuong.full_name + '</option>');
                                        });
                                    }
                                });
                            });

                        }
                    });
                });

            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Khởi tạo Owl Carousel
        var owl = $(".owl-carousel");
        owl.owlCarousel({
            items: 4, // Hiển thị 4 phần tử cùng lúc
            loop: true, // Lặp lại vòng quay
            margin: 10, // Khoảng cách giữa các phần tử
            autoplay: true, // Tự động chạy
            autoplayTimeout: 3000, // Thời gian giữa các lần tự động chuyển slide
            autoplayHoverPause: true, // Tạm dừng khi hover
            nav: true, // Hiển thị nút điều hướng
            dots: false, // Tắt điểm phân trang
            slidesToScroll: 10, // Cuộn 4 phần tử cùng lúc
        });

        // Hàm sao chép mã giảm giá
        $('.copy-btn').click(function(event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định (refresh trang)
            var discountCode = $(this).closest('.card').find('.discount-code');
            var codeValue = discountCode.val(); // Lấy giá trị của mã giảm giá
            discountCode.select();
            document.execCommand('copy'); // Sao chép vào clipboard
            Swal.fire(
                'Đã sao chép!',
                'Mã giảm giá ' + codeValue + ' đã được sao chép.',
                'success'
            ); // Hiển thị thông báo với tên mã giảm giá
        });

        // Tùy chọn: Di chuyển bước tùy chỉnh (nấc) với các nút next/prev
        $('.owl-next').click(function() {
            owl.trigger('next.owl.carousel', [4]); // Di chuyển 4 phần tử
        });

        $('.owl-prev').click(function() {
            owl.trigger('prev.owl.carousel', [4]); // Di chuyển lùi 4 phần tử
        });
    });
</script>

@endsection