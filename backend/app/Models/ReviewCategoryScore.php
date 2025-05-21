<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewCategoryScore extends Model
{
    use HasFactory;
    protected $table = 'review_category_scores';
    protected $guarded = [];
    protected $casts = [];
    public $timestamps = true;

    public function review(){
        return $this->belongsTo(Review::class, 'review_id');
    }
    public function reviewCategory(){
        return $this->belongsTo(ReviewCategory::class, 'category_id');
    }
}
