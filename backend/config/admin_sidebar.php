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
            ],
            [
                'title' => 'DS Khách sạn đăng kí',
                'routeName' => 'admin.hotel.indexHotelApproval',
                'icon' => '<i class="ti ti-list"></i>',
            ],
        ]
    ],
    [
        'title' => 'DS Giao dịch',
        'routeName' => 'admin.transaction.index',
        'icon' => '<i class="ti ti-list"></i>',
        'sub' => []
    ],
        [
        'title' => 'DS Booking',
        'routeName' => 'admin.booking.index',
        'icon' => '<i class="ti ti-list"></i>',
        'sub' => []
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
    [
        'title' => 'Quản lý thuộc tính',
        'routeName' => null,
        'icon' => '<i class="ti ti-chart-dots"></i>',
        'sub' => [
            [
                'title' => 'Thêm Thuộc tính',
                'routeName' => 'admin.attribute.create',
                'icon' => '<i class="ti ti-plus"></i>',
            ],
            [
                'title' => 'DS Thuộc tính',
                'routeName' => 'admin.attribute.index',
                'icon' => '<i class="ti ti-list"></i>',
            ]
        ]
    ],
    [
        'title' => 'Quản lý mùa ưu đãi',
        'routeName' => null,
        'icon' => '<i class="ti ti-clock-hour-10"></i>',
        'sub' => [
            [
                'title' => 'Thêm mùa mới',
                'routeName' => 'admin.season.create',
                'icon' => '<i class="ti ti-plus"></i>',
            ],
            [
                'title' => 'DS Mùa',
                'routeName' => 'admin.season.index',
                'icon' => '<i class="ti ti-list"></i>',
            ]
        ]
    ],
    [
        'title' => 'Quản lý thông báo',
        'routeName' => null,
        'icon' => '<i class="ti ti-bell"></i>',
        'sub' => [
            [
                'title' => 'Thêm thông báo',
                'routeName' => 'admin.notification.create',
                'icon' => '<i class="ti ti-plus"></i>',
            ],
            [
                'title' => 'DS Thông báo',
                'routeName' => 'admin.notification.index',
                'icon' => '<i class="ti ti-list"></i>',
            ]
        ]
    ],
    [
        'title' => 'Quản lý voucher',
        'routeName' => null,
        'icon' => '<i class="ti ti-ticket"></i>',
        'sub' => [
            [
                'title' => 'Thêm voucher',
                'routeName' => 'admin.voucher.create',
                'icon' => '<i class="ti ti-plus"></i>',
            ],
            [
                'title' => 'DS Voucher',
                'routeName' => 'admin.voucher.index',
                'icon' => '<i class="ti ti-list"></i>',
            ]
        ]
    ],
    [
        'title' => 'Cấu hình quy tắc hoa hồng',
        'routeName' => null,
        'icon' => '<i class="ti ti-settings"></i>',
        'sub' => [
            [
                'title' => 'Thêm quy tắc hoa hồng',
                'routeName' => 'admin.commission_rule.create',
                'icon' => '<i class="ti ti-plus"></i>',
            ],
            [
                'title' => 'DS Quy tắc hoa hồng',
                'routeName' => 'admin.commission_rule.index',
                'icon' => '<i class="ti ti-list"></i>',
            ]
        ]
    ],
];
