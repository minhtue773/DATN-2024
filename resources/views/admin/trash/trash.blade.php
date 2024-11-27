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
                        type="button" role="tab" aria-controls="product" aria-selected="true">Sản phẩm <span class="badge text-bg-danger ms-1">{{ $data['product']['quantity'] }}</span></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="post-tab" data-bs-toggle="tab" data-bs-target="#post"
                        type="button" role="tab" aria-controls="post" aria-selected="false">Bài viết <span class="badge text-bg-danger ms-1">{{ $data['post']['quantity'] }}</span></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order"
                        type="button" role="tab" aria-controls="order" aria-selected="false">Đơn hàng <span class="badge text-bg-danger ms-1">{{ $data['order']['quantity'] }}</span></button>
                </li>
            </ul>
            <div class="tab-content mt-3" id="myTabContent">
                <div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="product-tab">
                    <div class="card border-top-primary shadow">
                        <div class="card-body">
                            <div class="col-12">
                                <h4 class="text-gray-800 mb-3">Danh sách sản phẩm đã xóa</h4>
                            </div>
                            <div class="col-12">
                                <form action="{{ route('admin.trash.deleteBox') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="type" value="product">
                                    <table id="productTable" class="table table-hover table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th rowspan="2"><input type="checkbox" id="checkAllProduct"></th>
                                                <th rowspan="2">Hình</th>
                                                <th rowspan="2">Tên mô hình</th>
                                                <th rowspan="2">Danh mục</th>
                                                <th rowspan="2">Giá</th>
                                                <th rowspan="2">Ngày xóa</th>
                                                <th colspan="2">Thao tác</th>
                                            </tr>
                                            <tr>
                                                <th width="5%">Restore</th>
                                                <th width="5%">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['product']['data'] as $item)
                                            <tr class="text-center">
                                                <td><input class="product-checkbox" type="checkbox" name="ids[]" value="{{ $item->id }}"></td>
                                                <td><img src="{{ asset('uploads/images/product') }}/{{ $item->image }}"
                                                        class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->productCategory->name }}</td>
                                                <td>{{ number_format($item->price, 0, '.', '.') }} đ</td>
                                                <td>{{ $item->deleted_at->format('d-m-Y') }}</td>
                                                <td><a href="{{ route('admin.trash.restore', ['type' => 'product', 'id' => $item->id]) }}"><i class="fa-solid fa-share-from-square text-success"></i></a></td>
                                                <td><a onclick="confirmDelete('{{ route('admin.trash.delete', ['type' => 'product', 'id' => $item->id]) }}','{{ $item->name }}')"><i class="fa-solid fa-trash text-danger"></i></a></td> 
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex mt-3">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeleteBtn(this.form)">
                                            <i class="fa-solid fa-trash-can me-1"></i>Xóa mục đã chọn
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="post" role="tabpanel" aria-labelledby="post-tab">
                    <div class="card border-top-primary shadow">
                        <div class="card-body">
                            <div class="col-12">
                                <h4 class="text-gray-800 mb-3">Danh sách bài viết đã xóa</h4>
                            </div>
                            <div class="col-12">
                                <form action="{{ route('admin.trash.deleteBox') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="type" value="post">
                                    <table id="postTable" class="table table-hover table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th rowspan="2"><input type="checkbox" id="checkAllPost"></th>
                                                <th rowspan="2">Hình</th>
                                                <th rowspan="2">Tiêu đề</th>
                                                <th rowspan="2">Tác giả</th>
                                                <th rowspan="2">Chuyên mục</th>
                                                <th rowspan="2">Ngày xóa</th>
                                                <th colspan="2">Thao tác</th>
                                            </tr>
                                            <tr>
                                                <th width="5%">Restore</th>
                                                <th width="5%">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['post']['data'] as $item)
                                            <tr class="text-center">
                                                <td><input class="post-checkbox" type="checkbox" name="ids[]" value="{{ $item->id }}"></td>
                                                <td><img src="{{ asset('uploads/images/post') }}/{{ $item->image }}"
                                                        class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->category->name }}</td>
                                                <td>{{ $item->deleted_at->format('d-m-Y') }}</td>
                                                <td><a href="{{ route('admin.trash.restore', ['type' => 'post', 'id' => $item->id]) }}"><i class="fa-solid fa-share-from-square text-success"></i></a></td>
                                                <td><a onclick="confirmDelete('{{ route('admin.trash.delete', ['type' => 'post', 'id' => $item->id]) }}','{{ $item->title }}')"><i class="fa-solid fa-trash text-danger"></i></a></td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex mt-3">
                                        <button type="button" onclick="confirmDeleteBtn(this.form)" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash-can me-1"></i>Xóa mục đã chọn
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
                    <div class="card border-top-primary shadow">
                        <div class="card-body">
                            <div class="col-12">
                                <h4 class="text-gray-800 mb-3">Danh sách đơn hàng đã xóa</h4>
                            </div>
                            <div class="col-12" style="overflow: hidden">
                                <form action="{{ route('admin.trash.deleteBox') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="type" value="order">
                                    <table id="orderTable" class="table table-hover table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th rowspan="2"><input type="checkbox" id="checkAllOrder"></th>
                                                <th rowspan="2">Mã đơn hàng</th>
                                                <th rowspan="2">Tên khách hàng</th>
                                                <th rowspan="2">Hóa đơn</th>
                                                <th rowspan="2">Trạng thái</th>
                                                <th rowspan="2">Ngày xóa</th>
                                                <th colspan="2">Thao tác</th>
                                            </tr>
                                            <tr>
                                                <th width="5%">Restore</th>
                                                <th width="5%">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['order']['data'] as $item)
                                            <tr class="text-center">
                                                <td><input class="order-checkbox" type="checkbox" name="ids[]" value="{{ $item->id }}"></td>
                                                <td>{{ $item->invoice_code }}</td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->total }}</td>
                                                @switch($item->status)
                                                    @case(3)
                                                    <td><span class="badge badge-success rounded-pill d-inline">Giao thành công</span></td>
                                                        @break
                                                    @case(5)
                                                    <td><span class="badge badge-danger rounded-pill d-inline">Đã hủy</span></td>
                                                        @break
                                                    @default
                                                @endswitch
                                                <td>{{ $item->deleted_at->format('d-m-Y') }}</td>
                                                <td><a href="{{ route('admin.trash.restore', ['type' => 'order', 'id' => $item->id]) }}"><i class="fa-solid fa-share-from-square text-success"></i></a></td>
                                                <td><a onclick="confirmDelete('{{ route('admin.trash.delete', ['type' => 'order', 'id' => $item->id]) }}','{{ $item->invoice_code }}')"><i class="fa-solid fa-trash text-danger"></i></a></td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex mt-3">
                                        <button type="button" onclick="confirmDeleteBtn(this.form)" class="btn btn-danger btn-sm">
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
    </div>
    <!-- /.container-fluid -->
@endsection
@section('js')
    {{-- check-all --}}
    <script>
        document.getElementById('checkAllProduct').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.product-checkbox');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
        document.getElementById('checkAllPost').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.post-checkbox');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
        document.getElementById('checkAllOrder').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.order-checkbox');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
    </script>
    <script>
        new DataTable('#productTable', {
            processing: true,
            lengthMenu: [8, 15, 20],
            searching: true,
            info: false,
            ordering: true,
            paging: true,
            responsive: true,
            order: [
                [5, 'desc']
            ],
            columnDefs: [{
                    targets: [2, 3, 4, 5],
                    orderable: true
                },
                {
                    targets: [0,1,6,7],
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
        new DataTable('#postTable', {
            processing: true,
            lengthMenu: [8, 15, 20],
            searching: true,
            info: false,
            ordering: true,
            paging: true,
            responsive: true,
            order: [
                [5, 'desc']
            ],
            columnDefs: [{
                    targets: [2, 3, 4, 5],
                    orderable: true
                },
                {
                    targets: [0,1,6,7],
                    orderable: false
                },
            ],
            language: {
                "processing": "Đang tải dữ liệu",
                "lengthMenu": "Hiển thị _MENU_ bài viết",
                "zeroRecords": "Không tìm thấy bài viết nào",
                "emptyTable": "Không tìm thấy bài viết nào",
                "info": "Trang _PAGE_ của _PAGES_",
                "infoEmpty": "Không có dữ liệu",
                "infoFiltered": "(lọc từ _MAX_ bài viết)",
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
        new DataTable('#orderTable', {
            processing: true,
            lengthMenu: [8, 15, 20],
            searching: true,
            info: false,
            ordering: true,
            paging: true,
            responsive: true,
            order: [
                [5, 'desc']
            ],
            columnDefs: [{
                    targets: [1,2, 3, 4, 5],
                    orderable: true
                },
                {
                    targets: [0,6,7],
                    orderable: false
                },
            ],
            language: {
                "processing": "Đang tải dữ liệu",
                "lengthMenu": "Hiển thị _MENU_ đơn hàng",
                "zeroRecords": "Không tìm thấy đơn hàng nào",
                "emptyTable": "Không tìm thấy đơn hàng nào",
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
        document.addEventListener('DOMContentLoaded', function () {
            let activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                let tab = new bootstrap.Tab(document.querySelector(`#${activeTab}-tab`));
                tab.show();
            }
            document.querySelectorAll('.nav-link').forEach(tab => {
                tab.addEventListener('shown.bs.tab', function (event) {
                    localStorage.setItem('activeTab', event.target.id.replace('-tab', ''));
                });
            });
        });
    </script>
    {{-- Toast message --}}
    <script>
        function confirmDelete(url, name) {
            Swal.fire({
                title: `Xóa ${name}`,
                text: `Bạn có chắc chắn muốn xóa ${name} không?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, tôi muốn xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
        function confirmDeleteBtn(form) {
            Swal.fire({
                title: 'Xóa mục đã chọn',
                text: `Tất cả mục bạn chọn đều sẽ bị xóa!`,
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
@endsection
