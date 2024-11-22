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
    if (typeof loadNotifications === 'function') {
        loadNotifications();
    }
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
        destination: '/admin/order/' + data.order_id,
        newWindow: true,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
            color: "#ffffff",
            borderRadius: "8px",
            padding: "10px 15px",
            boxShadow: "0px 4px 6px rgba(0, 0, 0, 0.1)"
        },    
        onClick: function(){}
    }).showToast();
});
window.Echo.channel('orders')
.listen('.order.cancel', function(data) {
    if (typeof loadNotifications === 'function') {
        loadNotifications();
    }
    Toastify({
        text: 'Yêu cầu hủy đơn hàng #' + data.invoice_code + ' từ ' + data.customer_name ,
        className: "success",
        duration: 3000,
        destination: '/admin/order/' + data.order_id,
        newWindow: true,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        style: {
            background: "linear-gradient(to right, #ffcc00, #ff5733)",
            color: "#ffffff",
            borderRadius: "8px",
            padding: "10px 15px",
            boxShadow: "0px 4px 6px rgba(0, 0, 0, 0.1)"
        },    
        onClick: function(){}
    }).showToast();
});
