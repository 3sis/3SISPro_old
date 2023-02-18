<?php

namespace App\Imports;

use App\Models\MemIncomeRevisionExcel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class IncomeRevisionImport implements ToModel,WithHeadingRow,SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MemIncomeRevisionExcel([
            'PGADHEmployeeId' => $row['employeeid'], 
            'PGADHNoPayDays' => $row['nopaydays'],
        ]);
    }
}
