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

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class, 'room_id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
