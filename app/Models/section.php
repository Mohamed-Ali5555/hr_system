<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employeer;

class section extends Model
{
    use HasFactory;
    protected $fillable=['section_name','photo','slug'];

    public function employer(){
        // return $this->hasMany('App\Models\Employeer')->where('section_id','id');
        return $this->hasMany(Employeer::Class,'section_id','id');

    }

    

}
