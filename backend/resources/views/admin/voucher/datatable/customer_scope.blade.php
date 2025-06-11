<span @class([
    'badge',
    App\Enums\Voucher\VoucherCustomerScope::from($customer_scope)->badge(),
])>{{ \App\Enums\Voucher\VoucherCustomerScope::getDescription($customer_scope) }}</span>
