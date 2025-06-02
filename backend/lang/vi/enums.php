<?php

use App\Enums\Hotel\HotelStatus;
use App\Enums\User\UserGender;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;

return [
    UserRole::class => [
        UserRole::Admin->value => 'Admin',
        UserRole::Customer->value => 'Khách hàng',
        UserRole::Owner->value => 'Chủ khách sạn',
    ],
    UserStatus::class => [
        UserStatus::Active->value => 'Đang hoạt động',
        UserStatus::Deactivated->value => 'Vô hiệu hóa',
    ],
    UserGender::class => [
        UserGender::Male->value => 'Nam',
        UserGender::Female->value => 'Nữ',
    ],
    HotelStatus::class => [
        HotelStatus::Pending->value => 'Chờ duyệt',
        HotelStatus::Active->value => 'Đang hoạt động',
        HotelStatus::Blocked->value => 'Khóa',
        HotelStatus::Rejected->value => 'Bị từ chối',

    ],
];
