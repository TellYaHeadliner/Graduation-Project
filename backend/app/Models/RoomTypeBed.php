<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomTypeBed extends Model
{
    use HasFactory;
    protected $table = 'room_type_beds';
    protected $guarded = [];
    protected $casts = [];
    public $timestamps = true;

    public function roomType()
    {
        return $this->belongsTo(RoomType::class,'room_type_id');
    }

    public function bedType()
    {
        return $this->belongsTo(BedType::class,'bed_type_id');
    }
}
