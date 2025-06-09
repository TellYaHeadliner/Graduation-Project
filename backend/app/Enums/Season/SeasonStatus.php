<?php

namespace App\Enums\Season;


use App\Support\Enum;

enum SeasonStatus: int
{
    use Enum;

    case Blocked = 0;
    case Active = 1;


    public function badge(): string
    {
        return match ($this) {
            SeasonStatus::Blocked => 'bg-red-lt',
            SeasonStatus::Active => 'bg-green-lt',
        };
    }
}
