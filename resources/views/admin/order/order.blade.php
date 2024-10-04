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
                        <div class="col-12">
                            <form action="">
                                <table class="table table-hover table-bordered" id="myTable">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2"><input type="checkbox"></th>
                                            <th rowspan="2">Mã đơn hàng</th>
                                            <th rowspan="2">Ngày tạo đơn</th>
                                            <th rowspan="2">Tên khách hàng</th>
                                            <th rowspan="2">Địa chỉ</th>
                                            <th rowspan="2">Hoá đơn</th>
                                            <th rowspan="2">Trạng thái</th>
                                            <th colspan="2" width="10%">Thao tác</th>
                                        </tr>
                                        <tr>
                                            <th>Xem</th>
                                            <th>Xóa</th>
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
<script>
    new DataTable('#myTable', {
        processing: true,
        lengthMenu: [5, 10, 20],
        searching: true,
        info: false,
        ordering: true,
        paging: true,
        responsive: true,
        order: [
            [1, 'asc']
        ],
        columnDefs: [{
                targets: [1,2,3,5,6], // Các cột có thể sắp xếp
                orderable: true
            },
            {
                targets: [0,4,5,7,8], // Cột "Tên mô hình" không thể sắp xếp
                orderable: false
            },
        ],
        language: {
            "processing": "Đang tải dữ liệu",
            "lengthMenu": "Hiển thị _MENU_ đơn hàng",
            "zeroRecords": "Không tìm thấy đơn hàng nào",
            "info": "Trang _PAGE_ của _PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(lọc từ _MAX_ đơn hàng)",
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