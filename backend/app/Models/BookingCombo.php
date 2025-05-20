<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingCombo extends Model
{
    use HasFactory;
    protected $table = 'booking_combos';
    protected $guarded = [];
    protected $casts = [];
    public $timestamps = true;

    public function booking(){
        return $this->belongsTo(Booking::class,'booking_id');
    }

    public function combo(){
        return $this->belongsTo(Combo::class,'combo_id');
    }
}
