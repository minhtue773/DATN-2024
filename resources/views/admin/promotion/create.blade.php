@extends('admin.layout.app')
@section('title')
    Thêm mã khuyến mãi
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.promotion.index') }}">Khuyến mãi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm mã khuyến mãi</li>
                </ol>
            </nav>
            <a href="{{ route('admin.promotion.index') }}" class="btn btn-danger btn-sm mb-3"><i class="fa-solid fa-right-from-bracket me-2"></i>Thoát</a>
            <form action="{{ route('admin.promotion.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-8">
                        <div class="card border-top-primary shadow">
                            <div class="card-header text-gray-800">
                                Thông tin khuyến mãi
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Tên mã khuyến mãi:</label>
                                        <input type="text" name="name" class="form-control form-control-sm" placeholder="Nhập tên mã khuyến mãi..." required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Mã code:</label>
                                        <input type="text" name="code" class="form-control form-control-sm" placeholder="Nhập mã code..." required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Giảm giá (%):</label>
                                        <input type="number" name="discount" class="form-control form-control-sm" placeholder="Nhập phần trăm giảm giá..." required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Số lượng:</label>
                                        <input type="number" name="quantity" class="form-control form-control-sm" placeholder="Nhập số lượng mã..." required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Ngày bắt đầu:</label>
                                        <input type="date" name="start_date" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Ngày kết thúc:</label>
                                        <input type="date" name="end_date" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Trạng thái:</label>
                                        <select name="status" class="form-select form-select-sm">
                                            <option value="1">Kích hoạt</option>
                                            <option value="0">Không kích hoạt</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm me-2"><i class="fa-solid fa-floppy-disk me-2"></i>Thêm mới</button>
                                <a href="{{ route('admin.promotion.index') }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-right-from-bracket me-2"></i>Thoát</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mb-3">
                        <div class="card border-top-primary shadow">
                            <div class="card-header text-gray-800">
                                Hình banner khuyến mãi
                            </div>
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-12">
                                        <div class="photoUpload-zone" id="photo-zone">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" id="preview-image" class="img-fluid col-9">
                                            <div class="lable-zone">
                                                <label class="photoUpload-file" for="file-zone">
                                                    <input type="file" name="file" id="file-zone" onchange="previewImage(event)">
                                                    <div class="d-flex flex-column justify-content-center ">
                                                        <i class="fas fa-cloud-upload-alt"></i>
                                                        <p class="photoUpload-choose btn btn-outline-primary btn-sm">Chọn hình</p>
                                                    </div>
                                                </label>
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
        function previewBanner(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview-banner');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
