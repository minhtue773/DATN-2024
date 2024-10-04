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
            [2, 'asc']
        ],
        columnDefs: [{
                targets: [2, 4], // Các cột có thể sắp xếp
                orderable: true
            },
            {
                targets: [0, 1, 3, 5, 6], // Cột "Tên mô hình" không thể sắp xếp
                orderable: false
            },
        ],
        language: {
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