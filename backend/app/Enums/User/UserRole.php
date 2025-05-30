<?php

namespace App\Enums\User;


use App\Support\Enum;

enum UserRole: int
{
    use Enum;

    case Admin = 1;
    case Customer = 2;
    case Owner = 3;

    public function badge(): string
    {
        return match ($this) {
            UserRole::Customer => 'bg-green-lt',
            UserRole::Admin => 'bg-red-lt',
            UserRole::Owner => 'bg-blue-lt',
        };
    }
}
