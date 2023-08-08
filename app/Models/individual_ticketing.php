<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class individual_ticketing extends Model
{
    use HasFactory; 
    protected $table ='individual_ticketing';
    protected $fillable=[
        'id', 'reservation_id','ticketing_type', 'selling_price', 'buying_price', 'service_price', 'created_at', 'updated_at'
    ]; 
    public function reservation()
    {
        return $this->belongsTo(reservation::class, 'reservation_id');
    }
}
