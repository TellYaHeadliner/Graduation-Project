<span @class([
    'badge',
    App\Enums\Transaction\TransactionStatus::from($payment_status)->badge(),
])>{{ \App\Enums\Transaction\TransactionStatus::getDescription($payment_status) }}</span>
