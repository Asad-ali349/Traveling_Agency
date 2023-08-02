<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class air_company extends Model
{
    use HasFactory; 
    protected $table ='air_company';
    protected $fillable=[
        'id', 'name', 'abbreviation', 'created_at', 'updated_at'
    ]; 
}
