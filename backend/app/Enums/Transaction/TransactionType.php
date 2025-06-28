<?php

namespace App\Enums\Transaction;


use App\Support\Enum;

enum TransactionType: int
{
    use Enum;

    case Holding   = 0; // Giữ tiền sau khi khách đặt (chưa chi cho hotel)
    case Release   = 1; // Trả tiền về hotel (sau checkout)
    case Refund    = 2; // Hoàn tiền cho khách

    public function badge(): string
    {
        return match ($this) {
            self::Holding => 'bg-yellow-lt',
            self::Release => 'bg-green-lt',
            self::Refund  => 'bg-blue-lt',
        };
    }
}
