<?php

namespace App\Imports;

use App\Models\Payroll\PayrollGeneration\MemSalaryRevisionXL;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Illuminate\Support\Carbon;



class SalaryRevisionImport implements ToModel,WithHeadingRow,SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected  $gCompanyId = '1000';

    public function model(array $row)
    {
        $MemSalaryRevisionXL = MemSalaryRevisionXL::where('PGSRHCompanyId',$this->gCompanyId)
        ->where('PGSRHEmployeeId',$row['employeeid'])
        ->get()
        ->first();
        // echo 'Data Submitted. '.$MemSalaryRevisionXL;
        // // // // print_r($EmployeeSelected);
        // die();
        if ($MemSalaryRevisionXL=='') {

            return new MemSalaryRevisionXL([
                # code...
                'PGSRHCompanyId'        => $this->gCompanyId,
                'PGSRHEmployeeId'       => $row['employeeid'], 

                'PGSRHEffectiveFrom'    => gmdate("Y-m-d",($row['effectivefrom'] - 25569) * 86400),
                'PGSRHEffectiveTo'      => gmdate("Y-m-d",($row['effectiveto'] - 25569) * 86400),
                'PGSRHRevisedAmt'       => $row['revisedamt'],
                'PGSRHFixedOrPercent'   => strtoupper($row['forp']),
            ]);
    }

    }
    
}
