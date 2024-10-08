@extends('admin.layout.app')
@section('title')
    Bài viết
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bài viết</li>
                </ol>
            </nav>
            <div class="card border-top-primary shadow">
                <div class="card-body">
                    <div class="row mt-2">
                        <h4 class="text-gray-800 mb-3">Danh sách bài viết</h4>
                        <div class="row mb-3">
                            <div class="d-flex">
                                <a href="{{ route('admin.post.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-plus me-1"></i>Bài viết mới
                                </a>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <form action="">                                    
                                    <div class="input-group">
                                        <input type="search" id="form1" class="form-control-sm" placeholder="Tìm bài viết...." style="border: 1px solid #0d6efd; outline:none"/>
                                        <button type="button" class="btn btn-primary btn-sm">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    Tất cà chuyên mục
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <li><a class="dropdown-item" href="#">Chuyên mục 1</a></li>
                                    <li><a class="dropdown-item" href="#">Chuyên mục 2</a></li>
                                    <li><a class="dropdown-item" href="#">Chuyên mục 3</a></li>
                                </ul>
                                <button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Tất cà lựa chọn
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Mới nhất</a></li>
                                    <li><a class="dropdown-item" href="#">Cũ nhất</a></li>
                                    <li><a class="dropdown-item" href="#">Chuyên mục 3</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <form action="">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5%"><input type="checkbox"></th>
                                            <th>Hình</th>
                                            <th>Tiêu đề</th>
                                            <th>Tác giả</th>
                                            <th>Chuyên mục</th>
                                            <th>Thời gian</th>
                                            <th>Trạng thái</th>
                                            <th colspan="3" width="15%">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td><input type="checkbox"></td>
                                            <td><img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                            <td>Bài viết số 1</td>
                                            <td>Admin</td>
                                            <td>Amine</td>
                                            <td>20-08-2024</td>
                                            <td><span class="badge badge-primary rounded-pill d-inline">Đã xuất bản</span></td>
                                            <td><a href=""><i class="fa-solid fa-eye text-success"></i></a></td>
                                            <td><a href="{{route('admin.post.edit',1)}}"><i class="fa fa-edit text-primary"></i></a></td>
                                            <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td><input type="checkbox"></td>
                                            <td><img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                            <td>Bài viết số 2</td>
                                            <td>Admin</td>
                                            <td>Amine</td>
                                            <td>23-08-2024</td>
                                            <td><span class="badge badge-success rounded-pill d-inline">Chưa xuất bản</span></td>
                                            <td><a href="/admin/home" target="_blank"><i class="fa-solid fa-eye text-success"></i></a></td>
                                            <td><a href="{{route('admin.post.edit',1)}}"><i class="fa fa-edit text-primary"></i></a></td>
                                            <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td><input type="checkbox"></td>
                                            <td><img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                            <td>Bài viết số 3</td>
                                            <td>Admin</td>
                                            <td>Amine</td>
                                            <td>23-08-2024</td>
                                            <td><span class="badge badge-primary rounded-pill d-inline">Đã xuất bản</span></td>
                                            <td><a href="/admin/home" target="_blank"><i class="fa-solid fa-eye text-success"></i></a></td>
                                            <td><a href="{{route('admin.post.edit',1)}}"><i class="fa fa-edit text-primary"></i></a></td>
                                            <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td><input type="checkbox"></td>
                                            <td><img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                            <td>Bài viết số 4</td>
                                            <td>Admin</td>
                                            <td>Amine</td>
                                            <td>23-08-2024</td>
                                            <td><span class="badge badge-primary rounded-pill d-inline">Đã xuất bản</span></td>
                                            <td><a href="/admin/home" target="_blank"><i class="fa-solid fa-eye text-success"></i></a></td>
                                            <td><a href="{{route('admin.post.edit',1)}}"><i class="fa fa-edit text-primary"></i></a></td>
                                            <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex">
                                    <a href="#" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash-can me-1"></i>Xóa mục đã chọn
                                    </a>
                                </div>
                            </form>     
                        </div>
                    </div>
                </div>
            </div>
                
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
@section('js')
    
@endsection