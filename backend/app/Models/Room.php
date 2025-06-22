<?php

namespace App\Models;

use App\Enums\Room\RoomStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';
    protected $guarded = [];
    protected $casts = [
        'status' => RoomStatus::class,
    ];

    public function variant()
    {
        return $this->belongsTo(RoomTypeVariant::class, 'variant_id');
    }

    public function roomType()
    {
        return $this->hasOneThrough(
            RoomType::class,
            RoomTypeVariant::class,
            'id',            
            'id',            
            'variant_id',    
            'room_type_id'   
        );
    }
    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class, 'room_id');
    }
}