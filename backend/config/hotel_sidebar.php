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
        'title' => 'Quản lý Tiện ích',
        'routeName' => null,
        'icon' => '<i class="ti ti-school"></i>',
        'sub' => [
            [
                'title' => 'Thêm Lớp',
                'routeName' => null,
                'icon' => '<i class="ti ti-plus"></i>',
            ],
            [
                'title' => 'DS Lớp học',
                'routeName' => null,
                'icon' => '<i class="ti ti-list"></i>',
            ]
        ]
    ],
   

];
