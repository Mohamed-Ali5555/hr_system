<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionAndDiscount extends Model
{
    use HasFactory;

    protected $guarded =[]; 

    // public function section(){
    //     return $this->belongsTo(section::Class);
    // }

    public function employer(){
        return $this->belongsTo(Employeer::Class);
    }

    // public function setCategoryAttribute($value)
    // {
    //     $this->attributes['week_holiday'] = json_encode($value);
    // }

    // public function getCategoryAttribute($value)
    // {
    //     return $this->attributes['week_holiday'] = json_decode($value);
    // }
}
