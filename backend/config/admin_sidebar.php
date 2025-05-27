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
   

];
