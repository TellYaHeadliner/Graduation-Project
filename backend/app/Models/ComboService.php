<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboService extends Model
{
    use HasFactory;

    protected $table = 'combo_services';
    protected $guarded = [];
    protected $casts = [];

    public $timestamps = true;

    public function combo(){
        return $this->belongsTo(Combo::class,'combo_id');
    }

    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }
}
