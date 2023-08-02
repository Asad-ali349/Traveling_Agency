<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    use HasFactory; 
    protected $table ='reservation';
    protected $fillable = [
        'id', 'customer_id', 'service_type', 'reservation_status', 'created_at', 'updated_at'
    ]; 

    function customer() {
        return $this->belongsTo(customer::class,'customer_id');
    }
    function package() {
        return $this->hasOne('App\Models\package_reservation');
    }
    function lodging() {
        return $this->hasOne('App\Models\lodging_reservation');
    }
    function flight() {
        return $this->hasOne('App\Models\flight_reservation');
    }
    function visa() {
        return $this->hasOne('App\Models\visa_reservation');
    }
    function transport() {
        return $this->hasOne('App\Models\transport_reservation');
    }
    function extra_service() {
        return $this->hasOne('App\Models\extra_service_for_reservation');
    }
    function payment() {
        return $this->hasOne('App\Models\payment_detail_for_reservation');
    }

}
