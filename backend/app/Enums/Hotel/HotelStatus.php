<?php

namespace App\Enums\Hotel;


use App\Support\Enum;

enum HotelStatus: int
{
    use Enum;

    case Pending = 1;
    case Active = 2;
    case Blocked = 3;
    case Rejected = 4;

    public function badge(): string
    {
        return match ($this) {
            HotelStatus::Pending => 'bg-yellow-lt',
            HotelStatus::Active => 'bg-green-lt',
            HotelStatus::Blocked => 'bg-gray-lt',
            HotelStatus::Rejected => 'bg-red-lt',
        };
    }
}
