<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory; 
    protected $table ='customer';
    protected $fillable=[
        'id', 'first_name', 'last_name', 'sex', 'gender', 'phone', 'dob', 'id_card', 'passport', 'passport_issue_date', 'passport_file', 'nationality', 'city', 'email', 'gaurdian_name', 'gaurdian_phone', 'gaurdian_relation', 'collaborator', 'linked_with', 'created_at', 'updated_at'
    ]; 

    function linkedWith() {
        return $this->belongsTo(customer::class,'linked_with');
    }
    function Collaborator() {
        return $this->belongsTo(collaborator::class,'collaborator');
    }
}
