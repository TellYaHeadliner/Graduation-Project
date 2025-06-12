<?php

namespace App\Enums\CommissionRule;


use App\Support\Enum;

enum CommissionRuleStatus: int
{
    use Enum;

    case Active = 1;
    case Inactive = 0;

    public function badge(): string
    {
        return match ($this) {
            CommissionRuleStatus::Inactive => 'bg-red-lt',
            CommissionRuleStatus::Active => 'bg-green-lt',
        };
    }
}
