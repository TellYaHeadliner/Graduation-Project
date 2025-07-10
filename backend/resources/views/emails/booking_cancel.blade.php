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
            background-color: #607D8B;
            background-image: url('https://via.placeholder.com/600x150/607D8B/ffffff?text=Booking+Cancelled');
            background-size: cover;
            background-position: center;
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
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
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
            background-color: #eceff1;
            border: 1px solid #cfd8dc;
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
            width: 180px;
            color: #455A64;
            font-weight: 600;
        }

        .highlight {
            color: #607D8B;
            font-weight: 700;
        }

        .button-container {
            text-align: center;
            margin-top: 35px;
            margin-bottom: 25px;
        }

        .button {
            display: inline-block;
            background-color: #607D8B;
            color: #ffffff;
            padding: 14px 28px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 5px 15px rgba(96, 125, 139, 0.4);
        }

        .button:hover {
            background-color: #546E7A;
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
                <h1>Đặt phòng của bạn đã được Hủy</h1>
            </div>
            <div class="content">
                <h2>Xin chào, <span class="highlight">{{ $booking->user->fullname }}</span>!</h2>

                <p>Chúng tôi xác nhận rằng đặt phòng **{{ $booking->booking_code }}** của bạn tại
                    **{{ $booking->hotel->name }}** đã được **hủy thành công**.</p>
                <p>Dưới đây là thông tin chi tiết về đặt phòng đã hủy:</p>

                <div class="details-box">
                    <p><strong>Mã đơn:</strong> {{ $booking->booking_code }}</p>
                    <p><strong>Khách sạn:</strong> {{ $booking->hotel->name }}</p>
                    <p><strong>Ngày hủy:</strong> {{ \Carbon\Carbon::now()->format('H:i, d/m/Y') }}</p>
                    <p><strong>Tình trạng:</strong> <span class="highlight">Đã Hủy</span></p>
                    <p><strong>Tổng tiền hóa đơn:</strong> <span
                                class="highlight">{{ number_format($booking->total_amount) }}₫</span></p>
                    @if(isset($booking->cancellation_fee) && $booking->cancellation_fee > 0)
                        <p><strong>Phí hủy phòng:</strong> <span
                                class="highlight">{{ number_format($booking->cancellation_fee) }}₫</span></p>
                    @endif
                    @if(isset($transaction->amount) && $transaction->amount > 0)
                        <p><strong>Số tiền hoàn lại:</strong> <span
                                class="highlight">{{ number_format($transaction->amount) }}₫</span></p>
                    @endif
                </div>
                <p>Chúng tôi hy vọng sẽ được phục vụ bạn trong những lần ghé thăm sắp tới.</p>

                <div class="button-container">
                    <a href="YOUR_WEBSITE_OR_NEW_BOOKING_URL" class="button">Đặt phòng mới</a>
                </div>
            </div>
            <div class="footer">
                <p>&copy; 2025 Roomix. Cảm ơn bạn đã lựa chọn chúng tôi!</p>
                <p><a href="http://127.0.0.1:5173/" style="color: #777777; text-decoration: none;">Truy cập Website
                        Roomix</a></p>
            </div>
        </div>
    </div>
</body>

</html>