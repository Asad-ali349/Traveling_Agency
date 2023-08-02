<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grouping extends Model
{
    use HasFactory; 
    protected $table ='grouping';
    protected $fillable=[
        'id', 'group_name', 'going_date', 'coming_date', 'created_at', 'updated_at'
    ]; 
}
