<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';
    protected $guarded = [];
    protected $casts = [];

    public $timestamps = true;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class,'hotel_id');
    }
}
