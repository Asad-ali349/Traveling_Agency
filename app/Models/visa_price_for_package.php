<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visa_price_for_package extends Model
{
    use HasFactory; 
    protected $table ='visa_price_for_package';
    protected $fillable=[
        'id', 'visa_service_id', 'adult_buying', 'adult_selling', 'child_buying', 'child_selling', 'infant_buying', 'infant_selling', 'created_at', 'updated_at'
    ]; 
}
