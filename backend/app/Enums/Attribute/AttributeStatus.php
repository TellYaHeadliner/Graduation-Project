<?php

namespace App\Enums\Attribute;


use App\Support\Enum;

enum AttributeStatus: int
{
    use Enum;

    case Blocked = 0;
    case Active = 1;


    public function badge(): string
    {
        return match ($this) {
            AttributeStatus::Blocked => 'bg-red-lt',
            AttributeStatus::Active => 'bg-green-lt',
        };
    }
}
