<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\section;

class official_holidays extends Model
{
    use HasFactory;
    protected $guarded =[]; 
    public function section(){
        return $this->belongsTo(section::Class);
    }
}
