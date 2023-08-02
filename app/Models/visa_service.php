<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visa_service extends Model
{
    use HasFactory; 
    protected $table ='visa_service';
    protected $fillable=[
        'id', 'visa_name', 'created_at', 'updated_at'
    ]; 
    function package_price() {
        return $this->hasOne('App\Models\visa_price_for_package');
    }
    function individual_price() {
        return $this->hasOne('App\Models\visa_price_for_individual');
    }
}
