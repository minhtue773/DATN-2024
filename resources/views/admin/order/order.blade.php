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
                            <form action="{{ route('admin.order.destroyBox') }}" method="GET">
                                @csrf
                                <table class="table table-hover table-bordered" id="myTable">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2"><input type="checkbox" id="select-all"></th>
                                            <th rowspan="2">Mã đơn hàng</th>
                                            <th rowspan="2">Ngày tạo đơn</th>
                                            <th rowspan="2">Tên khách hàng</th>
                                            <th rowspan="2">Địa chỉ</th>
                                            <th rowspan="2">Hoá đơn</th>
                                            <th rowspan="2">Trạng thái</th>
                                            <th colspan="3">Thao tác</th>
                                        </tr>
                                        <tr>
                                            <th>---</th>
                                            <th>Xem</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                            <tr class="text-center">
                                                <td>
                                                    @if ($item->status == 3 || $item->status == 5)
                                                    <input type="checkbox" name="order_ids[]" value="{{$item->id}}" >
                                                    @else
                                                    <input type="checkbox" disabled>
                                                    @endif
                                                </td>
                                                <td>#{{ $item->invoice_code }}</td>
                                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $item->user->name ?? '' }}</td>
                                                <td>{{ $item->recipient_address }}</td>
                                                <td class="text-danger">{{ number_format($item->total,0,'.','.') }} đ</td>
                                                @switch($item->status)
                                                        @case(0)
                                                            <td><span class="badge badge-primary rounded-pill d-inline">Chờ xác nhận</span></td>
                                                            <td><a style="cursor: pointer;" onclick="confirmStatus('{{route('admin.order.updateStatus', $item)}}')"><i class="fa-solid fa-check-double text-primary"></i></a></td>
                                                        @break
                                                        @case(1)
                                                            <td><span class="badge badge-primary rounded-pill d-inline">Đang xử lý</span></td>
                                                            <td><a href="{{route('admin.order.updateStatus', $item)}}"><i class="fa-solid fa-truck-fast text-primary"></i></a></td>
                                                        @break
                                                        @case(2)
                                                            <td><span class="badge badge-info rounded-pill d-inline">Đang giao hàng</span></td>
                                                            <td><a href="{{route('admin.order.updateStatus', $item)}}"><i class="fa-solid fa-check-double text-primary"></i></a></td>
                                                        @break
                                                        @case(3)
                                                            <td><span class="badge badge-success rounded-pill d-inline">Giao thành công</span></td>
                                                            <td><a href="javascrip:void(0)" style="cursor: not-allowed;"><i class="fa-solid fa-ban text-muted"></i></a></td>
                                                        @break
                                                        @case(4)
                                                            <td><span class="badge badge-warning rounded-pill d-inline">Yêu cầu hủy</span></td>
                                                            <td><a style="cursor: pointer;" onclick="confirmStatusCancel('{{route('admin.order.updateStatus', $item)}}')"><i class="fa-solid fa-circle-info text-warning"></i></a></td>
                                                        @break
                                                        @case(5)
                                                            <td><span class="badge badge-danger rounded-pill d-inline">Đã hủy</span></td>
                                                            <td><a href="javascrip:void(0)" style="cursor: not-allowed;"><i class="fa-solid fa-ban text-muted"></i></a></td>
                                                        @break
                                                        @default
                                                @endswitch
                                                <td><a href="{{route('admin.order.show', $item)}}"><i class="fa-solid fa-eye text-success"></i></a></td>
                                                <td>
                                                    @if ($item->status == 3)
                                                    <a style="cursor: pointer" onclick="confirmStatusDel('{{ route('admin.order.delete',$item) }}')"><i class="fa fa-trash text-danger"></i></a>
                                                    @elseif ($item->status == 5)
                                                    <a style="cursor: pointer" onclick="confirmStatusDel('{{ route('admin.order.delete',$item) }}')"><i class="fa fa-trash text-danger"></i></a>
                                                    @else
                                                    <a href="javascrip:void(0)" style="cursor: not-allowed"><i class="fa fa-trash text-gray-500"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                                <div class="d-flex">
                                    <button type="button" onclick="confirmDelete(this.form)" class="btn btn-danger btn-sm">
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
                    targets: [1,2,3,5],
                    orderable: true
                },
                {
                    targets: [0,4,5,6,7,8,9],
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
    <script>
    function confirmStatus(urlPath) {
        Swal.fire({
            title: 'Thông báo',
            text: 'Bạn có muốn xác nhận đơn hàng này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xác nhận',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = urlPath;
            }
        });
    }
    function confirmStatusCancel(urlPath) {
        Swal.fire({
            title: 'Thông báo',
            text: 'Đơn hàng này yêu cầu hủy vì lý do khách hàng muốn đổi địa chỉ. Bạn có muốn hủy đơn hàng này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xác nhận hủy',
            cancelButtonText: 'Hủy!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = urlPath;
            }
        });
    }
    function confirmStatusDel(urlPath) {
        Swal.fire({
            title: 'Thông báo',
            text: 'Bạn muốn xóa đơn hàng này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa đơn',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = urlPath;
            }
        });
    }
    function confirmDelete(form) {
        Swal.fire({
            title: 'Xóa đơn hàng',
            text: 'Tất cả đơn hàng bạn chọn đều sẽ bị xóa!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Vẫn xóa!',
            cancelButtonText: 'Không'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
    </script>
    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]:not([disabled])');
            const isChecked = this.checked;
            checkboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

    </script>
@endsection