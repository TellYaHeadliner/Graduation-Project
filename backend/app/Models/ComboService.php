<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboService extends Model
{
    use HasFactory;

    protected $table = 'combo_services';
    protected $guarded = [];
    protected $casts = [];

    public $timestamps = true;

    public function combo(){
        return $this->belongsTo(Combo::class,'combo_id');
    }

    public function hotelService(){
        return $this->belongsTo(HotelService::class,'hotel_service_id','id');
    }

    public function service(){
        return $this->hasOneThrough(Service::class, HotelService::class, 'id', 'id', 'hotel_service_id', 'service_id');
    }
}
