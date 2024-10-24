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
<<<<<<< HEAD
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
                                                <td>{{ $item->User->name }}</td>
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
=======
                                        <tr class="text-center">
                                            <td><input type="checkbox"></td>
                                            <td>1234567</td>
                                            <td>01-10-2024</td>
                                            <td>Nguyễn Văn A</td>
                                            <td>36 đường B, Phú thạnh, HCM</td>
                                            <td class="text-danger">2.320.000 đ</td>
                                            <td><span class="badge badge-primary rounded-pill d-inline">Chờ thanh toán</span></td>
                                            <td><a href="{{route('admin.order.show', 1)}}"><i class="fa-solid fa-eye text-success"></i></a></td>
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
                                            <td><a href="{{route('admin.order.show', 1)}}"><i class="fa-solid fa-eye text-success"></i></a></td>
                                            <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
>>>>>>> PS34351
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
<<<<<<< HEAD
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
=======
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
>>>>>>> PS34351
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