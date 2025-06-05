<span @class([
    'badge',
    App\Enums\Hotel\HotelStatus::from($status)->badge(),
])>{{ \App\Enums\Hotel\HotelStatus::getDescription($status) }}</span>
