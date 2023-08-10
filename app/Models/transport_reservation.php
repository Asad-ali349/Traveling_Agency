<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transport_reservation extends Model
{
    use HasFactory; 
    protected $table ='transport_reservation';
    protected $fillable=[
        'id', 'reservation_id', 'transport_service_id','country', 'type', 'trip_type', 'service_price', 'service_buying_price','created_at', 'updated_at'
    ]; 
    function transport_service() {
        return $this->belongsTo(transport_service::class,'transport_service_id');
    }
}
