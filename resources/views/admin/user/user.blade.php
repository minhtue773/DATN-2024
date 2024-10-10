@extends('admin.layout.app')
@section('title')
    Quản lý tài khoản
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Quản lý tài khoản</li>
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
                    <div class="row">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h4 class="text-gray-800 p-0 m-0">Danh sách người dùng</h4>
                            </div>
                            <form method="GET">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <select class="form-select form-select-sm form-outline-dark" name="status">
                                            <option value="" selected>Tất cả trạng thái --</option>
                                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Chưa kích hoạt</option>
                                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Đã kích hoạt</option>
                                            <option value="2" {{ request('status') === '2' ? 'selected' : '' }}>Đã chặn</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-outline-dark btn-sm"><i class="bi bi-funnel"></i>Lọc</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-12">
                            <table id="myTable" class="table table-hover table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2">Ảnh đại diện</th>
                                        <th rowspan="2">Tên người dùng</th>
                                        <th rowspan="2">Email</th>
                                        <th rowspan="2">Phone</th>
                                        <th rowspan="2">Vai trò</th>
                                        <th rowspan="2">Trạng thái</th>
                                        <th colspan="3">Thao tác</th>
                                    </tr>
                                    <tr>
                                        <th>Xem</th>
                                        <th>Sữa</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                        <tr class="text-center">
                                            <td><img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                            <td class="text-truncate" style="max-width:350px">{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone_number }}</td>
                                            <td>
                                                @if ($item->role == 'admin')
                                                <span class="badge badge-success rounded-pill d-inline">Admin</span>
                                                @else
                                                <span class="badge badge-primary rounded-pill d-inline">Khách hàng</span>
                                                @endif
                                            </td>
                                            <td>
                                                @switch($item->status)
                                                    @case(0)<span class="badge badge-warning rounded-pill d-inline">Chưa kích hoạt</span>@break
                                                    @case(1)<span class="badge badge-success rounded-pill d-inline">Đã kích hoạt</span>@break
                                                    @case(2)<span class="badge badge-danger rounded-pill d-inline">Đã chặn</span>@break
                                                    @default
                                                    <span class="badge badge-warning rounded-pill d-inline">Chưa kích hoạt</span>
                                                @endswitch
                                            </td>
                                            <td><a href="javascrip:void(0)" onclick="showUserDetail({{ $item->id }})"><i class="fa-solid fa-eye text-success"></i></a></td>
                                            <td><a href="{{ route('admin.user.edit', $item) }}"><i class="fa-solid fa-edit text-primary"></i></a></td>
                                            <td>
                                                <form action="{{ route('admin.user.destroy', $item) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="confirmDelete('{{ $item->name }}', this.form)" class="border-0" style="background-color: transparent"><i class="fa fa-trash text-danger"></i></button>
                                                </form>
                                            </td>
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
    <!-- /.container-fluid -->
    {{-- Modal detail --}}
    <div class="modal fade" id="userDetailModal" tabindex="-1" aria-labelledby="userDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="userDetailModalLabel">Chi tiết người dùng</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modalContent"></div>
                </div>
            </div>
        </div>
    </div>   
@endsection
@section('js')
{{-- Sweetalert --}}
<script>
    function confirmDelete(itemName, form) {
        Swal.fire({
            title: 'Xóa người dùng',
            text: `Bạn có chắc muốn xóa ${itemName} không?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Có, xóa nó!',
            cancelButtonText: 'Không'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Gửi form nếu xác nhận
            }
        });
    }
</script>    
{{-- Datatable --}}
<script>
    new DataTable('#myTable', {
        processing: true,
        lengthMenu: [5,10,20],
        searching: true,
        info: false,
        ordering: true,
        paging: true,
        responsive: true,
        order: [[4, 'asc']],
        columnDefs: [
            {
                targets: [1,2,4,5], // Các cột có thể sắp xếp
                orderable: true
            },
            {
                targets: [0,3,6,7,8], // Cột "Tên người dùng" không thể sắp xếp
                orderable: false
            },
        ],
        language: {
            "processing": "Đang tải dữ liệu",
            "lengthMenu": "Hiển thị _MENU_ trên _TOTAL_ người dùng",
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
{{-- Detail Modal --}}
<script>
    function showUserDetail(userID) {
        fetch('/admin/user/' + userID)
        .then(response => response.text())
        .then(data => {
            document.getElementById('modalContent').innerHTML = data;
            var myModal = new bootstrap.Modal(document.getElementById('userDetailModal'));
            myModal.show();
        })
        .catch(error => {
            console.error('Lỗi khi tải chi tiết sản phẩm:', error);
        });
    }
</script>
@endsection
