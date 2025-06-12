<span @class([
    'badge',
    App\Enums\Voucher\VoucherStatus::from($is_active)->badge(),
])>{{ \App\Enums\Voucher\VoucherStatus::getDescription($is_active) }}</span>
