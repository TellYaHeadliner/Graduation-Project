<?php

namespace App\Models;

use App\Enums\HotelRule\HotelRuleChildPolicy;
use App\Enums\HotelRule\HotelRulePetPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRule extends Model
{
    use HasFactory;

    protected $table = 'hotel_rules';
    protected $guarded = [];
    protected $casts = [
        'child_policy' => HotelRuleChildPolicy::class,
        'pet_policy' => HotelRulePetPolicy::class,
    ];

    public function hotel(){
        return $this->belongsTo(Hotel::class,'id','id');
    }
}
    