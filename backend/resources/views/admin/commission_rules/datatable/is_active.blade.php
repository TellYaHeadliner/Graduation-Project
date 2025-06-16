<span @class([
    'badge',
    App\Enums\CommissionRule\CommissionRuleStatus::from($is_active)->badge(),
])>{{ \App\Enums\CommissionRule\CommissionRuleStatus::getDescription($is_active) }}</span>
