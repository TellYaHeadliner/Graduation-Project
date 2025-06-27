<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
            background-color: #eef2f7;
        }
        .wrapper {
            background-color: #eef2f7;
            padding: 20px 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 25px 30px;
            text-align: center;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .content {
            padding: 30px;
        }
        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
        }
        p {
            margin-bottom: 15px;
            font-size: 16px;
        }
        .details-list {
            list-style: none;
            padding: 0;
            margin: 25px 0;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .details-list li {
            padding: 12px 20px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .details-list li:last-child {
            border-bottom: none;
        }
        .details-list strong {
            font-weight: bold;
            color: #555555;
            flex-shrink: 0;
            margin-right: 15px;
        }
        .details-list span {
            text-align: right;
            flex-grow: 1;
            color: #333333;
        }
        .highlight {
            color: #4CAF50;
            font-weight: bold;
        }
        .footer {
            background-color: #333333;
            color: #ffffff;
            text-align: center;
            padding: 20px 30px;
            font-size: 0.9em;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
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
                <h1>Chào mừng đến với Roomix!</h1>
            </div>
            <div class="content">
                <h2>Xin chào <span class="highlight">{{ $booking->user->fullname }}</span>,</h2>

                <p>Bạn đã đặt phòng thành công tại <strong class="highlight">{{ $booking->hotel->name }}</strong>. Chúng tôi rất vui được chào đón bạn!</p>

                <ul class="details-list">
                    <li>
                        <strong>Mã đơn:</strong>
                        <span>{{ $booking->booking_code }}</span>
                    </li>
                    <li>
                        <strong>Check-in:</strong>
                        <span>{{ format_date($booking->checkin_date,'m-d-Y') . ' lúc ' . format_datetime($booking->hotel->hotelRule->check_in_time,'H:i') }}</span>
                    </li>
                    <li>
                        <strong>Check-out:</strong>
                        <span>{{ format_date($booking->checkout_date,'m-d-Y'). ' lúc ' . format_datetime($booking->hotel->hotelRule->check_out_time,'H:i') }}</span>
                    </li>
                    <li>
                        <strong>Tổng tiền:</strong>
                        <span class="highlight">{{ number_format($booking->total_amount) }}₫</span>
                    </li>
                </ul>

                <p>Nếu bạn có bất kỳ câu hỏi nào, đừng ngần ngại liên hệ với chúng tôi.</p>
            </div>
            <div class="footer">
                <p>&copy; 2025 Roomix. Cảm ơn bạn đã chọn chúng tôi.</p>
                <p><a href="http://127.0.0.1:5173/" style="color: #ffffff; text-decoration: none;">Visit Roomix Website</a></p>
            </div>
        </div>
    </div>
</body>
</html>