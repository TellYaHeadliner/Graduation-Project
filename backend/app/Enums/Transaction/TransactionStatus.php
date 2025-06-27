<?php

namespace App\Enums\Transaction;


use App\Support\Enum;

enum TransactionStatus: int
{
    use Enum;
    case Processing = 0;
    case Success = 1;     // Thành công
    case Failed = 2;      // Thất bại
    case Refunded = 3;    // Đã hoàn tiền

    public function badge(): string
    {
        return match ($this) {
            TransactionStatus::Processing => 'bg-yellow-lt',
            TransactionStatus::Success => 'bg-green-lt',
            TransactionStatus::Failed => 'bg-red-lt',
            TransactionStatus::Refunded => 'bg-blue-lt',
        };
    }
}
