<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lodging_service extends Model
{
    use HasFactory; 
    protected $table ='lodging_service';
    protected $fillable=[
        'id', 'hotel_name', 'city', 'hotel_type', 'available_from', 'available_to', 'rooms_for_two', 'rooms_for_three', 'rooms_for_four', 'rooms_for_five', 'created_at', 'updated_at'
    ]; 
    function price_for_package() {
        return $this->hasOne('App\Models\lodging_service_price_for_package');
    }
    function price_for_individual() {
        return $this->hasOne('App\Models\lodging_service_price_for_individual');
    }
}
