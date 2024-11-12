@extends('admin.layout.app')
@section('title')
    Bình luận
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bình luận</li>
                </ol>
            </nav>
            <div class="card border-top-primary shadow">
                <div class="card-body">
                    <div class="row">
                        <h4 class="text-gray-800 mb-3">Danh sách bình luận</h4>
                        <div class="d-flex justify-content-end align-items-center mb-3">
                            <form action="" method="GET">
                                <div class="d-flex">
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
                            <form action="{{ route('admin.comment.destroyBox') }}" method="POST">
                                @csrf
                                <table id="commentTable" class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th rowspan="2"><input type="checkbox" id="checkAll"></th>
                                            <th rowspan="2">Tên người dùng</th>
                                            <th rowspan="2">Nội dung</th>
                                            <th rowspan="2">Bài viết</th>
                                            <th rowspan="2">Ngày đăng</th>
                                            <th rowspan="2">Hiển thị</th>
                                            <th colspan="2">Thao tác</th> <!-- Thêm cột cho "Trả lời" -->
                                        </tr>
                                        <tr>
                                            <th>Xem</th>
                                            <!-- <th>Trả lời</th> Cột mới -->
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comments as $comment)
                                        <tr class="text-center">
                                            <td><input class="comment-checkbox" type="checkbox" name="comment_ids[]" value="{{ $comment->id }}"></td>
                                            <td class="text-truncate" style="max-width:350px">{{ $comment->user->name }}</td>
                                            <td class="text-truncate" style="max-width:500px">{{ $comment->content }}</td>
                                            <td>{{ $comment->product->name }}</td>
                                            <td>{{ $comment->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <input type="checkbox" {{ $comment->status == 1 ? 'checked' : '' }}
                                                    onchange="updateHidden({{ $comment->id }}, this.checked)">
                                            </td>
                                            <td><a href="{{ route('product.detail', $comment->product->slug) }}"><i class="fa-solid fa-eye text-success"></i></a></td>
                                            <!-- <td><a href=""><i class="fa-solid fa-reply text-primary"></i></a></td> -->
                                            <td><a style="cursor: pointer" onclick="confirmDeletePath('{{ route('admin.comment.delete', $comment) }}')"><i class="fa fa-trash text-danger"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex mt-3">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(this.form)">
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
    {{-- check-all --}}
    <script>
        document.getElementById('checkAll').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.comment-checkbox');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
    </script>
<script>
    new DataTable('#commentTable', {
        processing: true,
        lengthMenu: [5,10,20],
        searching: true,
        info: false,
        ordering: true,
        paging: true,
        responsive: true,
        order: [[4, 'desc']], // Sắp xếp theo ngày bình luận
        columnDefs: [
            {
                targets: [1,2,3,4], // Các cột có thể sắp xếp
                orderable: true
            },
            {
                targets: [0,5,6,7], // Các cột không thể sắp xếp
                orderable: false
            },
        ],
        language: {
            "processing": "Đang tải dữ liệu",
            "lengthMenu": "Hiển thị _MENU_ bình luận",
            "zeroRecords": "Không tìm thấy bình luận nào",
            "info": "Trang _PAGE_ của _PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(lọc từ _MAX_ bình luận)",
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
                url: ' {{ route('admin.comment.updateHidden') }} ',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    status: isChecked ? 0 : 1
                }
            });
        }
    </script>
    <script>
    function confirmDelete(form) {
    Swal.fire({
        title: 'Xóa bình luận',
        text: 'Tất cả bình luận bạn chọn đều sẽ bị xóa!',
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
                text: 'Bạn muốn xóa bình luận này?',
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
