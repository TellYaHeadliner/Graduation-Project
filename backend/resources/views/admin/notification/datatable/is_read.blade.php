<span @class([
    'badge',
    App\Enums\Notification\NotificationStatus::from($is_read)->badge(),
])>{{ \App\Enums\Notification\NotificationStatus::getDescription($is_read) }}</span>
