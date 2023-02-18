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
use App\Models\Payroll\PayrollGeneration\NoPayDays;
use App\Models\Payroll\PayrollGeneration\SalarySlashDetail;
use App\Models\Payroll\PayrollGeneration\AdhocPaymentPeriod;

use App\Models\CommonMasters\FiscalYear\MaintainCalendar;
use App\Models\Payroll\EmployeeEarnings\IncomeMaster;
use App\Models\Payroll\IncomeDeductionType\IncomeType;
use App\Models\Payroll\EmployeeEarnings\DeductionMaster;


trait payrollGenerationDbOperations {
    use statutoryDeductionTrait;
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
    function UpdateSelect_UnSelectEmployeeTrait($request) {
        $EmployeeSelected1 = MemEmployeeMaster::where('EMGIHEmployeeId', $request->EMGIHEmployeeId)
        ->where('EMGIHCompId', $this->gCompanyId)
        ->get(['EMGIHSelect'])
        ->first();

        if ($EmployeeSelected1->EMGIHSelect == 1) {
            MemEmployeeMaster::where('EMGIHEmployeeId', $request->EMGIHEmployeeId)
            ->where('EMGIHCompId', $this->gCompanyId)
            ->first()              
            ->update([
                'EMGIHSelect' => 0
            ]);
        }else {
            MemEmployeeMaster::where('EMGIHEmployeeId', $request->EMGIHEmployeeId)
            ->where('EMGIHCompId', $this->gCompanyId)
            ->first()              
            ->update([
                'EMGIHSelect' => 1
            ]);
        }

        
    }
    public function BrowserEmployeeListTrait($request){
        return $browserData = MemEmployeeMaster::get([
            'EMGIHSelect', 
            'EMGIHEmployeeId',
            'EMGIHFullName',
            'EMGIHLocationId', 
         ]);
    }
    public function UpdateMemForAllEmployeeTrait($request)
    {
        MemEmployeeMaster::where('EMGIHCompId', $this->gCompanyId)
        ->delete();
        if ($request->PGGPHLocationId == 'All Location') {
            $employeeMaster = GeneralInfo::where('EMGIHCompId', $this->gCompanyId)
            ->where('EMGIHDateOfJoining','<=', $request->FYFYHPeriodEndDate)
            ->where('EMGIHDateOfLeaving','>=', $request->FYFYHPeriodStartDate)
            ->orderBy('EMGIHEmployeeId')
            ->get();
            $this->UpdateEmployeeMemForAll($request , $employeeMaster , '1');
        }else {
            $employeeMaster = GeneralInfo::where('EMGIHCompId', $this->gCompanyId)
            ->where('EMGIHLocationId', $request->PGGPHLocationId)
            ->where('EMGIHDateOfJoining','<=', $request->FYFYHPeriodEndDate)
            ->where('EMGIHDateOfLeaving','>=', $request->FYFYHPeriodStartDate)
            ->orderBy('EMGIHEmployeeId')
            ->get();
            $this->UpdateEmployeeMemForAll($request , $employeeMaster , '0');
        }
        
    }
    function UpdateEmployeeMemForSelective($request , $employeeMaster){
        foreach ($employeeMaster as $key => $value) {
            MemEmployeeMaster::create([
                'EMGIHUniqueId'             => $value->EMGIHUniqueId,
                'EMGIHCompId'               => $value->EMGIHCompId,
                'EMGIHLocationId'           => $value->EMGIHLocationId,
                'EMGIHEmployeeId'           => $value->EMGIHEmployeeId,
                'EMGIHGenderId'             => $value->EMGIHGenderId,
                'EMGIHSelect'               => 0,
                'EMGIHFullName'             => $value->EMGIHFullName,
                'EMGIHDateOfJoining'        => $value->EMGIHDateOfJoining,
                'EMGIHEmploymentTypeId'     => $value->EMGIHEmploymentTypeId,
                'EMGIHDesignationId'        => $value->EMGIHDesignationId,
                'EMGIHDepartmentId'         => $value->EMGIHDepartmentId,
                'EMGIHCalendarId'           => $value->EMGIHCalendarId,
                'EMGIHIsResignation'        => $value->EMGIHIsResignation,
                'EMGIHDateOfLeaving'        => $value->EMGIHDateOfLeaving,
                'EMGIHLeaveWithoutPayIndicator'        => $value->EMGIHLeaveWithoutPayIndicator,
                'EMGIHLeaveWithoutPayFrom'        => $value->EMGIHLeaveWithoutPayFrom,
                'EMGIHUser'                 => Auth::user()->name,
                'EMGIHLastCreated'          => $value->EMGIHLastCreated,
                'EMGIHLastUpdated'          => $value->EMGIHLastUpdated,
                'EMGIHDeletedAt'            => $value->EMGIHDeletedAt   ,
            ]);
        }
    }
    function UpdateEmployeeMemForAll($request , $employeeMaster){
        foreach ($employeeMaster as $key => $value) {
            MemEmployeeMaster::create([
                'EMGIHUniqueId'             => $value->EMGIHUniqueId,
                'EMGIHCompId'               => $value->EMGIHCompId,
                'EMGIHLocationId'           => $value->EMGIHLocationId,
                'EMGIHEmployeeId'           => $value->EMGIHEmployeeId,
                'EMGIHGenderId'             => $value->EMGIHGenderId,
                'EMGIHSelect'               => 1,
                'EMGIHFullName'             => $value->EMGIHFullName,
                'EMGIHDateOfJoining'        => $value->EMGIHDateOfJoining,
                'EMGIHEmploymentTypeId'     => $value->EMGIHEmploymentTypeId,
                'EMGIHDesignationId'        => $value->EMGIHDesignationId,
                'EMGIHDepartmentId'         => $value->EMGIHDepartmentId,
                'EMGIHCalendarId'           => $value->EMGIHCalendarId,
                'EMGIHIsResignation'        => $value->EMGIHIsResignation,
                'EMGIHDateOfLeaving'        => $value->EMGIHDateOfLeaving,
                'EMGIHLeaveWithoutPayIndicator'        => $value->EMGIHLeaveWithoutPayIndicator,
                'EMGIHLeaveWithoutPayFrom'        => $value->EMGIHLeaveWithoutPayFrom,
                'EMGIHUser'                 => Auth::user()->name,
                'EMGIHLastCreated'          => $value->EMGIHLastCreated,
                'EMGIHLastUpdated'          => $value->EMGIHLastUpdated,
                'EMGIHDeletedAt'            => $value->EMGIHDeletedAt   ,
            ]);
        }
    }
    public function CalculateEmployeePayrollTrait($request)
    {
        MemPayrollHeader::where('PGGPHCompanyId', $this->gCompanyId)
        ->delete();
        MemPayrollDetail::where('PGGPDCompanyId', $this->gCompanyId)
        ->delete();
        $EmployeeSelected = MemEmployeeMaster::where('EMGIHCompId', $this->gCompanyId)
        ->where('EMGIHSelect', 1)
        ->get();
        
        foreach ($EmployeeSelected as $key => $value) {
            //This will calculate Employee gross Working days based on Joining or Leaving Date
            $EmployeeCalendarDays = 0;
            $EmployeeCalendarDays = $this->CalculateEmployeeCalendarDays($request, $value);
            //This will calculate no pay days from XL uploaded file.
            $NoPayDaysArray = $this->GetNoPayDays($request, $value);
            $NoPayDays = 0;
            foreach ($NoPayDaysArray as $NoPayDaysArray){
                $NoPayDays = $NoPayDaysArray['PGADHNoPayDays'];
            }
            //This will calculate leave without pay from Employee general info
            $LeaveWithoutPay = 0;
            if ($value->EMGIHLeaveWithoutPayIndicator == 1) {
                $LeaveWithoutPay = $this->CalculateLeaveWithoutyPay($request, $value);
            }
            //This will calculate Weekly off and public holidays from generated calendar.
            $WeeklyOff = $this->GetWeeklyOff($request, $value);
            $PublicHoliday = $this->GetPublicHoliday($request, $value);
            $PaidDays = 0;
            $PaidDays = $EmployeeCalendarDays-($NoPayDays + $LeaveWithoutPay);
            if ($PaidDays < 0) {
               $PaidDays = 0;
            }
            //Update Header Mem with calculated Pid Days
            $UniqueIdH = $this->UpdatePayrollHeaderMem($request, $EmployeeCalendarDays, $value, $NoPayDays,
                            $WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays);
            //Calculate Income for each employee
           $IncomeMaster = IncomeMaster::where('EEIMDCompId', $this->gCompanyId)
            ->where('EEIMDEmployeeId', $value->EMGIHEmployeeId)
            ->where('EEIMDEffectiveTo','>=', $request->FYFYHPeriodStartDate)
            ->where('EEIMDEffectiveFrom','<=', $request->FYFYHPeriodEndDate)
            ->where('EEIMDMarkForDeletion',0)
            ->orderby('EEIMDIncomeId')
            ->get();
            // echo 'Data Submitted.1'.$IncomeMaster;
            // // print_r($EmployeeSelected);
            // die();
            $CountOfIncomeMaster = count($IncomeMaster);
            $recordProcessed = 0;
            $lineNo = 10;
            $TotalDays=0;
            $PayrollDays=0;
            $IncomeId='';
            $GrossIncome=0;
            $GrossPay=0;
            $PayrollAmt=0;
            $TotalGrossIncome=0;
            $TotalGrossPay=0;
            $TotalPayrollAmt=0;

            foreach ($IncomeMaster as $key => $Income){
                $recordProcessed++;
                if ($IncomeId == '') {
                    $IncomeId = $Income->EEIMDIncomeId;
                }
                if ($IncomeId != $Income->EEIMDIncomeId) {
                    $this->UpdatePayrollDetailMem($request, $Income, $value,$EmployeeCalendarDays,
                    $NoPayDays,$WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays,$lineNo,$GrossIncome,
                    $GrossPay,$PayrollAmt,$IncomeId,$UniqueIdH,100);
                    $lineNo++;

                    $TotalGrossIncome = $TotalGrossIncome+$GrossIncome;
                    $TotalGrossPay = $TotalGrossPay+$GrossPay;
                    $TotalPayrollAmt = $TotalPayrollAmt+$PayrollAmt;

                    $GrossIncome=0;
                    $GrossPay=0;
                    $PayrollAmt=0;
                    

                    $IncomeId = $Income->EEIMDIncomeId;
                }
                if ($IncomeId == $Income->EEIMDIncomeId) {
                    $PayrollDays = $this->CalculatePayrollDays($request,$Income);
                    $GrossIncome = $GrossIncome + ($Income->EEIMDPayrollIncome/$request->TotalNoOfDays)*$PayrollDays;
                    $SlashesSalary = $this->GetSalarySlash($request,$value,$Income,$GrossIncome);
                    $GrossPay = ($SlashesSalary /$request->TotalNoOfDays)*$EmployeeCalendarDays;
                    $PayrollAmt = ($GrossPay /$EmployeeCalendarDays)*$PaidDays;

                }
                if ($CountOfIncomeMaster == $recordProcessed) {

                    $this->UpdatePayrollDetailMem($request, $Income, $value,$EmployeeCalendarDays,
                    $NoPayDays,$WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays,$lineNo,$GrossIncome,
                    $GrossPay,$PayrollAmt,$IncomeId,$UniqueIdH,100);
                    $lineNo++;
                    $TotalGrossIncome = $TotalGrossIncome+$GrossIncome;
                    $TotalGrossPay = $TotalGrossPay+$GrossPay;
                    $TotalPayrollAmt = $TotalPayrollAmt+$PayrollAmt;
                    $adhocPaymentPeriod = $this->GetadhocPaymentPeriod($request,$value);
                    if ($adhocPaymentPeriod !='') {
                        foreach ($adhocPaymentPeriod as $key => $adhocPayment){
                            $this->UpdatePayrollDetailMem($request, $Income, $value,$EmployeeCalendarDays,
                            $NoPayDays,$WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays,$lineNo,0,
                            $adhocPayment->PGAIDGrossPayment,$adhocPayment->PGAIDGrossPayment,$adhocPayment->PGAIDIncDedId,$UniqueIdH,100);
                            $lineNo++;
                            
                            $TotalGrossPay = $TotalGrossPay+$adhocPayment->PGAIDGrossPayment;
                            $TotalPayrollAmt = $TotalPayrollAmt+$adhocPayment->PGAIDGrossPayment;
                        }
                    }
                    
                    //Write Income Total line
                    $this->UpdatePayrollDetailMem($request, $Income, $value,$EmployeeCalendarDays,
                    $NoPayDays,$WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays,$lineNo,$TotalGrossIncome,
                    $TotalGrossPay,$TotalPayrollAmt,$IncomeId,$UniqueIdH,200);
                }
            }
            // echo 'Data Submitted.1'.$IncomeMaster;
            // die();
            $this->CalculateEmployeeDeductionTrait($request,$value,$EmployeeCalendarDays,
                $NoPayDays,$WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays,$UniqueIdH);
        }
    }
    public function UpdatePayrollHeaderMem($request, $EmployeeCalendarDays, $value, $NoPayDays,$WeeklyOff,
                            $PublicHoliday,$LeaveWithoutPay,$PaidDays)
    {
       $Data = MemPayrollHeader::create([
            'PGGPHCompanyId'                => $value->EMGIHCompId,
            'PGGPHLocationId'               => $value->EMGIHLocationId,
            'PGGPHEmpCode'                  => $value->EMGIHEmployeeId,
            'PGGPHDesigId'                  => $value->EMGIHDesignationId,
            'PGGPHFiscalYear'               => $request->PGGPHFiscalYear,
            'PGGPHFiscalPeriod'             => $request->PGGPHFiscalPeriod,
            'PGGPHFiscalMonth'              => $request->FYFYHCurrentPeriodDesc,
            'PGGPHFromDate'                 => $request->FYFYHPeriodStartDate,
            'PGGPHToDate'                   => $request->FYFYHPeriodEndDate,
            'PGGPHCaldendarDays'            => $request->TotalNoOfDays,
            'PGGPHEmployeeCaldendarDays'    => $EmployeeCalendarDays,
            'PGGPHAbsentDays'               => $NoPayDays,
            'PGGPHWeeklyOff'                => $WeeklyOff,
            'PGGPHPublicHoliday'            => $PublicHoliday,
            'PGGPHLeaveWithoutyPay'         => $LeaveWithoutPay,
            'PGGPHPaidDays'                 => $PaidDays,
            'PGGPHUser'                     => Auth::user()->name,
            'PGGPHLastCreated'              => $value->EMGIHLastCreated,
            'PGGPHLastUpdated'              => $value->EMGIHLastUpdated,
            'PGGPHDeletedAt'                => $value->EMGIHDeletedAt
        ]);
        return $UniqueId = $Data->PGGPHUniqueId; 
        
        
        // 'PGGPHPaidLeaves',
        // 'PGGPHGrossIncome',
        // 'PGGPHGrossPay',
        // 'PGGPHPayrollAmt',
        // 'PGGPHUserEditedAmt',
        // 'PGGPHGrossDeduction',
        // 'PGGPHNetDeduction',
        // 'PGGPHGrossCompContri',
        // 'PGGPHNetCompContri',
        // 'PGGPHGrossPaid',
        // 'PGGPHNetPaid',
        // 'PGGPHEmploymentType',
        // 'PGGPHGradeId',
        // 'PGGPHDeptartmentId',
        // 'PGGPHSlashSalary',
        // 'PGGPHLWPSalary',
          
    }
    public function UpdatePayrollDetailMem($request, $Income, $value,$EmployeeCalendarDays,
        $NoPayDays,$WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays,$lineNo,$GrossIncome,
        $GrossPay,$PayrollAmt,$IncomeId,$UniqueIdH,$SysId)
    {
        $IncomeType = IncomeType::where('PMITHIncomeId', $IncomeId,)
        ->where('PMITHMarkForDeletion',0)
        ->get()
        ->first();
        MemPayrollDetail::create([
            'PGGPDUniqueIdH'                => $UniqueIdH,
            'PGGPDCompanyId'                => $value->EMGIHCompId,
            'PGGPDLocationId'               => $value->EMGIHLocationId,
            'PGGPDEmployeeId'               => $value->EMGIHEmployeeId,
            'PGGPDDesignationId'            => $value->EMGIHDesignationId,
            'PGGPDFiscalYear'               => $request->PGGPHFiscalYear,
            'PGGPDPeriodId'                 => $request->PGGPHFiscalPeriod,
            'PGGPDPeriodMonth'              => $request->FYFYHCurrentPeriodDesc,
            'PGGPDFromDate'                 => $request->FYFYHPeriodStartDate,
            'PGGPDToDate'                   => $request->FYFYHPeriodEndDate,
            

            'PGGPDSysId'                    => $SysId,
            'PGGPDUserSorting'              => $SysId == 200 ? $SysId : $lineNo,
            'PGGPDIncDedId'                 => $SysId == 200 ? 2999 : $IncomeId,
            'PGGPDIncOrDed'                 => 'I',
            'PGGPDDesc'                     => $SysId == 200 ? 'Total Income' : $IncomeType->PMITHDesc1,
            'PGGPDGrossIncome'              => $GrossIncome,
            'PGGPDGrossPay'                 => $GrossPay,
            'PGGPDPayrollAmt'               => $PayrollAmt,
            'PGGPDUserEditedAmt'            => $PayrollAmt,
            'PGGPDCompContriGross'          => 0,
            'PGGPDCompContriNet'            => 0,
            'PGGPDCompContriUserEditedAmt'  => 0,

            'PGGPDCaldendarDays'            => $request->TotalNoOfDays,
            'PGGPHEmployeeCaldendarDays'    => $EmployeeCalendarDays,
            'PGGPDAbsentDays'               => $NoPayDays,
            'PGGPDWeeklyOff'                => $WeeklyOff,
            'PGGPDPublicHolidays'           => $PublicHoliday,
            'PGGPDLeaveWithoutPay'          => $LeaveWithoutPay,
            'PGGPDPaidDays'                 => $PaidDays,
            'PGGPDUser'                     => Auth::user()->name,
            'PGGPDStatusId'                 => 1000,
            'PGGPDLastCreated'              => $value->EMGIHLastCreated,
            'PGGPDLastUpdated'              => $value->EMGIHLastUpdated,
            'PGGPDDeletedAt'                => $value->EMGIHDeletedAt
        ]);
        
        // 'PGGPDPresentDays',
        // 'PGGPDPaidLeave',
    }
    public function CalculateEmployeeCalendarDays($request, $value)
    {
        $DoJ = $value->EMGIHDateOfJoining;
        $DoL = $value->EMGIHDateOfLeaving;
        $PSD = $request->FYFYHPeriodStartDate;
        $PED = $request->FYFYHPeriodEndDate;
        
        if ($DoJ <= $PSD && $DoL >= $PED) {
            return $request->TotalNoOfDays;
           
        }
        if ($DoJ >= $PSD && $DoL >= $PED) {
            $start_date = Carbon::parse($DoJ);
            $end_date = Carbon::parse( $PED);
            return $diff_Days = $start_date->diffInDays($end_date)+1;
        }
        if ($DoJ >= $PSD && $DoL <= $PED) {
            $start_date = Carbon::parse($DoJ);
            $end_date = Carbon::parse( $DoL);
            return $diff_Days = $start_date->diffInDays($end_date)+1;
        }
        if ($DoJ <= $PSD && $DoL <= $PED) {
            $start_date = Carbon::parse($PSD);
            $end_date = Carbon::parse( $DoL);
            return $diff_Days = $start_date->diffInDays($end_date)+1;
        }
    }
    public function GetNoPayDays($request, $value)
    {
        return $NoPayDays = NoPayDays::where('PGADHCompanyId', $this->gCompanyId)
        ->where('PGADHEmployeeId', $value->EMGIHEmployeeId)
        ->where('PGADHFiscalYearId', $request->PGGPHFiscalYear)
        ->where('PGADHPeriodId', $request->PGGPHFiscalPeriod)
        ->get(['PGADHNoPayDays','PGADHPaidDays'])
        ->toArray();
        // echo 'Data Submitted.1'.$NoPayDays->PGADHNoPayDays;
        // print_r($request->input());
        // die();
    }
    public function GetWeeklyOff($request, $value)
    {
        return $WeeklyOff = MaintainCalendar::where('FYCOHCompId', $this->gCompanyId)
        ->where('FYCOHCalendarId', $value->EMGIHCalendarId)
        ->where('FYCOHFiscalYearId', $request->PGGPHFiscalYear)
        ->where('FYCOHOffDate','>=', $request->FYFYHPeriodStartDate)
        ->where('FYCOHOffDate','<=', $request->FYFYHPeriodEndDate)
        ->where('FYCOHOffDayCode', 'WO')
        ->count();
    }
    public function GetPublicHoliday($request, $value)
    {
        return $PublicHoliday = MaintainCalendar::where('FYCOHCompId', $this->gCompanyId)
        ->where('FYCOHCalendarId', $value->EMGIHCalendarId)
        ->where('FYCOHFiscalYearId', $request->PGGPHFiscalYear)
        ->where('FYCOHOffDate','>=', $request->FYFYHPeriodStartDate)
        ->where('FYCOHOffDate','<=', $request->FYFYHPeriodEndDate)
        ->where('FYCOHOffDayCode', 'PH')
        ->count();
    }
    public function CalculateLeaveWithoutyPay($request, $value)
    {
        $LwPF = $value->EMGIHLeaveWithoutPayFrom;
        $PSD = $request->FYFYHPeriodStartDate;
        $PED = $request->FYFYHPeriodEndDate;
        
        if ($LwPF <= $PSD) {
            $start_date = Carbon::parse($PSD);
            $end_date = Carbon::parse( $PED);
            return $LeaveWithoutPay = $start_date->diffInDays($end_date)+1;
        }
        if ($LwPF >= $PSD && $LwPF <= $PED) {
            $start_date = Carbon::parse($LwPF);
            $end_date = Carbon::parse( $PED);
            return $LeaveWithoutPay = $start_date->diffInDays($end_date)+1;
        }
    }
    public function CalculatePayrollDays($request,$Income)
    {
        $TotalDays=0;
        $EF = $Income->EEIMDEffectiveFrom;
        $ET = $Income->EEIMDEffectiveTo;
        $PSD = $request->FYFYHPeriodStartDate;
        $PED = $request->FYFYHPeriodEndDate;
        if ($EF<=$PSD && $ET>=$PED) {
            $TotalDays=$request->TotalNoOfDays;
        }
        if ($EF>$PSD && $ET<$PED) {
            $start_date = Carbon::parse($EF);
            $end_date = Carbon::parse( $ET);
            $TotalDays = $start_date->diffInDays($end_date)+1;
        }
        if ($EF<=$PSD && $ET<$PED) {
            $start_date = Carbon::parse($PSD);
            $end_date = Carbon::parse( $ET);
            $TotalDays = $start_date->diffInDays($end_date)+1;
        }
        if ($EF>$PSD && $ET>$PED) {
            $start_date = Carbon::parse($EF);
            $end_date = Carbon::parse( $PED);
            $TotalDays = $start_date->diffInDays($end_date)+1;
        }
        return $TotalDays;
        // return $PayrollIncome= ($Income->EEIMDPayrollIncome/$request->TotalNoOfDays)*$TotalDays;
        // echo 'Data Submitted. '.$PayrollIncome.' <br>';
        // // // // print_r($IncomeMaster);
        // die();
    }
    public function GetSalarySlash($request,$value,$Income,$GrossIncome)
    {
        $SalarySlashDetail = SalarySlashDetail::where('PGSSDCompanyId', $this->gCompanyId)
        ->where('PGSSDEmployeeId', $value->EMGIHEmployeeId)
        ->where('PGSSDIncDedId', $Income->EEIMDIncomeId)
        ->where('PGSSDToDate','>=', $request->FYFYHPeriodStartDate)
        ->where('PGSSDFromDate','<=', $request->FYFYHPeriodEndDate)
        ->where('PGSSDMarkForDeletion',0)
        ->orderby('PGSSDIncDedId')
        ->get()
        ->first();
        $SlashesSalary = 0;
        
        if ($SalarySlashDetail != '') {
            if ( $SalarySlashDetail->PGSSDIncomeFixOrPercent == 'P') {
                $SlashesSalary = $GrossIncome-($GrossIncome*$SalarySlashDetail->PGSSDIncomePaymentPercent)/100;
            }else {
                $SlashesSalary = $GrossIncome - $SalarySlashDetail->PGSSDGrossPayment;
            }
            return $SlashesSalary;
        }
        return $GrossIncome;
    }
    public function GetadhocPaymentPeriod($request,$value)
    {
        return $AdhocPaymentPeriod = AdhocPaymentPeriod::where('PGAIDCompanyId', $this->gCompanyId)
        ->where('PGAIDEmployeeId', $value->EMGIHEmployeeId)
        ->where('PGAIDFiscalYear', $request->PGGPHFiscalYear)
        ->where('PGAIDPeriodId','>=', $request->PGGPHFiscalPeriod)
        ->where('PGAIDMarkForDeletion',0)
        ->orderby('PGAIDIncDedId')
        ->get();
        
    }

    # Append Mem to actual Table Income
    public function UpdateActPayrollDetailWithMemTable(){
        $loginName = Auth::user()->name;
        // Add records from MemPayrollDetail table to Actual table
        $MemPayrollDetail = MemPayrollDetail::where('PGGPDCompanyId', $this->gCompanyId)
        ->get();
        foreach ($MemPayrollDetail as $key => $value) {
            // Get Income Type Description           
            PayrollDetail::create([              
                'PGGPDUniqueIdH'                => $value->PGGPDUniqueIdH,
                'PGGPDCompanyId'                => $value->PGGPDCompanyId,
                'PGGPDLocationId'               => $value->PGGPDLocationId,
                'PGGPDEmployeeId'               => $value->PGGPDEmployeeId,
                'PGGPDDesignationId'            => $value->PGGPDDesignationId,
                'PGGPDFiscalYear'               => $value->PGGPDFiscalYear,
                'PGGPDPeriodId'                 => $value->PGGPDPeriodId,
                'PGGPDPeriodMonth'              => $value->PGGPDPeriodMonth,
                'PGGPDFromDate'                 => $value->PGGPDFromDate,
                'PGGPDToDate'                   => $value->PGGPDToDate,
                'PGGPDSysId'                    => $value->PGGPDSysId,
                'PGGPDUserSorting'              => $value->PGGPDUserSorting,
                'PGGPDIncDedId'                 => $value->PGGPDIncDedId,
                'PGGPDIncOrDed'                 => $value->PGGPDIncOrDed,
                'PGGPDDesc'                     => $value->PGGPDDesc,
                'PGGPDGrossIncome'              => $value->PGGPDGrossIncome,
                'PGGPDGrossPay'                 => $value->PGGPDGrossPay,
                'PGGPDPayrollAmt'               => $value->PGGPDPayrollAmt,
                'PGGPDUserEditedAmt'            => $value->PGGPDUserEditedAmt,
                'PGGPDCompContriGross'          => $value->PGGPDCompContriGross,
                'PGGPDCompContriNet'            => $value->PGGPDCompContriNet,
                'PGGPDCompContriUserEditedAmt'  => $value->PGGPDCompContriUserEditedAmt,
                'PGGPDCaldendarDays'            => $value->PGGPDCaldendarDays,
                'PGGPDPresentDays'              => $value->PGGPDPresentDays,
                'PGGPDAbsentDays'               => $value->PGGPDAbsentDays,
                'PGGPDWeeklyOff'                => $value->PGGPDWeeklyOff,
                'PGGPDPublicHolidays'           => $value->PGGPDPublicHolidays,
                'PGGPDPaidLeave'                => $value->PGGPDPaidLeave,
                'PGGPDLeaveWithoutPay'          => $value->PGGPDLeaveWithoutPay,
                'PGGPDPaidDays'                 => $value->PGGPDPaidDays,
                'PGGPDUser'                     => $loginName,
                'PGGPDStatusId'                 => $value->PGGPDStatusId,
                'PGGPDLastCreated'              => $value->PGGPDLastCreated,
                'PGGPDLastUpdated'              => $value->PGGPDLastUpdated,
                'PGGPDDeletedAt'                => $value->PGGPDDeletedAt,
            ]);     
        }
    }
    public function UpdateActPayrollHeaderWithMemTable(){
        $loginName = Auth::user()->name;
        // Add records from MemPayrollDetail table to Actual table
        $MemPayrollHeader = MemPayrollHeader::where('PGGPHCompanyId', $this->gCompanyId)
        ->get();
        foreach ($MemPayrollHeader as $key => $value) {
            // Get Income Type Description 
            $employeeMaster = GeneralInfo::where('EMGIHCompId', $this->gCompanyId)
            ->where('EMGIHEmployeeId','<=', $value->PGGPHEmpCode)
            ->orderBy('EMGIHEmployeeId')
            ->get()         
            ->first();          
            PayrollHeader::create([ 
                'PGGPHUniqueId'                 => $value->PGGPHUniqueId,
                'PGGPHCompanyId'                => $value->PGGPHCompanyId,
                'PGGPHLocationId'               => $value->PGGPHLocationId,
                'PGGPHEmpCode'                  => $value->PGGPHEmpCode,
                'PGGPHDesigId'                  => $value->PGGPHDesigId,
                'PGGPHFiscalYear'               => $value->PGGPHFiscalYear,
                'PGGPHFiscalPeriod'             => $value->PGGPHFiscalPeriod,
                'PGGPHFiscalMonth'              => $value->PGGPHFiscalMonth,
                'PGGPHFromDate'                 => $value->PGGPHFromDate,
                'PGGPHToDate'                   => $value->PGGPHToDate,
                'PGGPHCaldendarDays'            => $value->PGGPHCaldendarDays,
                'PGGPHToDate'                   => $value->PGGPHToDate,
                'PGGPHCaldendarDays'            => $value->PGGPHCaldendarDays,
                'PGGPHEmployeeCaldendarDays'    => $value->PGGPHEmployeeCaldendarDays,
                'PGGPHAbsentDays'               => $value->PGGPHAbsentDays,
                'PGGPHWeeklyOff'                => $value->PGGPHWeeklyOff,
                'PGGPHPublicHoliday'            => $value->PGGPHPublicHoliday,
                'PGGPHPaidLeaves'               => $value->PGGPHPaidLeaves,
                'PGGPHLeaveWithoutyPay'         => $value->PGGPHLeaveWithoutyPay,
                'PGGPHPaidDays'                 => $value->PGGPHPaidDays,
                'PGGPHGrossIncome'              => $value->PGGPHGrossIncome,
                'PGGPHGrossPay'                 => $value->PGGPHGrossPay,
                'PGGPHPayrollAmt'               => $value->PGGPHPayrollAmt,
                'PGGPHUserEditedAmt'            => $value->PGGPHUserEditedAmt,
                'PGGPHGrossDeduction'           => $value->PGGPHGrossDeduction,
                'PGGPHNetDeduction'             => $value->PGGPHNetDeduction,
                'PGGPHGrossCompContri'          => $value->PGGPHGrossCompContri,
                'PGGPHNetCompContri'            => $value->PGGPHNetCompContri,
                'PGGPHGrossPaid'                => $value->PGGPHGrossPaid,
                'PGGPHNetPaid'                  => $value->PGGPHNetPaid,
                'PGGPHEmploymentType'           => $employeeMaster->EMGIHEmploymentTypeId,
                'PGGPHGradeId'                  => $employeeMaster->EMGIHGradeId,
                'PGGPHDeptartmentId'            => $employeeMaster->EMGIHDepartmentId,
                'PGGPHSlashSalary'              => $value->PGGPHSlashSalary,
                'PGGPHLWPSalary'                => $value->PGGPHLWPSalary,
                'PGGPHUser'                     => $value->PGGPHUser,
                'PGGPHStatusId'                 => $value->PGGPHStatusId,
                'PGGPHLastCreated'              => $value->PGGPHLastCreated,
                'PGGPHLastUpdated'              => $value->PGGPHLastUpdated,
                'PGGPHDeletedAt'                => $value->PGGPHDeletedAt,

            ]);     
        }
    }
}