import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});
window.Echo.channel('orders')
.listen('.order.placed', function(data) {
    const formatter = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
        maximumFractionDigits: 0 // Không hiển thị phần thập phân
    });
    const totalFormatted = formatter.format(data.total);    
    Toastify({
        text: 'Đơn hàng mới #' + data.invoice_code + ' từ ' + data.customer_name + ': ' + totalFormatted,
        className: "success",
        duration: 3000,
        destination: false,
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "#198754", // Sử dụng màu xanh đơn giản
            color: "#ffffff", // Chữ trắng để dễ đọc
            borderRadius: "8px", // Bo góc cho mềm mại
            padding: "10px 15px", // Tăng khoảng cách nội dung
            boxShadow: "0px 4px 6px rgba(0, 0, 0, 0.1)" // Tạo hiệu ứng đổ bóng nhẹ
        },    
        onClick: function(){} // Callback after click
    }).showToast();
});

