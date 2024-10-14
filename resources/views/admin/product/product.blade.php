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
                    <div class="row">
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
                                                <option value="{{ $item->id }}"
                                                    {{ request('category') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="me-3">
                                        <select class="form-select form-select-sm form-outline-dark" name="status">
                                            <option value="0">Tất cả trạng thái --</option>
                                            <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Mô hình mới</option>
                                            <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>Mô hình hot</option>
                                            <option value="3" {{ request('status') == 3 ? 'selected' : '' }}>Sắp hết hàng</option>
                                            <option value="4" {{ request('status') == 4 ? 'selected' : '' }}>Hết hàng</option>
                                            <option value="5" {{ request('status') == 5 ? 'selected' : '' }}>Đã ngừng bán</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-outline-dark btn-sm"><i class="bi bi-funnel"></i>
                                        Lọc</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-12">
                            <form action="{{ route('admin.product.destroyBox') }}" method="POST">
                                @csrf
                                <table id="myTable" class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2"><input type="checkbox" id="checkAll"></th>
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
                                                <td><input class="product-checkbox" type="checkbox" name="product_ids[]" value="{{ $item->id }}"></td>
                                                <td><img src="{{ asset('uploads/images/product') }}/{{ $item->image }}"
                                                        class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->productCategory->name }}</td>
                                                <td>{{ number_format($item->price, 0, '.', '.') }} đ</td>
                                                <td>{{ $item->stock }}</td>
                                                <td>
                                                    @switch($item->status)
                                                        @case(0)
                                                            <span class="badge badge-primary rounded-pill d-inline">Đang bán</span>
                                                        @break

                                                        @case(1)
                                                            <span class="badge badge-success rounded-pill d-inline">Sản phẩm
                                                                mới</span>
                                                        @break

                                                        @case(2)
                                                            <span class="badge badge-info rounded-pill d-inline">HOT</span>
                                                        @break

                                                        @case(3)
                                                            <span class="badge badge-warning rounded-pill d-inline">Sắp hết
                                                                hàng</span>
                                                        @break

                                                        @case(4)
                                                            <span class="badge badge-danger rounded-pill d-inline">Hết hàng</span>
                                                        @break

                                                        @case(5)
                                                            <span class="badge badge-secondary rounded-pill d-inline">Ngừng
                                                                bán</span>
                                                        @break

                                                        @default
                                                    @endswitch
                                                </td>
                                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <input type="checkbox" {{ $item->is_hidden == 0 ? 'checked' : '' }}
                                                        onchange="updateHidden({{ $item->id }}, this.checked)">
                                                </td>
                                                <td><a href="javascript:void(0);"
                                                        onclick="showProductDetail({{ $item->id }})"><i
                                                            class="fa-solid fa-eye text-success"></i></a></td>
                                                <td><a href="{{ route('admin.product.edit', $item) }}"><i class="fa fa-edit"></i></a></td>
                                                <td><a style="cursor: pointer" onclick="confirmDeletePath('{{ route('admin.product.delete', $item) }}')"><i class="fa fa-trash text-danger"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex mt-3">
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

    <!-- Modal -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="productDetailModalLabel">Chi tiết sản phẩm</h1>
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
{{-- check-all --}}
<script>
    document.getElementById('checkAll').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.product-checkbox');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
    });
</script>
{{-- Datatables --}}
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
            [7, 'desc']
        ],
        columnDefs: [{
                targets: [2, 3, 4, 5, 7], // Các cột có thể sắp xếp
                orderable: true
            },
            {
                targets: [0, 1, 6, 8, 9, 10, 11], // Cột "Tên mô hình" không thể sắp xếp
                orderable: false
            },
        ],
        language: {
            "emptyTable": "Không có dữ liệu",
            "processing": "Đang tải dữ liệu",
            "lengthMenu": "Hiển thị _MENU_ trên _TOTAL_ mô hình ",
            "zeroRecords": "Không tìm thấy mô hình nào",
            "info": "Trang _PAGE_ của _PAGES_ trong tổng số _TOTAL_ mô hình",
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
{{-- update hidden --}}
<script>
    function updateHidden(id, isChecked) {
        $.ajax({
            url: ' {{ route('admin.product.updateHidden') }} ',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                is_hidden: isChecked ? 0 : 1
            }
        });
    }
</script>
{{-- Show detail modal --}}
<script>
    function showProductDetail(productId) {
        fetch('/admin/product/' + productId)
            .then(response => response.text())
            .then(data => {
                document.getElementById('modalContent').innerHTML = data;
                var myModal = new bootstrap.Modal(document.getElementById('productDetailModal'));
                myModal.show();
            })
            .catch(error => {
                console.error('Lỗi khi tải chi tiết sản phẩm:', error);
            });
    }
</script>
<script>
function confirmDelete(form) {
Swal.fire({
    title: 'Xóa sản phẩm',
    text: 'Tất cả sản phẩm bạn chọn đều sẽ bị xóa!',
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
    function confirmDeletePath(urlPath) {
        Swal.fire({
            title: 'Thông báo',
            text: 'Bạn muốn xóa sản phẩm này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = urlPath;
            }
        });
    }
</script>
@endsection
