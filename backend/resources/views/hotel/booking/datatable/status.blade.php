<span @class([
    'badge',
    App\Enums\Booking\BookingStatus::from($status)->badge(),
])>{{ \App\Enums\Booking\BookingStatus::getDescription($status) }}</span>
