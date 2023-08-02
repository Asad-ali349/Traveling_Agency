<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transport_service extends Model
{
    use HasFactory; 
    protected $table ='transport_service';
    protected $fillable=[
        'id', 'name', 'created_at', 'updated_at'
    ];

    function price_for_adult() {
        return $this->hasOne('App\Models\transport_service_price_for_adult');
    }
    function price_for_child() {
        return $this->hasOne('App\Models\transport_service_price_for_child');
    }
    function price_for_infant() {
        return $this->hasOne('App\Models\transport_service_price_for_infant');
    }
}
