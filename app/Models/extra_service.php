<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extra_service extends Model
{
    use HasFactory; 
    protected $table ='extra_service';
    protected $fillable=[
        'id', 'name', 'created_at', 'updated_at'
    ]; 

    function service_price() {
        return $this->hasOne('App\Models\extra_service_price');
    }
}
