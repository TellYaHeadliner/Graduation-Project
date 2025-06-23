<?php

namespace App\Enums\RoomType;


use App\Support\Enum;

enum RoomTypeStatus: int
{
    use Enum;

    case Discontinued = 0;
    case Active = 1;
    case TemporarilyUnavailable = 2;


    public function badge(): string
    {
        return match ($this) {
            RoomTypeStatus::Discontinued => 'bg-red-lt',
            RoomTypeStatus::Active => 'bg-green-lt',
            RoomTypeStatus::TemporarilyUnavailable => 'bg-yellow-lt',
        };
    }
}
