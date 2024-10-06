@extends('admin.layout.app')
@section('title')
    Sản phẩm
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
                </ol>
            </nav>
            <div class="card border-top-primary shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex">
                            <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-plus me-1"></i>Thêm sản phẩm mới
                            </a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <h4 class="text-gray-800 mb-3">Danh sách sản phẩm</h4>
                        <div class="col-12">                            
                            <form action="">
                                <table id="myTable" class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2"><input type="checkbox"></th>
                                            <th rowspan="2">Hình</th>
                                            <th rowspan="2">Tên mô hình</th>
                                            <th rowspan="2">Giá</th>
                                            <th rowspan="2">Hiển thị</th>
                                            <th rowspan="2">Nổi bật</th>
                                            <th rowspan="2">Trạng thái</th>
                                            <th colspan="3">Thao tác</th>
                                        </tr>
                                        <tr>
                                            <th>Xem</th>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td><input type="checkbox"></td>
                                            <td><img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                            <td class="text-truncate" style="max-width:350px">mô hình dragonball</td>
                                            <td>850.000 đ</td>
                                            <td><input type="checkbox"></td>
                                            <td><input type="checkbox" checked></td>
                                            <td><span class="badge badge-primary rounded-pill d-inline">Best sale</span></td>
                                            <td><a href=""><i class="fa-solid fa-eye text-success"></i></a></td>
                                            <td><a href="{{route('admin.product.edit', 1)}}"><i class="fa fa-edit"></i></a></td>
                                            <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                    </tbody>                                    
                                </table>
                                <div class="d-flex mt-3">
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash-can me-1"></i>Xóa mục đã chọn
                                    </button>
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
<script>
    new DataTable('#myTable', {
        processing: true,
        lengthMenu: [5,10,20],
        searching: true,
        info: false,
        ordering: true,
        paging: true,
        responsive: true,
        order: [[2, 'desc']],
        columnDefs: [
            {
                targets: [2,3,4,5,6], // Các cột có thể sắp xếp
                orderable: true
            },
            {
                targets: [0,1,7,8,9], // Cột "Tên mô hình" không thể sắp xếp
                orderable: false
            },
        ],
        language: {
            "processing": "Đang tải dữ liệu",
            "lengthMenu": "Hiển thị _MENU_ mô hình",
            "zeroRecords": "Không tìm thấy mô hình nào",
            "info": "Trang _PAGE_ của _PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(lọc từ _MAX_ mô hình)",
            "search": "Tìm kiếm:",
            "paginate": {
                "previous": "Trước",
                "next": "Sau"
            },
            "aria": {
                "sortAscending": ": Đợi xíu",
                "sortDescending": ": Đợi xíu",
            }
        }
    });
</script>
@endsection
