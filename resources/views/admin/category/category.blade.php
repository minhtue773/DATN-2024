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
                    <li class="breadcrumb-item active" aria-current="page">Danh mục sản phẩm</li>
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
                        <div class="col-12">
                            <table class="table table-hover table-bordered" id="myTable">
                                <thead class="table-info">
                                    <tr class="text-center">
                                        <th rowspan="2">Hình</th>
                                        <th rowspan="2">Tên danh mục</th>
                                        <th rowspan="2">Hiển thị</th>
                                        <th rowspan="2">Ngày tạo</th>
                                        <th colspan="2">Thao tác</th>
                                    </tr>
                                    <tr>
                                        <th>Sữa</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $item)
                                        <tr class="text-center">
                                            <td><img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg"
                                                    class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                            <td class="text-truncate" style="max-width:350px">{{ $item->name }}</td>
                                            <td><input type="checkbox" {{ $item->is_hidden == 0 ? 'checked' : '' }}></td>
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td><a href=""><i class="fa fa-edit"></i></a></td>
                                            <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                    @endforeach
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
                [3, 'asc']
            ],
            columnDefs: [{
                    targets: [1,3], // Các cột có thể sắp xếp
                    orderable: true
                },
                {
                    targets: [0,2,4,5], // Cột "Tên mô hình" không thể sắp xếp
                    orderable: false
                },
            ],
            language: {
                "processing": "Đang tải dữ liệu",
                "lengthMenu": "Hiển thị _MENU_ danh mục",
                "zeroRecords": "Không tìm thấy danh mục nào",
                "info": "Trang _PAGE_ của _PAGES_",
                "infoEmpty": "Không có dữ liệu",
                "infoFiltered": "(lọc từ _MAX_ danh mục)",
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
