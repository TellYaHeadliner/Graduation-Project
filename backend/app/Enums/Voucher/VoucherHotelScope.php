<?php

namespace App\Enums\Voucher;


use App\Support\Enum;

enum VoucherHotelScope: int
{
    use Enum;

    case All = 1;
    case SpecificHotels = 0;


    public function badge(): string
    {
        return match ($this) {
            VoucherHotelScope::SpecificHotels => 'bg-yellow-lt',
            VoucherHotelScope::All => 'bg-green-lt',
        };
    }
}
