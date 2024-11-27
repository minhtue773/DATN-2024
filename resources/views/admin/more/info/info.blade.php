@extends('admin.layout.app')
@section('title')
    Thông tin website
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.configuration') }}">Thiết lập chung</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thông tin website</li>
                </ol>
            </nav>
            <form action="{{ route('admin.configuration.updateInfo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 order-2 order-md-1">
                        <div class="card border-top-primary shadow">
                            <div class="card-header text-gray-800">
                                Thiết lập
                            </div>
                            <div class="card-body">
                                <h5 class="text-center">Thông tin chính</h5>
                                <div class="border border-bottom-danger mb-3"></div>    
                                <div class="row">
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 mb-3">
                                        <label class="form-label">Tên website <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nhập tên webiste" name="site_name" value="{{ old('site_name', $setting['site_name'] ?? '')}}">
                                        @error('site_name')
                                            <span class="text-danger m-0 mt-2">* {{ $message }}</span>
                                        @enderror
                                    </div>                                
                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6 mb-3">
                                        <label class="form-label">Tên công ty <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nhập tên công ty" name="company_name" value="{{ old('company_name', $setting['company_name'] ?? '')}}">
                                        @error('company_name')
                                            <span class="text-danger m-0 mt-2">* {{ $message }}</span>
                                        @enderror
                                    </div>                                
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nhập email" name="email" value="{{ old('email', $setting['email'] ?? '')}}">
                                        @error('email')
                                            <span class="text-danger m-0 mt-2">* {{ $message }}</span>
                                        @enderror
                                    </div>                                
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                        <label class="form-label">Hotline <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nhập số điện thoại" name="phone_number" value="{{ old('phone_number', $setting['phone_number'] ?? '')}}">
                                        @error('phone_number')
                                            <span class="text-danger m-0 mt-2">* {{ $message }}</span>
                                        @enderror
                                    </div>                                
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                        <label class="form-label">Địa chỉ <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nhập địa chỉ" name="address" value="{{ old('address', $setting['address'] ?? '')}}">
                                        @error('address')
                                            <span class="text-danger m-0 mt-2">* {{ $message }}</span>
                                        @enderror
                                    </div>                                
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-3">
                                        <label class="form-label">Bản đồ: (Link nhúng) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nhập link nhúng bản đồ" name="map" value="{{ old('map', $setting['map'] ?? '')}}">
                                        @error('map')
                                            <span class="text-danger m-0 mt-2">* {{ $message }}</span>
                                        @enderror
                                    </div>  
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Mô tả ngắn của website <span class="text-danger">*</span></label>
                                        <textarea class="form-control form-control-sm" placeholder="Nhập mô tả" name="description_company">{{ old('description_company', $setting['description_company'] ?? '')}} </textarea>
                                        @error('description_company')
                                            <span class="text-danger m-0 mt-2">* {{ $message }}</span>
                                        @enderror
                                    </div>  
                                </div>
                                <h5 class="text-center">Mạng xã hội</h5>
                                <div class="border border-bottom-danger mb-3"></div>   
                                <div class="row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text socical-btn" style="min-width: 150px"><i class="bi bi-facebook me-1"></i>/facebook</span>
                                        <input type="text" class="form-control" placeholder="Chưa có link" name="facebook" value="{{ old('facebook', $setting['facebook'] ?? '')}}">
                                        @error('facebook')
                                            <span class="text-danger m-0 mt-2">* {{ $message }}</span>
                                        @enderror
                                    </div>                                      
                                    <div class="input-group mb-3">
                                        <span class="input-group-text socical-btn" style="min-width: 150px"><i class="bi bi-tiktok me-1"></i>/tiktok</span>
                                        <input type="text" class="form-control" placeholder="Chưa có link" name="tiktok" value="{{ old('tiktok', $setting['tiktok'] ?? '')}}">
                                        @error('tiktok')
                                            <span class="text-danger m-0 mt-2">* {{ $message }}</span>
                                        @enderror
                                    </div>                                      
                                    <div class="input-group mb-3">
                                        <span class="input-group-text socical-btn" style="min-width: 150px"><i class="bi bi-instagram me-1"></i>/instagram</span>
                                        <input type="text" class="form-control" placeholder="Chưa có link" name="instagram" value="{{ old('instagram', $setting['instagram'] ?? '')}}">
                                        @error('instagram')
                                            <span class="text-danger m-0 mt-2">* {{ $message }}</span>
                                        @enderror
                                    </div>                                      
                                    <div class="input-group mb-3">
                                        <span class="input-group-text socical-btn" style="min-width: 150px"><i class="bi bi-youtube me-1"></i>/youtube</span>
                                        <input type="text" class="form-control" placeholder="Chưa có link" name="youtube" value="{{ old('youtube', $setting['youtube'] ?? '')}}">
                                        @error('youtube')
                                            <span class="text-danger m-0 mt-2">* {{ $message }}</span>
                                        @enderror
                                    </div>                                      
                                    <div class="input-group mb-3">
                                        <span class="input-group-text socical-btn" style="min-width: 150px"><i class="bi bi-twitter me-1"></i>/twitter</span>
                                        <input type="text" class="form-control" placeholder="Chưa có link" name="twitter" value="{{ old('twitter', $setting['twitter'] ?? '')}}">
                                        @error('twitter')
                                            <span class="text-danger m-0 mt-2">* {{ $message }}</span>
                                        @enderror
                                    </div>                                  
                                    <div class="input-group mb-3">
                                        <span class="input-group-text socical-btn" style="min-width: 150px"><i class="bi bi-linkedin me-1"></i>/linkedin</span>
                                        <input type="text" class="form-control" placeholder="Chưa có link" name="linkedin" value="{{ old('linkedin', $setting['linkedin'] ?? '')}}">
                                        @error('linkedin')
                                            <span class="text-danger m-0 mt-2">* {{ $message }}</span>
                                        @enderror
                                    </div>                                  
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm me-2"><i class="fa-solid fa-floppy-disk me-2"></i>Cập nhật</button>
                                <a href="{{ route('admin.configuration') }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-right-from-bracket me-2"></i>Thoát</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-3 order-1 order-md-2 no-gutters">
                        <div class="col-12 mb-3">
                            <div class="card border-top-primary shadow">
                                <div class="card-header text-gray-800">
                                    Favicon <span class="text-danger">*</span>
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-12">
                                            <div class="photoUpload-zone" id="photo-zone">
                                                <img src="{{ asset('uploads/images/favicon') }}/{{$setting['img_favicon']}}" id="preview-favicon" class="img-fluid col-9 w-25">
                                                <div class="lable-zone">
                                                    <label class="photoUpload-file" for="file-favicon">
                                                        <input type="file" name="favicon" id="file-favicon" onchange="previewImage(event, 'preview-favicon')">
                                                        <div class="d-flex flex-column justify-content-center ">
                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                            <p class="photoUpload-choose btn btn-outline-primary btn-sm">Chọn hình</p>
                                                        </div>
                                                        @error('favicon')
                                                            <span class="text-danger m-0 mt-2">* {{ $message }}</span>
                                                        @enderror
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <div class="card border-top-primary shadow">
                                <div class="card-header text-gray-800">
                                    Logo website <span class="text-danger">*</span>
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-12">
                                            <div class="photoUpload-zone" id="photo-zone">
                                                <img src="{{ asset('uploads/images/logo') }}/{{$setting['img_logo']}}" id="preview-logo" class="img-fluid w-50 col-9">
                                                <div class="lable-zone">
                                                    <label class="photoUpload-file" for="file-logo">
                                                        <input type="file" name="logo" id="file-logo" onchange="previewImage(event, 'preview-logo')">
                                                        <div class="d-flex flex-column justify-content-center ">
                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                            <p class="photoUpload-choose btn btn-outline-primary btn-sm">Chọn hình</p>
                                                        </div>
                                                        @error('logo')
                                                            <span class="text-danger m-0 mt-2">* {{ $message }}</span>
                                                        @enderror
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function previewImage(event, previewId) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById(previewId);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection