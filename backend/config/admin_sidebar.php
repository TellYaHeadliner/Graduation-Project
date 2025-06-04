<?php

return [
    [
        'title' => 'Dashboard',
        'routeName' => 'admin.dashboard',
        'icon' => '<i class="ti ti-home"></i>',
        'sub' => []
    ],
    [
        'title' => 'Quản lý Tiện ích',
        'routeName' => null,
        'icon' => '<i class="ti ti-tournament"></i>',
        'sub' => [
            [
                'title' => 'Thêm Tiện ích',
                'routeName' => 'admin.amenity.create',
                'icon' => '<i class="ti ti-plus"></i>',
            ],
            [
                'title' => 'DS Tiện ích',
                'routeName' => 'admin.amenity.index',
                'icon' => '<i class="ti ti-list"></i>',
            ]
        ]
    ],
    [
        'title' => 'Quản lý Loại giường',
        'routeName' => null,
        'icon' => '<i class="ti ti-bed"></i>',
        'sub' => [
            [
                'title' => 'Thêm Loại giường',
                'routeName' => 'admin.bed_type.create',
                'icon' => '<i class="ti ti-plus"></i>',
            ],
            [
                'title' => 'DS Loại giường',
                'routeName' => 'admin.bed_type.index',
                'icon' => '<i class="ti ti-list"></i>',
            ]
        ]
    ],
    [
        'title' => 'Quản lý Người dùng',
        'routeName' => null,
        'icon' => '<i class="ti ti-user"></i>',
        'sub' => [
            [
                'title' => 'Thêm Người dùng',
                'routeName' => 'admin.user.create',
                'icon' => '<i class="ti ti-plus"></i>',
            ],
            [
                'title' => 'DS Người dùng',
                'routeName' => 'admin.user.index',
                'icon' => '<i class="ti ti-list"></i>',
            ]
        ]
    ],
    [
        'title' => 'Quản lý Khách sạn',
        'routeName' => null,
        'icon' => '<i class="ti ti-building-skyscraper"></i>',
        'sub' => [
            [
                'title' => 'Thêm Khách sạn',
                'routeName' => 'admin.hotel.create',
                'icon' => '<i class="ti ti-plus"></i>',
            ],
            [
                'title' => 'DS Khách sạn',
                'routeName' => 'admin.hotel.index',
                'icon' => '<i class="ti ti-list"></i>',
            ]
        ]
    ],
    [
        'title' => 'Quản lý dịch vụ',
        'routeName' => null,
        'icon' => '<i class="ti ti-server"></i>',
        'sub' => [
            [
                'title' => 'Thêm Dịch vụ',
                'routeName' => 'admin.service.create',
                'icon' => '<i class="ti ti-plus"></i>',
            ],
            [
                'title' => 'DS Dịch vụ',
                'routeName' => 'admin.service.index',
                'icon' => '<i class="ti ti-list"></i>',
            ]
        ]
    ],
];
