<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_ticketing extends Model
{
    use HasFactory; 
    protected $table ='group_ticketing';
    protected $fillable=[
        'id', 'grouping_id','ticketing_type', 'selling_price', 'buying_price', 'service_price', 'created_at', 'updated_at'
    ]; 


    public function grouping()
    {
        return $this->belongsTo(grouping::class, 'grouping_id');
    }

}
