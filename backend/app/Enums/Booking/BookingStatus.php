<?php

namespace App\Enums\Booking;


use App\Support\Enum;

enum BookingStatus: int
{
    use Enum;

    case Pending = 0;        // Đang chờ xử lý
    case Confirmed = 1;      // Đã xác nhận 
    case CheckedIn = 2;      // Đã nhận phòng
    case CheckedOut = 3;     // Đã trả phòng
    case Cancelled = 4;      // Đã hủy (theo yêu cầu khách/chủ)
    case Refunded = 5;       // Đã hoàn tiền

    public function badge(): string
    {
        return match ($this) {
            BookingStatus::Pending    => 'bg-yellow-lt',
            BookingStatus::Confirmed  => 'bg-green-lt',
            BookingStatus::CheckedIn  => 'bg-cyan-lt',
            BookingStatus::CheckedOut => 'bg-blue-lt',
            BookingStatus::Cancelled  => 'bg-red-lt',
            BookingStatus::Refunded   => 'bg-indigo-lt',
        };
    }
}
