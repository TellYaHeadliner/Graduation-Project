<?php

use App\Enums\Attribute\AttributeStatus;
use App\Enums\Combo\ComboStatus;
use App\Enums\CommissionRule\CommissionRuleStatus;
use App\Enums\Hotel\HotelStatus;
use App\Enums\HotelRule\HotelRuleChildPolicy;
use App\Enums\HotelRule\HotelRulePetPolicy;
use App\Enums\HotelService\HotelServiceStatus;
use App\Enums\Notification\NotificationStatus;
use App\Enums\RoomType\RoomTypeStatus;
use App\Enums\Season\SeasonStatus;
use App\Enums\Service\ServiceStatus;
use App\Enums\User\UserGender;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Enums\Voucher\VoucherCustomerScope;
use App\Enums\Voucher\VoucherDiscountType;
use App\Enums\Voucher\VoucherDiscountTypeStatus;
use App\Enums\Voucher\VoucherHotelScope;
use App\Enums\Voucher\VoucherStatus;
use App\Models\CommissionRule;
use App\Models\HotelRule;
use App\Models\HotelService;
use App\Models\RoomType;
use App\Models\Service;
use App\Models\Voucher;

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
    VoucherStatus::class => [
        VoucherStatus::Blocked->value => 'Ngừng áp dụng',
        VoucherStatus::Active->value => 'Đang áp dụng',
    ],
    VoucherDiscountType::class => [
        VoucherDiscountType::FixedAmount->value => 'Số tiền cố định',
        VoucherDiscountType::Percentage->value => 'Giảm giá phần trăm',
    ],
    VoucherHotelScope::class => [
        VoucherHotelScope::All->value => 'Tất cả',
        VoucherHotelScope::SpecificHotels->value => 'Một số khách sạn',
    ],
    VoucherCustomerScope::class => [
        VoucherCustomerScope::All->value => 'Tất cả',
        VoucherCustomerScope::SpecificCustomers->value => 'Một số khách hàng',
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
    CommissionRuleStatus::class => [
        CommissionRuleStatus::Inactive->value => 'Tạm ngưng áp dụng',
        CommissionRuleStatus::Active->value => 'Đang áp dụng',
    ],
    ComboStatus::class => [
        ComboStatus::Inactive->value => 'Tạm ngưng áp dụng',
        ComboStatus::Active->value => 'Đang áp dụng',
    ],
    HotelServiceStatus::class => [
        HotelServiceStatus::INACTIVE->value => 'Đang bảo trì',
        HotelServiceStatus::Active->value => 'Đang hoạt động',
    ],
    RoomTypeStatus::class => [
        RoomTypeStatus::Discontinued->value => 'Ngừng hoạt động',
        RoomTypeStatus::Active->value => 'Đang hoạt động',
        RoomTypeStatus::TemporarilyUnavailable->value => 'Hết phòng tạm thời',
    ],
    HotelRulePetPolicy::class => [
        HotelRulePetPolicy::Allowed->value => 'Cho phép',
        HotelRulePetPolicy::NotAllowed->value => 'Không cho phép',
    ],
    HotelRuleChildPolicy::class => [
        HotelRuleChildPolicy::Allowed->value => 'Cho phép',
        HotelRuleChildPolicy::NotAllowed->value => 'Không cho phép',
    ],
    
];
