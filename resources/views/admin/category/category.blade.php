@extends('admin.layout.app')
@section('title')
    Danh mục sản phẩm
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Danh mục</li>
                </ol>
            </nav>
            <div class="card border-top-primary shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex">
                            <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-plus me-1"></i>Thêm danh mục mới
                            </a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <h4 class="text-gray-800 mb-3">Danh sách danh mục</h4>
                        <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <form action="">                                    
                                    <div class="input-group">
                                        <input type="search" id="form1" class="form-control-sm" placeholder="Tìm kiếm...." style="border: 1px solid #0d6efd; outline:none"/>
                                        <button type="button" class="btn btn-primary btn-sm">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-outline-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sắp xếp theo
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Tên: A-Z </a></li>
                                    <li><a class="dropdown-item" href="#">Tên: Z-A </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th width="5%">STT</th>
                                        <th>Hình</th>
                                        <th width="25%">Tên mô hình</th>
                                        <th>Hiển thị</th>
                                        <th>Ngày tạo</th>
                                        <th colspan="2" width="10%">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td>1</td>
                                        <td><img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                        <td class="text-truncate" style="max-width:350px">mô hình dragonball</td>
                                        <td><input type="checkbox" checked></td>
                                        <td>20-08-2024</td>
                                        <td><a href=""><i class="fa fa-edit"></i></a></td>
                                        <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>2</td>
                                        <td><img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                        <td class="text-truncate" style="max-width:350px">mô hình dragonball</td>
                                        <td><input type="checkbox" checked></td>
                                        <td>20-08-2024</td>
                                        <td><a href=""><i class="fa fa-edit"></i></a></td>
                                        <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    
@endsection