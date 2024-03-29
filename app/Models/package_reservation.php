<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class package_reservation extends Model
{
    use HasFactory; 
    protected $table ='package_reservation';
    protected $fillable=[
        'id', 'reservation_id', 'package_type', 'package_service_id', 'from_date', 'to_date', 'length_of_stay', 'service_price','service_buying_price', 'created_at', 'updated_at'
    ]; 

    function package_service() {
        return $this->belongsTo(package_service::class,'package_service_id');
    }
}
