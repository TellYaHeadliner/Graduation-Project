<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewCategory extends Model
{
    use HasFactory;
    protected $table = 'review_categories';
    protected $guarded = [];
    protected $casts = [];

    public function reviews(){
                return $this->belongsToMany(Review::class, 'review_category_scores','category_id','review_id')
                    ->withPivot('score')
                    ->withTimestamps();
    }

}
