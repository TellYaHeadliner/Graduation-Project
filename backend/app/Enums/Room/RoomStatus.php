<?php

namespace App\Enums\Room;


use App\Support\Enum;

enum RoomStatus: int
{
    use Enum;

    case Inactive = 0;
    case Active = 1;
    case Maintenance = 2;
    case Cleaning = 3;


    public function badge(): string
    {
        return match ($this) {
            RoomStatus::Inactive     => 'bg-gray-lt',
            RoomStatus::Active       => 'bg-green-lt',
            RoomStatus::Maintenance  => 'bg-yellow-lt ',
            RoomStatus::Cleaning     => 'bg-orange-lt ',
        };
    }
}
