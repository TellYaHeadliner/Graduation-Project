<span @class([
    'badge',
    App\Enums\Room\RoomStatus::from($status)->badge(),
])>{{ \App\Enums\Room\RoomStatus::getDescription($status) }}</span>
