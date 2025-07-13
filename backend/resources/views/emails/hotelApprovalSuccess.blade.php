<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }
        .wrapper {
            background-color: #f0f2f5;
            padding: 20px 0;
        }
        .container {
            max-width: 580px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }
        .header {
            background-color: #28a745;
            color: #ffffff;
            padding: 40px 25px 30px;
            text-align: center;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }
        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }
        .content {
            padding: 30px;
            text-align: center;
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: 700;
        }
        p {
            margin-bottom: 18px;
            font-size: 16px;
            color: #555555;
        }
        .details-box {
            background-color: #eaf7ed;
            border: 1px solid #c8e6c9;
            border-radius: 10px;
            padding: 22px;
            margin: 30px auto;
            max-width: 420px;
            text-align: left;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }
        .details-box p {
            margin: 8px 0;
            font-size: 15px;
            line-height: 1.6;
        }
        .details-box strong {
            display: inline-block;
            width: 130px;
            color: #388e3c;
            font-weight: 600;
        }
        .highlight {
            color: #28a745;
            font-weight: 700;
        }
        .button-container {
            text-align: center;
            margin-top: 35px;
            margin-bottom: 25px;
        }
        .button {
            display: inline-block;
            background-color: #28a745;
            color: #ffffff;
            padding: 14px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }
        .button:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }
        .footer {
            background-color: #f7fbfc;
            color: #777777;
            text-align: center;
            padding: 22px 25px;
            font-size: 0.9em;
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
            border-top: 1px solid #eeeeee;
        }
        .footer a {
            color: #777777;
            text-decoration: none;
            font-weight: 500;
        }
        .footer a:hover {
            color: #555555;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>Khách sạn của bạn đã được Duyệt!</h1>
            </div>
            <div class="content">
                <h2>Xin chào, <span class="highlight">{{ $hotel->user->fullname }}</span>!</h2>

                <p>Chúng tôi rất vui thông báo rằng thông tin khách sạn {{ $hotel->name }} của bạn đã được duyệt và hiện đã có sẵn trên hệ thống của Roomix.</p>
                <p>Bạn có thể bắt đầu quản lý đặt phòng, cập nhật thông tin và chào đón khách ngay bây giờ!</p>

                <p>Dưới đây là một số thông tin chính:</p>

                <div class="details-box">
                    <p><strong>Tên khách sạn:</strong> {{ $hotel->name }}</p>
                    <p><strong>Mã ID khách sạn:</strong> {{ $hotel->id }}</p>
                    <p><strong>Trạng thái:</strong> <span class="highlight">Đã duyệt & Hoạt động</span></p>
                    <p><strong>Ngày duyệt:</strong> {{ \Carbon\Carbon::now()->format('H:i, d/m/Y') }}</p>
                </div>

                <p>Để bắt đầu, vui lòng đăng nhập vào tài khoản quản lý của bạn và khám phá các tính năng mới.</p>

                <div class="button-container">
                    <a href="{{ route('login.index') }}" class="button">Đến Trang Quản lý</a>
                </div>
            </div>
            <div class="footer">
                <p>&copy; 2025 Roomix. Chúng tôi rất mong được hợp tác với bạn!</p>
                <p><a href="http://127.0.0.1:5173/" style="color: #777777; text-decoration: none;">Truy cập Website Roomix</a></p>
            </div>
        </div>
    </div>
</body>
</html>