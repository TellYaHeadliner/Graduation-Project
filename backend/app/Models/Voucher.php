<?php

namespace App\Models;

use App\Enums\Voucher\VoucherDiscountType;
use App\Enums\Voucher\VoucherStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'vouchers';
    protected $guarded = [];
    protected $casts = [
        'discount_type' => VoucherDiscountType::class,
        'is_active' => VoucherStatus::class
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'voucher_user', 'voucher_id', 'user_id')
            ->withTimestamps();
    }
    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'voucher_hotels', 'voucher_id', 'hotel_id')
            ->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
