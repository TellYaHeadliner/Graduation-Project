<?php

use App\Enums\Attribute\AttributeStatus;
use App\Enums\Hotel\HotelStatus;
use App\Enums\Notification\NotificationStatus;
use App\Enums\Season\SeasonStatus;
use App\Enums\Service\ServiceStatus;
use App\Enums\User\UserGender;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Models\Service;

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
    AttributeStatus::class => [
        AttributeStatus::Blocked->value => 'Không hiển thị',
        AttributeStatus::Active->value => 'Hiển thị',
    ],
    SeasonStatus::class => [
        SeasonStatus::Blocked->value => 'Ngừng áp dụng',
        SeasonStatus::Active->value => 'Đang áp dụng',
    ],
    NotificationStatus::class => [
        NotificationStatus::NOT_READ->value => 'Chưa đọc',
        NotificationStatus::READ->value => 'Đã đọc',
    ],
    HotelStatus::class => [
        HotelStatus::Pending->value => 'Chờ duyệt',
        HotelStatus::Active->value => 'Đang hoạt động',
        HotelStatus::Blocked->value => 'Khóa',
        HotelStatus::Rejected->value => 'Bị từ chối',
    ],
    ServiceStatus::class => [
        ServiceStatus::Pending->value => 'Chờ duyệt',
        ServiceStatus::Active->value => 'Đang hoạt động',
        ServiceStatus::Suspended->value => 'Tạm ngừng',
    ],
];
