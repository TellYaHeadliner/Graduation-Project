<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRule extends Model
{
    use HasFactory;

    protected $table = 'hotel_rules';
    protected $guarded = [];
    protected $casts = [];

    public function hotel(){
        return $this->belongsTo(Hotel::class,'id','id');
    }
}
