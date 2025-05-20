<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $table = 'complaints';
    protected $guarded = [];
    protected $casts = [];

      public function booking(){
        return $this->belongsTo(Booking::class,'booking_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class,'hotel_id');
    }
}
