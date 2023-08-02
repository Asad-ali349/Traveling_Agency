<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transport_service_price_for_adult extends Model
{
    use HasFactory; 
    protected $table ='transport_service_price_for_adult';
    protected $fillable=[
        'id', 'transport_service_id', 'vip_morroco_buying_one', 'vip_morroco_selling_one', 'vip_morroco_buying_round', 'vip_morroco_selling_round', 'vip_ksa_buying_one', 'vip_ksa_selling_one', 'vip_ksa_buying_round', 'vip_ksa_selling_round', 'normal_morroco_buying_one', 'normal_morroco_selling_one', 'normal_morroco_buying_round', 'normal_morroco_selling_round', 'normal_ksa_buying_one', 'normal_ksa_selling_one', 'normal_ksa_buying_round', 'normal_ksa_selling_round', 'created_at', 'updated_at'
    ]; 
}
