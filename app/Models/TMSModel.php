<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMSModel extends Model
{
    use HasFactory;
    protected $table = 'tms';
    protected $primaryKey = 'id';

    public function getDueDateAttribute($value){
        return date('d-M-Y', strtotime($value));
    }
    public function getCreatedAtAttribute($value){
        return date('d-M-Y', strtotime($value));
    }
    
}
