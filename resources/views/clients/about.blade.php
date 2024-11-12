@extends('clients.layout.app')
@section('title')

@endsection
@section('content')
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Giới thiệu</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="/">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Giới thiệu</p>
        </div>
    </div>
</div>
<div class="container mt-5">
    @php
    // Chuyển đổi $websiteSettings thành một mảng cho dễ sử dụng
    $settingsArray = $websiteSettings->keyBy('setting_key')->toArray();
    @endphp
    <div class="row mt-4 align-items-center" style="height: 400px;"> <!-- Thiết lập chiều cao cho hàng -->
        <div class="col-md-6 text-justify">
            <h2>Về Chúng Tôi</h2>
            <p>HobbyZone là trang web chuyên bán các mô hình sưu tập tại TP.HCM, mang đến cho khách hàng đam mê mô hình một không gian mua sắm trực tuyến phong phú và chuyên nghiệp. Trang web cung cấp đa dạng các loại mô hình từ xe hơi, máy bay, đến nhân vật nổi tiếng, giúp khách hàng dễ dàng tìm thấy các sản phẩm yêu thích. Với giao diện thân thiện, thông tin chi tiết và hình ảnh sắc nét, HobbyZone cam kết mang lại trải nghiệm mua sắm thuận tiện và đáng tin cậy cho các tín đồ mô hình ở mọi lứa tuổi.
            </p>
            <h4>Liên hệ:</h4>
            <ul class="list-unstyled">
                <li>Địa chỉ: {{ $settingsArray['address']['setting_value'] ?? 'Địa chỉ chưa được cập nhật' }}</li>
                <li>SĐT: {{ $settingsArray['phone']['setting_value'] ?? '+012 345 67890' }}</li>
                <li>Email: {{ $settingsArray['email']['setting_value'] ?? 'Email chưa được cập nhật' }}</li>
            </ul>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('uploads/images/favicon/favicon.png') }}" alt="Hình ảnh về chúng tôi" class="img-fluid rounded">
        </div>
    </div>
</div>
@endsection