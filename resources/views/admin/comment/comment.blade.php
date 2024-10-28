@extends('admin.layout.app')
@section('title')
    Bình luận
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bình luận</li>
                </ol>
            </nav>
            <div class="card border-top-primary shadow">
                <div class="card-body">
                    <div class="row">
                        <h4 class="text-gray-800 mb-3">Danh sách bình luận</h4>
                        <div class="col-12">
                            <form action="">
                                <table id="commentTable" class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2"><input type="checkbox"></th>
                                            <th rowspan="2">Tên người dùng</th>
                                            <th rowspan="2">Nội dung</th>
                                            <th rowspan="2">Bài viết</th>
                                            <th rowspan="2">Ngày đăng</th>
                                            <th colspan="3">Thao tác</th> <!-- Thêm cột cho "Trả lời" -->
                                        </tr>
                                        <tr>
                                            <th>Xem</th>
                                            <th>Trả lời</th> <!-- Cột mới -->
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td><input type="checkbox"></td>
                                            <td class="text-truncate" style="max-width:350px">Nguyễn Văn B</td>
                                            <td class="text-truncate" style="max-width:500px">Đây là bình luận của tôi về bài viết.</td>
                                            <td>Bài viết "abcxzxc"</td>
                                            <td>04/10/2024</td>
                                            <td><a href=""><i class="fa-solid fa-eye text-success"></i></a></td>
                                            <td><a href=""><i class="fa-solid fa-reply text-primary"></i></a></td> <!-- Nút trả lời -->
                                            <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td><input type="checkbox"></td>
                                            <td class="text-truncate" style="max-width:350px">Trần Thị C</td>
                                            <td class="text-truncate" style="max-width:500px">Bài viết rất hữu ích, cảm ơn bạn!</td>
                                            <td>Bài viết "Hướng dẫn mua hàng online"</td>
                                            <td>03/10/2024</td>
                                            <td><a href=""><i class="fa-solid fa-eye text-success"></i></a></td>
                                            <td><a href=""><i class="fa-solid fa-reply text-primary"></i></a></td> <!-- Nút trả lời -->
                                            <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                        <tr class="text-center">
                                            <td><input type="checkbox"></td>
                                            <td class="text-truncate" style="max-width:350px">Phạm Quốc D</td>
                                            <td class="text-truncate" style="max-width:500px">Đây là bình luận của tôi về bài viết.</td>
                                            <td>Bài viết đánh giá Sản phẩm ABC</td>
                                            <td>02/10/2024</td>
                                            <td><a href=""><i class="fa-solid fa-eye text-success"></i></a></td>
                                            <td><a href=""><i class="fa-solid fa-reply text-primary"></i></a></td> <!-- Nút trả lời -->
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
    new DataTable('#commentTable', {
        processing: true,
        lengthMenu: [5,10,20],
        searching: true,
        info: false,
        ordering: true,
        paging: true,
        responsive: true,
        order: [[4, 'desc']], // Sắp xếp theo ngày bình luận
        columnDefs: [
            {
                targets: [1,2,3,4], // Các cột có thể sắp xếp
                orderable: true
            },
            {
                targets: [0,5,6,7], // Các cột không thể sắp xếp
                orderable: false
            },
        ],
        language: {
            "processing": "Đang tải dữ liệu",
            "lengthMenu": "Hiển thị _MENU_ bình luận",
            "zeroRecords": "Không tìm thấy bình luận nào",
            "info": "Trang _PAGE_ của _PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(lọc từ _MAX_ bình luận)",
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
