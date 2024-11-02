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
        <div class="col-md-6 text-center">
            <h2>Về Chúng Tôi</h2>
            <p>{{ $settingsArray['company_description']['setting_value'] ?? 'Chúng tôi là một đội ngũ đam mê với sứ mệnh cung cấp các sản phẩm và dịch vụ tốt nhất cho khách hàng. Với nhiều năm kinh nghiệm trong ngành, chúng tôi cam kết mang đến giá trị và sự hài lòng cho từng khách hàng.' }}</p>
            <h4>Liên hệ:</h4>
            <ul class="list-unstyled">
                <li>Địa chỉ: {{ $settingsArray['address']['setting_value'] ?? 'Địa chỉ chưa được cập nhật' }}</li>
                <li>SĐT: {{ $settingsArray['phone']['setting_value'] ?? '+012 345 67890' }}</li>
                <li>Email: {{ $settingsArray['email']['setting_value'] ?? 'Email chưa được cập nhật' }}</li>
            </ul>
        </div>
        <div class="col-md-6">
            <img src="{{ $settingsArray['img_favicon']['setting_value'] ?? 'https://via.placeholder.com/400' }}" alt="Hình ảnh về chúng tôi" class="img-fluid rounded">
        </div>
    </div>
</div>
@endsection