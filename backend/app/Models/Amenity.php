<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $table = 'amenities';
    protected $guarded = [];
    protected $casts = [];

    public function children(){
        return $this->hasMany(Amenity::class, 'parent_id');
    }

    public function parent(){
        return $this->belongsTo(Amenity::class, 'parent_id');
    }

    public function hotels(){
        return $this->belongsToMany(Hotel::class, 'hotel_amenities', 'amenity_id', 'hotel_id');
    }

    public function roomTypes(){
        return $this->belongsToMany(RoomType::class, 'room_type_amenities', 'amenity_id', 'room_type_id');
    }


}
