<?php

return [
    [
        'title' => 'Dashboard',
        'routeName' => 'admin',
        'icon' => '<i class="ti ti-home"></i>',
        'sub' => []
    ],
    [
        'title' => 'Quản lý Tiện ích',
        'routeName' => null,
        'icon' => '<i class="ti ti-school"></i>',
        'sub' => [
            [
                'title' => 'Thêm Lớp',
                'routeName' => 'admin',
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
