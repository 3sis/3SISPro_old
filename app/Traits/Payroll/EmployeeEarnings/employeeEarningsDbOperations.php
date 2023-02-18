<?php
namespace app\Traits\Payroll\EmployeeEarnings;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
// Reference Model
use App\Models\Payroll\EmployeeMaster\GeneralInfo;
use App\Models\CommonMasters\GeneralMaster\Company;
use App\Models\CommonMasters\GeographicInfo\Location;
use App\Models\Payroll\EmployeeStatus\Designation;
use App\Models\Payroll\GeneralMaster\Salutation;
use App\Models\Payroll\IncomeDeductionType\IncomeType;
use App\Models\Payroll\IncomeEmployeeMaster\EmployeeMaster;
use App\Models\Payroll\IncomeDeductionType\DeductionType;
// Update Models
use App\Models\Payroll\EmployeeEarnings\MemEmployeeIncome;
Use App\Models\Payroll\EmployeeEarnings\MemEmployeeDeduction;
use App\Models\Payroll\EmployeeEarnings\IncomeMaster;
use App\Models\Payroll\EmployeeEarnings\DeductionMaster;
// PMEE : Payroll Master: Employee Earnings
trait employeeEarningsDbOperations {
    # Landing Page browser
    public function PMEE11BrowserDataTrait(){
        // echo 'Data Submitted at Trait.';
        // return $BrowserDataTable;
        // die();
        return $browserData = GeneralInfo::join('T05901l01', 'GMCOHCompanyId', '=', 'T11101l01.EMGIHCompId')
        ->join('T05901L06', 'GMLMHLocationId', '=', 'T11101l01.EMGIHLocationId')
        ->join('T11903L01', 'ESDEHDesignationId', '=', 'T11101l01.EMGIHDesignationId')
        ->where('T11101l01.EMGIHCompId', $this->gCompanyId)
        ->where('T11101l01.EMGIHMarkForDeletion', 0)
        ->get([            
            'T11101l01.EMGIHEmployeeId',
            'T11101l01.EMGIHFullName',
            'T11101l01.EMGIHGenderId',
            // Company table field
            'T05901l01.GMCOHNickName',
            // Location table field
            'T05901L06.GMLMHDesc1',
            // Designation table field
            'T11903L01.ESDEHDesc1',
            'T11101l01.EEGIHIncomeDefined',
            'T11101l01.EEGIHDeductionDefined',
            'T11101l01.EMGIHUniqueId',
            'T11101l01.EMGIHUser',
            'T11101l01.EMGIHLastUpdated'
            
        ]);
    }
    # Landing Page browser Ends*****
    #-----------------------------------------------------------------------------------------------------------------
    # Edit events - Landing Page Browser
    public function PMEE11FethchEditedDataTrait($request){        
        // Now Update all the Header fields
        $EMGIHUniqueId = $request->input('id');
        $EmployeeMaster = GeneralInfo::find($EMGIHUniqueId);        
        // Get Foreign Keys Description
        $LocationDesc = Location::where('GMLMHLocationId', $EmployeeMaster->EMGIHLocationId)
            ->where('GMLMHCompanyId', $this->gCompanyId)        
            ->get(['GMLMHDesc1'])
            ->first();
        $DesignationDesc = Designation::where('ESDEHDesignationId', $EmployeeMaster->EMGIHDesignationId)
            ->get(['ESDEHDesc1'])
            ->first();
        $SalutationDesc = Salutation::where('GMSLHSalutationId', $EmployeeMaster->EMGIHSalutationId)
            ->get(['GMSLHDesc1'])
            ->first();
        // Get Foreign Keys Description Ends*****
        return $output = array(
            'EMGIHUniqueId'             =>  $EmployeeMaster->EMGIHUniqueId,
            'EMGIHEmployeeId'           =>  $EmployeeMaster->EMGIHEmployeeId,
            'EMGIHFullName'             =>  trim($SalutationDesc->GMSLHDesc1).' '.$EmployeeMaster->EMGIHFullName,
            'DesignationDesc'           =>  $DesignationDesc->ESDEHDesc1,
            'LocationDesc'              =>  $LocationDesc->GMLMHDesc1,
            'EMGIHDateOfJoining'        =>  $EmployeeMaster->EMGIHDateOfJoining,
            'EMGIHUser'                 =>  $EmployeeMaster->EMGIHUser,
            'EMGIHLastCreated'          =>  $EmployeeMaster->EMGIHLastCreated,
            'EMGIHLastUpdated'          =>  $EmployeeMaster->EMGIHLastUpdated
        );
    }
    # Delete Mem Tables
    public function PMEE11DeleteMemTablesTrait($request){        
        // Delete Mem Table
        $loginName = Auth::user()->name;  
        MemEmployeeIncome::where('EEIMDUser', $loginName)
        ->delete();
        MemEmployeeDeduction::where('EEDMDUser', $loginName)
        ->delete();
        return;
    }
    # Append Mem Table Income
    public function UpdateMemTableIncome($request){
        $loginName = Auth::user()->name;
        // Add records from Employee Income table to mem table
        $Master = IncomeMaster::where('EEIMDUniqueIdEmp', $request->id)
        // ->where('EEIMDMarkForDeletion', 0)
        ->where('EEIMDStatusId', '!=' , 9999)
        ->orderBy('EEIMDIncomeIdK')
        ->get();
        $LineNo = 10;
        foreach ($Master as $key => $value) {
            // Get Income Type Description
            $IncomeType = IncomeType::where('PMITHIncomeIdK', $value->EEIMDIncomeIdK)
            ->get(['PMITHDesc1'])
            ->first();            
            MemEmployeeIncome::create([
                'EEIMDUniqueIdEmp'          => $value->EEIMDUniqueIdEmp,
                'EEIMDLineNo'               => $LineNo,
                'EEIMDCompId'               => $value->EEIMDCompId,
                'EEIMDEmployeeId'           => $value->EEIMDEmployeeId,
                'EEIMDIncomeId'             => $value->EEIMDIncomeId,
                'EEIMDIncomeIdK'            => $value->EEIMDIncomeIdK,
                'EEIMDDesc1'                => $IncomeType->PMITHDesc1,
                'EEIMDGrossIncome'          => $value->EEIMDGrossIncome,
                'EEIMDIncomePercent'        => $value->EEIMDIncomePercent,
                'EEIMDPayrollIncome'        => $value->EEIMDPayrollIncome,
                'EEIMDEffectiveFrom'        => $value->EEIMDEffectiveFrom,
                'EEIMDEffectiveTo'          => $value->EEIMDEffectiveTo,
                'PMDTDUser'                 => $loginName,
                'EEIMDStatusId'             => $value->EEIMDStatusId,
                'EEIMDMarkForDeletion'      => $value->EEIMDMarkForDeletion,
                'EEIMDLastCreated'          => $value->EEIMDLastCreated,
                'EEIMDLastUpdated'          => $value->EEIMDLastUpdated,
                'EEIMDDeletedAt'            => $value->EEIMDDeletedAt
            ]);     
            $LineNo++;
        }
    }
    # Append Mem Table Deduction
    public function UpdateMemTableDeduction($request){
        
        $loginName = Auth::user()->name;
        // Add records from Employee Deduction table to mem table
        $Master = DeductionMaster::where('EEDMDUniqueIdEmp', $request->id)
        ->where('EEDMDStatusId', '!=' , 9999)
        ->orderBy('EEDMDDeductionIdK')
        ->get();        
        $LineNo = 10;
       
        if($Master->isEmpty()){
            // Bring Employee Master Record
            $GeneralInfo = GeneralInfo::where('EMGIHUniqueId', $request->id)
            ->where('EMGIHCompId', $this->gCompanyId)
            ->get()
            ->first();
            // echo 'Data Submitted at Trait Shishir Employee.' .$GeneralInfo->EMGIHEmployeeId;
            // die();
            $DeductionType = DeductionType::where('PMDTHRuleId', '!=' ,'')
            ->where('PMDTHRuleId', '!=' ,'Z1000')
            ->where('PMDTHMarkForDeletion', 0)
            ->orderBy('PMDTHDeductionIdK')
            ->get();
            foreach ($DeductionType as $key => $value) {
                MemEmployeeDeduction::create([
                    'EEDMDUniqueIdEmp'          => $request->id,
                    'EEDMDLineNo'               => $LineNo,
                    'EEDMDCompId'               => $this->gCompanyId,
                    'EEDMDEmployeeId'           => $GeneralInfo->EMGIHEmployeeId,
                    'EEDMDDeductionId'          => $value->PMDTHDeductionId,
                    'EEDMDDeductionIdK'         => $value->PMDTHDeductionIdK,
                    'EEDMDDesc1'                => $value->PMDTHDesc1,
                    'EEDMDDeductionRuleId'      => $value->PMDTHRuleId,
                    'EEDMDGrossDeduction'       => 0.00,
                    'EEDMDDeductionPercent'     => 0.00,
                    'EEDMDPayrollDeduction'     => 0.00,
                    'EEDMDEffectiveFrom'        => '2020-01-01',
                    'EEDMDEffectiveTo'          => '9999-12-31',
                    'PMDTDUser'                 => $loginName,
                    'EEDMDStatusId'             => 1000,
                    'EEDMDMarkForDeletion'      => 0,
                    'EEDMDLastCreated'          => Carbon::now(),
                    'EEDMDLastUpdated'          => Carbon::now(),
                    'EEDMDDeletedAt'            => NULL,
                ]);     
                $LineNo++;
            }
        }else{
            foreach ($Master as $key => $value) {
                // Get Deduction Type Description
                $DeductionType = DeductionType::where('PMDTHDeductionIdK', $value->EEDMDDeductionIdK)
                ->get(['PMDTHDesc1'])
                ->first();            
                MemEmployeeDeduction::create([
                    'EEDMDUniqueIdEmp'          => $value->EEDMDUniqueIdEmp,
                    'EEDMDLineNo'               => $LineNo,
                    'EEDMDCompId'               => $value->EEDMDCompId,
                    'EEDMDEmployeeId'           => $value->EEDMDEmployeeId,
                    'EEDMDDeductionId'          => $value->EEDMDDeductionId,
                    'EEDMDDeductionIdK'         => $value->EEDMDDeductionIdK,
                    'EEDMDDesc1'                => $DeductionType->PMDTHDesc1,
                    'EEDMDDeductionRuleId'      => $value->EEDMDDeductionRuleId,
                    'EEDMDGrossDeduction'       => $value->EEDMDGrossDeduction,
                    'EEDMDDeductionPercent'     => $value->EEDMDDeductionPercent,
                    'EEDMDPayrollDeduction'     => $value->EEDMDPayrollDeduction,
                    'EEDMDEffectiveFrom'        => $value->EEDMDEffectiveFrom,
                    'EEDMDEffectiveTo'          => $value->EEDMDEffectiveTo,
                    'PMDTDUser'                 => $loginName,
                    'EEDMDStatusId'             => $value->EEDMDStatusId,
                    'EEDMDMarkForDeletion'      => $value->EEDMDMarkForDeletion,
                    'EEDMDLastCreated'          => $value->EEDMDLastCreated,
                    'EEDMDLastUpdated'          => $value->EEDMDLastUpdated,
                    'EEDMDDeletedAt'            => $value->EEDMDDeletedAt
                ]);     
                $LineNo++;
            }
        }        
    }
    # Edit events - Landing Page Browser Ends*****
    #-----------------------------------------------------------------------------------------------------------------
    # Income Sub Form
    public function PMEE11BrowserSubFormIncomeTrait($request){
        return $browserData = MemEmployeeIncome::get([
            'EEIMDLineNo', 
            'EEIMDIncomeId',
            'EEIMDDesc1',
            'EEIMDPayrollIncome', 
            'EEIMDEffectiveFrom',
            'EEIMDEffectiveTo',
            'EEIMDUser',
            'EEIMDMarkForDeletion',
            'EEIMDUniqueId'
         ]);
    }
    public function PMEE11CheckDuplicateIncomeTrait($request){
        if ($request->button_action_DetailEntry1 == 'insert') {
            # code...
            return $DuplicateFound = MemEmployeeIncome::where('EEIMDUniqueIdEmp', $request->UniqueIdEmpI)
            ->where('EEIMDEmployeeId', $request->EmployeeIdI)
            ->where('EEIMDIncomeId', $request->EEIMDIncomeId)
            ->where('EEIMDEffectiveFrom', $request->EEIMDEffectiveFrom)
            ->where('EEIMDEffectiveTo', $request->EEIMDEffectiveTo)
            ->get(['EEIMDLineNo'])
            ->first();            
        } else {
            # code...
            return $DuplicateFound = MemEmployeeIncome::where('EEIMDUniqueIdEmp', $request->UniqueIdEmpI)
            ->where('EEIMDEmployeeId', $request->EmployeeIdI)
            ->where('EEIMDIncomeId', $request->EEIMDIncomeId)
            ->where('EEIMDEffectiveFrom', $request->EEIMDEffectiveFrom)
            ->where('EEIMDEffectiveTo', $request->EEIMDEffectiveTo)
            ->where('EEIMDUniqueId', '!=' ,$request->EEIMDUniqueId)
            ->get(['EEIMDLineNo'])
            ->first();      
        }
        
    }
    public function PMEE11AddUpdateMemIncomeTrait($request){
        # Update Effectiveto Date for the same Income
        $IncomeRecordFound = MemEmployeeIncome::where('EEIMDUniqueIdEmp', $request->UniqueIdEmpI)
            ->where('EEIMDEmployeeId', $request->EmployeeIdI)
            ->where('EEIMDIncomeId', $request->EEIMDIncomeId)
            ->orderBy('EEIMDEffectiveTo', 'desc')
            ->get()
            ->first();
        if ($IncomeRecordFound != '') {
            $ExpirtyDate = date_create($request->EEIMDEffectiveFrom)->modify('-1 days')->format('Y-m-d');

            MemEmployeeIncome::where('EEIMDUniqueIdEmp', $request->UniqueIdEmpI)
                ->where('EEIMDEmployeeId', $request->EmployeeIdI)
                ->where('EEIMDIncomeId', $request->EEIMDIncomeId)
                ->orderBy('EEIMDEffectiveTo', 'desc')
                ->first()              
                ->update([
                    'EEIMDEffectiveTo' => $ExpirtyDate
                ]);
        }
        # Update Effectiveto Date for the same Income Ends*****

        // Get Income Id Desc
        $IncomeTypeDesc = IncomeType::where('PMITHIncomeId', $request->EEIMDIncomeId)
        ->get(['PMITHDesc1'])
        ->first();
        if($request->get('button_action_DetailEntry1') == 'insert') {
            // Find the last Line No.
            $getLastLineNo = MemEmployeeIncome::where('EEIMDUniqueIdEmp', $request->UniqueIdEmpI)
            ->orderBy('EEIMDLineNo', 'desc')
            ->get(['EEIMDLineNo'])
            ->first();
            if ($getLastLineNo == '') {
                $LastLineNo = 10;
            } else {
                $LastLineNo = (int)$getLastLineNo->EEIMDLineNo + 1;
            }            
            $MemEmployeeIncome = new MemEmployeeIncome;                
            $MemEmployeeIncome->EEIMDUniqueIdEmp        =   $request->UniqueIdEmpI;            
            $MemEmployeeIncome->EEIMDLineNo             =   $LastLineNo;            
            $MemEmployeeIncome->EEIMDCompId             =   $this->gCompanyId;        
            $MemEmployeeIncome->EEIMDEmployeeId         =   $request->EmployeeIdI; 
            $MemEmployeeIncome->EEIMDStatusId           =   1000; 
            $MemEmployeeIncome->EEIMDLastCreated        =   Carbon::now();
        }elseif($request->get('button_action_DetailEntry1') == 'update'){
            $MemEmployeeIncome = MemEmployeeIncome::find($request->get('EEIMDUniqueId'));
            $MemEmployeeIncome->EEIMDStatusId           =   1100; 

        } 
        $MemEmployeeIncome->EEIMDIncomeId                   =   $request->EEIMDIncomeId;
        $MemEmployeeIncome->EEIMDIncomeIdK                  =   'I'.$request->EEIMDIncomeId;
        $MemEmployeeIncome->EEIMDDesc1                      =   $IncomeTypeDesc->PMITHDesc1;
        $MemEmployeeIncome->EEIMDGrossIncome                =   $request->EEIMDGrossIncome;
        $MemEmployeeIncome->EEIMDIncomePercent              =   $request->EEIMDIncomePercent;
        $MemEmployeeIncome->EEIMDPayrollIncome              =   $request->EEIMDPayrollIncome;
        $MemEmployeeIncome->EEIMDEffectiveFrom              =   $request->EEIMDEffectiveFrom;
        $MemEmployeeIncome->EEIMDEffectiveTo                =   $request->EEIMDEffectiveTo;
        $MemEmployeeIncome->EEIMDUser                       =   Auth::user()->name;
        $MemEmployeeIncome->EEIMDLastUpdated                =   Carbon::now();
        $MemEmployeeIncome->save(); 
        if($request->get('button_action_DetailEntry1') == 'insert') {
            $UniqueId = $MemEmployeeIncome->EEIMDUniqueId; 
        }elseif($request->get('button_action_DetailEntry1') == 'update'){
            $UniqueId = $request->get('EEIMDUniqueId');
        }
        
        return $UniqueId; 
    }
    public function PMEE11DeleteMemRecordIncomeTrait($request){
        $UniqueId = $request->input('id');
        $MemEmployeeIncome = MemEmployeeIncome::where('EEIMDUniqueId', $UniqueId)
        ->get()
        ->first();
        $MemEmployeeIncome->EEIMDMarkForDeletion    = $MemEmployeeIncome->EEIMDMarkForDeletion == 0 ? 1 : 0;
        $MemEmployeeIncome->EEIMDStatusId           = $MemEmployeeIncome->EEIMDMarkForDeletion == 0 ? 1000 : 9910;
        $MemEmployeeIncome->EEIMDDeletedAt          = $MemEmployeeIncome->EEIMDMarkForDeletion == 0 ? NULL : Carbon::now();
        $MemEmployeeIncome->save();
        return;
    }
    public function PMEE11FethchEditedDataIncomeTrait($request){        
        $EEIMDUniqueId = $request->input('id');
        $MemEmployeeIncome = MemEmployeeIncome::find($EEIMDUniqueId);
        return $output = array(
            'EEIMDUniqueId'             =>  $MemEmployeeIncome->EEIMDUniqueId,
            'UniqueIdEmpI'              =>  $MemEmployeeIncome->EEIMDUniqueIdEmp,
            'EmployeeIdI'               =>  $MemEmployeeIncome->EEIMDEmployeeId,
            'EEIMDIncomeId'             =>  $MemEmployeeIncome->EEIMDIncomeId,
            'EEIMDIncomeIdK'            =>  $MemEmployeeIncome->EEIMDIncomeIdK,
            
            'EEIMDGrossIncome'          =>  $MemEmployeeIncome->EEIMDGrossIncome,
            'EEIMDIncomePercent'        =>  $MemEmployeeIncome->EEIMDIncomePercent,
            'EEIMDPayrollIncome'        =>  $MemEmployeeIncome->EEIMDPayrollIncome,

            'EEIMDEffectiveFrom'        =>  $MemEmployeeIncome->EEIMDEffectiveFrom,
            'EEIMDEffectiveTo'          =>  $MemEmployeeIncome->EEIMDEffectiveTo,
            
            'EEIMDUser'                 =>  $MemEmployeeIncome->EEIMDUser
        );
    }
    # Income Sub Form Ends*****
    #-----------------------------------------------------------------------------------------------------------------
    # Deduction Sub Form
    public function PMEE11BrowserSubFormDeductionTrait($request){
        return $browserData = MemEmployeeDeduction::get([
            'EEDMDLineNo', 
            'EEDMDDeductionId',
            'EEDMDDesc1',
            'EEDMDPayrollDeduction', 
            'EEDMDEffectiveFrom',
            'EEDMDEffectiveTo',
            'EEDMDUser',
            'EEDMDMarkForDeletion',
            'EEDMDUniqueId',
            'EEDMDDeductionRuleId'
         ]);
    }  
    public function PMEE11CheckDuplicateTraitDeduction($request){        
        if ($request->button_action_DetailEntry2 == 'insert') {
            # code...
            return $DuplicateFound = MemEmployeeDeduction::where('EEDMDUniqueIdEmp', $request->UniqueIdEmpD)
            ->where('EEDMDEmployeeId', $request->EmployeeIdD)
            ->where('EEDMDDeductionId', $request->EEDMDDeductionId)
            ->where('EEDMDEffectiveFrom', $request->EEDMDEffectiveFrom)
            ->where('EEDMDEffectiveTo', $request->EEDMDEffectiveTo)
            ->get(['EEDMDLineNo'])
            ->first();            
        } else {
            # code...
            return $DuplicateFound = MemEmployeeDeduction::where('EEDMDUniqueIdEmp', $request->UniqueIdEmpD)
            ->where('EEDMDEmployeeId', $request->EmployeeIdD)
            ->where('EEDMDDeductionId', $request->EEDMDDeductionId)
            ->where('EEDMDEffectiveFrom', $request->EEDMDEffectiveFrom)
            ->where('EEDMDEffectiveTo', $request->EEDMDEffectiveTo)
            ->where('EEDMDUniqueId', '!=' ,$request->EEDMDUniqueId)
            ->get(['EEDMDLineNo'])
            ->first();      
        }
        
    }
    public function PMEE11AddUpdateMemDeductionTrait($request){
        
        // Get Deduction Id Desc
        $DeductionTypeDesc = DeductionType::where('PMDTHDeductionId', $request->EEDMDDeductionId)
        ->get([
            'PMDTHDesc1',
            'PMDTHRuleId'
            ])
        ->first();
        if($request->get('button_action_DetailEntry2') == 'insert') {
            // Find the last Line No.
            $getLastLineNo = MemEmployeeDeduction::where('EEDMDUniqueIdEmp', $request->UniqueIdEmpD)
            ->orderBy('EEDMDLineNo', 'desc')
            ->get([
                'EEDMDLineNo'])
            ->first();
            if ($getLastLineNo == '') {
                $LastLineNo = 10;
            } else {
                $LastLineNo = (int)$getLastLineNo->EEDMDLineNo + 1;
            }            
            $MemEmployeeDeduction = new MemEmployeeDeduction;                
            $MemEmployeeDeduction->EEDMDUniqueIdEmp        =   $request->UniqueIdEmpD;            
            $MemEmployeeDeduction->EEDMDLineNo             =   $LastLineNo;            
            $MemEmployeeDeduction->EEDMDCompId             =   $this->gCompanyId;        
            $MemEmployeeDeduction->EEDMDEmployeeId         =   $request->EmployeeIdD; 
            $MemEmployeeDeduction->EEDMDStatusId           =   1000; 
            $MemEmployeeDeduction->EEDMDLastCreated        =   Carbon::now();
        }elseif($request->get('button_action_DetailEntry2') == 'update'){
            $MemEmployeeDeduction = MemEmployeeDeduction::find($request->get('EEDMDUniqueId'));
            $MemEmployeeDeduction->EEDMDStatusId           =   1100; 

        } 
        $MemEmployeeDeduction->EEDMDDeductionId         =   $request->EEDMDDeductionId;
        $MemEmployeeDeduction->EEDMDDeductionIdK        =   'D'.$request->EEDMDDeductionId;
        $MemEmployeeDeduction->EEDMDDesc1               =   $DeductionTypeDesc->PMDTHDesc1;
        $MemEmployeeDeduction->EEDMDDeductionRuleId     =   $DeductionTypeDesc->PMDTHRuleId;
        $MemEmployeeDeduction->EEDMDGrossDeduction      =   $request->EEDMDGrossDeduction;
        $MemEmployeeDeduction->EEDMDDeductionPercent    =   $request->EEDMDDeductionPercent;
        $MemEmployeeDeduction->EEDMDPayrollDeduction    =   $request->EEDMDPayrollDeduction;
        $MemEmployeeDeduction->EEDMDEffectiveFrom       =   $request->EEDMDEffectiveFrom;
        $MemEmployeeDeduction->EEDMDEffectiveTo            =   $request->EEDMDEffectiveTo;
        $MemEmployeeDeduction->EEDMDUser                =   Auth::user()->name;
        $MemEmployeeDeduction->EEDMDLastUpdated         =   Carbon::now();
        $MemEmployeeDeduction->save(); 
        if($request->get('button_action_DetailEntry2') == 'insert') {
            $UniqueId = $MemEmployeeDeduction->EEDMDUniqueId; 
        }elseif($request->get('button_action_DetailEntry2') == 'update'){
            $UniqueId = $request->get('EEDMDUniqueId');
        }
        
        return $UniqueId; 
    }
    public function PMEE11DeleteMemRecordDeductionTrait($request){
        $UniqueId = $request->input('id');
        $MemEmployeeDeduction = MemEmployeeDeduction::where('EEDMDUniqueId', $UniqueId)
        ->get()
        ->first();
        $MemEmployeeDeduction->EEDMDMarkForDeletion    = $MemEmployeeDeduction->EEDMDMarkForDeletion == 0 ? 1 : 0;
        $MemEmployeeDeduction->EEDMDStatusId           = $MemEmployeeDeduction->EEDMDMarkForDeletion == 0 ? 1000 : 9910;
        $MemEmployeeDeduction->EEDMDDeletedAt          = $MemEmployeeDeduction->EEDMDMarkForDeletion == 0 ? NULL : Carbon::now();
        $MemEmployeeDeduction->save();
        return;
    }
    public function PMEE11FethchEditedDataDeductionTrait($request){        
        $EEDMDUniqueId = $request->input('id');
        $MemEmployeeDeduction = MemEmployeeDeduction::find($EEDMDUniqueId);
        return $output = array(
            'EEDMDUniqueId'             =>  $MemEmployeeDeduction->EEDMDUniqueId,
            'UniqueIdEmpD'              =>  $MemEmployeeDeduction->EEDMDUniqueIdEmp,
            'EmployeeIdD'               =>  $MemEmployeeDeduction->EEDMDEmployeeId,
            'EEDMDDeductionId'             =>  $MemEmployeeDeduction->EEDMDDeductionId,
            'EEDMDDeductionIdK'            =>  $MemEmployeeDeduction->EEDMDDeductionIdK,
            'EEDMDDeductionRuleId'          =>  $MemEmployeeDeduction->EEDMDDeductionRuleId,
            
            'EEDMDGrossDeduction'          =>  $MemEmployeeDeduction->EEDMDGrossDeduction,
            'EEDMDDeductionPercent'     =>  $MemEmployeeDeduction->EEDMDDeductionPercent,
            'EEDMDPayrollDeduction'     =>  $MemEmployeeDeduction->EEDMDPayrollDeduction,

            'EEDMDEffectiveFrom'        =>  $MemEmployeeDeduction->EEDMDEffectiveFrom,
            'EEDMDEffectiveTo'          =>  $MemEmployeeDeduction->EEDMDEffectiveTo,
            
            'EEDMDUser'                 =>  $MemEmployeeDeduction->EEDMDUser
        );
    }
    # Deduction Sub Form Ends*****
    #-----------------------------------------------------------------------------------------------------------------
    // Update Tables on Final Save
    function PMEE11AddUpdateHeaderDetailTrait($request){        
        // Move data from Mem Table to Actual Table : Income
        $this->moveSubFormDataIncome($request);
        // Move data from Mem Table to Actual Table : Deduction
        $this->moveSubFormDataDeduction($request);
        // Move data from Mem Table to Actual Table : Deduction Ends*****
    }
    public function moveSubFormDataIncome($request){
        //Delete Actual Table Data : Income
        $IncomeMaster = IncomeMaster::where('EEIMDUniqueIdEmp', $request->EMGIHUniqueId)
        ->where('EEIMDCompId', $this->gCompanyId)
        ->where('EEIMDStatusId', '!=' , 9999)
        ->get();
        foreach ($IncomeMaster as $value) {
            $value->EEIMDMarkForDeletion    = 1;
            $value->EEIMDUser               = Auth::user()->name;
            $value->EEIMDStatusId           = 9999;
            $value->EEIMDDeletedAt          = Carbon::now();
            $value->save();
        };
        // Append from Income Mem to Actual
        $IncomeDefined = 0;
        $MemEmployeeIncome = MemEmployeeIncome::orderBy('EEIMDLineNo')
        ->get();
        foreach ($MemEmployeeIncome as $key => $value) {
            if ($IncomeDefined == 0) {
                $this->updateEmployeeMaster($request->EMGIHUniqueId);
                $IncomeDefined = 1;
            }
            $IncomeType = IncomeType::where('PMITHIncomeIdK', $value->EEIMDIncomeIdK)
            ->get(['PMITHRuleId'])
            ->first();
            IncomeMaster::create([
                'EEIMDUniqueIdEmp'      => $value->EEIMDUniqueIdEmp,
                'EEIMDCompId'           => $value->EEIMDCompId,
                'EEIMDEmployeeId'       => $value->EEIMDEmployeeId,
                'EEIMDIncomeId'         => $value->EEIMDIncomeId,
                'EEIMDIncomeIdK'        => $value->EEIMDIncomeIdK,
                'EEIMDIncomeRuleId'     => $IncomeType->PMITHRuleId,
                'EEIMDGrossIncome'      => $value->EEIMDGrossIncome,
                'EEIMDIncomePercent'    => $value->EEIMDIncomePercent,
                'EEIMDPayrollIncome'    => $value->EEIMDPayrollIncome,
                'EEIMDEffectiveFrom'    => $value->EEIMDEffectiveFrom,
                'EEIMDEffectiveTo'      => $value->EEIMDEffectiveTo,
                'EEIMDMarkForDeletion'  => $value->EEIMDMarkForDeletion,
                'EEIMDUser'             => Auth::user()->name,
                'EEIMDStatusId'         => $value->EEIMDStatusId,
                'EEIMDLastCreated'      => $value->EEIMDLastCreated,
                'EEIMDLastUpdated'      => $value->EEIMDLastUpdated,
                'EEIMDDeletedAt'        => $value->EEIMDDeletedAt,
            ]);
        }
    }
    function updateEmployeeMaster($UniqueId) {
        GeneralInfo::where('EMGIHUniqueId', $UniqueId)
        ->first()              
        ->update([
            'EEGIHIncomeDefined' => 1
        ]);
    }
    public function moveSubFormDataDeduction($request){
        //Delete Actual Table Data : Deduction
        $DeductionMaster = DeductionMaster::where('EEDMDUniqueIdEmp', $request->EMGIHUniqueId)
        ->where('EEDMDCompId', $this->gCompanyId)
        ->where('EEDMDStatusId', '!=' , 9999)
        ->get();
        foreach ($DeductionMaster as $value) {
            $value->EEDMDMarkForDeletion    = 1;
            $value->EEDMDUser               = Auth::user()->name;
            $value->EEDMDStatusId           = 9999;
            $value->EEDMDDeletedAt          = Carbon::now();
            $value->save();
        };
        // Append from Deduction Mem to Actual
        $MemEmployeeDeduction = MemEmployeeDeduction::orderBy('EEDMDLineNo')
        ->get();
        foreach ($MemEmployeeDeduction as $key => $value) {
            
            DeductionMaster::create([
                'EEDMDUniqueIdEmp'          => $value->EEDMDUniqueIdEmp,
                'EEDMDCompId'               => $value->EEDMDCompId,
                'EEDMDEmployeeId'           => $value->EEDMDEmployeeId,
                'EEDMDDeductionId'          => $value->EEDMDDeductionId,
                'EEDMDDeductionIdK'         => $value->EEDMDDeductionIdK,
                'EEDMDDeductionRuleId'      => $value->EEDMDDeductionRuleId,
                'EEDMDGrossDeduction'       => $value->EEDMDGrossDeduction,
                'EEDMDDeductionPercent'     => $value->EEDMDDeductionPercent,
                'EEDMDPayrollDeduction'     => $value->EEDMDPayrollDeduction,
                'EEDMDEffectiveFrom'        => $value->EEDMDEffectiveFrom,
                'EEDMDEffectiveTo'          => $value->EEDMDEffectiveTo,
                'EEDMDMarkForDeletion'      => $value->EEDMDMarkForDeletion,
                'EEDMDUser'                 => Auth::user()->name,
                'EEDMDStatusId'             => $value->EEDMDStatusId,
                'EEDMDLastCreated'          => $value->EEDMDLastCreated,
                'EEDMDLastUpdated'          => $value->EEDMDLastUpdated,
                'EEDMDDeletedAt'            => $value->EEDMDDeletedAt,
            ]);
            // echo 'Status Id :'.$value->EEDMDStatusId;
            // die();
        }
    }
    // Update Tables on Final Save Ends*****
}
//*************************************** End of Program
// echo 'Data Submitted at Trait.';
// return $request->input(); or
// echo 'Data Submitted at Trait Shishir Income.' .$request->id;
// echo 'Last Line No. : ' .$LastLineNo;
// return $EmployeeMaster;
// die();

// if ($DuplicateFound == '') {
//     echo '     Last Line No. xxx : ' .$DuplicateFound;
// }
// else{
//     echo 'Last Line No. : ' .$DuplicateFound->EEIMDLineNo;
// }
// die();