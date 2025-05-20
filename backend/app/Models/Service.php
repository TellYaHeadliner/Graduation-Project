<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $guarded = [];
    protected $casts = [];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_services', 'service_id', 'booking_id')
                    ->withPivot('quantity', 'price', 'total_price')
                    ->withTimestamps();
    }
    public function combos()
    {
        return $this->belongsToMany(Combo::class, 'combo_services', 'service_id', 'combo_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_services', 'service_id', 'hotel_id')
                    ->withPivot('short_description', 'base_price', 'promo_price')
                    ->withTimestamps();
    }

}
