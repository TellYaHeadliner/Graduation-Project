<?php

namespace App\Enums\RoomTypeVariant;


use App\Support\Enum;

enum RoomTypeVariantStatus: int
{
    use Enum;

    case Inactive = 0;
    case Active = 1;
    case OutOfStock = 2;


    public function badge(): string
    {
        return match ($this) {
            RoomTypeVariantStatus::Inactive => 'bg-red-lt',
            RoomTypeVariantStatus::Active => 'bg-green-lt',
            RoomTypeVariantStatus::OutOfStock => 'bg-yellow-lt',
        };
    }
}
