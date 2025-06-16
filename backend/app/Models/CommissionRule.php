<?php

namespace App\Models;

use App\Enums\CommissionRule\CommissionRuleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionRule extends Model
{
    use HasFactory;
     protected $table = 'commission_rules';
    protected $guarded = [];
    protected $casts = [
        'is_active' => CommissionRuleStatus::class,
    ];
}
