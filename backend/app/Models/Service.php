<?php

namespace App\Models;

use App\Enums\Service\ServiceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $guarded = [];
    protected $casts = [
        'status' => ServiceStatus::class
    ];


    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'hotel_services', 'service_id', 'hotel_id')
            ->withPivot('short_description', 'base_price', 'promo_price', 'status')
            ->withTimestamps();
    }
}
