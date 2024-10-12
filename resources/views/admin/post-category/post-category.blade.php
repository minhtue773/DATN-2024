@extends('admin.layout.app')
@section('title')
    Chuyên mục bài viết
@endsection
@section('content')
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chuyên mục bài viết</li>
                </ol>
            </nav>
            <div class="card border-top-primary shadow">
                <div class="card-body">
                    <div class="row">
                        <h4 class="text-gray-800 mb-3">Danh sách chuyên mục</h4>
                        <div class="row mb-3">
                            <div class="d-flex">
                                <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-plus me-1"></i>Thêm chuyên mục mới
                                </a>
                            </div>
                        </div>
                        <div class="col-12">
                            <table class="table table-hover table-bordered" id="myTable">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2">Banner</th>
                                        <th rowspan="2">Tên chuyên mục</th>
                                        <th rowspan="2">Ngày tạo</th>
                                        <th rowspan="2">Hiển thị</th>
                                        <th colspan="2">Thao tác</th>
                                    </tr>
                                    <tr>
                                        <th>Sữa</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $item)
                                        <tr class="text-center">
                                            <td><img src="{{ asset('uploads/images/post_category') }}/{{ $item->image }}"
                                                    class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                            <td class="text-truncate" style="max-width:350px">{{ $item->name }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <input type="checkbox" {{ $item->status == 1 ? 'checked' : '' }}
                                                onchange="updateCategoryStatus({{ $item->id }}, this.checked)">
                                            </td>                                            
                                            <td><a href="{{ route('admin.post-category.edit', $item) }}"><i class="fa fa-edit"></i></a></td>
                                            <td>
                                                <form action="{{ route('admin.post-category.destroy', $item) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="border-0 bg-transparent" onclick="confirmDelete('{{ $item->name }}', this.form)"><i class="fa fa-trash text-danger"></i></button>
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
@endsection
@section('js')
    <script>
    function confirmDelete(itemName, form) {
        Swal.fire({
            title: 'Xóa chyên mục',
            text: `Tất cả bài viết thuộc ${itemName} đều sẽ bị xóa!`,
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
                    targets: [1,2], // Các cột có thể sắp xếp
                    orderable: true
                },
                {
                    targets: [0,3,4,5], // Cột "Tên mô hình" không thể sắp xếp
                    orderable: false
                },
            ],
            language: {
                "processing": "Đang tải dữ liệu",
                "lengthMenu": "Hiển thị _MENU_ danh mục",
                "zeroRecords": "Không tìm thấy danh mục nào",
                "info": "Trang _PAGE_ của _PAGES_",
                "infoEmpty": "Không có dữ liệu",
                "infoFiltered": "(lọc từ _MAX_ danh mục)",
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
        function updateCategoryStatus(id, isChecked) {
            $.ajax({
                url: '{{ route("admin.post-category.updateStatus") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    status: isChecked ? 1 : 0
                }
            });
        }
    </script>    
@endsection
