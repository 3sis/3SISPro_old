<?php
namespace App\Traits\Payroll\PayrollGeneration;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Traits\Payroll\PayrollGeneration\statutoryDeductionTrait;
use App\Models\Payroll\EmployeeMaster\GeneralInfo;
use App\Models\Payroll\EmployeeMaster\MemEmployeeMaster;
use App\Models\CommonMasters\GeographicInfo\Location;
use App\Models\Payroll\PayrollGeneration\MemPayrollDetail;
use App\Models\Payroll\PayrollGeneration\MemPayrollHeader;
use App\Models\Payroll\PayrollGeneration\PayrollHeader;
use App\Models\Payroll\PayrollGeneration\PayrollDetail;
use App\Models\Payroll\EmployeeEarnings\IncomeMaster;
use App\Models\Payroll\IncomeDeductionType\IncomeType;
use App\Models\Payroll\EmployeeEarnings\DeductionMaster;


trait maintainPayrollDbOperations {
    public function BrowserDataTrait() 
    { 
        

         return $browserData = MemPayrollHeader::join('T11101l01', 'T11101l01.EMGIHEmployeeId', '=', 'zmem11125l08.PGGPHEmpCode')
         ->leftjoin('T05901L06', 'T05901L06.GMLMHLocationId', '=', 'zmem11125l08.PGGPHLocationId')
         ->get([
            'zmem11125l08.PGGPHUniqueId',
            'zmem11125l08.PGGPHCompanyId',
            'zmem11125l08.PGGPHLocationId',
            // Location table field
            'T05901L06.GMLMHDesc1',
            'zmem11125l08.PGGPHEmpCode',
            // Employee Name table field
            'T11101l01.EMGIHFullName',
            'zmem11125l08.PGGPHDesigId',
            'zmem11125l08.PGGPHAbsentDays',
            'zmem11125l08.PGGPHWeeklyOff',
            'zmem11125l08.PGGPHPublicHoliday',
            'zmem11125l08.PGGPHPaidLeaves',
            'zmem11125l08.PGGPHLeaveWithoutyPay',
            'zmem11125l08.PGGPHPaidDays',
            'zmem11125l08.PGGPHGrossIncome',
            'zmem11125l08.PGGPHGrossPay',
            'zmem11125l08.PGGPHPayrollAmt',
            'zmem11125l08.PGGPHUserEditedAmt',
            'zmem11125l08.PGGPHGrossDeduction',
            'zmem11125l08.PGGPHNetDeduction',
            'zmem11125l08.PGGPHGrossCompContri',
            'zmem11125l08.PGGPHNetCompContri',
            'zmem11125l08.PGGPHGrossPaid',
            'zmem11125l08.PGGPHNetPaid'
         ]);
    }
    public function BrowserPayrollDetailDataTrait($request){
        // echo "Requesr ";
        // return $request->input();
        return $browserData = MemPayrollDetail::
        where('PGGPDStatusId',1000)
        ->where('PGGPDUniqueIdH',$request->UniqueIdH)
        ->orderBy('PGGPDSysId')

        ->get([
            'PGGPDUniqueId',
            'PGGPDUniqueIdH',
            'PGGPDIncDedId',
            'PGGPDIncOrDed',
            'PGGPDDesc',
            'PGGPDGrossIncome',
            'PGGPDGrossPay',
            'PGGPDPayrollAmt',
            'PGGPDUserEditedAmt',
            'PGGPDCompContriGross',
            'PGGPDCompContriNet',
            'PGGPDCompContriUserEditedAmt', 
            'PGGPDSysId',
            'PGGPDUserSorting',
         ]);
    }
    public function UpdateMemEmployeeTrait($request)
    {
        // echo 'Data Submitted.1';
        // print_r($request->input());
        // die();
        if ($request->UpdateMode == 1) {
            MemEmployeeMaster::where('EMGIHCompId', $this->gCompanyId)
                ->delete();
            if ($request->PGGPHLocationId == 'All Location') {
                $employeeMaster = GeneralInfo::where('EMGIHCompId', $this->gCompanyId)
                ->where('EMGIHDateOfJoining','<=', $request->FYFYHPeriodEndDate)
                ->where('EMGIHDateOfLeaving','>=', $request->FYFYHPeriodStartDate)
                ->orderBy('EMGIHEmployeeId')
                ->get();
                // echo '<BR> Data Submitted.2'.$employeeMaster;
                // die();
                $this->UpdateEmployeeMemForSelective($request , $employeeMaster);
               }else {
                $employeeMaster = GeneralInfo::where('EMGIHCompId', $this->gCompanyId)
                ->where('EMGIHLocationId', $request->PGGPHLocationId)
                ->where('EMGIHDateOfJoining','<=', $request->FYFYHPeriodEndDate)
                ->where('EMGIHDateOfLeaving','>=', $request->FYFYHPeriodStartDate)
                ->orderBy('EMGIHEmployeeId')
                ->get();
                $this->UpdateEmployeeMemForSelective($request , $employeeMaster);
            }
        }
        else {
            if ($request->PGGPHLocationId == 'All Location') {
                $EmployeeSelected = MemEmployeeMaster::where('EMGIHCompId', $this->gCompanyId)
                ->where('EMGIHSelect', 1)
                ->get(['EMGIHEmployeeId']);
                // ->toArray();
                if ($EmployeeSelected =='') {
                    MemEmployeeMaster::where('EMGIHCompId', $this->gCompanyId)
                    ->delete();
                    $employeeMaster = GeneralInfo::where('EMGIHCompId', $this->gCompanyId)
                    ->where('EMGIHDateOfJoining','<=', $request->FYFYHPeriodEndDate)
                    ->where('EMGIHDateOfLeaving','>=', $request->FYFYHPeriodStartDate)
                    ->orderBy('EMGIHEmployeeId')
                    ->get();
                    $this->UpdateEmployeeMemForSelective($request , $employeeMaster);
                }
                else {
                    MemEmployeeMaster::where('EMGIHCompId', $this->gCompanyId)
                    ->whereNotIn('EMGIHEmployeeId', $EmployeeSelected)
                    ->delete();
                    $employeeMaster = GeneralInfo::where('EMGIHCompId', $this->gCompanyId)
                    ->whereNotIn('EMGIHEmployeeId', $EmployeeSelected)
                    ->where('EMGIHDateOfJoining','<=', $request->FYFYHPeriodEndDate)
                    ->where('EMGIHDateOfLeaving','>=', $request->FYFYHPeriodStartDate)
                    ->orderBy('EMGIHEmployeeId')
                    ->get();
                    $this->UpdateEmployeeMemForSelective($request , $employeeMaster);
                }
            }else {
                $EmployeeSelected = MemEmployeeMaster::where('EMGIHCompId', $this->gCompanyId)
                ->where('EMGIHLocationId', $request->PGGPHLocationId)
                ->where('EMGIHSelect', 1)
                ->get(['EMGIHEmployeeId'])
                ->first();
                if ($EmployeeSelected =='') {
                    MemEmployeeMaster::where('EMGIHCompId', $this->gCompanyId)
                    ->delete();
                    $employeeMaster = GeneralInfo::where('EMGIHCompId', $this->gCompanyId)
                    ->where('EMGIHLocationId', $request->PGGPHLocationId)
                    ->where('EMGIHDateOfJoining','<=', $request->FYFYHPeriodEndDate)
                    ->where('EMGIHDateOfLeaving','>=', $request->FYFYHPeriodStartDate)
                    ->orderBy('EMGIHEmployeeId')
                    ->get();
                    $this->UpdateEmployeeMemForSelective($request , $employeeMaster);
                }else {
                    MemEmployeeMaster::where('EMGIHCompId', $this->gCompanyId)
                    ->where('EMGIHLocationId','!=', $request->PGGPHLocationId)
                    ->delete();
                }
            }
        }
    }
    public function FethchEditedDetailDataTrait($request){  
        
        $PGDADUniqueId = $request->input('id');
        $MemPayrollDetail = MemPayrollDetail::find($PGDADUniqueId);

        return $output = array(
            'PGGPDUniqueId'                 =>  $MemPayrollDetail->PGGPDUniqueId,
            'PGGPDLocationId'               =>  $MemPayrollDetail->PGGPDLocationId,
            'PGGPDEmployeeId'               =>  $MemPayrollDetail->PGGPDEmployeeId,
            'PGGPDIncDedId'                 =>  $MemPayrollDetail->PGGPDIncDedId,
            'PGGPDIncOrDed'                 =>  $MemPayrollDetail->PGGPDIncOrDed,
            'PGGPDDesc'                      =>  $MemPayrollDetail->PGGPDDesc,
            
            'PGGPDGrossIncome'               =>  $MemPayrollDetail->PGGPDGrossIncome,

            'PGGPDGrossPay'                  =>  $MemPayrollDetail->PGGPDGrossPay,
            'PGGPDPayrollAmt'                =>  $MemPayrollDetail->PGGPDPayrollAmt,
            'PGGPDUserEditedAmt'             =>  $MemPayrollDetail->PGGPDUserEditedAmt,
            'PGGPDCompContriGross'           =>  $MemPayrollDetail->PGGPDCompContriGross,
            'PGGPDCompContriNet'             =>  $MemPayrollDetail->PGGPDCompContriNet,
            'PGGPDCompContriUserEditedAmt'   =>  $MemPayrollDetail->PGGPDCompContriUserEditedAmt,
            'PGGPDSysId'                     =>  $MemPayrollDetail->PGGPDSysId,
            'PGGPDUserSorting'               =>  $MemPayrollDetail->PGGPDUserSorting
        );
    }
    
}