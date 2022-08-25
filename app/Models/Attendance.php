<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $guarded =[]; 

    // public function section(){
    //     return $this->belongsTo(section::Class);
    // }
    public function employer(){
        return $this->belongsTo(Employeer::Class);
    }
}
