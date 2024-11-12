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
                    <li class="breadcrumb-item"><a href="{{ route('admin.configuration') }}">Thiệp lập chung</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Khuyến mãi</li>
                </ol>
            </nav>
            <div class="card border-top-primary shadow">
                <div class="card-body">
                    <div class="row">
                        <h4 class="text-gray-800 mb-3">Danh sách mã khuyến mãi</h4>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <a href="{{ route('admin.promotion.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-database-fill-add me-2"></i>Thêm mã khuyến mãi mới
                                </a>
                            </div>
                            <form action="" method="GET">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <select class="form-select form-select-sm" name="type">
                                            <option value="0">Tất cả các loại --</option>
                                            <!--  -->
                                        </select>
                                    </div>
                                    <div class="me-3">
                                        <select class="form-select form-select-sm form-outline-dark" name="status">
                                            <option value="0">Tất cả trạng thái --</option>
                                            <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Hiển thị</option>
                                            <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>Ẩn</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-outline-dark btn-sm"><i class="bi bi-funnel"></i>
                                        Lọc</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-12">
                            <form action="">
                                <table id="promotionTable" class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2"><input type="checkbox" id="checkAll"></th>
                                            <th rowspan="2">Mã khuyến mãi</th>
                                            <th rowspan="2">Loại khuyến mãi</th>
                                            <th rowspan="2">Giảm giá</th>
                                            <th rowspan="2">Giảm giá tối đa</th>
                                            <th rowspan="2">Số lượng mã</th>
                                            <th rowspan="2">Đã sử dụng</th>
                                            <th rowspan="2">Trạng thái</th>
                                            <th rowspan="2">Hiển thị</th>
                                            <th colspan="2">Thời gian</th>
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
                                        @foreach ($DiscountCodes as $item)
                                        <tr class="text-center">
                                            <td><input type="checkbox"></td>
                                            <td>{{ $item->code }}</td>
                                            <td>
                                                @if ($item->type == 'percentage')
                                                    Phần trăm
                                                @elseif ($item->type == 'fixed')
                                                    Giá cố định
                                                @elseif ($item->type == 'percentage_with_cap')
                                                    Phần trăm (Giới hạn giá)
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->type == 'fixed')
                                                    {{ number_format($item->discount, 0) }} VND
                                                @elseif ($item->type == 'percentage' || $item->type == 'percentage_with_cap')
                                                    {{ number_format($item->discount, 2) }} %
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->type == 'percentage_with_cap')
                                                    {{ number_format($item->max_discount, 0) }} VND
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->used_count }}</td>
                                            <td>
                                                @if (\Carbon\Carbon::now()->greaterThan(\Carbon\Carbon::parse($item->expiry_date)))
                                                    <span class="badge badge-secondary rounded-pill d-inline">Hết hạn</span>
                                                @elseif ($item->quantity == $item->used_count)
                                                    <span class="badge badge-danger rounded-pill d-inline">Hết lượt sử dụng</span>
                                                @elseif (\Carbon\Carbon::now()->greaterThan(\Carbon\Carbon::parse($item->start_date)))
                                                    <span class="badge badge-success rounded-pill d-inline">Đang hoạt động</span>
                                                @else
                                                <span class="badge badge-info rounded-pill d-inline">Chưa hoạt động</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="checkbox" {{ $item->status == 1 ? 'checked' : '' }}
                                                    onchange="updateHidden({{ $item->id }}, this.checked)">
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->expiry_date)->format('d/m/Y') }}</td>
                                            <td><a href=""><i class="fa-solid fa-pen-to-square text-warning"></i></a></td>
                                            <td><a href=""><i class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                        @endforeach
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
