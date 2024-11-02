<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Liên hệ từ Khách hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-top: 4px solid #007BFF;
        }
        h2 {
            color: #333333;
            text-align: center;
        }
        .content {
            margin-top: 20px;
        }
        p {
            color: #555555;
            line-height: 1.6;
            margin-bottom: 15px;
        }
       
        .highlight {
            color: #007BFF;
            font-weight: bold;
        }
        @media (max-width: 600px) {
            .container {
                width: 100%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Liên hệ từ Khách hàng</h2>
        <div class="content">
            <p><span class="highlight">Họ tên khách hàng:</span> {{$hoten}}</p>
            <p><span class="highlight">Email:</span> {{$email}}</p>
            <p><span class="highlight">Nội dung khách liên hệ:</span><br>
                {!! nl2br($noidung) !!}
            </p>
        </div>
        
    </div>
</body>
</html>