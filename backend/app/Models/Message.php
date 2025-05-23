<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';
    protected $guarded = [];
    protected $casts = [];

    public function conversation(){
        return $this->belongsTo(Conversation::class,'conversation_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'sender_id');
    }
}
