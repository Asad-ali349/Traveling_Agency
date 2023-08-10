<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class package_service extends Model
{ 
    use HasFactory; 
    protected $table ='package_service';
    protected $fillable=[
        'id', 'name', 'available_from', 'available_to', 'visa', 'lodging_in_makkah','room_type_makkah', 'lodging_in_madina','room_type_madina', 'ticket', 'price_for_adult', 'price_for_child', 'price_for_infant','buying_price_for_adult', 'buying_price_for_child', 'buying_price_for_infant', 'created_at', 'updated_at'
    ]; 
}
