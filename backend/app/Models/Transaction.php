<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $guarded = [];
    protected $casts = [];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
    public function voucher()
    {
        return $this->belongsTo(Voucher::class,'voucher_id');
    }
}
