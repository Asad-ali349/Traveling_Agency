<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_members extends Model
{
    use HasFactory; 
    protected $table ='group_members';
    protected $fillable=[
        'id', 'group_id', 'customer_id', 'created_at', 'updated_at'
    ]; 
}
