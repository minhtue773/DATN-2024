@extends('clients.layout.app')
@section('title')

@endsection
@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Liên Hệ</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="/">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Liên hệ</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Contact For Any Queries</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form">
                
                <form method="post" action="{{ url('/guilienhe') }}">
                    <div class="control-group">
                        <input type="text" class="form-control"  name="ht" placeholder="Họ và tên"
                            required="required" data-validation-required-message="Please enter your name" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="email" class="form-control" name="em"  placeholder="Email"
                            required="required" data-validation-required-message="Please enter your email" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <textarea class="form-control" rows="6" name="nd"  placeholder="Nội dung liên hệ..."
                            required="required"
                            data-validation-required-message="Please enter your message"></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div>
                        @csrf
                        <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Gửi liên hệ</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 mb-5">
            @php
            // Chuyển đổi $websiteSettings thành một mảng cho dễ sử dụng
            $settingsArray = $websiteSettings->keyBy('setting_key')->toArray();
            @endphp
            <h5 class="font-weight-semi-bold mb-3">Liên hệ với chúng tôi</h5>
            <p>{{ $settingsArray['company_description']['setting_value'] ?? 'Địa chỉ chưa được cập nhật' }}</p>

            <div class="d-flex flex-column mb-3">
                <h5 class="font-weight-semi-bold mb-3">Cửa hàng</h5>



                <p class="mb-2">
                    <i class="fa fa-map-marker-alt text-primary mr-3"></i>
                    {{ $settingsArray['address']['setting_value'] ?? 'Địa chỉ chưa được cập nhật' }}
                </p>

                <p class="mb-2">
                    <i class="fa fa-envelope text-primary mr-3"></i>
                    {{ $settingsArray['email']['setting_value'] ?? 'Email chưa được cập nhật' }}
                </p>

                <p class="mb-2">
                    <i class="fa fa-phone-alt text-primary mr-3"></i>
                    {{ $settingsArray['phone']['setting_value'] ?? '+012 345 67890' }}
                </p>
            </div>
        </div>

    </div>
    <div class="google-map-section">
        <div class="container-fluid">
            <div class="google-map plr-185">
                <!-- Thay thế div cũ bằng iframe Google Maps -->
                <iframe
                    src=" {{ $settingsArray['map']['setting_value'] }}"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection