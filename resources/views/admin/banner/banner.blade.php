@extends('admin.layout.app')
@section('title')
    Danh sách banners
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.configuration') }}">Thiệp lập chung</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Banners</li>
                </ol>
            </nav>
            <div class="card border-top-primary shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex">
                            <a href="{{ route('admin.banner.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-plus me-1"></i>Thêm banner mới
                            </a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <h4 class="text-gray-800 mb-3">Danh sách banners</h4>
                        <div class="col-12">
                            <table id="myTable" class="table table-hover table-bordered" style="overflow: hidden">
                                <thead>
                                    <tr class="text-center">
                                        <th rowspan="2">Hình ảnh</th>
                                        <th rowspan="2">Nội dung</th>
                                        <th rowspan="2">Liên kết</th>
                                        <th rowspan="2">Ngày tạo</th>
                                        <th rowspan="2">Hiển thị</th>
                                        <th colspan="2">Thao tác</th> <!-- Các cột cho các thao tác -->
                                    </tr>
                                    <tr>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $item)
                                    <tr class="text-center">
                                        <td><img src="{{asset('uploads/images/banner')}}/{{$item->image}}" class="img-thumbnail" style="max-width:100px; max-height:60px;"></td>
                                        <td>{{$item->content}}</td>
                                        <td><a href="https://example.com/sale1" target="_blank">Link</a></td>
                                        <td>{{$item->created_at->format('d-m-Y')}}</td>
                                        <td><input type="checkbox" {{$item->is_hidden == 1 ? 'checked' : ''}} onchange="updateBannerStatus({{ $item->id }}, this.checked)"></td>
                                        <td><a href="{{route('admin.banner.edit', $item)}}"><i class="fa-solid fa-pen-to-square text-warning"></i></a></td>
                                        <td>
                                            <form action="{{route('admin.banner.destroy',$item)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="border-0 bg-transparent" type="button" onclick="confirmDelete(this.form)"><i class="fa fa-trash text-danger"></i></button>
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
    <!-- /.container-fluid -->
@endsection
@section('js')
<script>
    new DataTable('#myTable', {
        processing: true,
        lengthMenu: [10,15,20],
        searching: true,
        info: false,
        ordering: true,
        paging: true,
        responsive: true,
        order: [[3, 'desc']],
        columnDefs: [
            {
                targets: [1,3],
                orderable: true
            },
            {
                targets: [0,2,4,5,6],
                orderable: false
            },
        ],
        language: {
            "processing": "Đang tải dữ liệu",
            "lengthMenu": "Hiển thị _MENU_ banners",
            "zeroRecords": "Không tìm thấy banner nào",
            "info": "Trang _PAGE_ của _PAGES_",
            "infoEmpty": "Không có dữ liệu",
            "infoFiltered": "(lọc từ _MAX_ banners)",
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
    function updateBannerStatus(id, isChecked) {
        $.ajax({
            url: '{{ route("admin.banner.updateStatus") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                is_hidden: isChecked ? 1 : 0
            }
        });
    }
    function confirmDelete(form) {
        Swal.fire({
            title: 'Xóa banner',
            text: 'Bạn có muốn xóa banner này không!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa!',
            cancelButtonText: 'Không'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script> 
@endsection
