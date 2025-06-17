<?php

namespace App\Enums\HotelService;


use App\Support\Enum;

enum HotelServiceStatus: int
{
    use Enum;

    case Active = 1;
    case INACTIVE = 0;

    public function badge(): string
    {
        return match ($this) {
            HotelServiceStatus::INACTIVE => 'bg-red-lt',
            HotelServiceStatus::Active => 'bg-green-lt',
        };
    }
}
