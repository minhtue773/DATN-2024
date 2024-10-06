@extends('admin.layout.app')
@section('title')
    Danh sách banners
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Banners</li>
                </ol>
            </nav>
            <div class="card border-top-primary shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex">
                            <a href="{{ route('admin.banner.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-plus me-1"></i>Thêm banner mới
                            </a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <h4 class="text-gray-800 mb-3">Danh sách banners</h4>
                        <div class="col-12">
                            <form action="">
                                <table id="bannerTable" class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2"><input type="checkbox"></th>
                                            <th rowspan="2">Hình ảnh</th>
                                            <th rowspan="2">Nội dung</th>
                                            <th rowspan="2">Liên kết</th>
                                            <th rowspan="2">Ngày tạo</th>
                                            <th colspan="2">Thao tác</th> <!-- Các cột cho các thao tác -->
                                        </tr>
                                        <tr>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td><input type="checkbox" value="1"></td>
                                            <td><img src="https://via.placeholder.com/100x60.png?text=Banner+1" class="img-thumbnail" style="max-width:100px; max-height:60px;"></td>
                                            <td>Giảm giá 50% cho tất cả sản phẩm</td>
                                            <td><a href="https://example.com/sale1" target="_blank">https://example.com/sale1</a></td>
                                            <td>06/10/2024</td>
                                            <td><a href="{{route('admin.banner.edit', $id = 1)}}"><i class="fa-solid fa-pen-to-square text-warning"></i></a></td>
                                            <td><a href="#" onclick="return confirm('Bạn có chắc chắn muốn xóa banner này?')"><i class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td><input type="checkbox" value="2"></td>
                                            <td><img src="https://via.placeholder.com/100x60.png?text=Banner+2" class="img-thumbnail" style="max-width:100px; max-height:60px;"></td>
                                            <td>Khuyến mãi mùa hè 30%</td>
                                            <td><a href="https://example.com/sale2" target="_blank">https://example.com/sale2</a></td>
                                            <td>01/07/2024</td>
                                            <td><a href="{{route('admin.banner.edit', $id = 1)}}"><i class="fa-solid fa-pen-to-square text-warning"></i></a></td>
                                            <td><a href="#" onclick="return confirm('Bạn có chắc chắn muốn xóa banner này?')"><i class="fa fa-trash text-danger"></i></a></td>
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
    new DataTable('#bannerTable', {
        processing: true,
        lengthMenu: [5,10,20],
        searching: true,
        info: false,
        ordering: true,
        paging: true,
        responsive: true,
        order: [[4, 'desc']], // Sắp xếp theo ngày tạo
        columnDefs: [
            {
                targets: [1,2,3,4], // Các cột có thể sắp xếp
                orderable: true
            },
            {
                targets: [0,5,6], // Cột thao tác không thể sắp xếp
                orderable: false
            },
        ],
        language: {
            "processing": "Đang tải dữ liệu",
            "lengthMenu": "Hiển thị _MENU_ banners",
            "zeroRecords": "Không tìm thấy banner nào",
            "info": "Trang _PAGE_ của _PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(lọc từ _MAX_ banners)",
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
