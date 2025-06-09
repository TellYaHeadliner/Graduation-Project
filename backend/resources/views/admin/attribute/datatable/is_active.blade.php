<span @class([
    'badge',
    App\Enums\Attribute\AttributeStatus::from($is_active)->badge(),
])>{{ \App\Enums\Attribute\AttributeStatus::getDescription($is_active) }}</span>
