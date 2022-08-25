<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary_report extends Model
{
    use HasFactory;
    protected $guarded =[]; 

    public function section(){
        return $this->belongsTo(section::Class,'section_id','id');
    }

    public function employer(){
        return $this->belongsTo(Employeer::Class);
    }
    public function attendance(){
        return $this->belongsTo(Attendance::Class);
    }

    public function addition(){
        return $this->hasMany('App\Models\AdditionAndDiscount')->where('addition_id','id');
    }
}
