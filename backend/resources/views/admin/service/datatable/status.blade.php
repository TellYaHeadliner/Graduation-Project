<span @class([
    'badge',
    App\Enums\Service\ServiceStatus::from($status)->badge(),
])>{{ \App\Enums\Service\ServiceStatus::getDescription($status) }}</span>
