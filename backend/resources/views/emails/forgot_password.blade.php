<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Poppins', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
            background-color: #f7fbfc;
        }
        .wrapper {
            background-color: #f7fbfc;
            padding: 20px 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: 1px solid #e0e0e0;
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 30px 30px;
            text-align: center;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }
        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .content {
            padding: 30px;
            text-align: center;
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: 600;
        }
        p {
            margin-bottom: 15px;
            font-size: 16px;
        }
        .password-box {
            background-color: #e6f7ff;
            border: 1px solid #99d6ff;
            border-radius: 8px;
            padding: 20px;
            margin: 30px auto;
            max-width: 300px;
            font-size: 24px;
            font-weight: bold;
            color: #0056b3;
            word-break: break-all;
        }
        .button-container {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 17px;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4);
        }
        .footer {
            background-color: #333333;
            color: #ffffff;
            text-align: center;
            padding: 20px 30px;
            font-size: 0.9em;
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
        }
        .footer a {
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>Thông báo Mật khẩu Mới</h1>
            </div>
            <div class="content">
                <h2>Xin chào, **{{ $user->fullname }}**!</h2>

                <p>Chúng tôi đã cấp một mật khẩu mới cho tài khoản của bạn để bạn có thể truy cập trang web của chúng tôi.</p>

                <p>Mật khẩu mới của bạn là:</p>
                <div class="password-box">
                    {{ $password }}
                </div>

                <p>Vui lòng sử dụng mật khẩu này để đăng nhập. Chúng tôi khuyến nghị bạn nên đổi mật khẩu ngay sau khi đăng nhập thành công để bảo mật tài khoản tốt hơn.</p>

                <div class="button-container">
                    <a href="http://127.0.0.1:5173/login" class="button">Đăng nhập ngay</a>
                </div>

                <p>Nếu bạn không yêu cầu thay đổi mật khẩu này, vui lòng liên hệ với chúng tôi ngay lập tức.</p>
            </div>
            <div class="footer">
                <p>&copy; 2025 Roomix. Bảo mật tài khoản của bạn là ưu tiên hàng đầu của chúng tôi.</p>
                <p><a href="http://127.0.0.1:5173/" style="color: #ffffff; text-decoration: none;">Truy cập Website</a></p>
            </div>
        </div>
    </div>
</body>
</html>