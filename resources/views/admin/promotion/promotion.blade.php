@extends('admin.layout.app')
@section('title')
    Danh sách khuyến mãi
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Khuyến mãi</li>
                </ol>
            </nav>
            <div class="card border-top-primary shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex">
                            <a href="{{ route('admin.promotion.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-plus me-1"></i>Thêm mã khuyến mãi mới
                            </a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <h4 class="text-gray-800 mb-3">Danh sách khuyến mãi</h4>
                        <div class="col-12">
                            <form action="">
                                <table id="promotionTable" class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2"><input type="checkbox"></th>
                                            <th rowspan="2">Mã khuyến mãi</th>
                                            <th rowspan="2">Tên khuyến mãi</th>
                                            <th rowspan="2">Banner</th> <!-- Cột Banner khuyến mãi -->
                                            <th rowspan="2">Phần trăm giảm giá</th>
                                            <th rowspan="2">Giá trị tối đa</th>
                                            <th colspan="2">Thời gian</th>
                                            <th rowspan="2">Trạng thái</th>
                                            <th colspan="2">Thao tác</th> <!-- Các cột cho các thao tác -->
                                        </tr>
                                        <tr>
                                            <th>Bắt đầu</th>
                                            <th>Kết thúc</th>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td><input type="checkbox"></td>
                                            <td>KM2024-01</td>
                                            <td>Giảm giá mùa hè</td>
                                            <td><img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" class="img-thumbnail" style="max-width:100px; max-height:60px;"></td> <!-- Banner khuyến mãi -->
                                            <td>20%</td>
                                            <td>500,000 VND</td>
                                            <td>01/06/2024</td>
                                            <td>30/06/2024</td>
                                            <td><span class="badge badge-success rounded-pill d-inline">Đang hoạt động</span></td>
                                            <td><a href=""><i class="fa-solid fa-pen-to-square text-warning"></i></a></td>
                                            <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td><input type="checkbox"></td>
                                            <td>KM2024-02</td>
                                            <td>Giảm giá 8/3</td>
                                            <td><img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" class="img-thumbnail" style="max-width:100px; max-height:60px;"></td> <!-- Banner khuyến mãi -->
                                            <td>30%</td>
                                            <td>1,000,000 VND</td>
                                            <td>05/03/2024</td>
                                            <td>08/03/2024</td>
                                            <td><span class="badge badge-secondary rounded-pill d-inline">Đã kết thúc</span></td>
                                            <td><a href=""><i class="fa-solid fa-pen-to-square text-warning"></i></a></td>
                                            <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                        <!-- Thêm nhiều dòng dữ liệu khác -->
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
    new DataTable('#promotionTable', {
        processing: true,
        lengthMenu: [5,10,20],
        searching: true,
        info: false,
        ordering: true,
        paging: true,
        responsive: true,
        order: [[4, 'desc']], // Sắp xếp theo phần trăm giảm giá
        columnDefs: [
            {
                targets: [1,2,3,4,5,6,7,8], // Các cột có thể sắp xếp
                orderable: true
            },
            {
                targets: [0,9,10], // Cột "Trạng thái" và các thao tác không thể sắp xếp
                orderable: false
            },
        ],
        language: {
            "processing": "Đang tải dữ liệu",
            "lengthMenu": "Hiển thị _MENU_ khuyến mãi",
            "zeroRecords": "Không tìm thấy khuyến mãi nào",
            "info": "Trang _PAGE_ của _PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(lọc từ _MAX_ khuyến mãi)",
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
