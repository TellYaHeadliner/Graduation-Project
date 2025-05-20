<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $guarded = [];
    protected $casts = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function hotel(){
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
    public function booking(){
        return $this->belongsTo(Booking::class, 'booking_id');
    }
    public function reviewCategories(){
        return $this->belongsToMany(ReviewCategory::class, 'review_category_scores','review_id','category_id')
                    ->withPivot('score')
                    ->withTimestamps();
    }


}
