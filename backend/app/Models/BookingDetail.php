<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $table = 'booking_details';
    protected $guarded = [];
    protected $casts = [];

    public function booking()
    {
        return $this->belongsTo(Booking::class,'booking_id');
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class,'room_type_id');
    }

    public function variant()
    {
        return $this->belongsTo(RoomTypeVariant::class, 'room_type_variant_id');
    }
}
