<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $table = 'conversations';
    protected $guarded = [];
    protected $casts = [];

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function partner(){
        return $this->belongsTo(User::class, 'partner_id');
    }

    public function messages(){
        return $this->hasMany(Message::class,'conversation_id');
    }
}
