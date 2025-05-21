<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = 'hotels';
    protected $guarded = [];
    protected $casts = [];

    public function user(){
        return $this->belongsTo(User::class,'id','id');
    }
    public function reputationLogs(){
        return $this->hasMany(ReputationLog::class, 'hotel_id');
    }

    public function roomTypes(){
        return $this->hasMany(RoomType::class, 'hotel_id');
    }

    public function transactions(){
        return $this->hasMany(Transaction::class, 'hotel_id');
    }

    public function combos()
    {
        return $this->hasMany(Combo::class, 'hotel_id');
    }

    public function hotelRule()
    {
        return $this->hasOne(HotelRule::class, 'id','id');
    }

    public function hotelAmenities()
    {
        return $this->hasMany(HotelAmenity::class, 'hotel_id');
    }

    public function hotelServices()
    {
        return $this->hasMany(HotelService::class, 'hotel_id');
    }

    public function services(){
        return $this->belongsToMany(Service::class, 'hotel_services', 'hotel_id', 'service_id')
                    ->withPivot('short_description', 'base_price', 'promo_price')
                    ->withTimestamps();
    }

    public function amenities(){
        return $this->belongsToMany(Amenity::class, 'hotel_amenities', 'hotel_id', 'amenity_id')
                    ->withTimestamps();
    }

    public function bookings(){
        return $this->hasMany(Booking::class, 'hotel_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class, 'hotel_id');
    }

    public function vouchers(){
        return $this->hasMany(Voucher::class, 'hotel_id');
    }

    public function complaints(){
        return $this->hasMany(Complaint::class, 'hotel_id');
    }

    public function favourites(){
        return $this->belongsToMany(User::class,'favourites','hotel_id','user_id')
                    ->withTimestamps();
    }
}
