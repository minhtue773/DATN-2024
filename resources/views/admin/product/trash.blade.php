@extends('admin.layout.app')
@section('title')
    Lịch sữ đã xóa
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lịch sữ đã xóa</li>
                </ol>
            </nav>
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="product-tab" data-bs-toggle="tab" data-bs-target="#product"
                        type="button" role="tab" aria-controls="product" aria-selected="true">Sản phẩm</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="post-tab" data-bs-toggle="tab" data-bs-target="#post"
                        type="button" role="tab" aria-controls="post" aria-selected="false">Bài viết</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                        type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
                </li>
            </ul>
            <div class="tab-content mt-3" id="myTabContent">
                <div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="product-tab">
                    <div class="card border-top-primary shadow">
                        <div class="card-body">
                            <h4 class="text-gray-800 mb-3">Danh sách sản phẩm đã xóa</h4>
                            <div class="col-12">
                                <table id="myTable" class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2">Hình</th>
                                            <th rowspan="2">Tên mô hình</th>
                                            <th rowspan="2">Giá</th>
                                            <th rowspan="2">Trạng thái</th>
                                            <th colspan="2">Thao tác</th>
                                        </tr>
                                        <tr>
                                            <th>Hoàn tác</th>
                                            <th>Xóa vĩnh viễn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="post" role="tabpanel" aria-labelledby="post-tab">...</div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
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
                [1, 'desc']
            ],
            columnDefs: [{
                    targets: [1, 2, 3],
                    orderable: true
                },
                {
                    targets: [0, 4, 5],
                    orderable: false
                },
            ],
            language: {
                "processing": "Đang tải dữ liệu",
                "lengthMenu": "Hiển thị _MENU_ mô hình",
                "zeroRecords": "Không tìm thấy mô hình nào",
                "emptyTable": "Không có sản phẩm nào được xóa",
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
