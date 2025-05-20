<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $table = 'room_types';
    protected $guarded = [];
    protected $casts = [];

    public function hotel(){
        return $this->belongsTo(Hotel::class,'hotel_id');
    }
    public function rooms(){
        return $this->hasMany(Room::class,'room_type_id');
    }
    public function roomTypeBeds(){
        return $this->hasMany(RoomTypeBed::class,'room_type_id');
    }
    public function bedTypes(){
        return $this->belongsToMany(BedType::class, 'room_type_beds', 'room_type_id', 'bed_type_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
    public function roomTypeAmenities()
    {
        return $this->hasMany(RoomTypeAmenity::class,'room_type_id');
    }
    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'room_type_amenities', 'room_type_id', 'amenity_id');
    }
    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class,'room_type_id');
    }
    public function variants()
    {
        return $this->hasMany(RoomTypeVariant::class,'room_type_id');
    }

}
