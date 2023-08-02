<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lodging_service_price_for_package extends Model
{
    use HasFactory; 
    protected $table ='lodging_service_price_for_package';
    protected $fillable=[
        'id', 'lodging_service_id', 'room_two_buying_adult', 'room_two_selling_adult', 'room_two_buying_child', 'room_two_selling_child', 'room_two_buying_infant', 'room_two_selling_infant', 'room_three_buying_adult', 'room_three_selling_adult', 'room_three_buying_child', 'room_three_selling_child', 'room_three_buying_infant', 'room_three_selling_infant', 'room_four_buying_adult', 'room_four_selling_adult', 'room_four_buying_child', 'room_four_selling_child', 'room_four_buying_infant', 'room_four_selling_infant', 'room_five_buying_adult', 'room_five_selling_adult', 'room_five_buying_child', 'room_five_selling_child', 'room_five_buying_infant', 'room_five_selling_infant', 'created_at', 'updated_at'
    ]; 
}
