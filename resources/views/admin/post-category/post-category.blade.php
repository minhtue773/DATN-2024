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
                                <a href="{{ route('admin.post-category.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-plus me-1"></i>Thêm chuyên mục mới
                                </a>
                            </div>
                        </div>
                        <div class="col-12">
                            <table class="table table-hover table-bordered" id="myTable" style="overflow: hidden">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2">Hình</th>
                                        <th rowspan="2">Tên chuyên mục</th>
                                        <th rowspan="2">Số lượng bài viết</th>
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
                                    @foreach ($postCategories as $item)
                                        <tr class="text-center">
                                            <td><img src="{{ asset('uploads/images/post_category') }}/{{ $item->image }}"
                                                    class="img-thumbnail" style="max-width:70px; max-height:55px"></td>
                                            <td>{{ $item->name }}</td>
                                            <td class="text-center">{{ $item->posts->count() }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y')}}</td> 
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
            text: `Bạn muốn xóa chuyên mục ${itemName} ?`,
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
        lengthMenu: [10, 15, 20],
        searching: true,
        info: false,
        ordering: true,
        paging: true,
        responsive: true,
        order: [
            [3, 'desc']
        ],
        columnDefs: [{
                targets: [1,3], // Các cột có thể sắp xếp
                orderable: true
            },
            {
                targets: [0,2,4,5,6], // Cột "Tên mô hình" không thể sắp xếp
                orderable: false
            },
        ],
        language: {
            "emptyTable": "Không có dữ liệu",
            "processing": "Đang tải dữ liệu",
            "lengthMenu": "Hiển thị _MENU_ chuyên mục",
            "zeroRecords": "Không tìm thấy chuyên mục nào",
            "info": "Trang _PAGE_ của _PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(lọc từ _MAX_ chuyên mục)",
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
