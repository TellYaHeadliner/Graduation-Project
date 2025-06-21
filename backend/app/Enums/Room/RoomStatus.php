<?php

namespace App\Enums\Room;


use App\Support\Enum;

enum RoomStatus: int
{
    use Enum;

    case Inactive = 0;
    case Active = 1;
    case Booked = 2;
    case CheckedIn = 3;
    case Maintenance = 4;
    case Cleaning = 5;


    public function badge(): string
    {
        return match ($this) {
            RoomStatus::Inactive     => 'bg-gray-lt',
            RoomStatus::Active       => 'bg-green-lt',
            RoomStatus::Booked       => 'bg-blue-lt',
            RoomStatus::CheckedIn    => 'bg-indigo-lt ',
            RoomStatus::Maintenance  => 'bg-yellow-lt ',
            RoomStatus::Cleaning     => 'bg-orange-lt ',
        };
    }
}
