<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grouping extends Model
{
    use HasFactory; 
    protected $table ='grouping';
    protected $fillable=[
        'id', 'group_name', 'going_date', 'coming_date','group_by','group_by_role', 'created_at', 'updated_at'
    ]; 
    function members() {
        return $this->hasMany('App\Models\group_members');
    }
}
