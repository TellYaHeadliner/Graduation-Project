<?php

namespace App\Models;

use App\Enums\HotelService\HotelServiceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelService extends Model
{
    use HasFactory;

    protected $table = 'hotel_services';
    protected $guarded = [];
    protected $casts = [
        'status' => HotelServiceStatus::class
    ];
    public $timestamps = true;


    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function combos()
    {
        return $this->belongsToMany(Combo::class, 'combo_services', 'hotel_service_id', 'combo_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_services', 'hotel_service_id', 'booking_id')
            ->withPivot('quantity', 'price', 'total_price')
            ->withTimestamps();
    }

    public function comboServices()
    {
        return $this->hasMany(ComboService::class, 'hotel_service_id');
    }
}
