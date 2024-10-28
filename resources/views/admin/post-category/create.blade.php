@extends('admin.layout.app')
@section('title')
    Thêm chuyên mục
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Chuyên mục</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm chuyên mục</li>
                </ol>
            </nav>
            <a href="{{ route('admin.post-category.index') }}" class="btn btn-danger btn-sm mb-3"><i class="fa-solid fa-right-from-bracket me-2"></i>Thoát</a>
            <form action="{{ route('admin.post-category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-8">
                        <div class="card border-top-primary shadow">
                            <div class="card-header text-gray-800">
                                Thông tin chuyên mục
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Tên chuyên mục:</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nhập tên..." name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Thứ tự:</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">#</span>
                                            <input type="number" class="form-control" name="order_number" value="{{ old('order_number') ?? 0 }}" >
                                            @error('order_number')
                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
                                            @enderror
                                        </div>                                                                      
                                    </div>                                                       
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm me-2"><i class="fa-solid fa-floppy-disk me-2"></i>Thêm mới</button>
                                <a href="{{ route('admin.post-category.index') }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-right-from-bracket me-2"></i>Thoát</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 no-gutters">
                        <div class="col-12 mb-3">
                            <div class="card border-top-primary shadow">
                                <div class="card-header text-gray-800">
                                    Ảnh chuyên mục
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