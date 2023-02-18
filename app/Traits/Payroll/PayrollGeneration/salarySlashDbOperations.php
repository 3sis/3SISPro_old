<?php
namespace App\Traits\Payroll\PayrollGeneration;
use App\Models\Payroll\PayrollGeneration\MemSalaryRevisionXL;
use App\Models\Payroll\PayrollGeneration\IncomeTypeSalarySlashF4;
use App\Models\Payroll\PayrollGeneration\SalarySlashHeader;
use App\Models\Payroll\PayrollGeneration\SalarySlashDetail;
use App\Models\Payroll\IncomeDeductionType\IncomeType;
use App\Models\Payroll\EmployeeEarnings\IncomeMaster;
use App\Models\Payroll\EmployeeMaster\GeneralInfo;


use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
trait salarySlashDbOperations
{
    
    public function XLDeleteMemSalaryRevisionXLTrait() 
    {
        $loginName = Auth::user()->name;
        $MemSalaryRevisionXL=MemSalaryRevisionXL::where('PGSRHUser', $loginName)
        ->delete();
    }
    public function DeleteMemIncomeTypeTrait() 
    {
        $loginName = Auth::user()->name;
        $IncomeTypeSalarySlashF4=IncomeTypeSalarySlashF4::where('PMSSHUser', $loginName)
        ->delete();
    }
    public function XLUploadBrowserDataTrait() 
     { 
        return $browserData = MemSalaryRevisionXL::leftjoin('T11101l01', 'EMGIHEmployeeId', '=', 'mem11126L04.PGSRHEmployeeId')
        ->get([
            'mem11126L04.PGSRHUniqueId',
            'mem11126L04.PGSRHEmployeeId',
            'T11101l01.EMGIHFullName',
            'mem11126L04.PGSRHEffectiveFrom',
            'mem11126L04.PGSRHEffectiveTo',
            'mem11126L04.PGSRHRevisedAmt',
            'mem11126L04.PGSRHFixedOrPercent',
            'mem11126L04.PGSRHSelect',
            'mem11126L04.PGSRHUser',
        ]);
     }
    function UpdateSelect_UnSelectTrait($request) {
        $MemSalaryRevisionXL = MemSalaryRevisionXL::
        where('PGSRHEmployeeId', $request->PGSRHEmployeeId)
        ->where('PGSRHCompanyId', $this->gCompanyId)
        ->get(['PGSRHSelect'])
        ->first();
        if ($MemSalaryRevisionXL->PGSRHSelect == 1) {
            MemSalaryRevisionXL::where('PGSRHEmployeeId', $request->PGSRHEmployeeId)
            ->where('PGSRHCompanyId', $this->gCompanyId)
            ->first()              
            ->update([
                'PGSRHSelect' => 0
            ]);
        }else {
            MemSalaryRevisionXL::where('PGSRHEmployeeId', $request->PGSRHEmployeeId)
            ->where('PGSRHCompanyId', $this->gCompanyId)
            ->first()              
            ->update([
                'PGSRHSelect' => 1
            ]);
        }

        
    }
    public function UpdateIncomeTypeMemTrait($request)
    {
        if ($request->UpdateMode == 1) {
            IncomeTypeSalarySlashF4::where('PMSSHUser', Auth::user()->name)
            ->delete();
            $IncomeTypeMaster = IncomeType::where('PMITHMarkForDeletion', 0)
            ->get();
            foreach ($IncomeTypeMaster as $key => $value) {
                IncomeTypeSalarySlashF4::create([
                    'PMSSHUniqueId'             => $value->PMITHUniqueId,
                    'PMSSHIncomeId'             => $value->PMITHIncomeId,
                    'PMSSHDesc1'                => $value->PMITHDesc1,
                    'PMSSHSelect'               => 0,
                    'PMSSHUser'                 => Auth::user()->name,
                    'PMSSHLastCreated'          => $value->PMITHLastCreated,
                ]);
            }
        }
    }
    public function BrowserIncomeTypeListTrait($request){
        return $browserData = IncomeTypeSalarySlashF4::get([
            'PMSSHSelect', 
            'PMSSHIncomeId',
            'PMSSHDesc1',
         ]);
    }
    function UpdateSelect_UnSelectIncomeTypeTrait($request) {
        $IncomeTypeSalarySlashF4 = IncomeTypeSalarySlashF4::where('PMSSHIncomeId', $request->PMSSHIncomeId)
        ->where('PMSSHUser', Auth::user()->name)
        ->get(['PMSSHSelect'])
        ->first();
        if ($IncomeTypeSalarySlashF4->PMSSHSelect == 1) {
            IncomeTypeSalarySlashF4::where('PMSSHIncomeId', $request->PMSSHIncomeId)
            ->where('PMSSHUser', Auth::user()->name)
            ->first()              
            ->update([
                'PMSSHSelect' => 0
            ]);
        }else {
            IncomeTypeSalarySlashF4::where('PMSSHIncomeId', $request->PMSSHIncomeId)
            ->where('PMSSHUser', Auth::user()->name)
            ->first()              
            ->update([
                'PMSSHSelect' => 1
            ]);
        }
    }
    public function UpdateActualTableWithUpdateIncomeTypeMemTrait($request){
        //Delete Actual Table Data : NoPayDays
        // 
        $loginName = Auth::user()->name;
        $SalarySlashDetail = SalarySlashDetail::where('PGSSDCompanyId', $this->gCompanyId)
        ->where('PGSSDUser', $loginName)
        ->where('PGSSDMarkForDeletion', '!=' , 1)
        ->get();
        foreach ($SalarySlashDetail as $value) {
            $value->PGSSDStatusId           = 9999;
            $value->PGSSDMarkForDeletion    = 1;
            $value->PGSSDUser               = $loginName;
            $value->PGSSDDeletedAt          = Carbon::now();
            $value->save();
        };
        // Append from Income Mem to Actual
        $MemSalaryRevisionXL = MemSalaryRevisionXL::orderBy('PGSRHEmployeeId')
        ->where('PGSRHSelect', '=' , 1)
        ->get();
        $IncomeTypeSalarySlashF4 = IncomeTypeSalarySlashF4::where('PMSSHSelect', '=' , 1)
        ->get();
        foreach ($IncomeTypeSalarySlashF4 as $key => $value) {
            $this->UpdateSalarySlashDetailActual($request,$value,$MemSalaryRevisionXL);
        }
        
    }
    public function CheckSelectedIncomeTypeMemTrait($request)
    {
        return $SelectedFound = IncomeTypeSalarySlashF4::where('PMSSHUser', Auth::user()->name)
        ->where('PMSSHSelect', 1)
        ->get(['PMSSHSelect'])
        ->first();
    }
    public function CheckSelectedEmployeAtSalaryRevisionMemTrait($request)
    {
        return $SelectedFound = MemSalaryRevisionXL::where('PGSRHUser', Auth::user()->name)
        ->where('PGSRHSelect', 1)
        ->get(['PGSRHSelect'])
        ->first();
    }

    public function UpdateSalarySlashDetailActual($request,$value,$MemSalaryRevisionXL){
        foreach ($MemSalaryRevisionXL as $key => $SalaryRevisionMem){

            $IncomeMaster = IncomeMaster::where('EEIMDCompId', $this->gCompanyId)
            ->where('EEIMDEmployeeId', $SalaryRevisionMem->PGSRHEmployeeId)
            ->where('EEIMDIncomeId', $value->PMSSHIncomeId)
            ->where('EEIMDEffectiveTo','>=', $SalaryRevisionMem->PGSRHEffectiveFrom)
            ->where('EEIMDEffectiveFrom','<=', $SalaryRevisionMem->PGSRHEffectiveTo)
            ->where('EEIMDMarkForDeletion', '=' , 0)
            ->get(['EEIMDPayrollIncome'])
            ->first();
            if ($IncomeMaster != '') {
                $employeeMaster = GeneralInfo::where('EMGIHCompId', $this->gCompanyId)
                ->where('EMGIHEmployeeId', $SalaryRevisionMem->PGSRHEmployeeId)
                ->get(['EMGIHLocationId'])
                ->first();
                SalarySlashDetail::create([
                    'PGSSDCompanyId'            => $SalaryRevisionMem->PGSRHCompanyId,
                    'PGSSDFiscalYear'           => '',
                    'PGSSDPeriodId'             => 0,
                    'PGSSDLocationId'           =>  $employeeMaster->EMGIHLocationId,
                    'PGSSDEmployeeId'           =>  $SalaryRevisionMem->PGSRHEmployeeId,
                    'PGSSDIncDedId'             =>  $value->PMSSHIncomeId,
                    'PGSSDDesc1'                =>  $value->PMSSHDesc1,
                    'PGSSDGrossAmount'          =>  $IncomeMaster->EEIMDPayrollIncome,

                    'PGSSDIncomeFixOrPercent'   =>  $SalaryRevisionMem->PGSRHFixedOrPercent,
                    'PGSSDIncomePaymentPercent' =>  $SalaryRevisionMem->PGSRHFixedOrPercent == "P" ? $SalaryRevisionMem->PGSRHRevisedAmt : 0,
                    'PGSSDGrossPayment'         =>  $SalaryRevisionMem->PGSRHFixedOrPercent == "P" ? 
                                                    ($IncomeMaster->EEIMDPayrollIncome+($IncomeMaster->EEIMDPayrollIncome*$SalaryRevisionMem->PGSRHRevisedAmt)/100) : 
                                                    $SalaryRevisionMem->PGSRHRevisedAmt,
                    'PGSSDFromDate'             =>  $SalaryRevisionMem->PGSRHEffectiveFrom,
                    'PGSSDToDate'               =>  $SalaryRevisionMem->PGSRHEffectiveTo,
                
                    'PGSSDMarkForDeletion'      => 0,
                    'PGSSDUser'                 => Auth::user()->name,
                    'PGSSDStatusId'             => 1000,
                    'PGSSDLastCreated'          => Carbon::now(),
                    'PGSSDLastUpdated'          => Carbon::now()
                ]);
                $this->UpdateSalarySlashHeaderActual($SalaryRevisionMem,$employeeMaster);
            }
        }
    }
    public function UpdateSalarySlashHeaderActual($SalaryRevisionMem,$employeeMaster){
        $SalarySlashHeader = SalarySlashHeader::where('PGSSHCompanyId', $this->gCompanyId)
        ->where('PGSSHEmployeeId', $SalaryRevisionMem->PGSRHEmployeeId)
        ->get(['PGSSHEmployeeId'])
        ->first();
        // echo 'Data Submitted.'.$EmpFound;
        // // // print_r($request);
        // die();
        if ($SalarySlashHeader == '') {
            $SalarySlashHeader = new SalarySlashHeader;
            $SalarySlashHeader->PGSSHCompanyId          = $SalaryRevisionMem->PGSRHCompanyId;
            $SalarySlashHeader->PGSSHFiscalYear         = '';
            $SalarySlashHeader->PGSSHPeriodId           = 0;
            $SalarySlashHeader->PGSSHLocationId         =  $employeeMaster->EMGIHLocationId;
            $SalarySlashHeader->PGSSHEmployeeId         =  $SalaryRevisionMem->PGSRHEmployeeId;
            $SalarySlashHeader->PGSSHCurrentIncome      = 0;
            $SalarySlashHeader->PGSSHIncreaseDecrese    = 0;
            $SalarySlashHeader->PGSSHRevisedIncome      = 0;
            $SalarySlashHeader->PGSSHMarkForDeletion     = 0;
            $SalarySlashHeader->PGSSHLastCreated        = Carbon::now();
        }
        $SalarySlashHeader->PGSSHFromDate            =  $SalaryRevisionMem->PGSRHEffectiveFrom;
        $SalarySlashHeader->PGSSHToDate              =  $SalaryRevisionMem->PGSRHEffectiveTo;
        $SalarySlashHeader->PGSSHUser                =  Auth::user()->name;
        $SalarySlashHeader->PGSSHStatusId            =  1000;
        $SalarySlashHeader->PGSSHLastCreated         =  Carbon::now();
        $SalarySlashHeader->PGSSHLastUpdated         =  Carbon::now();
        $SalarySlashHeader->save(); 
    }
    public function BrowserHeadDataTrait() 
    { 
        return $browserData = SalarySlashHeader::leftjoin('T11101l01', 'EMGIHEmployeeId', '=', 'T11125L02.PGSSHEmployeeId')
        ->leftjoin('T05901L06', 'GMLMHLocationId', '=', 'T11125L02.PGSSHLocationId')
        ->get([
            'T11125L02.PGSSHUniqueId',
            'T11125L02.PGSSHEmployeeId',
            'T11101l01.EMGIHFullName',
            'T11125L02.PGSSHLocationId',
            'T05901L06.GMLMHDesc1',
            'T11125L02.PGSSHFromDate',
            'T11125L02.PGSSHToDate',
            'T11125L02.PGSSHUser',
            'T11125L02.PGSSHLastUpdated',
        ]);
    }
    public function BrowserDetailDataTrait($request) 
    { 
        
        return $browserData = SalarySlashDetail::where('PGSSDCompanyId', $this->gCompanyId)
        ->where('PGSSDEmployeeId', $request->PGSSHEmployeeId)
        ->get([
            'PGSSDUniqueId',
            'PGSSDIncDedId',
            'PGSSDDesc1',
            'PGSSDGrossAmount',
            'PGSSDIncomeFixOrPercent',
            'PGSSDIncomePaymentPercent',
            'PGSSDGrossPayment',
            'PGSSDFromDate',
            'PGSSDToDate',
            'PGSSDStatusId',
            'PGSSDMarkForDeletion',
        ]);
    }
    public function FethchEditedDetailDataTrait($request){  
        
        $PGSSDUniqueId = $request->input('id');
        $SalarySlashDetail = SalarySlashDetail::find($PGSSDUniqueId);
        return $output = array(
            'PGSSDUniqueId'                 =>  $SalarySlashDetail->PGSSDUniqueId,
            'PGSSDLocationId'               =>  $SalarySlashDetail->PGSSDLocationId,
            'PGSSDEmployeeId'               =>  $SalarySlashDetail->PGSSDEmployeeId,
            'PGSSDIncDedId'                 =>  $SalarySlashDetail->PGSSDIncDedId,
            'PGSSDDesc1'                    =>  $SalarySlashDetail->PGSSDDesc1,
            
            'PGSSDGrossAmount'              =>  $SalarySlashDetail->PGSSDGrossAmount,
            'PGSSDIncomeFixOrPercent'       =>  $SalarySlashDetail->PGSSDIncomeFixOrPercent,
            'PGSSDIncomePaymentPercent'     =>  $SalarySlashDetail->PGSSDIncomePaymentPercent,

            'PGSSDGrossPayment'             =>  $SalarySlashDetail->PGSSDGrossPayment,
            'PGSSDFromDate'                 =>  $SalarySlashDetail->PGSSDFromDate,
            'PGSSDToDate'                   =>  $SalarySlashDetail->PGSSDToDate,
            'PGSSDUser'                     =>  $SalarySlashDetail->PGSSDUser
        );
    }
    public function CheckDuplicateIncomeTrait($request){
        if ($request->button_action_DetailEntry1 == 'insert') {
            # code...
            return $DuplicateFound = SalarySlashDetail::where('PGSSDEmployeeId', $request->PGSSDEmployeeId)
            ->where('PGSSDIncDedId', $request->PGSSDIncDedId)
            ->get(['PGSSDIncDedId'])
            ->first();            
        } else {
            # code...
            return $DuplicateFound = SalarySlashDetail::where('PGSSDEmployeeId', $request->PGSSDEmployeeId)
            ->where('PGSSDIncDedId', $request->PGSSDIncDedId)
            ->where('PGSSDUniqueId', '!=' ,$request->PGSSDUniqueId)
            ->get(['PGSSDIncDedId'])
            ->first();      
        }
        
    }
    public function AddUpdateSalarySlashDetailTrait($request){
        // Get Income Id Desc
        $IncomeTypeDesc = IncomeType::where('PMITHIncomeId', $request->PGSSDIncDedId)
        ->get(['PMITHDesc1'])
        ->first();
        $GeneralInfo = GeneralInfo::where('EMGIHCompId', $this->gCompanyId)
        ->where('EMGIHEmployeeId', $request->PGSSDEmployeeId)
        ->get(['EMGIHLocationId'])
        ->first();
        // echo 'Data Submitted.';
        // print_r($request->input());
        // die();
        if($request->get('button_action_DetailEntry1') == 'insert') {
            $SalarySlashDetail = new SalarySlashDetail;                
            $SalarySlashDetail->PGSSDCompanyId          =   $this->gCompanyId;            
            $SalarySlashDetail->PGSSDLocationId         =   $GeneralInfo->EMGIHLocationId;            
            $SalarySlashDetail->PGSSDEmployeeId         =   $request->PGSSDEmployeeId;            
            $SalarySlashDetail->PGSSDFromDate           =   $request->PGSSDFromDate;
            $SalarySlashDetail->PGSSDToDate             =   $request->PGSSDToDate;
            $SalarySlashDetail->PGSSDStatusId           =   1000;  
            $SalarySlashDetail->PGSSDLastCreated        =   Carbon::now();
        }elseif($request->get('button_action_DetailEntry1') == 'update'){
            $SalarySlashDetail = SalarySlashDetail::find($request->get('PGSSDUniqueId'));
        }
        $SalarySlashDetail->PGSSDIncDedId               =   $request->PGSSDIncDedId;         
        $SalarySlashDetail->PGSSDDesc1                  =   $IncomeTypeDesc->PMITHDesc1;  
        $SalarySlashDetail->PGSSDGrossAmount            =   $request->PGSSDGrossAmount;
        $SalarySlashDetail->PGSSDIncomeFixOrPercent     =   $request->PGSSDIncomeFixOrPercent;
        $SalarySlashDetail->PGSSDIncomePaymentPercent   =   $request->PGSSDIncomePaymentPercent;
        $SalarySlashDetail->PGSSDGrossPayment           =   $request->PGSSDGrossPayment;
        $SalarySlashDetail->PGSSDUser                   =   Auth::user()->name;
        $SalarySlashDetail->PGSSDLastUpdated            =   Carbon::now();
        $SalarySlashDetail->save(); 
        if($request->get('button_action_DetailEntry1') == 'insert') {
            $UniqueId = $SalarySlashDetail->PGSSDUniqueId; 
        }elseif($request->get('button_action_DetailEntry1') == 'update'){
            $UniqueId = $request->get('PGSSDUniqueId');
        }
        
        return $UniqueId; 
    }
    public function DeleteRecordSalarySlashDetailTrait($request){
        $UniqueId = $request->input('id');
        $SalarySlashDetail = SalarySlashDetail::where('PGSSDUniqueId', $UniqueId)
        ->get()
        ->first();
        $SalarySlashDetail->PGSSDMarkForDeletion    = $SalarySlashDetail->PGSSDMarkForDeletion == 0 ? 1 : 0;
        $SalarySlashDetail->PGSSDStatusId           = $SalarySlashDetail->PGSSDMarkForDeletion == 0 ? 1000 : 9910;
        $SalarySlashDetail->PGSSDDeletedAt          = $SalarySlashDetail->PGSSDMarkForDeletion == 0 ? NULL : Carbon::now();
        $SalarySlashDetail->save();
        return;
    }
}
