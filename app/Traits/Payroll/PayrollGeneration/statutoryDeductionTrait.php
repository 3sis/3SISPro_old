<?php
namespace App\Traits\Payroll\PayrollGeneration;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\EmployeeMaster\GeneralInfo;
use App\Models\Payroll\EmployeeMaster\MemEmployeeMaster;
use App\Models\CommonMasters\GeographicInfo\Location;
use App\Models\Payroll\PayrollGeneration\MemPayrollDetail;
use App\Models\Payroll\PayrollGeneration\PayrollDetail;
use App\Models\Payroll\IncomeDeductionType\IncomeType;
use App\Models\Payroll\EmployeeEarnings\DeductionMaster;
use App\Models\Payroll\IncomeDeductionType\DeductionType;
use App\Models\SystemsMaster\PaymentMaster\RuleDefinition;
use App\Models\Payroll\IncomeDeductionType\IncDependentDed;
use App\Models\Payroll\StatutoryDeductionSlab\StatutoryDeductionSlabDetail;
use App\Models\Payroll\IncomeDeductionType\PeriodicIncDed;
use App\Models\Payroll\LoanBook\LoanBookDetail;

trait statutoryDeductionTrait
{
    public function CalculateEmployeeDeductionTrait($request,$value,$EmployeeCalendarDays,
    $NoPayDays,$WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays,$UniqueIdH)
    {
        $lineNo = 10;
        $TotalEmpDeductionAmt = 0;
        $TotalCompDeductionAmt = 0;
        $EmpContriAmount = 0;

        // echo 'Data Submitted.1';
        // print_r($EmployeeSelected);
        // die();
        // echo 'Data Submitted.1';
        // die();
        $employeeMaster = GeneralInfo::where('EMGIHCompId', $this->gCompanyId)
        ->where('EMGIHLocationId', $value->EMGIHLocationId)
        ->where('EMGIHEmployeeId','<=', $value->EMGIHEmployeeId)
        ->orderBy('EMGIHEmployeeId')
        ->get()
        ->first();
       
        $DeductionMasterEmp = DeductionMaster::where('EEDMDCompId', $this->gCompanyId)
        ->where('EEDMDEmployeeId', $value->EMGIHEmployeeId)
        ->where('EEDMDEffectiveTo','>=', $request->FYFYHPeriodStartDate)
        ->where('EEDMDEffectiveFrom','<=', $request->FYFYHPeriodEndDate)
        ->where('EEDMDMarkForDeletion',0)
        ->orderby('EEDMDDeductionId')
        ->get();
       
        foreach ($DeductionMasterEmp as $key => $Deduction){
            
            // Apply If condition to process only statutory deduction Id.
            $DeductionType = DeductionType::where('PMDTHDeductionId', $Deduction->EEDMDDeductionId)
            ->where('PMDTHMarkForDeletion',0)
            ->orderby('PMDTHDeductionId')
            ->get()
            ->first();

            
            $TotalGrossIncome = 0;
            $TotalGrossPay = 0;
            $TotalGrossAmt = 0;
            $TotalUserEditedAmt = 0;
            $EmpContriAmount = 0;
            $CompContriAmount = 0;
            $TotalUserIncomeAmt = 0;
            $TotalUserDeductionAmt = 0;
            $PendingDeductionAfterSettleAmt = 0;
            $PeriodId = 0;

            if ($DeductionType->PMDTHIsIncomeDependent == 1) {
                $MemPayrollDetail = MemPayrollDetail::where('PGGPDEmployeeId', $value->EMGIHEmployeeId)
                ->where('PGGPDIncOrDed','I')
                ->orderby('PGGPDIncDedId')
                ->get();
                foreach ($MemPayrollDetail as $key => $MemPayrollDetail){
                    $IncDependentDed = IncDependentDed::where('PMDTDDeductionId', $DeductionType->PMDTHDeductionId)
                    ->where('PMDTDIncomeId', $MemPayrollDetail->PGGPDIncDedId)
                    ->where('PMDTDIsSelect',1)
                    ->where('PMDTDMarkForDeletion',0)
                    ->get()
                    ->first();
                    if ($IncDependentDed != '') {
                        $TotalGrossIncome   = $TotalGrossIncome + $MemPayrollDetail->PGGPDGrossIncome;
                        $TotalGrossPay      =  $TotalGrossPay + $MemPayrollDetail->PGGPDGrossPay;
                        $TotalGrossAmt      = $TotalGrossAmt + $MemPayrollDetail->PGGPDPayrollAmt;
                        $TotalUserEditedAmt = $TotalUserEditedAmt + $MemPayrollDetail->PGGPDUserEditedAmt;
                    }
                }
            }
            $RuleDefinition = $this->GetRuleDefinition($Deduction->EEDMDDeductionRuleId);
            
            $GeographicId = $this->GetGeographicId($value);
            
            if ($DeductionType->PMDTHDeductionCycle == 'M') {
                $PeriodId = $request->PGGPHFiscalPeriod;
            }else{
                $DeductionPeriodId = $this->GetDeductionPeriod($Deduction->EEDMDDeductionId, $request->PGGPHFiscalPeriod);
                if($DeductionPeriodId != ''){
                    $PeriodId = $request->PGGPHFiscalPeriod;
                }
            }
            if ($PeriodId == $request->PGGPHFiscalPeriod) {
                if ( $RuleDefinition != '') {
                    //PF Calculation 

                    if ($Deduction->EEDMDDeductionRuleId == 'D1000') {
                        //Get total income amount from payroll Detail Mem
                        $TotalUserIncomeAmt = $TotalUserIncomeAmt +$this->GetTotalUserEditedAmtMem($request,$value);

                        $StatutoryDeductionSlabDetail = $this->GetStatutrotyDeductionSlab($request,$value,$DeductionType,$Deduction->EEDMDDeductionRuleId,$RuleDefinition,$GeographicId);
                        $PFLimitEmployee = $this->GetPFlimitEmployee($employeeMaster,$value,$RuleDefinition,$TotalGrossIncome,$TotalGrossPay,$TotalUserEditedAmt);
                        $PFLimitCompany = $this->GetPFlimitCompany($employeeMaster,$value,$RuleDefinition,$TotalGrossIncome,$TotalGrossPay,$TotalUserEditedAmt);
                        
                        if ($StatutoryDeductionSlabDetail != '') {
                            if ($StatutoryDeductionSlabDetail->PMDSDIncomeFrom <= $PFLimitEmployee && $StatutoryDeductionSlabDetail->PMDSDIncomeTo >= $PFLimitEmployee) {
                                $EmpContriAmount = $StatutoryDeductionSlabDetail->PMDSDEmpContriType == "P" ? ($PFLimitEmployee*$StatutoryDeductionSlabDetail->PMDSDEmpContriAmount)/100 : $StatutoryDeductionSlabDetail->PMDSDEmpContriAmount;
                            }
                            if ($StatutoryDeductionSlabDetail->PMDSDIncomeFrom <= $PFLimitCompany && $StatutoryDeductionSlabDetail->PMDSDIncomeTo >= $PFLimitCompany && $employeeMaster->EMGIHPFAgreedByComp == 1) {
                                $CompContriAmount = $StatutoryDeductionSlabDetail->PMDSDCompContriType == "P" ? ($PFLimitCompany*$StatutoryDeductionSlabDetail->PMDSDCompContriAmount)/100 : $StatutoryDeductionSlabDetail->PMDSDCompContriAmount;
                            }
                            $this->UpdatePayrollDetailMemForDeduction($request,$value, $EmployeeCalendarDays,
                            $NoPayDays,$WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays,$lineNo,$EmpContriAmount,
                            $CompContriAmount,$Deduction->EEDMDDeductionId,$DeductionType->PMDTHDesc1,$UniqueIdH,500,0,0);
                            $lineNo++;
                            $TotalEmpDeductionAmt = $TotalEmpDeductionAmt + $EmpContriAmount;
                            $TotalCompDeductionAmt = $TotalCompDeductionAmt + $CompContriAmount;

                        }
                    }

                    //ESIC Calculation 
                    if ( $Deduction->EEDMDDeductionRuleId == 'D3000') {
                        //Get total income amount from payroll Detail Mem
                        $TotalUserIncomeAmt = $TotalUserIncomeAmt +$this->GetTotalUserEditedAmtMem($request,$value);

                        $StatutoryDeductionSlabDetail = $this->GetStatutrotyDeductionSlab($request,$value,$DeductionType,$Deduction->EEDMDDeductionRuleId,$RuleDefinition,$GeographicId);
                        $StatutoryDeductionLimit = $this->GetStatutoryDeductionLimit($RuleDefinition,$TotalGrossIncome,$TotalUserEditedAmt);
                        
                        if ($StatutoryDeductionSlabDetail != '') {
                            if ($StatutoryDeductionSlabDetail->PMDSDIncomeFrom <= $StatutoryDeductionLimit && $StatutoryDeductionSlabDetail->PMDSDIncomeTo >= $StatutoryDeductionLimit) {
                                $EmpContriAmount = $StatutoryDeductionSlabDetail->PMDSDEmpContriType == "P" ? ($StatutoryDeductionLimit*$StatutoryDeductionSlabDetail->PMDSDEmpContriAmount)/100 : $StatutoryDeductionSlabDetail->PMDSDEmpContriAmount;
                            }
                            if ($StatutoryDeductionSlabDetail->PMDSDIncomeFrom <= $StatutoryDeductionLimit && $StatutoryDeductionSlabDetail->PMDSDIncomeTo >= $StatutoryDeductionLimit && $employeeMaster->EMGIHPFAgreedByComp == 1) {
                                $CompContriAmount = $StatutoryDeductionSlabDetail->PMDSDCompContriType == "P" ? ($StatutoryDeductionLimit*$StatutoryDeductionSlabDetail->PMDSDCompContriAmount)/100 : $StatutoryDeductionSlabDetail->PMDSDCompContriAmount;
                            }
                            $this->UpdatePayrollDetailMemForDeduction($request,$value, $EmployeeCalendarDays,
                            $NoPayDays,$WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays,$lineNo,$EmpContriAmount,
                            $CompContriAmount,$Deduction->EEDMDDeductionId,$DeductionType->PMDTHDesc1,$UniqueIdH,500,0,0);
                            $lineNo++;
                            
                            $TotalEmpDeductionAmt = $TotalEmpDeductionAmt + $EmpContriAmount;
                            
                            $TotalCompDeductionAmt = $TotalCompDeductionAmt + $CompContriAmount;


                        }
                    }
                    //PT Calculation 
                    if ( $Deduction->EEDMDDeductionRuleId == 'D2000') {
                        //Get total income amount from payroll Detail
                        $TotalUserIncomeAmt = $this->GetTotalUserEditedAmtFromPayrollDetail($request,$value,$Deduction->EEDMDDeductionId);
                        
                        //Get total income amount from payroll Detail Mem
                        $TotalUserIncomeAmt = $TotalUserIncomeAmt +$this->GetTotalUserEditedAmtMem($request,$value);
                        // echo 'Total Income'.$this->GetTotalUserEditedAmtMem($request,$value);;
                        // die();
                        //Get total Deduction amount from payroll Detail besad on Deduction Type
                        $TotalUserDeductionAmt = $this->GetTotalDeductionAmtFromPayrollDetail($request,$value,$Deduction->EEDMDDeductionId);
                        //Get Statutory Deduction Slab based on Income Amount
                        $StatutoryDeductionSlabDetail = $this->GetStatutrotyDeductionSlabForPT($request,$value,$DeductionType,$Deduction->EEDMDDeductionRuleId,$RuleDefinition,$GeographicId,$TotalUserIncomeAmt);
                        // echo 'Total Income'.$TotalUserIncomeAmt.' - '.$StatutoryDeductionSlabDetail;
                        // die();
                        if ($StatutoryDeductionSlabDetail != '') {
                            if ($StatutoryDeductionSlabDetail->PMDSDIncomeFrom <= $TotalUserIncomeAmt && $StatutoryDeductionSlabDetail->PMDSDIncomeTo >= $TotalUserIncomeAmt) {
                                $EmpContriAmount = $StatutoryDeductionSlabDetail->PMDSDEmpContriType == "P" ? ($TotalUserIncomeAmt*$StatutoryDeductionSlabDetail->PMDSDEmpContriAmount)/100 : $StatutoryDeductionSlabDetail->PMDSDEmpContriAmount;
                            }
                            $PendingDeductionAfterSettleAmt = $EmpContriAmount -  $TotalUserDeductionAmt;
                            $this->UpdatePayrollDetailMemForDeduction($request,$value, $EmployeeCalendarDays,
                            $NoPayDays,$WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays,$lineNo,$PendingDeductionAfterSettleAmt,
                            0,$Deduction->EEDMDDeductionId,$DeductionType->PMDTHDesc1,$UniqueIdH,500,0,0);
                            $lineNo++;
                            $TotalEmpDeductionAmt = $TotalEmpDeductionAmt + $PendingDeductionAfterSettleAmt;

                        }
                    }  
                    //Other Deduction
                    if ( $Deduction->EEDMDDeductionRuleId == 'Z1000') {
                        
                        $PendingDeductionAfterSettleAmt = $EmpContriAmount -  $TotalUserDeductionAmt;
                        $this->UpdatePayrollDetailMemForDeduction($request,$value, $EmployeeCalendarDays,
                        $NoPayDays,$WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays,$lineNo,$Deduction->EEDMDPayrollDeduction,
                        0,$Deduction->EEDMDDeductionId,$DeductionType->PMDTHDesc1,$UniqueIdH,500,0,0);
                        $lineNo++;
                        $TotalEmpDeductionAmt = $TotalEmpDeductionAmt + $Deduction->EEDMDPayrollDeduction;

                    }                    
                }
            }
            // if ($DeductionType->PMDTHDeductionCycle == 'P') {
                
            //     $TotalUserIncomeAmt = 0;
            //     $TotalUserDeductionAmt = 0;
            //     $PendingDeductionAfterSettleAmt = 0;
            //     //PT Calculation 
            //     if ( $Deduction->EEDMDDeductionRuleId == 'D2000') {
                    
            //         //Get total income amount from payroll Detail
            //         $TotalUserIncomeAmt = $this->GetTotalUserEditedAmtFromPayrollDetail($request,$value,$Deduction->EEDMDDeductionId);
            //         //Get total income amount from payroll Detail Mem
            //         $TotalUserIncomeAmt = $TotalUserIncomeAmt +$this->GetTotalUserEditedAmtMem($request,$value);
            //         //Get total Deduction amount from payroll Detail besad on Deduction Type
            //         $TotalUserDeductionAmt = $this->GetTotalDeductionAmtFromPayrollDetail($request,$value,$Deduction->EEDMDDeductionId);
            //         //Get Statutory Deduction Slab based on Income Amount
            //         $StatutoryDeductionSlabDetail = $this->GetStatutrotyDeductionSlab($request,$value,$DeductionType,$Deduction->EEDMDDeductionRuleId,$RuleDefinition,$GeographicId);
            //         // echo 'Data Submitted.'.$StatutoryDeductionSlabDetail;
            //         // die();
            //         if ($StatutoryDeductionSlabDetail != '') {
            //             if ($StatutoryDeductionSlabDetail->PMDSDIncomeFrom <= $TotalUserIncomeAmt && $StatutoryDeductionSlabDetail->PMDSDIncomeTo >= $TotalUserIncomeAmt) {
            //                 $EmpContriAmount = $StatutoryDeductionSlabDetail->PMDSDEmpContriType == "P" ? ($TotalUserIncomeAmt*$StatutoryDeductionSlabDetail->PMDSDEmpContriAmount)/100 : $StatutoryDeductionSlabDetail->PMDSDEmpContriAmount;
            //             }
            //             $PendingDeductionAfterSettleAmt = $EmpContriAmount -  $TotalUserDeductionAmt;
            //             $this->UpdatePayrollDetailMemForDeduction($request,$value, $EmployeeCalendarDays,
            //             $NoPayDays,$WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays,$lineNo,$PendingDeductionAfterSettleAmt,
            //             0,$Deduction->EEDMDDeductionId,$DeductionType->PMDTHDesc1,$UniqueIdH,500);
            //             $lineNo++;
            //         }
            //     }
            // }
        }

        //Update Loan Line in Deduction Amount
        $LoanBookDetail = LoanBookDetail::where('LALBDCompanyId', $this->gCompanyId)
        ->where('LALBDEmployeeId', $value->EMGIHEmployeeId)
        ->where('LALBDEndDateEMI','>=', $request->FYFYHPeriodStartDate)
        ->where('LALBDStartDateEMI','<=', $request->FYFYHPeriodEndDate)
        ->where('LALBDMarkForDeletion',0)
        ->orderby('LALBDDeductionId')
        ->get();
        if ($LoanBookDetail != '') {
            foreach ($LoanBookDetail as $key => $Loan){
                $DeductionType = DeductionType::where('PMDTHDeductionId', $Loan->LALBDDeductionId)
                ->where('PMDTHMarkForDeletion',0)
                ->orderby('PMDTHDeductionId')
                ->get()
                ->first();

                $this->UpdatePayrollDetailMemForDeduction($request,$value, $EmployeeCalendarDays,
                $NoPayDays,$WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays,$lineNo,$Loan->LALBDEMIAmount,
                0,$Loan->LALBDDeductionId,$DeductionType->PMDTHDesc1,$UniqueIdH,500,0,0);
                $lineNo++;
                $TotalEmpDeductionAmt = $TotalEmpDeductionAmt + $Loan->LALBDEMIAmount;
            }
        }
        // write total Deduction line in payroll mem
        $this->UpdatePayrollDetailMemForDeduction($request,$value, $EmployeeCalendarDays,
        $NoPayDays,$WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays,$lineNo,$TotalEmpDeductionAmt,
        $TotalCompDeductionAmt,'','',$UniqueIdH,600,0,0);

        //get total Income from MemPayrollDetail
        $MemPayrollDetail = MemPayrollDetail::where('PGGPDEmployeeId', $value->EMGIHEmployeeId)
        ->where('PGGPDIncOrDed','I')
        ->where('PGGPDSysId',200)
        ->orderby('PGGPDIncDedId')
        ->get();
        $PayrollGrossIncome = 0;
        $PayrollGrossPay = 0;
        $PayrollGrossAmt = 0;
        $PayrollUserEditedAmt = 0;
        foreach ($MemPayrollDetail as $key => $MemPayrollDetail){
            
            $PayrollGrossIncome   = $PayrollGrossIncome + $MemPayrollDetail->PGGPDGrossIncome;
            $PayrollGrossPay      = $PayrollGrossPay + $MemPayrollDetail->PGGPDGrossPay;
            $PayrollGrossAmt      = $PayrollGrossAmt + $MemPayrollDetail->PGGPDPayrollAmt;
            $PayrollUserEditedAmt = $PayrollUserEditedAmt + $MemPayrollDetail->PGGPDUserEditedAmt;
        }
        // write total line in payroll mem
        $this->UpdatePayrollDetailMemForDeduction($request,$value, $EmployeeCalendarDays,
        $NoPayDays,$WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays,$lineNo,$PayrollGrossAmt-$TotalEmpDeductionAmt,
        $TotalCompDeductionAmt,'','',$UniqueIdH,900,$PayrollGrossIncome,$PayrollGrossPay);
    }
    public function GetRuleDefinition($RuleId)
    {
        return $RuleDefinition = RuleDefinition::where('PMRDHRuleId', $RuleId)
        ->where('PMRDHIncOrDed', 'D')
        ->where('PMRDHMarkForDeletion',0)
        ->orderby('PMRDHRuleId')
        ->get()
        ->first();
    }
    public function GetGeographicId($value)
    {
        return $GeographicId = Location::where('GMLMHCompanyId', $this->gCompanyId)
        ->where('GMLMHLocationId', $value->EMGIHLocationId)
        ->where('GMLMHMarkForDeletion',0)
        ->orderby('GMLMHLocationId')
        ->get()
        ->first();
    }
    public function GetGenderId($value,$DeductionType)
    {
        $GenderId = $DeductionType->PMDTHApplicableFor;
        if ($GenderId == 'I') {
            return $value->EMGIHGenderId;
        }
        return $DeductionType->PMDTHApplicableFor;
    }
    public function GetDeductionPeriod($DeductionId, $PeriodId)
    {
        return $PeriodicIncDed = PeriodicIncDed::where('PMIDDIncDedId', $DeductionId)
        ->where('PMIDDIncOrDed', 'D')
        ->where('PMIDDPeriodId','=' ,$PeriodId)
        ->where('PMIDDMarkForDeletion',0)
        ->orderby('PMIDDIncDedId')
        ->get()
        ->first();
    }
    public function GetStatutrotyDeductionSlab($request,$value,$DeductionType,$RuleId,$RuleDefinition,$GeographicId)
    {
        
        $StatutoryDeductionSlabDetail = '';
        $GenderId = $this->GetGenderId($value,$DeductionType);

        //When Hierarchy Id = 1000 (Country Level)
        if ($RuleDefinition->PMRDHHierarchyId == '1000') {
            $StatutoryDeductionSlabDetail = StatutoryDeductionSlabDetail::where('PMDSDRuleId', $RuleId)
            ->where('PMDSDHierarchyId',$RuleDefinition->PMRDHHierarchyId)
            ->where('PMDSDGeographicId',$GeographicId->GMLMHCountryId)
            ->where('PMDSDGenderId',$GenderId)
            ->where('PMDSDIncOrDed','D')
            ->where('PMDSDEffectiveTo','>=', $request->FYFYHPeriodStartDate)
            ->where('PMDSDEffectiveFrom','<=', $request->FYFYHPeriodEndDate)
            ->get()
            ->first();

        }
        
        
        //When Hierarchy Id = 2000 (State Level)
        if ($RuleDefinition->PMRDHHierarchyId == '1100') {
            
            $StatutoryDeductionSlabDetail = StatutoryDeductionSlabDetail::where('PMDSDRuleId', $RuleId)
            ->where('PMDSDHierarchyId',$RuleDefinition->PMRDHHierarchyId)
            // ->where('PMDSDGeographicId',$GeographicId->GMLMHStateId)
            ->where('PMDSDGenderId',$GenderId)
            ->where('PMDSDIncOrDed','D')
            ->where('PMDSDEffectiveTo','>=', $request->FYFYHPeriodStartDate)
            ->where('PMDSDEffectiveFrom','<=', $request->FYFYHPeriodEndDate)
            ->get()
            ->first();
        }
        //When Hierarchy Id = 3000 (City Level)
        if ($RuleDefinition->PMRDHHierarchyId == '1200') {
            $StatutoryDeductionSlabDetail = StatutoryDeductionSlabDetail::where('PMDSDRuleId', $RuleId)
            ->where('PMDSDHierarchyId',$RuleDefinition->PMRDHHierarchyId)
            ->where('PMDSDGeographicId',$GeographicId->GMLMHCityId)
            ->where('PMDSDGenderId',$GenderId)
            ->where('PMDSDIncOrDed','D')
            ->where('PMDSDEffectiveTo','>=', $request->FYFYHPeriodStartDate)
            ->where('PMDSDEffectiveFrom','<=', $request->FYFYHPeriodEndDate)
            ->get()
            ->first();
        }
        //When Hierarchy Id = 4000 (Location Level)
        if ($RuleDefinition->PMRDHHierarchyId == '1300') {
            $StatutoryDeductionSlabDetail = StatutoryDeductionSlabDetail::where('PMDSDRuleId', $RuleId)
            ->where('PMDSDHierarchyId',$RuleDefinition->PMRDHHierarchyId)
            ->where('PMDSDGeographicId',$GeographicId->GMLMHLocationId)
            ->where('PMDSDGenderId',$GenderId)
            ->where('PMDSDIncOrDed','D')
            ->where('PMDSDEffectiveTo','>=', $request->FYFYHPeriodStartDate)
            ->where('PMDSDEffectiveFrom','<=', $request->FYFYHPeriodEndDate)
            ->get()
            ->first();
        }

        return $StatutoryDeductionSlabDetail;
    }
    public function GetStatutrotyDeductionSlabForPT($request,$value,$DeductionType,$RuleId,$RuleDefinition,$GeographicId,$TotalUserIncomeAmt)
    {
        
        $StatutoryDeductionSlabDetail = '';
        $GenderId = $this->GetGenderId($value,$DeductionType);

        //When Hierarchy Id = 1000 (Country Level)
        if ($RuleDefinition->PMRDHHierarchyId == '1000') {
            $StatutoryDeductionSlabDetail = StatutoryDeductionSlabDetail::where('PMDSDRuleId', $RuleId)
            ->where('PMDSDHierarchyId',$RuleDefinition->PMRDHHierarchyId)
            ->where('PMDSDGeographicId',$GeographicId->GMLMHCountryId)
            ->where('PMDSDGenderId',$GenderId)
            ->where('PMDSDIncOrDed','D')
            ->where('PMDSDEffectiveTo','>=', $request->FYFYHPeriodStartDate)
            ->where('PMDSDEffectiveFrom','<=', $request->FYFYHPeriodEndDate)
            ->where('PMDSDIncomeFrom','<=', $TotalUserIncomeAmt)
            ->where('PMDSDIncomeTo','>=', $TotalUserIncomeAmt)
            ->get()
            ->first();

        }
        
        
        //When Hierarchy Id = 2000 (State Level)
        if ($RuleDefinition->PMRDHHierarchyId == '1100') {
            
            $StatutoryDeductionSlabDetail = StatutoryDeductionSlabDetail::where('PMDSDRuleId', $RuleId)
            ->where('PMDSDHierarchyId',$RuleDefinition->PMRDHHierarchyId)
            // ->where('PMDSDGeographicId',$GeographicId->GMLMHStateId)
            ->where('PMDSDGenderId',$GenderId)
            ->where('PMDSDIncOrDed','D')
            ->where('PMDSDEffectiveTo','>=', $request->FYFYHPeriodStartDate)
            ->where('PMDSDEffectiveFrom','<=', $request->FYFYHPeriodEndDate)
            ->where('PMDSDIncomeFrom','<=', $TotalUserIncomeAmt)
            ->where('PMDSDIncomeTo','>=', $TotalUserIncomeAmt)
            ->get()
            ->first();
        }
        //When Hierarchy Id = 3000 (City Level)
        if ($RuleDefinition->PMRDHHierarchyId == '1200') {
            $StatutoryDeductionSlabDetail = StatutoryDeductionSlabDetail::where('PMDSDRuleId', $RuleId)
            ->where('PMDSDHierarchyId',$RuleDefinition->PMRDHHierarchyId)
            ->where('PMDSDGeographicId',$GeographicId->GMLMHCityId)
            ->where('PMDSDGenderId',$GenderId)
            ->where('PMDSDIncOrDed','D')
            ->where('PMDSDEffectiveTo','>=', $request->FYFYHPeriodStartDate)
            ->where('PMDSDEffectiveFrom','<=', $request->FYFYHPeriodEndDate)
            ->where('PMDSDIncomeFrom','<=', $TotalUserIncomeAmt)
            ->where('PMDSDIncomeTo','>=', $TotalUserIncomeAmt)
            ->get()
            ->first();
        }
        //When Hierarchy Id = 4000 (Location Level)
        if ($RuleDefinition->PMRDHHierarchyId == '1300') {
            $StatutoryDeductionSlabDetail = StatutoryDeductionSlabDetail::where('PMDSDRuleId', $RuleId)
            ->where('PMDSDHierarchyId',$RuleDefinition->PMRDHHierarchyId)
            ->where('PMDSDGeographicId',$GeographicId->GMLMHLocationId)
            ->where('PMDSDGenderId',$GenderId)
            ->where('PMDSDIncOrDed','D')
            ->where('PMDSDEffectiveTo','>=', $request->FYFYHPeriodStartDate)
            ->where('PMDSDEffectiveFrom','<=', $request->FYFYHPeriodEndDate)
            ->where('PMDSDIncomeFrom','<=', $TotalUserIncomeAmt)
            ->where('PMDSDIncomeTo','>=', $TotalUserIncomeAmt)
            ->get()
            ->first();
        }

        return $StatutoryDeductionSlabDetail;
    }
    public function GetPFlimitEmployee($employeeMaster,$value,$RuleDefinition,$TotalGrossIncome,$TotalGrossPay,$TotalUserEditedAmt)
    {
        //'1000' - Gross
        //'2000' - Net
        $PFLimitEmployee = $employeeMaster->EMGIHPFThreshold;
        // PF Eligibility
        if ($RuleDefinition->PMRDHDeductionEligibility == '1000') {
            if ($PFLimitEmployee >  $TotalGrossIncome ) {
                $PFLimitEmployee = $TotalGrossPay;
            }
        }else {
            if ($PFLimitEmployee >  $TotalUserEditedAmt ) {
                $PFLimitEmployee = $TotalUserEditedAmt;
            }
        }
        // PF Calculation Basis
        if ($RuleDefinition->PMRDHDeductionBasis == '1000') {
            if ($PFLimitEmployee >  $TotalGrossIncome ) {
                $PFLimitEmployee = $TotalGrossPay;
            }
        }else {
            if ($PFLimitEmployee > $TotalUserEditedAmt ) {
                $PFLimitEmployee = $TotalUserEditedAmt;
            }
        }
        return $PFLimitEmployee;
    }
    public function GetPFlimitCompany($employeeMaster,$value,$RuleDefinition,$TotalGrossIncome,$TotalGrossPay,$TotalUserEditedAmt)
    {
        //'1000' - Gross
        //'2000' - Net
        $PFLimitCompany = 0;
        if ($employeeMaster->EMGIHPFAgreedByComp == 1) {
            $PFLimitCompany = $employeeMaster->EMGIHPFCompLimit;
            if ($RuleDefinition->PMRDHDeductionEligibility == '1000') {
                if ($PFLimitCompany >  $TotalGrossIncome ) {
                    $PFLimitCompany = $TotalGrossPay;
                }
            }else {
                if ($PFLimitCompany >  $TotalUserEditedAmt ) {
                    $PFLimitCompany = $TotalUserEditedAmt;
                }
            }
            // PF Calculation Basis
            if ($RuleDefinition->PMRDHDeductionBasis == '1000') {
                if ($PFLimitCompany >  $TotalGrossIncome ) {
                    $PFLimitCompany = $TotalGrossPay;
                }
            }else {
                if ($PFLimitCompany > $TotalUserEditedAmt ) {
                    $PFLimitCompany = $TotalUserEditedAmt;
                }
            }
        }
        return $PFLimitCompany;
    }
    public function GetStatutoryDeductionLimit($RuleDefinition,$TotalGrossAmt,$TotalUserEditedAmt)
    {
        if ($RuleDefinition->PMRDHDeductionBasis == '1000') {
            return $TotalGrossAmt;
        }else {
            return $TotalUserEditedAmt;
        }
    }
    public function UpdatePayrollDetailMemForDeduction($request,$value, $EmployeeCalendarDays,
        $NoPayDays,$WeeklyOff,$PublicHoliday,$LeaveWithoutPay,$PaidDays,$lineNo,$PayrollAmt,
        $CompContriAmt,$DeductionId,$DeductionDesc,$UniqueIdH,$SysId,$PayrollGrossIncome,$PayrollGrossPay)
    {
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
            'PGGPDUserSorting'              => $SysId >= 600 ? $SysId : $lineNo,
            'PGGPDIncDedId'                 => ($SysId == 600) ? 6999 : (($SysId == 900) ? 9999 : $DeductionId),
            'PGGPDIncOrDed'                 => $SysId == 900 ? '' : 'D',
            'PGGPDDesc'                     => ($SysId == 600) ? 'Total Deduction' : (($SysId == 900) ? 'Paid Salary' : $DeductionDesc),
            'PGGPDGrossIncome'              => $PayrollGrossIncome,
            'PGGPDGrossPay'                 => $PayrollGrossPay,
            'PGGPDPayrollAmt'               => $PayrollAmt,
            'PGGPDUserEditedAmt'            => $PayrollAmt,
            'PGGPDCompContriGross'          => 0,
            'PGGPDCompContriNet'            => $CompContriAmt,
            'PGGPDCompContriUserEditedAmt'  => $CompContriAmt,

            'PGGPDCaldendarDays'            => $request->TotalNoOfDays,
            'PGGPDPresentDays'              => $EmployeeCalendarDays,
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
        
        // 'PGGPDPaidLeave',
    }

    public function GetTotalUserEditedAmtFromPayrollDetail($request,$value,$DeductionId)
    {
        return $TotalUserIncomeAmt = PayrollDetail::where('PGGPDCompanyId', $this->gCompanyId)
            ->where('PGGPDEmployeeId',$value->EMGIHEmployeeId)
            ->where('PGGPDFiscalYear',$request->PGGPHFiscalYear)
            ->where('PGGPDPeriodId','>=',1)
            ->where('PGGPDPeriodId','<',$request->PGGPHFiscalPeriod)
            ->where('PGGPDSysId', 100)
            ->where('PGGPDIncOrDed','I')
            ->sum('PGGPDUserEditedAmt');
    }
    public function GetTotalDeductionAmtFromPayrollDetail($request,$value,$DeductionId)
    {
        return $TotalUserDeductionAmt = PayrollDetail::where('PGGPDCompanyId', $this->gCompanyId)
            ->where('PGGPDEmployeeId',$value->EMGIHEmployeeId)
            ->where('PGGPDFiscalYear',$request->PGGPHFiscalYear)
            ->where('PGGPDPeriodId','>=',1)
            ->where('PGGPDPeriodId','<',$request->PGGPHFiscalPeriod)
            ->where('PGGPDSysId', 500)
            ->where('PGGPDIncOrDed','D')
            ->where('PGGPDIncDedId',$DeductionId)
            ->sum('PGGPDUserEditedAmt');
    }
    public function GetTotalUserEditedAmtMem($request,$value)
    {
        return  $TotalUserEditedAmtCurrent = MemPayrollDetail::where('PGGPDCompanyId', $this->gCompanyId)
                ->where('PGGPDEmployeeId', $value->EMGIHEmployeeId)
                ->where('PGGPDSysId', 100)
                ->where('PGGPDIncOrDed','I')
                ->sum('PGGPDUserEditedAmt');
    }
    
    
}
