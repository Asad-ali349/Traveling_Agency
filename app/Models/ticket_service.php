<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket_service extends Model
{
    use HasFactory; 
    protected $table ='ticket_service';
    protected $fillable=[
        'id', 'name', 'type', 'flight_type', 'air_company', 'buying_price_for_package', 'selling_price_for_package', 'created_at', 'updated_at'
    ]; 
    function airline() {
        return $this->belongsTo(air_company::class,'air_company');
    }
}
