<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lodging_reservation extends Model
{
    use HasFactory; 
    protected $table ='lodging_reservation';
    protected $fillable=[
        'id', 'reservation_id', 'destination', 'lodging_in_madina', 'room_type_in_madina', 'from_date_madina', 'to_date_madina', 'lodging_in_makkah', 'room_type_in_makkah', 'from_date_makkah', 'to_date_makkah', 'lodging_length_stay_madina','lodging_length_stay_makkah', 'madina_price', 'makkah_price','madina_buying_price', 'makkah_buying_price', 'created_at', 'updated_at'
    ]; 

    function lodging_madina() {
        return $this->belongsTo(lodging_service::class,'lodging_in_madina');
    }
    function lodging_makkah() {
        return $this->belongsTo(lodging_service::class,'lodging_in_makkah');
    }
}
