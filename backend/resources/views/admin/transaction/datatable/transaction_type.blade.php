<span @class([
    'badge',
    App\Enums\Transaction\TransactionType::from($transaction_type)->badge(),
])>{{ \App\Enums\Transaction\TransactionType::getDescription($transaction_type) }}</span>
