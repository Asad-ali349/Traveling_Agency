<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment_detail_for_reservation extends Model
{
    use HasFactory; 
    protected $table ='payment_detail_for_reservation';
    protected $fillable=[
        'id', 'reservation_id', 'payment_method', 'total_amount', 'advance_amount', 'rest_amount', 'created_at', 'updated_at'
    ]; 
}
