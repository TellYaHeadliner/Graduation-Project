<?php

namespace App\Enums\Notification;


use App\Support\Enum;

enum NotificationStatus: int
{
    use Enum;

    case NOT_READ = 0;
    case READ = 1;

    public function badge(): string
    {
        return match ($this) {
            NotificationStatus::NOT_READ => '',
            NotificationStatus::READ => 'bg-green-lt',
        };
    }
}
