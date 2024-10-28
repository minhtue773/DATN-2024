@if (session('ok'))
    <script>
        Swal.fire({
            title: "Thành Công",
            text: "{{ session('ok') }}",
            icon: "success"
        });
    </script>
@elseif (session('no'))
    <script>
        Swal.fire({
            icon: "error",
            title: "Thất Bại!",
            text: "{{ session('no') }}",
        });
    </script>
@endif
