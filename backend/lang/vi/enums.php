<?php

use App\Enums\User\UserRole;

return [
    UserRole::class => [
        UserRole::Admin->value => 'Admin',
        UserRole::Customer->value => 'Khách hàng',
        UserRole::Owner->value => 'Chủ khách sạn',
    ],
];
