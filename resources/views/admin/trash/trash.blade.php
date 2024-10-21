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
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                        type="button" role="tab" aria-controls="contact" aria-selected="false">Đơn hàng <span class="badge text-bg-danger ms-1">{{ $data['order']['quantity'] }}</span></button>
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
                                <form action="" method="post">
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
                                                <td><input class="product-checkbox" type="checkbox" name="product_ids[]" value="{{ $item->id }}"></td>
                                                <td><img src="{{ asset('uploads/images/product') }}/{{ $item->image }}"
                                                        class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->productCategory->name }}</td>
                                                <td>{{ number_format($item->price, 0, '.', '.') }} đ</td>
                                                <td>{{ $item->deleted_at->format('d-m-Y') }}</td>
                                                <td><a href=""><i class="fa-solid fa-share-from-square text-success"></i></a></td>
                                                <td><a href=""><i class="fa-solid fa-trash text-danger"></i></a></td>
                                                
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
                <div class="tab-pane fade" id="post" role="tabpanel" aria-labelledby="post-tab">...</div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
@section('js')
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
    </script>
    {{-- check-all --}}
    <script>
        document.getElementById('checkAllProduct').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.product-checkbox');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
    </script>
@endsection
