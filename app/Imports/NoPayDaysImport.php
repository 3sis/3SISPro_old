<?php

namespace App\Imports;

use App\Models\Payroll\PayrollGeneration\MemNoPayDays;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class NoPayDaysImport implements ToModel,WithHeadingRow,SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // echo 'Data Submitted.'.$row;
        // print_r($row);
        // die();
        return new MemNoPayDays([
            'PGADHEmployeeId' => $row['employeeid'], 
            'PGADHNoPayDays' => $row['nopaydays'],
            
        ]);
       

       
    }
}
