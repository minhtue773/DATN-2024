@extends('clients.layout.app')
<link rel="stylesheet" href="{{asset('client/css/my_account.css')}}">
@section('title')
Thông tin tài khoản
@endsection
@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">THÔNG TIN TÀI KHOẢN</h1>
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
        <div class="container-xl px-4 mt-4">
            <!-- Account page navigation-->
            <nav class="nav nav-borders">
                <a class="nav-link active ms-0" href="{{route('my_account')}}">Thông tin cá nhân</a>
                <a class="nav-link" href="{{route('orders')}}">Đơn hàng của tôi</a>

            </nav>
            <hr class="mt-0 mb-4">
            <form action="{{ route('account.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0" style="border: 2px solid; border-radius:5px; ">
                            <div class="card-header">Ảnh đại diện</div>
                            <div class="card-body">
                                <!-- Profile picture image-->
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <div class="img-account-profile-container mb-2">
                                        <img class="img-account-profile border-0 rounded-circle" style="width: 200px; height: 200px;" id="output" src="{{asset('uploads/images/user/' . $user->image)}}">
                                    </div>
                                    <div>
                                        <input type="file" accept="image/*" onchange="loadFile(event)" name="photo" class="form-control mb-3">
                                        @error('photo')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-4" style="border: 2px solid; border-radius:5px; ">
                            <div class="card-header">Thông tin chi tiết</div>
                            <div class="card-body">

                                <!-- Form Group (username)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputUsername">Tên người dùng</label>
                                    <input class="form-control" style="border: 2px solid; border-radius:5px; " id="inputUsername" type="text" name="name" value="{{ $user->name ?? null }}" placeholder="Enter your username">
                                </div>
                                <!-- Form Row-->
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputEmailAddress">Địa chỉ email</label>
                                    <input class="form-control" style="border: 2px solid; border-radius:5px; " id="inputEmailAddress" type="email" name="email" value="{{ $user->email ?? null }}" placeholder="Enter your email address">
                                </div>
                                <!-- Form Row-->
                                <div class="row mb-3">
                                    <!-- Form Group (phone number)-->
                                    <div class="col-md-12">
                                        <label class="small mb-1" for="inputPhone">Số điện thoại</label>
                                        <input class="form-control" style="border: 2px solid; border-radius:5px; " id="inputPhone" type="text" name="phone_number" value="{{ $user->phone_number ?? null }}" placeholder="Enter your phone number" value="555-123-4567">
                                    </div>
                                    <!-- Form Group (birthday)-->

                                </div>
                                <div class="row mb-3">
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
                                        <input name="addressDetail" style="border: 2px solid; border-radius:5px; " value="{{ $addressDetail ?? '' }}" class="form-control" type="text" placeholder="Số nhà, Tên đường...">
                                    </div>
                                </div>

                                <!-- Save changes button-->
                                <button class="btn btn-primary" style="float:right;border: 2px solid; border-radius:5px; width:25%;" type="submit">Lưu </button>

                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>


    </div>
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Mô Hình Yêu Thích</span></h2>
        </div>
        <div style="max-width: 1640px; margin:auto" class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($favoriteProducts as $product)
                    <div class="card product-item border-0">

                        <div
                            class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">

                            <img class="img-fluid w-100" style="max-height: 420px;" src="{{ asset('uploads/images/product/' . $product->image) }}"
                                alt="{{ $product->name }}">
                            @if ($product->stock == 0)
                            <div class="sold-out-overlay">
                                <span class="sold-out-text">Hết hàng</span>
                            </div>
                            @endif
                            <!-- Wishlist button -->
                            @auth
                            <a href="#"
                                class="wishlist-toggle btn btn-sm text-dark p-0 {{ Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'favorited' : '' }}"
                                data-product-id="{{ $product->id }}"
                                data-status="{{ Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'favorited' : '' }}"
                                title="{{ Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'Bỏ thích' : 'Thích' }}">
                                <i class="fas fa-heart {{ Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'text-danger' : 'text-primary' }} mr-1"></i>
                                <span class="wishlist-text">{{ Auth::user()->favorites()->where('product_id', $product->id)->exists() ? 'Bỏ thích' : 'Thích' }}</span>
                            </a>
                            @endauth

                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <a href="{{ route('product.detail', $product->slug) }}">
                                <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                            </a>
                            <div class="d-flex justify-content-center">
                                <h6>{{ number_format($product->price - ($product->price * $product->discount / 100), 2) }} đ</h6>
                                @if($product->discount > 0)
                                <h6 class="text-muted ml-2"><del>{{ number_format($product->price, 2) }} đ</del></h6>
                                @endif



                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="{{ route('product.detail', $product->slug) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem</a>
                            @if ($product->stock == 0)
                            <a href="javascript:void(0);" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Hết hàng</a>
                            @else
                            <a href="javascript:void(0);" class="btn btn-sm text-dark p-0" ng-click="addToCart({{ $product->id }}, 1, {{ $product->stock }})"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm</a>
                            @endif
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- LOGIN SECTION END -->
</div>
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
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
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
@endsection