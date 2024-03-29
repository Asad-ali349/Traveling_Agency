<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extra_service_for_reservation extends Model
{
    use HasFactory; 
    protected $table ='extra_service_for_reservation';
    protected $fillable=[
        'id', 'reservation_id','extra_service_id', 'country', 'type', 'trip_type', 'service_price','extra_service_buying_price', 'created_at', 'updated_at'
    ]; 


    function extra_service() {
        return $this->belongsTo(extra_service::class,'extra_service_id');
    }
}
