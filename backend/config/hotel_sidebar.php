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

];
