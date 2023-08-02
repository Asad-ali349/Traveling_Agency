<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visa_reservation extends Model
{
    use HasFactory; 
    protected $table ='visa_reservation';
    protected $fillable=[
        'id', 'reservation_id', 'visa_type', 'from_date', 'to_date', 'length_of_stay', 'service_price', 'created_at', 'updated_at'
    ]; 
}
