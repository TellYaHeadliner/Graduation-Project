<span @class([
    'badge',
    App\Enums\Season\SeasonStatus::from($status)->badge(),
])>{{ \App\Enums\Season\SeasonStatus::getDescription($status) }}</span>
