@extends('admin.layout.app')
@section('title')
    Cập nhật chuyên mục
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.post-category.index') }}">Chuyên mục bài viết</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cập nhật {{ $postCategory->name }}</li>
                </ol>
            </nav>
            <a href="{{ route('admin.post-category.index') }}" class="btn btn-danger btn-sm mb-3"><i class="fa-solid fa-right-from-bracket me-2"></i>Thoát</a>
            <form action="{{ route('admin.post-category.update', $postCategory) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 order-2 order-md-1">
                        <div class="card border-top-primary shadow">
                            <div class="card-header text-gray-800">
                                Thông tin chuyên mục
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Tên chuyên mục:</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nhập tên..." name="name" value="{{ $postCategory->name ?? old('name') }}">
                                        @error('name')
                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Thứ tự:</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">#</span>
                                            <input type="number" class="form-control" name="order_number" value="{{ $postCategory->order_number ?? old('order_number') }}" >
                                            @error('order_number')
                                            <p class="text-danger m-0 mt-2">* {{ $message }}</p>
                                            @enderror
                                        </div>                                                                      
                                    </div>   
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm me-2"><i class="fa-solid fa-floppy-disk me-2"></i>Lưu</button>
                                <a href="{{ route('admin.post-category.index') }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-right-from-bracket me-2"></i>Thoát</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-3 order-1 order-md-2 no-gutters">
                        <div class="col-12 mb-3">
                            <div class="card border-top-primary shadow">
                                <div class="card-header text-gray-800">
                                    Ảnh chuyên mục
                                </div>
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-12">
                                            <div class="photoUpload-zone" id="photo-zone">
                                                <img src="{{ !empty($postCategory->image) ? asset('uploads/images/post_category'.$postCategory->image) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQs9gUXKwt2KErC_jWWlkZkGabxpeGchT-fyw&s' }}" id="preview-image" class="img-fluid col-9">
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