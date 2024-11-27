@extends('admin.layout.app')
@section('title')
    Thêm người dùng
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Quản lý tài khoản</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm người dùng</li>
                </ol>
            </nav>
            <a href="{{ route('admin.user.index') }}" class="btn btn-danger btn-sm mb-3"><i class="fa-solid fa-right-from-bracket me-2"></i>Thoát</a>
            <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 order-2 order-md-1">
                        <div class="card border-top-primary shadow">
                            <div class="card-header text-gray-800">
                                Thông tin người dùng
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Email: <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control form-control-sm" placeholder="Nhập email..." name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Mật khẩu: <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control form-control-sm" placeholder="Nhập mật khẩu..." name="password">
                                        @error('password')
                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Tên người dùng: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nhập tên..." name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Số điện thoại:</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nhập số điện thoại..." name="phone_number" value="{{ old('phone_number') }}">
                                        @error('phone_number')
                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Địa chỉ:</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nhập địa chỉ..." name="address" value="{{ old('address') }}">
                                        @error('address')
                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Giới tính:</label>
                                        <select class="form-select form-select-sm" name="gender">
                                            <option value="other">Other</option>
                                            <option value="male">Nam</option>
                                            <option value="female">Nữ</option>
                                        </select>
                                        @error('gender')
                                            <p class="text-danger m-0 mt-1">* {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Ngày sinh:</label>
                                        <input type="date" class="form-control form-control-sm" name="birthday" value="{{ old('birthday') }}">
                                        @error('birthday')
                                            <p class="text-danger m-0 mt-1">* {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Vai trò:</label>
                                        <select class="form-select form-select-sm" name="role">
                                            <option value="customer">Khách hàng</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                        @error('role')
                                            <p class="text-danger m-0 mt-1">* {{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm me-2"><i class="fa-solid fa-floppy-disk me-2"></i>Thêm mới</button>
                                <a href="{{ route('admin.user.index') }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-right-from-bracket me-2"></i>Thoát</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-3 order-1 order-md-2 no-gutters">
                        <div class="col-12 mb-3">
                            <div class="card border-top-primary shadow">
                                <div class="card-header text-gray-800">
                                    Ảnh đại diện
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-12">
                                            <div class="photoUpload-zone" id="photo-zone">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" id="preview-image" class="img-fluid col-9">
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
