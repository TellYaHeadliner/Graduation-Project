<?php

namespace App\Models;

use App\Enums\RoomTypeVariant\RoomTypeVariantStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypeVariant extends Model
{
    use HasFactory;
    protected $table = 'room_type_variants';
    protected $guarded = [];
    protected $casts = [
        'status' => RoomTypeVariantStatus::class,
    ];
    public $timestamps = true;

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'variant_attributes', 'variant_id', 'attribute_id')
            ->withPivot('attribute_value')
            ->withTimestamps();
    }

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'room_type_season_prices', 'room_type_variant_id', 'season_id')
            ->withPivot(['discount_type', 'discount_value'])
            ->withTimestamps();
    }

    public function seasonPrices()
    {
        return $this->hasMany(RoomTypeSeasonPrice::class);
    }


    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class, 'room_type_variant_id');
    }

}
