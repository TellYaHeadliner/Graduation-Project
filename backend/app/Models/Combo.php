<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    use HasFactory;

    protected $table = 'booking_services';
    protected $guarded = [];
    protected $casts = [];

     public function hotel()
    {
        return $this->belongsTo(Hotel::class,'hotel_id');
    }
    public function services()
    {
        return $this->belongsToMany(Service::class, 'combo_services', 'combo_id', 'service_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_combos', 'combo_id', 'booking_id')
                    ->withPivot('quantity', 'price', 'total_price')
                    ->withTimestamps();
    }
   

}
