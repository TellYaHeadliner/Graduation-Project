<span @class([
    'badge',
    App\Enums\Voucher\VoucherHotelScope::from($hotel_scope)->badge(),
])>{{ \App\Enums\Voucher\VoucherHotelScope::getDescription($hotel_scope) }}</span>
