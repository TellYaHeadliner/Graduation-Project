<?php

return [
    [
        'title' => 'Dashboard',
        'routeName' => 'hotel.dashboard',
        'icon' => '<i class="ti ti-home"></i>',
        'param' => true,
        'sub' => []
    ],
    [
        'title' => 'Quy tắc đặt chỗ',
        'routeName' => 'hotel.hotel_rules.index',
        'icon' => '<i class="ti ti-clipboard-text"></i>',
        'param' => true,
        'sub' => []
    ],
    [
        'title' => 'Quản lý tiện ích',
        'routeName' => 'hotel.amenity.index',
        'icon' => '<i class="ti ti-tools"></i>',
        'param' => true,
        'sub' => []
    ],
    [
        'title' => 'Thông tin khách sạn',
        'routeName' => 'hotel.information.index',
        'icon' => '<i class="ti ti-file-description"></i>',
        'param' => true,
        'sub' => []
    ],
    [
        'title' => 'DS Giao dịch',
        'routeName' => 'hotel.transaction.index',
        'icon' => '<i class="ti ti-wallet"></i>',
        'param' => true,
        'sub' => []
    ],
    [
        'title' => 'DS Booking',
        'routeName' => 'hotel.booking.index',
        'icon' => '<i class="ti ti-calendar-check"></i>',
        'param' => true,
        'sub' => []
    ],
    [
        'title' => 'Quản lý dịch vụ',
        'routeName' => null,
        'icon' => '<i class="ti ti-package"></i>',
        'sub' => [
            [
                'title' => 'Thêm dịch vụ',
                'routeName' => 'hotel.hotel_service.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'param' => true,
            ],
            [
                'title' => 'DS dịch vụ',
                'routeName' => 'hotel.hotel_service.index',
                'icon' => '<i class="ti ti-list"></i>',
                'param' => true,
            ]
        ]
    ],
    [
        'title' => 'Quản lý Combo',
        'routeName' => null,
        'icon' => '<i class="ti ti-box-multiple"></i>',
        'sub' => [
            [
                'title' => 'Thêm Combo',
                'routeName' => 'hotel.combo.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'param' => true,
            ],
            [
                'title' => 'DS Combo',
                'routeName' => 'hotel.combo.index',
                'icon' => '<i class="ti ti-list"></i>',
                'param' => true,
            ]
        ]
    ],
    [
        'title' => 'Quản lý Loại phòng',
        'routeName' => null,
        'icon' => '<i class="ti ti-bed"></i>',
        'sub' => [
            [
                'title' => 'Thêm Loại phòng',
                'routeName' => 'hotel.room_type.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'param' => true,
            ],
            [
                'title' => 'DS Loại phòng',
                'routeName' => 'hotel.room_type.index',
                'icon' => '<i class="ti ti-list"></i>',
                'param' => true,
            ]
        ]
    ],
    [
        'title' => 'Quản lý Phòng',
        'routeName' => null,
        'icon' => '<i class="ti ti-door"></i>',
        'sub' => [
            [
                'title' => 'DS Phòng',
                'routeName' => 'hotel.room.index',
                'icon' => '<i class="ti ti-list"></i>',
                'param' => true,
            ]
        ]
    ],

];
