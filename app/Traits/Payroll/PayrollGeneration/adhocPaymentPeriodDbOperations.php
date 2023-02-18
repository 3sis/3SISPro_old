<?php
namespace App\Traits\Payroll\PayrollGeneration;
use App\Models\Payroll\PayrollGeneration\MemSalaryRevisionXL;
use App\Models\Payroll\PayrollGeneration\IncomeTypeSalarySlashF4;
use App\Models\Payroll\PayrollGeneration\AdhocPaymentPeriod;
use App\Models\Payroll\IncomeDeductionType\IncomeType;
use App\Models\Payroll\EmployeeEarnings\IncomeMaster;
use App\Models\Payroll\EmployeeMaster\GeneralInfo;
Use App\Models\CommonMasters\GeographicInfo\Location;
use App\Models\SystemsMaster\PeriodMaster;

use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
trait adhocPaymentPeriodDbOperations
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
            $IncomeType = IncomeType::where('PMITHMarkForDeletion', 0)
            ->get();
            foreach ($IncomeType as $key => $value) {
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
        $AdhocPaymentPeriod = AdhocPaymentPeriod::where('PGAIDCompanyId', $this->gCompanyId)
        ->where('PGAIDUser', $loginName)
        ->where('PGAIDMarkForDeletion', '!=' , 1)
        ->get();
        foreach ($AdhocPaymentPeriod as $value) {
            $value->PGAIDStatusId           = 9999;
            $value->PGAIDMarkForDeletion    = 1;
            $value->PGAIDUser               = $loginName;
            $value->PGAIDDeletedAt          = Carbon::now();
            $value->save();
        };
        // Append from Income Mem to Actual
        $MemSalaryRevisionXL = MemSalaryRevisionXL::orderBy('PGSRHEmployeeId')
        ->where('PGSRHSelect', '=' , 1)
        ->get();
        $IncomeTypeSalarySlashF4 = IncomeTypeSalarySlashF4::where('PMSSHSelect', '=' , 1)
        ->get();
        foreach ($IncomeTypeSalarySlashF4 as $key => $value) {
            $this->UpdateAdhocPaymentPeriodActual($request,$value,$MemSalaryRevisionXL);
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

    public function UpdateAdhocPaymentPeriodActual($request,$value,$MemSalaryRevisionXL){
        // echo 'Data Submitted.';
        // print_r($request->input());
        // die();
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
                AdhocPaymentPeriod::create([
                    'PGAIDCompanyId'            => $SalaryRevisionMem->PGSRHCompanyId,
                    'PGAIDFiscalYear'           => $request->PGAIDFiscalYear,
                    'PGAIDPeriodId'             => $request->PGAIDPeriodId,
                    'PGAIDLocationId'           =>  $employeeMaster->EMGIHLocationId,
                    'PGAIDEmployeeId'           =>  $SalaryRevisionMem->PGSRHEmployeeId,
                    'PGAIDIncDedId'             =>  $value->PMSSHIncomeId,
                    'PGAIDDesc1'                =>  $value->PMSSHDesc1,
                    'PGAIDGrossAmount'          =>  $IncomeMaster->EEIMDPayrollIncome,

                    'PGAIDGrossPayment'         =>  $SalaryRevisionMem->PGSRHRevisedAmt,
                    'PGAIDFromDate'             =>  $SalaryRevisionMem->PGSRHEffectiveFrom,
                    'PGAIDToDate'               =>  $SalaryRevisionMem->PGSRHEffectiveTo,
                
                    'PGAIDMarkForDeletion'      => 0,
                    'PGAIDUser'                 => Auth::user()->name,
                    'PGAIDStatusId'             => 1000,
                    'PGAIDLastCreated'          => Carbon::now(),
                    'PGAIDLastUpdated'          => Carbon::now()
                ]);
            }
        }
    }

    public function BrowserDetailDataTrait($request) 
    { 
        return $browserData = AdhocPaymentPeriod::leftjoin('T11101l01', 'EMGIHEmployeeId', '=', 'T11125L0411.PGAIDEmployeeId')
        ->leftjoin('T05901L06', 'GMLMHLocationId', '=', 'T11125L0411.PGAIDLocationId')
        ->where('T11125L0411.PGAIDCompanyId', $this->gCompanyId)
        ->get([
            'T11125L0411.PGAIDUniqueId',
            'T11125L0411.PGAIDFiscalYear',
            'T11125L0411.PGAIDPeriodId',
            'T11125L0411.PGAIDLocationId',
            'T05901L06.GMLMHDesc1',
            'T11125L0411.PGAIDEmployeeId',
            'T11101l01.EMGIHFullName',
            'T11125L0411.PGAIDIncDedId',
            'T11125L0411.PGAIDDesc1',
            'T11125L0411.PGAIDGrossAmount',
            'T11125L0411.PGAIDGrossPayment',
            'T11125L0411.PGAIDFromDate',
            'T11125L0411.PGAIDToDate',
            'T11125L0411.PGAIDStatusId',
            'T11125L0411.PGAIDMarkForDeletion',
        ]);
    }
    public function FethchEditedDetailDataTrait($request){  
        
        $PGAIDUniqueId = $request->input('id');
        $AdhocPaymentPeriodDetail = AdhocPaymentPeriod::find($PGAIDUniqueId);
        $Location = Location::where('GMLMHCompanyId', $this->gCompanyId)
        ->where('GMLMHLocationId', $AdhocPaymentPeriodDetail->PGAIDLocationId)
        ->get(['GMLMHDesc1'])
        ->first();
        $PeriodMaster = PeriodMaster::where('FYPMHPeriodId', $AdhocPaymentPeriodDetail->PGAIDPeriodId)
        ->get(['FYPMHDesc1'])
        ->first();
        return $output = array(
            'PGAIDUniqueId'                 =>  $AdhocPaymentPeriodDetail->PGAIDUniqueId,
            'PGAIDFiscalYear'               =>  $AdhocPaymentPeriodDetail->PGAIDFiscalYear,
            'PGAIDPeriodId'                 =>  $AdhocPaymentPeriodDetail->PGAIDPeriodId,
            'FYFYHCurrentPeriodDesc'        =>  $PeriodMaster->FYPMHDesc1,
            'PGAIDLocationId'               =>  $AdhocPaymentPeriodDetail->PGAIDLocationId,
            'locationDesc'                  =>  $Location->GMLMHDesc1,
            'PGAIDEmployeeId'               =>  $AdhocPaymentPeriodDetail->PGAIDEmployeeId,
            'PGAIDIncDedId'                 =>  $AdhocPaymentPeriodDetail->PGAIDIncDedId,
            'PGAIDDesc1'                    =>  $AdhocPaymentPeriodDetail->PGAIDDesc1,
            
            'PGAIDGrossAmount'              =>  $AdhocPaymentPeriodDetail->PGAIDGrossAmount,

            'PGAIDGrossPayment'             =>  $AdhocPaymentPeriodDetail->PGAIDGrossPayment,
            'PGAIDFromDate'                 =>  $AdhocPaymentPeriodDetail->PGAIDFromDate,
            'PGAIDToDate'                   =>  $AdhocPaymentPeriodDetail->PGAIDToDate,
            'PGAIDUser'                     =>  $AdhocPaymentPeriodDetail->PGAIDUser
        );
    }
    public function CheckDuplicateIncomeTrait($request){
        if ($request->button_action_DetailEntry1 == 'insert') {
            # code...
            return $DuplicateFound = AdhocPaymentPeriod::where('PGAIDEmployeeId', $request->PGAIDEmployeeId)
            ->where('PGAIDIncDedId', $request->PGAIDIncDedId)
            ->get(['PGAIDIncDedId'])
            ->first();            
        } else {
            # code...
            return $DuplicateFound = AdhocPaymentPeriod::where('PGAIDEmployeeId', $request->PGAIDEmployeeId)
            ->where('PGAIDIncDedId', $request->PGAIDIncDedId)
            ->where('PGAIDUniqueId', '!=' ,$request->PGAIDUniqueId)
            ->get(['PGAIDIncDedId'])
            ->first();      
        }
        
    }
    public function AddUpdateAdhocPaymentPeriodTrait($request){
        // Get Income Id Desc
        $IncomeTypeDesc = IncomeType::where('PMITHIncomeId', $request->PGAIDIncDedId)
        ->get(['PMITHDesc1'])
        ->first();
        $GeneralInfo = GeneralInfo::where('EMGIHCompId', $this->gCompanyId)
        ->where('EMGIHEmployeeId', $request->PGAIDEmployeeId)
        ->get(['EMGIHLocationId'])
        ->first();

        if($request->get('button_action_DetailEntry1') == 'insert') {
            $AdhocPaymentPeriodDetail = new AdhocPaymentPeriod;                 
            $AdhocPaymentPeriodDetail->PGAIDCompanyId          =   $this->gCompanyId;            
            $AdhocPaymentPeriodDetail->PGAIDFiscalYear         =   $request->PGAIDFiscalYear;            
            $AdhocPaymentPeriodDetail->PGAIDPeriodId           =   $request->PGAIDPeriodId;            
            $AdhocPaymentPeriodDetail->PGAIDLocationId         =   $GeneralInfo->EMGIHLocationId;            
            $AdhocPaymentPeriodDetail->PGAIDEmployeeId         =   $request->PGAIDEmployeeId;            
            $AdhocPaymentPeriodDetail->PGAIDFromDate           =   $request->PGAIDFromDate;
            $AdhocPaymentPeriodDetail->PGAIDToDate             =   $request->PGAIDToDate;
            $AdhocPaymentPeriodDetail->PGAIDStatusId           =   1000;  
            $AdhocPaymentPeriodDetail->PGAIDLastCreated        =   Carbon::now();
        }elseif($request->get('button_action_DetailEntry1') == 'update'){
            $AdhocPaymentPeriodDetail = AdhocPaymentPeriod::find($request->get('PGAIDUniqueId'));
        }
        $AdhocPaymentPeriodDetail->PGAIDIncDedId               =   $request->PGAIDIncDedId;         
        $AdhocPaymentPeriodDetail->PGAIDDesc1                  =   $IncomeTypeDesc->PMITHDesc1;  
        $AdhocPaymentPeriodDetail->PGAIDGrossAmount            =   0;
        $AdhocPaymentPeriodDetail->PGAIDGrossPayment           =   $request->PGAIDGrossPayment;
        $AdhocPaymentPeriodDetail->PGAIDUser                   =   Auth::user()->name;
        $AdhocPaymentPeriodDetail->PGAIDLastUpdated            =   Carbon::now();
        $AdhocPaymentPeriodDetail->save(); 
        if($request->get('button_action_DetailEntry1') == 'insert') {
            $UniqueId = $AdhocPaymentPeriodDetail->PGAIDUniqueId; 
        }elseif($request->get('button_action_DetailEntry1') == 'update'){
            $UniqueId = $request->get('PGAIDUniqueId');
        }
        
        return $UniqueId; 
    }
    public function DeleteRecordAdhocPaymentPeriodTrait($request){
        $UniqueId = $request->input('id');
        $AdhocPaymentPeriodDetail = AdhocPaymentPeriod::where('PGAIDUniqueId', $UniqueId)
        ->get()
        ->first();
        $AdhocPaymentPeriodDetail->PGAIDMarkForDeletion    = $AdhocPaymentPeriodDetail->PGAIDMarkForDeletion == 0 ? 1 : 0;
        $AdhocPaymentPeriodDetail->PGAIDStatusId           = $AdhocPaymentPeriodDetail->PGAIDMarkForDeletion == 0 ? 1000 : 9910;
        $AdhocPaymentPeriodDetail->PGAIDDeletedAt          = $AdhocPaymentPeriodDetail->PGAIDMarkForDeletion == 0 ? NULL : Carbon::now();
        $AdhocPaymentPeriodDetail->save();
        return;
    }
}
