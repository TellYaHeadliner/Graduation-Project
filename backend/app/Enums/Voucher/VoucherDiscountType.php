<?php

namespace App\Enums\Voucher;


use App\Support\Enum;

enum VoucherDiscountType: int
{
    use Enum;

    case FixedAmount = 0;
    case Percentage = 1;

}
