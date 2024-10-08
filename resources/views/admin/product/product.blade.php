@extends('admin.layout.app')
@section('title')
    Sản phẩm
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
                </ol>
            </nav>
            <div class="card border-top-primary shadow">
                <div class="card-body">
                    <div class="row mt-2">
                        <h4 class="text-gray-800 mb-3">Danh sách sản phẩm</h4>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-database-fill-add me-2"></i>Thêm sản phẩm mới
                                </a>
                            </div>
                            <form action="" method="GET">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <select class="form-select form-select-sm" name="category">
                                            <option value="0">Tất cả danh mục --</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}" {{ request('category') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="me-3">
                                        <select class="form-select form-select-sm form-outline-dark" name="status">
                                            <option value="0">Tất cả trạng thái --</option>
                                            <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Sản phẩm mới</option>
                                            <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>Sản phẩm hot</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-outline-dark btn-sm"><i class="bi bi-funnel"></i> Lọc</button>
                                </div>
                            </form>
                            
                        </div>
                        <div class="col-12">                            
                            <form action="">
                                <table id="myTable" class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2"><input type="checkbox"></th>
                                            <th rowspan="2">Hình</th>
                                            <th rowspan="2">Tên mô hình</th>
                                            <th rowspan="2">Danh mục</th>
                                            <th rowspan="2">Giá</th>
                                            <th rowspan="2">Số lượng</th>
                                            <th rowspan="2">Trạng thái</th>
                                            <th rowspan="2">Ngày tạo</th>
                                            <th rowspan="2">Hiển thị</th>
                                            <th colspan="3">Thao tác</th>
                                        </tr>
                                        <tr>
                                            <th>Xem</th>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $item)
                                            <tr class="text-center">
                                                <td><input type="checkbox"></td>
                                                <td><img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->ProductCategory->name }}</td>
                                                <td>{{ number_format($item->price,0,'.','.') }} đ</td>
                                                <td>{{ $item->stock }}</td>
                                                <td>
                                                    @switch($item->status)
                                                        @case(0)
                                                            <span class="badge badge-primary rounded-pill d-inline">Đang bán</span>
                                                            @break
                                                        @case(1)
                                                            <span class="badge badge-success rounded-pill d-inline">Sản phẩm mới</span>
                                                            @break
                                                        @case(2)
                                                            <span class="badge badge-info rounded-pill d-inline">HOT</span>
                                                            @break
                                                        @case(3)
                                                            <span class="badge badge-warning rounded-pill d-inline">Sắp hết hàng</span>
                                                            @break
                                                        @case(4)
                                                            <span class="badge badge-danger rounded-pill d-inline">Hết hàng</span>
                                                            @break
                                                        @case(5)
                                                            <span class="badge badge-secondary rounded-pill d-inline">Ngừng bán</span>
                                                            @break
                                                        @default
                                                            
                                                    @endswitch
                                                </td>
                                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <input type="checkbox" {{ $item->is_hidden == 0 ? 'checked' : '' }} onchange="updateHidden({{ $item->id }}, this.checked)">
                                                </td>
                                                <td><a href=""><i class="fa-solid fa-eye text-success"></i></a></td>
                                                <td><a href="{{route('admin.product.edit', $item)}}"><i class="fa fa-edit"></i></a></td>
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
        order: [[7, 'desc']],
        columnDefs: [
            {
                targets: [2,3,4,5,7], // Các cột có thể sắp xếp
                orderable: true
            },
            {
                targets: [0,1,6,8,9,10,11], // Cột "Tên mô hình" không thể sắp xếp
                orderable: false
            },
        ],
        language: {
            "emptyTable": "Không có dữ liệu",
            "processing": "Đang tải dữ liệu",
            "lengthMenu": "Hiển thị _MENU_ mô hình",
            "zeroRecords": "Không tìm thấy mô hình nào",
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
<script>
    function updateHidden(id, isChecked){
        $.ajax({
            url: ' {{ route("admin.product.updateHidden") }} ',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                is_hidden: isChecked ? 0 : 1
            }
        });
    }
</script>
@endsection
