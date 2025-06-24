<?php

namespace App\Models;

use App\Enums\Attribute\AttributeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $table = 'attributes';
    protected $guarded = [];
    protected $casts = [
        'status' => AttributeStatus::class,
    ];

    public function variants()
    {
        return $this->belongsToMany(RoomTypeVariant::class, 'variant_attributes', 'attribute_id', 'variant_id')
            ->withPivot('attribute_value')
            ->withTimestamps();
    }
}
