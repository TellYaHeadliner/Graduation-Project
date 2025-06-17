<span @class([
    'badge',
    App\Enums\HotelService\HotelServiceStatus::from($status)->badge(),
])>{{ \App\Enums\HotelService\HotelServiceStatus::getDescription($status) }}</span>
