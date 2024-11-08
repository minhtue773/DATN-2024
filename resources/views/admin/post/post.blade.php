@extends('admin.layout.app')
@section('title')
    Bài viết
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bài viết</li>
                </ol>
            </nav>
            <div class="card border-top-primary shadow">
                <div class="card-body">
                    <div class="row mt-2">
                        <h4 class="text-gray-800 mb-3">Danh sách bài viết</h4>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex">
                                <a href="{{ route('admin.post.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-plus me-1"></i>Bài viết mới
                                </a>
                            </div>
                            <form action="" method="GET">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <select class="form-select form-select-sm" name="category">
                                            <option value="">Tất cả chuyên mục --</option>
                                            @foreach ($postCategories as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ request('category') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="me-3">
                                        <select class="form-select form-select-sm form-outline-dark" name="status">
                                            <option value="">Tất cả trạng thái --</option>
                                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Công khai</option>
                                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Riêng tư</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-outline-dark btn-sm"><i class="bi bi-funnel"></i>
                                        Lọc</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-12">
                            <form action="{{ route('admin.post.destroyBox') }}" method="POST">
                                @csrf
                                <table id="myTable" class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2"><input type="checkbox" id="checkAll"></th>
                                            <th rowspan="2">Hình</th>
                                            <th rowspan="2">Tiêu đề</th>
                                            <th rowspan="2">Tác giả</th>
                                            <th rowspan="2">Chuyên mục</th>
                                            <th rowspan="2">Thời gian</th>
                                            <th rowspan="2">Trạng thái</th>
                                            <th rowspan="2">Nổi bật</th>
                                            <th colspan="3">Thao tác</th>
                                        </tr>
                                        <tr>
                                            <th>Xem</th>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $item)
                                        <tr class="text-center">
                                            <td><input type="checkbox" name=post_ids[] class="post-checkbox" value="{{ $item->id }}"></td>
                                            <td><img src="{{ asset('uploads/images/post') }}/{{ $item->image }}" class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                            <td class="text-capitalize">{{ $item->title }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>
                                            @if ($item->status == 0)
                                            <span class="badge badge-success rounded-pill d-inline">Công khai</span>
                                            @else
                                            <span class="badge badge-warning rounded-pill d-inline">Riêng tư</span>
                                            @endif
                                            </td>
                                            <td><input type="checkbox" {{ $item->is_featured == 1 ? 'checked' : '' }}
                                                onchange="updateCategoryStatus({{ $item->id }}, this.checked)"></td>
                                            <td><a href=""><i class="fa-solid fa-eye text-success"></i>chưa</a></td>
                                            <td><a href="{{route('admin.post.edit',$item)}}"><i class="fa fa-edit text-primary"></i></a></td>
                                            <td><a style="cursor: pointer" onclick="confirmDeletePath('{{ route('admin.post.delete', $item) }}')"><i class="fa fa-trash text-danger"></i></a></td>
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
@endsection
@section('js')
{{-- check-all --}}
<script>
    document.getElementById('checkAll').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.post-checkbox');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
    });
</script>
{{-- Datatables --}}
<script>
    new DataTable('#myTable', {
        processing: true,
        lengthMenu: [10,15,20],
        searching: true,
        info: false,
        ordering: true,
        paging: true,
        responsive: true,
        order: [
            [5, 'desc']
        ],
        columnDefs: [{
                targets: [2, 3, 5], // Các cột có thể sắp xếp
                orderable: true
            },
            {
                targets: [0,1,4,6,7,8,9,10], // Cột "Tên mô hình" không thể sắp xếp
                orderable: false
            },
        ],
        language: {
            "emptyTable": "Không có dữ liệu",
            "processing": "Đang tải dữ liệu",
            "lengthMenu": "Hiển thị _MENU_ trên _TOTAL_ bài viết ",
            "zeroRecords": "Không tìm thấy bài viết nào",
            "info": "Trang _PAGE_ của _PAGES_ trong tổng số _TOTAL_ bài viết",
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
</script>
<script>
    function updateCategoryStatus(id, isChecked) {
        $.ajax({
            url: '{{ route("admin.post.updateFeatured") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                is_featured: isChecked ? 1 : 0
            }
        });
    }
</script>
<script>
    function confirmDelete(form) {
    Swal.fire({
        title: 'Xóa bài viết',
        text: 'Tất cả bài viết bạn chọn đều sẽ bị xóa!',
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
    function confirmDeletePath(urlPath) {
    Swal.fire({
        title: 'Thông báo',
        text: 'Bạn muốn xóa bài viết này?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa bài viết',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = urlPath;
        }
    });
    }
</script>    
@endsection