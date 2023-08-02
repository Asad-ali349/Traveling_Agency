<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class flight_reservation extends Model
{
    use HasFactory; 
    protected $table ='flight_reservation';
    protected $fillable=[
        'id', 'reservation_id', 'flight_id', 'from_airport', 'to_airport', 'trip_type', 'flight_type', 'air_company_id', 'departure_time', 'return_time', 'service_price', 'created_at', 'updated_at'
    ]; 
}
