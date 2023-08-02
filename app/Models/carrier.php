<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carrier extends Model
{
    use HasFactory; 
    protected $table ='carrier';
    protected $fillable=[
        'id', 'company_name', 'driver_name', 'phone', 'created_at', 'updated_at'
    ]; 
}
