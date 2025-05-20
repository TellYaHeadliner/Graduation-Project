<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantAttribute extends Model
{
    use HasFactory;
    protected $table = 'variant_attributes';
    protected $guarded = [];
    protected $casts = [];

    public function variant()
    {
        return $this->belongsTo(RoomTypeVariant::class, 'variant_id');
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
