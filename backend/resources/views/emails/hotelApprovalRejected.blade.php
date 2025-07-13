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
            background-color: #ffc107;
            color: #333333;
            padding: 40px 25px 30px;
            text-align: center;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }
        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            text-shadow: 1px 1px 3px rgba(255,255,255,0.3);
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
            background-color: #fffde7;
            border: 1px solid #ffe082;
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
            color: #FF8F00;
            font-weight: 600;
        }
        .highlight {
            color: #FFC107;
            font-weight: 700;
        }
        .reason-list {
            margin-top: 15px;
            margin-bottom: 25px;
            list-style-type: disc;
            text-align: left;
            padding-left: 40px;
            color: #555555;
        }
        .reason-list li {
            margin-bottom: 8px;
            font-size: 15px;
        }
        .button-container {
            text-align: center;
            margin-top: 35px;
            margin-bottom: 25px;
        }
        .button {
            display: inline-block;
            background-color: #ffc107;
            color: #333333;
            padding: 14px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
        }
        .button:hover {
            background-color: #e0a800;
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
                <h1>Thông báo về Yêu cầu Khách sạn của bạn</h1>
            </div>
            <div class="content">
                <h2>Xin chào, <span class="highlight">{{ $hotel->user->fullname }}</span>!</h2>

                <p>Cảm ơn bạn đã gửi thông tin về khách sạn {{ $hotel->name }} để được xét duyệt trên Roomix.</p>
                <p>Sau khi xem xét kỹ lưỡng, chúng tôi rất tiếc phải thông báo rằng yêu cầu duyệt khách sạn của bạn hiện chưa được chấp thuận.</p>
                <p>Thông tin khách sạn này đã bị xóa khỏi hệ thống của chúng tôi.</p>

                <p>Lý do chính cho việc từ chối là: {{ $reason }}</p>
                

                <p>Chúng tôi hiểu rằng đây có thể là một tin không vui. Bạn có thể cải thiện thông tin khách sạn dựa trên các lý do trên và đăng ký lại một khách sạn mới với đầy đủ các yêu cầu của chúng tôi.</p>
                <p>Chúng tôi luôn sẵn lòng hỗ trợ bạn trong quá trình này.</p>

                <div class="button-container" style="margin-top: 15px;">
                    <a href="http://127.0.0.1:5173/" class="button">Đăng ký khách sạn mới</a>
                </div>
            </div>
            <div class="footer">
                <p>&copy; 2025 Roomix. Chúng tôi hy vọng sẽ được hợp tác với bạn trong tương lai.</p>
                <p><a href="http://127.0.0.1:5173/" style="color: #777777; text-decoration: none;">Truy cập Website Roomix</a></p>
            </div>
        </div>
    </div>
</body>
</html>