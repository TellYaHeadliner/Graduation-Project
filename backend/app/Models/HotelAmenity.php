<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelAmenity extends Model
{
    use HasFactory;

    protected $table = 'favorites';
    protected $guarded = [];
    protected $casts = [];

    public $timestamps = true;

    public function hotel(){
        return $this->belongsTo(Hotel::class,'hotel_id');
    }
    public function amenities(){
        return $this->belongsTo(Amenity::class,'amenity_id');
    }
}
