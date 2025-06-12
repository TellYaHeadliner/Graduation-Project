<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commission_rules extends Model
{
    use HasFactory;
     protected $table = 'commission_rules';
    protected $guarded = [];
    protected $casts = [];
}
