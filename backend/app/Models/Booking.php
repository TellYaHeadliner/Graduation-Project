<?php

namespace App\Models;

use App\Enums\Booking\BookingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $guarded = [];
    protected $casts = [
        'status' => BookingStatus::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'booking_id');
    }

    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class, 'booking_id');
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'booking_id');
    }

    public  function review()
    {
        return $this->hasOne(Review::class, 'booking_id');
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function hotelServices()
    {
        return $this->belongsToMany(HotelService::class, 'booking_services', 'booking_id', 'hotel_service_id')
            ->withPivot(['quantity', 'price', 'total_price'])
            ->withTimestamps();
    }

    public function combos()
    {
        return $this->belongsToMany(Combo::class, 'booking_combos', 'booking_id', 'combo_id')
            ->withPivot(['quanlity', 'price', 'total_price'])
            ->withTimestamps();
    }
}
