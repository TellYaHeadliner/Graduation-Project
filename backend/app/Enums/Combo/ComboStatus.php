<?php

namespace App\Enums\Combo;


use App\Support\Enum;

enum ComboStatus: int
{
    use Enum;

    case Active = 1;
    case Inactive = 0;

    public function badge(): string
    {
        return match ($this) {
            ComboStatus::Inactive => 'bg-red-lt',
            ComboStatus::Active => 'bg-green-lt',
        };
    }
}
