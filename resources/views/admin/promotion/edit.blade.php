@extends('admin.layout.app')
@section('title')
    Cập nhật mã khuyến mãi
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.promotion.index') }}">Mã khuyến mãi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mã khuyến mãi: PROMO123</li>
                </ol>
            </nav>
            <a href="{{ route('admin.promotion.index') }}" class="btn btn-danger btn-sm mb-3"><i class="fa-solid fa-right-from-bracket me-2"></i>Thoát</a>
            <form action="">
                <div class="row">
                    <div class="col-8">
                        <div class="card border-top-primary shadow">
                            <div class="card-header text-gray-800">
                                Thông tin mã khuyến mãi
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Mã khuyến mãi:</label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Nhập mã..." value="PROMO123">
                                    </div>                                      
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Tên khuyến mãi:</label>
                                        <input type="text" class="form-control form-control-sm" value="Giảm giá mùa thu">
                                    </div>                                      
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Giá trị (%):</label>
                                        <input type="text" class="form-control form-control-sm" value="20">
                                    </div>                                      
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Ngày bắt đầu:</label>
                                        <input type="date" class="form-control form-control-sm" value="2024-10-01">
                                    </div>  
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Ngày kết thúc:</label>
                                        <input type="date" class="form-control form-control-sm" value="2024-10-31">
                                    </div>        
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Trạng thái:</label>
                                        <select class="form-select form-select-sm">
                                            <option value="active" selected>Hoạt động</option>
                                            <option value="inactive">Ngừng hoạt động</option>
                                        </select>
                                    </div>                                   
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm me-2"><i class="fa-solid fa-floppy-disk me-2"></i>Cập nhật</button>
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
                                            <img src="https://bizweb.dktcdn.net/100/445/498/files/sub-banner3.png?v=1647834070787" id="preview-image" class="img-fluid col-9">
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
