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
            background-color: #FF7F50;
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
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: 600;
        }

        p {
            margin-bottom: 15px;
            font-size: 16px;
        }

        .details-list {
            list-style: none;
            padding: 0;
            margin: 25px 0;
            border: 1px solid #ffccb3;
            border-radius: 10px;
            background-color: #fffaf7;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .details-list li {
            padding: 14px 20px;
            border-bottom: 1px solid #ffe8df;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 15px;
        }

        .details-list li:last-child {
            border-bottom: none;
        }

        .details-list strong {
            font-weight: bold;
            color: #444444;
            flex-shrink: 0;
            margin-right: 15px;
        }

        .details-list span {
            text-align: right;
            flex-grow: 1;
            color: #333333;
        }

        .highlight {
            color: #FF7F50;
            font-weight: bold;
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            background-color: #FF7F50;
            color: #ffffff;
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 17px;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 10px rgba(255, 127, 80, 0.4);
        }

        .button:hover {
            background-color: #FF6347;
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
                <h1>Chào mừng đến với Roomix!</h1>
            </div>
            <div class="content">
                <h2>Xin chào <span class="highlight">{{ $booking->user->fullname }}</span>,</h2>

                <p>Bạn đã đặt phòng thành công tại <strong class="highlight">{{ $booking->hotel->name }}</strong>. Chúng
                    tôi rất vui được chào đón bạn!</p>

                <ul class="details-list">
                    <li>
                        <strong>Mã đơn:</strong>
                        <span>{{ $booking->booking_code }}</span>
                    </li>
                    <li>
                        <strong>Check-in:</strong>
                        <span>{{ format_date($booking->checkin_date, 'm-d-Y') . ' lúc ' . format_datetime($booking->hotel->hotelRule->check_in_time, 'H:i') }}</span>
                    </li>
                    <li>
                        <strong>Check-out:</strong>
                        <span>{{ format_date($booking->checkout_date, 'm-d-Y') . ' lúc ' . format_datetime($booking->hotel->hotelRule->check_out_time, 'H:i') }}</span>
                    </li>
                    <li>
                        <strong>Tổng tiền:</strong>
                        <span class="highlight">{{ number_format($booking->total_amount) }}₫</span>
                    </li>
                </ul>

                <div class="button-container">
                    <a href="http://127.0.0.1:5173/" class="button">Xem chi tiết đặt phòng</a>
                </div>

                <p style="text-align: center;">Nếu bạn có bất kỳ câu hỏi nào, đừng ngần ngại liên hệ với chúng tôi.</p>
            </div>
            <div class="footer">
                <p>&copy; 2025 Roomix. Cảm ơn bạn đã chọn chúng tôi.</p>
                <p><a href="http://127.0.0.1:5173/" style="color: #ffffff; text-decoration: none;">Truy cập Website</a></p>
            </div>
        </div>
    </div>
</body>

</html>