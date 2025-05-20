<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedType extends Model
{
    use HasFactory;

    protected $table = 'bed_types';
    protected $guarded = [];
    protected $casts = [];

    public function roomTypes(){
        return $this->belongsToMany(RoomType::class,'room_type_beds','bed_type_id','room_type_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
