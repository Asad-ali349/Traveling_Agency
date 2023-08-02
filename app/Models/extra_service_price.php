<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extra_service_price extends Model
{
    use HasFactory; 
    protected $table ='extra_service_price';
    protected $fillable=[
        'id', 'extra_service_id', 'adult_buying_one', 'adult_selling_one', 'adult_buying_round', 'adult_selling_round', 'child_buying_one', 'child_selling_one', 'child_buying_round', 'child_selling_round', 'infant_buying_one', 'infant_selling_one', 'infant_buying_round', 'infant_selling_round', 'created_at', 'updated_at'
    ]; 
}
