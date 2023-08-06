<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_members extends Model
{
    use HasFactory; 
    protected $table ='group_members';
    protected $fillable=[
        'id', 'grouping_id', 'reservation_id', 'created_at', 'updated_at'
    ];

    function reservation() {
        return $this->belongsTo(reservation::class,'reservation_id');
    }

}
