<?php

namespace App\Exports;

use App\Models\Employeer;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employeer::all();
    }


    
}
