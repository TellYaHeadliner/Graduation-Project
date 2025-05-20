<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingService extends Model
{
    use HasFactory;

    protected $table = 'booking_services';
    protected $guarded = [];
    protected $casts = [];
    public $timestamps = true;

    public function booking(){
        return $this->belongsTo(Booking::class,'booking_id');
    }
    public function service()
    {
        return $this->belongsTo(Service::class,'service_id');
    }
}
