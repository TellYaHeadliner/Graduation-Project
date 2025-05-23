<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\User\UserRole;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    protected $table = 'users';
    protected $guarded = [];
    protected $casts = [
        'role'=> UserRole::class,
    ];

    public function hotel(){
        return $this->hasOne(Hotel::class,'id','id');
    }

    public function complaints(){
        return $this->hasMany(Complaint::class,'user_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class,'user_id');
    }

    public function customerConversations(){
        return $this->hasMany(Conversation::class, 'customer_id');
    }
    public function partnerConversations(){
        return $this->hasMany(Conversation::class, 'partner_id');
    }

    public function messages(){
        return $this->hasMany(Message::class,'sender_id');
    }

    public function favorites(){
        return $this->belongsToMany(Hotel::class, 'favorites', 'user_id', 'hotel_id')->withTimestamps();
    }

    public function vouchers(){
        return $this->belongsToMany(Voucher::class, 'voucher_user', 'user_id', 'voucher_id')->withTimestamps();
    }

    public function notifications(){
        return $this->belongsToMany(Notification::class, 'notification_user', 'user_id', 'notification_id')
            ->withPivot(['is_read', 'read_at'])
            ->withTimestamps();
    }

    public function bookings(){
        return $this->hasMany(Booking::class, 'customer_id');
    }
}
