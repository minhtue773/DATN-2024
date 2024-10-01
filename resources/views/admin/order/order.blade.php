@extends('admin.layout.app')
@section('title')
    Đơn hàng
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Đơn hàng</li>
                </ol>
            </nav>
            <div class="card border-top-primary shadow">
                <div class="card-body">
                    <div class="row mt-2">
                        <h4 class="text-gray-800 mb-3">Danh sách đơn hàng</h4>
                        <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <form action="">                                    
                                    <div class="input-group">
                                        <input type="search" id="form1" class="form-control-sm" placeholder="Tìm đơn hàng...." style="border: 1px solid #0d6efd; outline:none"/>
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
                                    <li><a class="dropdown-item" href="#">Giá: Tăng dần</a></li>
                                    <li><a class="dropdown-item" href="#">Giá: Giảm dần</a></li>
                                    <li><a class="dropdown-item" href="#">Tên: A-Z </a></li>
                                    <li><a class="dropdown-item" href="#">Tên: Z-A </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <form action="">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="5%"><input type="checkbox"></th>
                                            <th>Mã đơn hàng</th>
                                            <th>Ngày tạo đơn</th>
                                            <th>Tên khách hàng</th>
                                            <th>Địa chỉ</th>
                                            <th>Hoá đơn</th>
                                            <th>Trạng thái</th>
                                            <th colspan="2" width="10%">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td><input type="checkbox"></td>
                                            <td>1234567</td>
                                            <td>01-10-2024</td>
                                            <td>Nguyễn Văn A</td>
                                            <td>36 đường B, Phú thạnh, HCM</td>
                                            <td class="text-danger">2.320.000 đ</td>
                                            <td><span class="badge badge-primary rounded-pill d-inline">Chờ thanh toán</span></td>
                                            <td><a href=""><i class="fa-solid fa-eye text-success"></i></a></td>
                                            <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td><input type="checkbox"></td>
                                            <td>1234568</td>
                                            <td>01-10-2024</td>
                                            <td>Nguyễn Văn B</td>
                                            <td>123 Tô Ký, Quận 12, HCM</td>
                                            <td class="text-danger">5.540.000 đ</td>
                                            <td><span class="badge badge-success rounded-pill d-inline">Đang giao hàng</span></td>
                                            <td><a href="/admin/home" target="_blank"><i class="fa-solid fa-eye text-success"></i></a></td>
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