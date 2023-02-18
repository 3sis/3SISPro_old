<?php
namespace App\Traits\Payroll\PayrollGeneration;
use App\Models\Payroll\PayrollGeneration\MemSalaryRevisionXL;
use App\Models\Payroll\PayrollGeneration\DeductionTypeSelectionF4;
use App\Models\Payroll\EmployeeMaster\GeneralInfo;
use App\Models\Payroll\IncomeDeductionType\DeductionType;
use App\Models\Payroll\EmployeeEarnings\DeductionMaster;

use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\PayrollGeneration\DeductionAdjustmentHeader;
use App\Models\Payroll\PayrollGeneration\DeductionAdjustmentDetail;
trait IncomeAdjustmentDbOperations
{
    public function XLDeleteMemSalaryRevisionXLTrait() 
    {
        $loginName = Auth::user()->name;
        $MemSalaryRevisionXL=MemSalaryRevisionXL::where('PGSRHUser', $loginName)
        ->delete();
    }
    public function DeleteMemDeductionTypeTrait() 
    {
        $loginName = Auth::user()->name;
        $DeductionTypeSelectionF4=DeductionTypeSelectionF4::where('PMDAHUser', $loginName)
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
    public function UpdateDeductionTypeMemTrait($request)
    {
        if ($request->UpdateMode == 1) {
            DeductionTypeSelectionF4::where('PMDAHUser', Auth::user()->name)
            ->delete();
            $DeductionTypeMaster = DeductionType::where('PMDTHMarkForDeletion', 0)
            ->get();
            foreach ($DeductionTypeMaster as $key => $value) {
                DeductionTypeSelectionF4::create([
                    'PMDAHUniqueId'             => $value->PMDTHUniqueId,
                    'PMDAHDeductionId'             => $value->PMDTHDeductionId,
                    'PMDAHDesc1'                => $value->PMDTHDesc1,
                    'PMDAHSelect'               => 0,
                    'PMDAHUser'                 => Auth::user()->name,
                    'PMDAHLastCreated'          => $value->PMDTHLastCreated,
                ]);
            }
        }
    }
    public function BrowserDeductionTypeListTrait($request){
        return $browserData = DeductionTypeSelectionF4::get([
            'PMDAHSelect', 
            'PMDAHDeductionId',
            'PMDAHDesc1',
         ]);
    }
    function UpdateSelect_UnSelectDeductionTypeTrait($request) {
        $DeductionTypeSelectionF4 = DeductionTypeSelectionF4::where('PMDAHDeductionId', $request->PMDAHDeductionId)
        ->where('PMDAHUser', Auth::user()->name)
        ->get(['PMDAHSelect'])
        ->first();
        if ($DeductionTypeSelectionF4->PMDAHSelect == 1) {
            DeductionTypeSelectionF4::where('PMDAHDeductionId', $request->PMDAHDeductionId)
            ->where('PMDAHUser', Auth::user()->name)
            ->first()              
            ->update([
                'PMDAHSelect' => 0
            ]);
        }else {
            DeductionTypeSelectionF4::where('PMDAHDeductionId', $request->PMDAHDeductionId)
            ->where('PMDAHUser', Auth::user()->name)
            ->first()              
            ->update([
                'PMDAHSelect' => 1
            ]);
        }
    }
    public function UpdateActualTableWithUpdateDeductionTypeMemTrait($request){
        //Delete Actual Table Data : NoPayDays
        // 
        $loginName = Auth::user()->name;
        $DeductionAdjustmentDetail = DeductionAdjustmentDetail::where('PGDADCompanyId', $this->gCompanyId)
        ->where('PGDADUser', $loginName)
        ->where('PGDADMarkForDeletion', '!=' , 1)
        ->get();
        foreach ($DeductionAdjustmentDetail as $value) {
            $value->PGDADStatusId           = 9999;
            $value->PGDADMarkForDeletion    = 1;
            $value->PGDADUser               = $loginName;
            $value->PGDADDeletedAt          = Carbon::now();
            $value->save();
        };
        // Append from Income Mem to Actual
        $MemSalaryRevisionXL = MemSalaryRevisionXL::orderBy('PGSRHEmployeeId')
        ->where('PGSRHSelect', '=' , 1)
        ->get();
        $DeductionTypeSelectionF4 = DeductionTypeSelectionF4::where('PMDAHSelect', '=' , 1)
        ->get();

        foreach ($DeductionTypeSelectionF4 as $key => $value) {

            $this->UpdateDeductionAdjustmentDetailActual($request,$value,$MemSalaryRevisionXL);
        }
        
    }
    public function CheckSelectedDeductionTypeMemTrait($request)
    {
        return $SelectedFound = DeductionTypeSelectionF4::where('PMDAHUser', Auth::user()->name)
        ->where('PMDAHSelect', 1)
        ->get(['PMDAHSelect'])
        ->first();
    }
    public function CheckSelectedEmployeAtSalaryRevisionMemTrait($request)
    {
        return $SelectedFound = MemSalaryRevisionXL::where('PGSRHUser', Auth::user()->name)
        ->where('PGSRHSelect', 1)
        ->get(['PGSRHSelect'])
        ->first();
    }
    public function UpdateDeductionAdjustmentDetailActual($request,$value,$MemSalaryRevisionXL){
        foreach ($MemSalaryRevisionXL as $key => $SalaryRevisionMem){
            $employeeMaster = GeneralInfo::where('EMGIHCompId', $this->gCompanyId)
            ->where('EMGIHEmployeeId', $SalaryRevisionMem->PGSRHEmployeeId)
            ->get(['EMGIHLocationId'])
            ->first();
            $DeductionMaster = DeductionMaster::where('EEDMDCompId', $this->gCompanyId)
            ->where('EEDMDEmployeeId', $SalaryRevisionMem->PGSRHEmployeeId)
            ->where('EEDMDDeductionId', $value->PMDAHDeductionId)
            ->where('EEDMDEffectiveTo','>=', $SalaryRevisionMem->PGSRHEffectiveFrom)
            ->where('EEDMDEffectiveFrom','<=', $SalaryRevisionMem->PGSRHEffectiveTo)
            ->where('EEDMDMarkForDeletion', '=' , 0)
            ->get(['EEDMDPayrollDeduction'])
            ->first();
            DeductionAdjustmentDetail::create([
                'PGDADCompanyId'            => $SalaryRevisionMem->PGSRHCompanyId,
                'PGDADFiscalYear'           => '',
                'PGDADPeriodId'             => 0,
                'PGDADLocationId'           =>  $employeeMaster->EMGIHLocationId,
                'PGDADEmployeeId'           =>  $SalaryRevisionMem->PGSRHEmployeeId,
                'PGDADIncDedId'             =>  $value->PMDAHDeductionId,
                'PGDADDesc1'                =>  $value->PMDAHDesc1,
                'PGDADGrossDeduction'       =>  $DeductionMaster != '' ? $DeductionMaster->EEDMDPayrollDeduction : 0,

                'PGDADNetDeduction'         =>   $SalaryRevisionMem->PGSRHRevisedAmt,
                                               
                'PGDADFromDate'             =>  $SalaryRevisionMem->PGSRHEffectiveFrom,
                'PGDADToDate'               =>  $SalaryRevisionMem->PGSRHEffectiveTo,
            
                'PGDADMarkForDeletion'      => 0,
                'PGDADUser'                 => Auth::user()->name,
                'PGDADStatusId'             => 1000,
                'PGDADLastCreated'          => Carbon::now(),
                'PGDADLastUpdated'          => Carbon::now()
            ]);
            $this->UpdateDeductionAdjustmentHeaderActual($SalaryRevisionMem,$employeeMaster);
        }
    }
    public function UpdateDeductionAdjustmentHeaderActual($SalaryRevisionMem,$employeeMaster){
        $DeductionAdjustmentHeader = DeductionAdjustmentHeader::where('PGDAHCompanyId', $this->gCompanyId)
        ->where('PGDAHEmployeeId', $SalaryRevisionMem->PGSRHEmployeeId)
        ->get(['PGDAHEmployeeId'])
        ->first();
        // echo 'Data Submitted.'.$SalaryRevisionMem->PGSRHEmployeeId;
        // // // print_r($request);
        // die();
        if ($DeductionAdjustmentHeader == '') {
            $DeductionAdjustmentHeader = new DeductionAdjustmentHeader;
            $DeductionAdjustmentHeader->PGDAHCompanyId          = $SalaryRevisionMem->PGSRHCompanyId;
            $DeductionAdjustmentHeader->PGDAHFiscalYear         = '';
            $DeductionAdjustmentHeader->PGDAHPeriodId           = 0;
            $DeductionAdjustmentHeader->PGDAHLocationId         =  $employeeMaster->EMGIHLocationId;
            $DeductionAdjustmentHeader->PGDAHEmployeeId         =  $SalaryRevisionMem->PGSRHEmployeeId;
            $DeductionAdjustmentHeader->PGDAHCurrentIncome      = 0;
            $DeductionAdjustmentHeader->PGDAHIncreaseDecrese    = 0;
            $DeductionAdjustmentHeader->PGDAHRevisedIncome      = 0;
            $DeductionAdjustmentHeader->PGDAHMarkForDeletion     = 0;
            $DeductionAdjustmentHeader->PGDAHLastCreated        = Carbon::now();
        }
        $DeductionAdjustmentHeader->PGDAHFromDate            =  $SalaryRevisionMem->PGSRHEffectiveFrom;
        $DeductionAdjustmentHeader->PGDAHToDate              =  $SalaryRevisionMem->PGSRHEffectiveTo;
        $DeductionAdjustmentHeader->PGDAHUser                =  Auth::user()->name;
        $DeductionAdjustmentHeader->PGDAHStatusId            =  1000;
        $DeductionAdjustmentHeader->PGDAHLastCreated         =  Carbon::now();
        $DeductionAdjustmentHeader->PGDAHLastUpdated         =  Carbon::now();
        $DeductionAdjustmentHeader->save(); 
    }

    public function BrowserHeadDataTrait() 
    { 
        return $browserData = DeductionAdjustmentHeader::leftjoin('T11101l01', 'EMGIHEmployeeId', '=', 'T11125L03.PGDAHEmployeeId')
        ->leftjoin('T05901L06', 'GMLMHLocationId', '=', 'T11125L03.PGDAHLocationId')
        ->get([
            'T11125L03.PGDAHUniqueId',
            'T11125L03.PGDAHEmployeeId',
            'T11101l01.EMGIHFullName',
            'T11125L03.PGDAHLocationId',
            'T05901L06.GMLMHDesc1',
            'T11125L03.PGDAHFromDate',
            'T11125L03.PGDAHToDate',
            'T11125L03.PGDAHUser',
            'T11125L03.PGDAHLastUpdated',
        ]);
    }
    public function BrowserDetailDataTrait($request) 
    { 
        
        return $browserData = DeductionAdjustmentDetail::where('PGDADCompanyId', $this->gCompanyId)
        ->where('PGDADEmployeeId', $request->PGDAHEmployeeId)
        ->get([
            'PGDADUniqueId',
            'PGDADIncDedId',
            'PGDADDesc1',
            'PGDADGrossDeduction',
            'PGDADNetDeduction',
            'PGDADFromDate',
            'PGDADToDate',
            'PGDADStatusId',
            'PGDADMarkForDeletion',
        ]);
    }
    public function FethchEditedDetailDataTrait($request){  
        
        $PGDADUniqueId = $request->input('id');
        $DeductionAdjustmentDetail = DeductionAdjustmentDetail::find($PGDADUniqueId);
        return $output = array(
            'PGDADUniqueId'                 =>  $DeductionAdjustmentDetail->PGDADUniqueId,
            'PGDADLocationId'               =>  $DeductionAdjustmentDetail->PGDADLocationId,
            'PGDADEmployeeId'               =>  $DeductionAdjustmentDetail->PGDADEmployeeId,
            'PGDADIncDedId'                 =>  $DeductionAdjustmentDetail->PGDADIncDedId,
            'PGDADDesc1'                    =>  $DeductionAdjustmentDetail->PGDADDesc1,
            
            'PGDADGrossDeduction'              =>  $DeductionAdjustmentDetail->PGDADGrossDeduction,

            'PGDADNetDeduction'             =>  $DeductionAdjustmentDetail->PGDADNetDeduction,
            'PGDADFromDate'                 =>  $DeductionAdjustmentDetail->PGDADFromDate,
            'PGDADToDate'                   =>  $DeductionAdjustmentDetail->PGDADToDate,
            'PGDADUser'                     =>  $DeductionAdjustmentDetail->PGDADUser
        );
    }
    public function CheckDuplicateDeductionTrait($request){
        if ($request->button_action_DetailEntry1 == 'insert') {
            # code...
            return $DuplicateFound = DeductionAdjustmentDetail::where('PGDADEmployeeId', $request->PGDADEmployeeId)
            ->where('PGDADIncDedId', $request->PGDADIncDedId)
            ->get(['PGDADIncDedId'])
            ->first();            
        } else {
            # code...
            return $DuplicateFound = DeductionAdjustmentDetail::where('PGDADEmployeeId', $request->PGDADEmployeeId)
            ->where('PGDADIncDedId', $request->PGDADIncDedId)
            ->where('PGDADUniqueId', '!=' ,$request->PGDADUniqueId)
            ->where('PGDADMarkForDeletion',0)
            ->get(['PGDADIncDedId'])
            ->first();      
        }
        
    }
    public function AddUpdateDeductionAdjustmentDetailTrait($request){
        // Get Deduction Id Desc
        $DeductionTypeDesc = DeductionType::where('PMDTHDeductionId', $request->PGDADIncDedId)
        ->get(['PMDTHDesc1'])
        ->first();
        $GeneralInfo = GeneralInfo::where('EMGIHCompId', $this->gCompanyId)
        ->where('EMGIHEmployeeId', $request->PGDADEmployeeId)
        ->get(['EMGIHLocationId'])
        ->first();
        // echo 'Data Submitted.';
        // print_r($request->input());
        // die();
        if($request->get('button_action_DetailEntry1') == 'insert') {
            $DeductionAdjustmentDetail = new DeductionAdjustmentDetail;                
            $DeductionAdjustmentDetail->PGDADCompanyId          =   $this->gCompanyId;            
            $DeductionAdjustmentDetail->PGDADLocationId         =   $GeneralInfo->EMGIHLocationId;            
            $DeductionAdjustmentDetail->PGDADEmployeeId         =   $request->PGDADEmployeeId;            
            $DeductionAdjustmentDetail->PGDADFromDate           =   $request->PGDADFromDate;
            $DeductionAdjustmentDetail->PGDADToDate             =   $request->PGDADToDate;
            $DeductionAdjustmentDetail->PGDADStatusId           =   1000;  
            $DeductionAdjustmentDetail->PGDADLastCreated        =   Carbon::now();
        }elseif($request->get('button_action_DetailEntry1') == 'update'){
            $DeductionAdjustmentDetail = DeductionAdjustmentDetail::find($request->get('PGDADUniqueId'));
        }
        $DeductionAdjustmentDetail->PGDADIncDedId               =   $request->PGDADIncDedId;         
        $DeductionAdjustmentDetail->PGDADDesc1                  =   $DeductionTypeDesc->PMDTHDesc1;  
        $DeductionAdjustmentDetail->PGDADGrossDeduction            =   $request->PGDADGrossDeduction;
        $DeductionAdjustmentDetail->PGDADNetDeduction           =   $request->PGDADNetDeduction;
        $DeductionAdjustmentDetail->PGDADUser                   =   Auth::user()->name;
        $DeductionAdjustmentDetail->PGDADLastUpdated            =   Carbon::now();
        $DeductionAdjustmentDetail->save(); 
        if($request->get('button_action_DetailEntry1') == 'insert') {
            $UniqueId = $DeductionAdjustmentDetail->PGDADUniqueId; 
        }elseif($request->get('button_action_DetailEntry1') == 'update'){
            $UniqueId = $request->get('PGDADUniqueId');
        }
        
        return $UniqueId; 
    }
    public function DeleteRecordDeductionAdjustmentDetailTrait($request){
        $UniqueId = $request->input('id');
        $DeductionAdjustmentDetail = DeductionAdjustmentDetail::where('PGDADUniqueId', $UniqueId)
        ->get()
        ->first();
        $DeductionAdjustmentDetail->PGDADMarkForDeletion    = $DeductionAdjustmentDetail->PGDADMarkForDeletion == 0 ? 1 : 0;
        $DeductionAdjustmentDetail->PGDADStatusId           = $DeductionAdjustmentDetail->PGDADMarkForDeletion == 0 ? 1000 : 9910;
        $DeductionAdjustmentDetail->PGDADDeletedAt          = $DeductionAdjustmentDetail->PGDADMarkForDeletion == 0 ? NULL : Carbon::now();
        $DeductionAdjustmentDetail->save();
        return;
    }
}
