<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $guarded = [];
    protected $casts = [];

    public function users(){
        return $this->belongsToMany(User::class,'notification_user','notification_id','user_id')
                    ->withPivot(['is_read','read_at'])
                    ->withTimestamps();
    }
}
