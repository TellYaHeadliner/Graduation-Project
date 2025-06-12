<?php

namespace App\Enums\Voucher;


use App\Support\Enum;

enum VoucherStatus: int
{
    use Enum;

    case Blocked = 0;
    case Active = 1;


    public function badge(): string
    {
        return match ($this) {
            VoucherStatus::Blocked => 'bg-red-lt',
            VoucherStatus::Active => 'bg-green-lt',
        };
    }
}
