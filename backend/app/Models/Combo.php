<?php

namespace App\Models;

use App\Enums\Combo\ComboStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    use HasFactory;

    protected $table = 'combos';
    protected $guarded = [];
    protected $casts = [
        'status' => ComboStatus::class,
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
    public function hotelServices()
    {
        return $this->belongsToMany(HotelService::class, 'combo_services', 'combo_id', 'hotel_service_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }
    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_combos', 'combo_id', 'booking_id')
            ->withPivot('quantity', 'price', 'total_price')
            ->withTimestamps();
    }

    public function comboServices()
    {
        return $this->hasMany(ComboService::class, 'combo_id');
    }
}
