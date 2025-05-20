<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelService extends Model
{
    use HasFactory;

    protected $table = 'hotel_services';
    protected $guarded = [];
    protected $casts = [];
    public $timestamps = true;


    public function hotel(){
        return $this->belongsTo(Hotel::class,'hotel_id');
    }
    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }
}
