<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class collaborator extends Model
{
    use HasFactory; 
    protected $table ='collaborator';
    protected $fillable=[
        'id', 'name', 'location', 'phone', 'created_at', 'updated_at'
    ]; 
}
