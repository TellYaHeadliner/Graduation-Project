<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReputationLog extends Model
{
    use HasFactory;
    protected $table = 'reputation_log';
    protected $guarded = [];
    protected $casts = [];

    public function hotel(){
        return $this->belongsTo(Hotel::class,'hotel_id');
    }
}
