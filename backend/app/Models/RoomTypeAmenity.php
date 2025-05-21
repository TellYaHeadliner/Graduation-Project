<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypeAmenity extends Model
{
    use HasFactory;
    protected $table = 'room_type_amenities';
    protected $guarded = [];
    protected $casts = [];
    public $timestamps = true;


    public function roomType()
    {
        return $this->belongsTo(RoomType::class,'room_type_id');
    }
    public function amenity()
    {
        return $this->belongsTo(Amenity::class,'amenity_id');
    }
}
