<?php

namespace App\Enums\Service;


use App\Support\Enum;

enum ServiceStatus: int
{
    use Enum;

    case Active = 1;
    case Suspended = 2;
    case Pending = 3;

    public function badge(): string
    {
        return match ($this) {
            ServiceStatus::Pending => 'bg-yellow-lt',
            ServiceStatus::Active => 'bg-green-lt',
            ServiceStatus::Suspended => 'bg-red-lt',
        };
    }
}
