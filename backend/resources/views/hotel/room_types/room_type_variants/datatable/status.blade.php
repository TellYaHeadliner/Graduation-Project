<span @class([
    'badge',
    App\Enums\RoomType\RoomTypeStatus::from($status)->badge(),
])>{{ \App\Enums\RoomType\RoomTypeStatus::getDescription($status) }}</span>
