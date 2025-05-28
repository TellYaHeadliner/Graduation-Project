<?php

namespace App\Enums\User;


use App\Support\Enum;

enum UserStatus: int
{
    use Enum;

    case Active = 1;
    case Deactivated = 2;

    public function badge(): string
    {
        return match ($this) {
            UserStatus::Active => 'bg-green-lt',
            UserStatus::Deactivated => 'bg-red-lt',
        };
    }
}
