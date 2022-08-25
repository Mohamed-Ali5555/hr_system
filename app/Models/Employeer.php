<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\section;
use App\Models\Salary_report;
use App\Models\Attendance;

class Employeer extends Model
{
    use HasFactory;

    protected $guarded =[]; 

    public function section(){
        return $this->belongsTo(section::Class);
    }

    public function salary_report(){
        return $this->belongsTo(Salary_report::Class);
    }

    public function attendance(){
        return $this->hasMany(Attendance::Class,'employer_id');
    }
}
