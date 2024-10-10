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
            <div class="row mb-3">
                <div class="col-3">
                    <div class="card border-left-primary">
                        <div class="card-body p-0">
                            <div class="d-flex">
                                <!-- Nội dung chính full chiều ngang -->
                                <div class="d-flex flex-column align-items-center p-3 flex-grow-1">
                                    <i class="bi bi-clipboard-minus fs-1 text-primary"></i>
                                    <h6>Chờ xác nhận</h6>
                                    <p class="text-muted">{{ $countStatus[0] }} đơn hàng</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card border-left-info">
                        <div class="card-body p-0">
                            <div class="d-flex">
                                <!-- Nội dung chính full chiều ngang -->
                                <div class="d-flex flex-column align-items-center p-3 flex-grow-1">
                                    <i class="bi bi-truck fs-1" style="color: #36b9cc"></i>
                                    <h6>Đang giao</h6>
                                    <p class="text-muted">{{ $countStatus[2] }} đơn hàng</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card border-left-success">
                        <div class="card-body p-0">
                            <div class="d-flex">
                                <!-- Nội dung chính full chiều ngang -->
                                <div class="d-flex flex-column align-items-center p-3 flex-grow-1">
                                    <i class="bi bi-check2-square fs-1 text-success"></i>
                                    <h6>Giao thành công</h6>
                                    <p class="text-muted">{{ $countStatus[3] }} đơn hàng</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card border-left-warning">
                        <div class="card-body p-0">
                            <div class="d-flex">
                                <!-- Nội dung chính full chiều ngang -->
                                <div class="d-flex flex-column align-items-center p-3 flex-grow-1">
                                    <i class="bi bi-question-circle fs-1 text-warning"></i>
                                    <h6>Yêu cầu hủy</h6>
                                    <p class="text-muted">{{ $countStatus[4] }} yêu cầu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-top-primary shadow">
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h4 class="text-gray-800 p-0 m-0">Danh sách đơn hàng</h4>
                            </div>
                            <form method="GET">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <select class="form-select form-select-sm form-outline-dark" name="status">
                                            <option value="" selected>Tất cả trạng thái --</option>
                                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Chờ xác nhận</option>
                                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Đang xử lý</option>
                                            <option value="2" {{ request('status') === '2' ? 'selected' : '' }}>Đang giao hàng</option>
                                            <option value="3" {{ request('status') === '3' ? 'selected' : '' }}>Giao thành công</option>
                                            <option value="4" {{ request('status') === '4' ? 'selected' : '' }}>Yêu cầu hủy</option>
                                            <option value="5" {{ request('status') === '5' ? 'selected' : '' }}>Đã hủy</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-outline-dark btn-sm"><i class="bi bi-funnel"></i>Lọc</button>
                                </div>
                            </form>
                        </div>
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
                                        @foreach ($orders as $item)
                                            <tr class="text-center">
                                                <td><input type="checkbox"></td>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $item->User->name }}</td>
                                                <td>{{ $item->recipient_address }}</td>
                                                <td class="text-danger">{{ number_format($item->total,0,'.','.') }} đ</td>
                                                <td>
                                                    @switch($item->status)
                                                        @case(0)<span class="badge badge-primary rounded-pill d-inline">Chờ xác nhận</span>@break
                                                        @case(1)<span class="badge badge-primary rounded-pill d-inline">Đang xử lý</span>@break
                                                        @case(2)<span class="badge badge-info rounded-pill d-inline">Đang giao hàng</span>@break
                                                        @case(3)<span class="badge badge-success rounded-pill d-inline">Giao thành công</span>@break
                                                        @case(4)<span class="badge badge-warning rounded-pill d-inline">Yêu cầu hủy</span>@break
                                                        @case(5)<span class="badge badge-danger rounded-pill d-inline">Đã hủy</span>@break
                                                        @default
                                                        <span class="badge badge-primary rounded-pill d-inline">Chờ xác nhận</span>
                                                    @endswitch
                                                </td>
                                                <td><a href="{{route('admin.order.show', 1)}}"><i class="fa-solid fa-eye text-success"></i></a></td>
                                                <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                            </tr>
                                        @endforeach 
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
        lengthMenu: [10, 15, 20],
        searching: true,
        info: false,
        ordering: true,
        paging: true,
        responsive: true,
        order: [
            [2, 'desc']
        ],
        columnDefs: [{
                targets: [1,2,3,5], // Các cột có thể sắp xếp
                orderable: true
            },
            {
                targets: [0,4,5,6,7,8], // Cột "Tên mô hình" không thể sắp xếp
                orderable: false
            },
        ],
        language: {
            "emptyTable": "Không có dữ liệu",
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