<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypeSeasonPrice extends Model
{
    use HasFactory;
    protected $table = 'room_type_season_prices';
    protected $guarded = [];
    protected $casts = [];
    public $timestamps = true;
    public function roomTypeVariant()
    {
        return $this->belongsTo(RoomTypeVariant::class,'room_type_variant_id');
    }

    public function season()
    {
        return $this->belongsTo(Season::class,'season_id');
    }
}
