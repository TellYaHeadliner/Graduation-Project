<span @class([
    'badge',
    App\Enums\Combo\ComboStatus::from($status)->badge(),
])>{{ \App\Enums\Combo\ComboStatus::getDescription($status) }}</span>
