@extends('admin.layout.app')
@section('title')
    Người dùng
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Người dùng</li>
                </ol>
            </nav>
            <div class="card border-top-primary shadow">
                <div class="card-body">
                    {{-- <div class="row">
                        <div class="d-flex">
                            <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-plus me-1"></i>Thêm người dùng mới
                            </a>
                        </div>
                    </div> --}}
                    <div class="row mt-2">
                        <h4 class="text-gray-800 mb-3">Danh sách người dùng</h4>
                        <div class="col-12">
                            <form action="">
                                <table id="myTable" class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2"><input type="checkbox"></th>
                                            <th rowspan="2">Ảnh đại diện</th>
                                            <th rowspan="2">Tên người dùng</th>
                                            <th rowspan="2">Email</th>
                                            <th rowspan="2">Phone</th>
                                            <th rowspan="2">Vai trò</th>
                                            <th colspan="2">Thao tác</th>
                                        </tr>
                                        <tr>
                                            <th>Xem</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $item)
                                            <tr class="text-center">
                                                <td><input type="checkbox"></td>
                                                <td><img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                                <td class="text-truncate" style="max-width:350px">{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone_number }}</td>
                                                <td>
                                                    @if ($item->role == 0)
                                                        <span class="badge badge-primary rounded-pill d-inline">Khách hàng</span>
                                                    @else
                                                        <span class="badge badge-success rounded-pill d-inline">Admin</span>
                                                    @endif
                                                </td>
                                                <td><a href=""><i class="fa-solid fa-eye text-success"></i></a></td>
                                                <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                            </tr>
                                        @endforeach
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
        order: [[1, 'desc']],
        columnDefs: [
            {
                targets: [1,2,3,4,5], // Các cột có thể sắp xếp
                orderable: true
            },
            {
                targets: [0,6,7], // Cột "Tên người dùng" không thể sắp xếp
                orderable: false
            },
        ],
        language: {
            "processing": "Đang tải dữ liệu",
            "lengthMenu": "Hiển thị _MENU_ người dùng",
            "zeroRecords": "Không tìm thấy người dùng nào",
            "info": "Trang _PAGE_ của _PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(lọc từ _MAX_ người dùng)",
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
