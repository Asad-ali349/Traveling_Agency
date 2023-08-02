<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticketing extends Model
{
    use HasFactory; 
    protected $table ='ticketing';
    protected $fillable=[
        'id', 'client_id', 'is_group', 'selling_price', 'buying_price', 'service_price', 'created_at', 'updated_at'
    ]; 
}
