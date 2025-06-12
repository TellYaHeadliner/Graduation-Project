<?php

namespace App\Enums\Voucher;


use App\Support\Enum;

enum VoucherCustomerScope: int
{
    use Enum;

    case All = 1;
    case SpecificCustomers = 0;


    public function badge(): string
    {
        return match ($this) {
            VoucherCustomerScope::SpecificCustomers => 'bg-yellow-lt',
            VoucherCustomerScope::All => 'bg-green-lt',
        };
    }
}
