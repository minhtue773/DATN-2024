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
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-8">
                        <div class="card border-top-primary shadow">
                            <div class="card-header text-gray-800">
                                Thiết lập
                            </div>
                            <div class="card-body">
                                <h5 class="text-center">Thông tin chính</h5>
                                <div class="border border-bottom-danger mb-3"></div>    
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Tên website:</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="..." name="site_name" value="{{ $setting['site_name'] }}">
                                        @error('name')
                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
                                        @enderror
                                    </div>                                
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Tên công ty:</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="..." name="company_name" value="{{ $setting['site_name'] }}">
                                        @error('name')
                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
                                        @enderror
                                    </div>                                
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Email:</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="..." name="email" value="{{ $setting['email'] }}">
                                        @error('name')
                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
                                        @enderror
                                    </div>                                
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Hotline:</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="..." name="phone_number" value="{{ $setting['phone_number'] }}">
                                        @error('name')
                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
                                        @enderror
                                    </div>                                
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Địa chỉ:</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="..." name="address" value="{{ $setting['address'] }}">
                                        @error('name')
                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
                                        @enderror
                                    </div>                                
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Bản đồ: (Link nhúng)</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="..." name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
                                        @enderror
                                    </div>  
                                </div>
                                <h5 class="text-center">Mạng xã hội</h5>
                                <div class="border border-bottom-danger mb-3"></div>   
                                <div class="row">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" style="min-width: 150px"><i class="bi bi-facebook me-1"></i>/facebook</span>
                                        <input type="text" class="form-control" placeholder="Url...">
                                    </div>                                      
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" style="min-width: 150px"><i class="bi bi-tiktok me-1"></i>/tiktok</span>
                                        <input type="text" class="form-control" placeholder="Url...">
                                    </div>                                      
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" style="min-width: 150px"><i class="bi bi-instagram me-1"></i>/instagram</span>
                                        <input type="text" class="form-control" placeholder="Url...">
                                    </div>                                      
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" style="min-width: 150px"><i class="bi bi-youtube me-1"></i>/youtube</span>
                                        <input type="text" class="form-control" placeholder="Url...">
                                    </div>                                      
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" style="min-width: 150px"><i class="bi bi-twitter me-1"></i>/twitter</span>
                                        <input type="text" class="form-control" placeholder="Url...">
                                    </div>                                  
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" style="min-width: 150px"><i class="bi bi-linkedin me-1"></i>/linkedin</span>
                                        <input type="text" class="form-control" placeholder="Url...">
                                    </div>                                  
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm me-2"><i class="fa-solid fa-floppy-disk me-2"></i>Cập nhật</button>
                                <a href="{{ route('admin.configuration') }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-right-from-bracket me-2"></i>Thoát</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 no-gutters">
                        <div class="col-12 mb-3">
                            <div class="card border-top-primary shadow">
                                <div class="card-header text-gray-800">
                                    Favicon
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-12">
                                            <div class="photoUpload-zone" id="photo-zone">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" id="preview-image" class="img-fluid col-9 w-25">
                                                <div class="lable-zone">
                                                    <label class="photoUpload-file" for="file-zone">
                                                        <input type="file" name="photo" id="file-zone" onchange="previewImage(event)">
                                                        <div class="d-flex flex-column justify-content-center ">
                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                            <p class="photoUpload-choose btn btn-outline-primary btn-sm">Chọn hình</p>
                                                        </div>
                                                        @error('photo')
                                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
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
                                    Logo website
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-12">
                                            <div class="photoUpload-zone" id="photo-zone">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" id="preview-image" class="img-fluid w-50 col-9">
                                                <div class="lable-zone">
                                                    <label class="photoUpload-file" for="file-zone">
                                                        <input type="file" name="photo" id="file-zone" onchange="previewImage(event)">
                                                        <div class="d-flex flex-column justify-content-center ">
                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                            <p class="photoUpload-choose btn btn-outline-primary btn-sm">Chọn hình</p>
                                                        </div>
                                                        @error('photo')
                                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
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
        function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview-image');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection