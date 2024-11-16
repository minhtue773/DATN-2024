<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Email Notification</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            color: #333333;
        }

        table {
            border-spacing: 0;
            width: 100%;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        a {
            text-decoration: none;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #17bebb;
            padding: 20px;
            text-align: center;
        }

        .email-header img {
            max-width: 150px;
        }

        .email-body {
            padding: 20px;
            line-height: 1.6;
        }

        .email-body h2 {
            font-size: 24px;
            color: #333333;
            margin-bottom: 10px;
        }

        .email-body p {
            font-size: 16px;
            color: #666666;
            margin-bottom: 20px;
        }

        .email-button {
            display: block;
            text-align: center;
            margin: 20px 0;
        }

        .email-button a {
            background-color: #17bebb;
            color: #ffffff;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            display: inline-block;
        }

        .email-footer {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #999999;
        }

        .email-footer a {
            color: #17bebb;
        }
    </style>
</head>

<body>
    <center>
        <table class="email-container">
            <!-- Header -->
            <tr>
                <td class="email-header">
                    <img src="{{ asset('uploads/images/logo/logo.png') }}" alt="HobbyZone Logo">
                </td>
            </tr>
            <!-- Body -->
            <tr>
                <td class="email-body">
                    <h2>Cập nhật đơn hàng #{{ $order->invoice_code }}</h2>
                    <p>{{ $statusMessage }}</p>
                    <div class="email-button">
                        <a href="{{ url('/orders/' . $order->id) }}">Xem chi tiết</a>
                    </div>
                    <p>Cảm ơn bạn đã sử dụng dịch vụ của <strong>HobbyZone</strong>.</p>
                    <p>Trân trọng,<br>HobbyZone Team</p>
                </td>
            </tr>
            <!-- Footer -->
            <tr>
                <td class="email-footer">
                    <p>&copy; {{ date('Y') }} HobbyZone. Mọi quyền được bảo lưu.</p>
                    <p><a href="{{ url('/') }}">Trang chủ</a> | <a href="{{ url('/contact') }}">Liên hệ</a></p>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>
