<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $table = 'seasons';
    protected $guarded = [];
    protected $casts = [];

    public function roomTypeVariants(){
                return $this->belongsToMany(Season::class, 'room_type_season_prices', 'season_id', 'room_type_variant_id')
                    ->withPivot(['discount_type','discount_value','status'])
                    ->withTimestamps();
    }
}
