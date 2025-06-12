<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherHotel extends Model
{
    use HasFactory;
    protected $table = 'voucher_hotels';
    protected $guarded = [];
    protected $casts = [];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
