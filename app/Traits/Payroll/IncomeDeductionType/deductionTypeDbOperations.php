<?php
namespace app\Traits\Payroll\IncomeDeductionType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\IncomeDeductionType\DeductionType;
use App\Models\Payroll\IncomeDeductionType\PeriodicIncDed;
use App\Models\Payroll\IncomeDeductionType\IncomeType;
use App\Models\Payroll\IncomeDeductionType\MemIncomeType;
use App\Models\Payroll\IncomeDeductionType\IncDependentDed;
// Deduction Type Master
// PMDTH11 : Deduction Type of Payrall
trait deductionTypeDbOperations { 
    public function PMDTH11BrowserDataTrait() 
    { 
        return $browserData = DeductionType::leftjoin('T00903l04', 'T00903l04.PMPCHCycleId', '=', 'T11906L02.PMDTHDeductionCycle')
        ->leftjoin('T00903l03', 'T00903l03.PMRDHRuleId', '=', 'T11906L02.PMDTHRuleId')
        ->leftjoin('T00905L01', 'T00905L01.RSRSHRoundingId', '=', 'T11906L02.PMDTHRoundingStrategy')
        ->where('PMDTHMarkForDeletion', 0)
        ->get([
            'T11906L02.PMDTHUniqueId',
            'T11906L02.PMDTHDeductionId',
            'T11906L02.PMDTHDesc1',
            'T00903l03.PMRDHDesc1',
            't00903l04.PMPCHDesc1',
            'T11906L02.PMDTHPrintingSeq',
            'T00905L01.RSRSHDesc1',
            'T11906L02.PMDTHIsIncomeDependent'
        ]);
    }    
    public function PMDTH11AddUpdateTrait($request)
    {         
        if($request->get('button_action') == 'insert') {
        $DeductionType = new DeductionType;                
        $DeductionType->PMDTHDeductionId            =   $request->PMDTHDeductionId;            
        $DeductionType->PMDTHDeductionIdK           =   $request->PMDTHDeductionIdK;            
        $DeductionType->PMDTHLastCreated            =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
        $DeductionType = DeductionType::find($request->get('PMDTHUniqueId'));
        } 
        $DeductionType->PMDTHDesc1                  =   $request->PMDTHDesc1;
        $DeductionType->PMDTHDesc2                  =   $request->PMDTHDesc2;

        $DeductionType->PMDTHApplicableFor          =   $request->genderSpecificId;        
        $DeductionType->PMDTHIsTaxExempted          =   $request->PMDTHIsTaxExempted;
        $DeductionType->PMDTHIsThisLoanLine         =   $request->PMDTHIsThisLoanLine;
        $DeductionType->PMDTHShowInTaxList          =   $request->PMDTHShowInTaxList;
        $DeductionType->PMDTHIsIncomeDependent      =   $request->PMDTHIsIncomeDependent;
        $DeductionType->PMDTHDedStrategy            =   $request->deductionStrategyId;
        $DeductionType->PMDTHDedStrategyDesc        =   $request->deductionStrategyId == "P" ? 'This Period Only' : 'Cumulative';
        
        $DeductionType->PMDTHDeductionCycle         =   $request->deductionCycleId;
        // Function to Update Deduction in Deduction Periodic Detail Table
        $this->PMDTH11PeriodicDetailTableTrait($request);        
        $DeductionType->PMDTHDedPercent             =   0.00;
        $DeductionType->PMDTHRuleId                 =   $request->ruleDefId == '- Select Rule -' ? 'Z1000' : $request->ruleDefId;
        $DeductionType->PMDTHPrintingSeq            =   $request->PMDTHPrintingSeq;
        $DeductionType->PMDTHRoundingStrategy       =   $request->roundingId;
        $DeductionType->PMDTHBiElementId            =   $request->biDescId == '-- BI Code --' ? NULL : $request->biDescId;
        
        $DeductionType->PMDTHMarkForDeletion        =   0;
        $DeductionType->PMDTHUser                   =   Auth::user()->name;
        $DeductionType->PMDTHLastUpdated            =   Carbon::now();
        $DeductionType->save();

        if($request->get('button_action') == 'insert') {
            $UniqueId = $DeductionType->PMDTHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('PMDTHUniqueId');
        }
        // Now Update Detail Table : Income Dependent Deduction
        // Delete Records for this Deduction Type first 
        IncDependentDed::where('PMDTDDeductionIdK', $request->PMDTHDeductionIdK)->delete();
        if ($request->PMDTHIsIncomeDependent == 1) {
            $this->PMDTH11AppendIncomeDependentTableTrait($request, $UniqueId); 
        }
        return $UniqueId; 
    }     
    public function PMDTH11FethchEditedDataTrait($request)
    {
        // Now Update all the Header fields
        $PMDTHUniqueId = $request->input('id');
        // Insert Records in Sub Form Mem Table
        $this->PMDTH11AppendMemTableEditModeTrait($PMDTHUniqueId);
        $DeductionType = DeductionType::find($PMDTHUniqueId);
        return $output = array(
            'PMDTHUniqueId'             =>  $DeductionType->PMDTHUniqueId,
            'PMDTHDeductionId'          =>  $DeductionType->PMDTHDeductionId,
            'PMDTHDeductionIdK'         =>  $DeductionType->PMDTHDeductionIdK,
            'PMDTHDesc1'                =>  $DeductionType->PMDTHDesc1,
            'PMDTHDesc2'                =>  $DeductionType->PMDTHDesc2,

            'PMDTHApplicableFor'        =>  $DeductionType->PMDTHApplicableFor,
            'PMDTHIsTaxExempted'        =>  $DeductionType->PMDTHIsTaxExempted,
            'PMDTHIsThisLoanLine'       =>  $DeductionType->PMDTHIsThisLoanLine,
            'PMDTHShowInTaxList'        =>  $DeductionType->PMDTHShowInTaxList,
            'PMDTHIsIncomeDependent'    =>  $DeductionType->PMDTHIsIncomeDependent,

            'PMDTHDedStrategy'          =>  $DeductionType->PMDTHDedStrategy,
            'PMDTHDeductionCycle'       =>  $DeductionType->PMDTHDeductionCycle,
            'PMDTHRuleId'               =>  $DeductionType->PMDTHRuleId,
            'PMDTHPrintingSeq'          =>  $DeductionType->PMDTHPrintingSeq,
            'PMDTHRoundingStrategy'     =>  $DeductionType->PMDTHRoundingStrategy,
            'PMDTHBiElementId'          =>  $DeductionType->PMDTHBiElementId,
            'PMDTHUser'                 =>  $DeductionType->PMDTHUser,
            'PMDTHLastCreated'          =>  $DeductionType->PMDTHLastCreated,
            'PMDTHLastUpdated'          =>  $DeductionType->PMDTHLastUpdated

        );
    }     
    public function PMDTH11DeleteRecordTrait($request)
    {
        $UniqueId = $request->input('id');
        $DeductionType = DeductionType::find($UniqueId);
        //Eloquent Way
        $DeductionType->PMDTHMarkForDeletion   =   1;
        $DeductionType->PMDTHUser               =   Auth::user()->name;
        $DeductionType->PMDTHDeletedAt         =  Carbon::now();
        $DeductionType->save();        
        return $DeductionType->PMDTHDeductionId;
    }
    public function PMDTH11BrowserDeletedRecordsTrait() 
    {
        return $browserDeletedRecords = DeductionType::
        select(
            'PMDTHUniqueId', 
            'PMDTHDeductionId',
            'PMDTHDesc1', 
            'PMDTHDesc2')
        ->where('PMDTHMarkForDeletion', 1);
    }
    public function PMDTH11UnDeleteRecordTrait($request)
    {
        $UniqueId = $request->input('id');
        //Eloquent Way
        $DeductionType = DeductionType::find($UniqueId);
        $DeductionType->PMDTHMarkForDeletion   =   0;
        $DeductionType->PMDTHUser               =   Auth::user()->name;
        $DeductionType->PMDTHDeletedAt         =  Null;
        $DeductionType->save();        
        return $DeductionType->PMDTHDeductionId;
    }   
    public function PMDTH11PeriodicDetailTableTrait($request)
    {
        // Delete Detail Record First
        $PeriodicIncDed = PeriodicIncDed::where('PMIDDIncDedIdK', $request->PMDTHDeductionIdK)
            ->delete();
        if ($request->deductionCycleId == 'P') {
            if (!empty($request->periodId)) {
                // Loop in Array to insert records in PeriodicIncDed table
                foreach($request->periodId as $key => $value){

                    $PeriodicIncDed = new PeriodicIncDed();
                    $PeriodicIncDed->PMIDDIncDedId          = $request->PMDTHDeductionId;
                    $PeriodicIncDed->PMIDDIncDedIdK         = $request->PMDTHDeductionIdK;
                    $PeriodicIncDed->PMIDDIncOrDed          = 'D';
                    $PeriodicIncDed->PMIDDDesc              = $request->PMDTHDesc1;
                    $PeriodicIncDed->PMIDDPeriodId          = $value;
                    $PeriodicIncDed->PMIDDMarkForDeletion   = 0;
                    $PeriodicIncDed->PMIDDUser              = Auth::user()->name;
                    $PeriodicIncDed->PMIDDLastCreated       = Carbon::now();
                    $PeriodicIncDed->PMIDDLastUpdated       = Carbon::now();
                    $PeriodicIncDed->save();
                }
            }
        }
    }    

    // Sub Form Events
    public function PMDTH11BrowserSubFormTrait() 
    { 
        return $browserData = MemIncomeType::get([
            'PMDTDUniqueId', 
            'PMDTDUniqueIdH',
            'PMDTDIncomeId',
            'PMDTDDesc1', 
            'PMDTDIsSelect',
            'PMDTDDedPercent',
            'PMDTDUser'
         ]);
    }
    public function PMDTH11AppendMemTableTrait()
    {        
        $loginName = Auth::user()->name;
        // Delete Records for this user first 
        MemIncomeType::where('PMDTDUser', $loginName)->delete();
        $Master = IncomeType::orderBy('PMITHUniqueId')->get();
        $LineNo = 10;
        foreach ($Master as $key => $value) {
            MemIncomeType::create([
                'PMDTDUniqueIdH'    => $LineNo,
                'PMDTDIncomeId'     => $value->PMITHIncomeId,
                'PMDTDIncomeIdK'    => $value->PMITHIncomeIdK,
                'PMDTDDesc1'        => $value->PMITHDesc1,
                'PMDTDIsSelect'     => 0,
                'PMDTDDedPercent'   => 100,
                'PMDTDUser'         => $loginName
            ]);            
            $LineNo++;
        }
        
    }
    public function PMDTH11AppendMemTableEditModeTrait($PMDTHUniqueId)
    { 
        $loginName = Auth::user()->name;
        // Delete Records for this user first 
        MemIncomeType::where('PMDTDUser', $loginName)->delete();
        $Master = IncomeType::orderBy('PMITHUniqueId')->get();
        $LineNo = 10;
        foreach ($Master as $key => $value) {
            // Check This Deduction Id in Actual Table
            $RecordFound = IncDependentDed::where('PMDTDIncomeIdK', '=', $value->PMITHIncomeIdK)
                ->where('PMDTDUniqueIdH', '=', $PMDTHUniqueId)
                ->first();
            MemIncomeType::create([
                'PMDTDUniqueIdH'    => $LineNo,
                'PMDTDIncomeId'     => $value->PMITHIncomeId,
                'PMDTDIncomeIdK'    => $value->PMITHIncomeIdK,
                'PMDTDDesc1'        => $value->PMITHDesc1,
                'PMDTDIsSelect'     => $RecordFound == '' ? 0 : 1,
                'PMDTDDedPercent'   => $RecordFound == '' ? 100 : $RecordFound->PMDTDDedPercent,
                // 'PMDTDDedPercent'   => $RecordFound == 'null' ? 100 : 100,
                'PMDTDUser'         => $loginName
            ]);            
            $LineNo++;
        }
        
    }
    public function PMDTH11FethchEditedSubFormDataTrait($request)
    {
        $PMDTDUniqueId = $request->input('id');        
        $MemIncomeType = MemIncomeType::findOrFail($PMDTDUniqueId);
        // $MemIncomeType = MemIncomeType::where('PMDTDUniqueId', $PMDTDUniqueId)->get();
        // echo 'Data Submitted.';
        // echo "<pre>";
        // print_r($MemIncomeType);
        // die();
        return $output = array(
            'PMDTDUniqueId'     =>  $MemIncomeType->PMDTDUniqueId,
            'PMDTDIncomeId'     =>  $MemIncomeType->PMDTDIncomeId,
            'PMDTDDesc1'        =>  $MemIncomeType->PMDTDDesc1,
            'PMDTDDedPercent'   =>  $MemIncomeType->PMDTDDedPercent
        );
    }
    public function PMDTH11AddUpdateDetailEntryTrait($request)
    {         
        if($request->get('button_action_DetailEntry') == 'update') {
            $MemIncomeType = MemIncomeType::find($request->get('PMDTDUniqueId'));
            $UniqueId = $request->get('PMDTDUniqueId');
        } 
        $MemIncomeType->PMDTDIsSelect   =   1;
        $MemIncomeType->PMDTDDedPercent =   $request->PMDTDDedPercent;
        $MemIncomeType->save();
        return $UniqueId; 
    }
    public function PMDTH11DeleteDetailEntryTrait($request)
    {
        $MemIncomeType = MemIncomeType::find($request->get('id'));
        $MemIncomeType->PMDTDIsSelect   =   0;
        $MemIncomeType->PMDTDDedPercent =   100;
        $MemIncomeType->save();
        $UniqueId = $request->get('PMDTDUniqueId');
        return $UniqueId; 
    }
    public function PMDTH11AppendIncomeDependentTableTrait($request, $UniqueId)
    {        
        $loginName = Auth::user()->name;
        $MemIncomeType = MemIncomeType::where('PMDTDUser', $loginName)
            ->where('PMDTDIsSelect', 1)
            ->orderBy('PMDTDUniqueId')
            ->get();
        foreach ($MemIncomeType as $key => $value) {
            IncDependentDed::create([
                'PMDTDUniqueIdH'        => $UniqueId,
                'PMDTDDeductionId'      => $request->PMDTHDeductionId,
                'PMDTDDeductionIdK'     => $request->PMDTHDeductionIdK,
                'PMDTDIncomeId'         => $value->PMDTDIncomeId,
                'PMDTDIncomeIdK'        => $value->PMDTDIncomeIdK,
                'PMDTDIsSelect'         => $value->PMDTDIsSelect,
                'PMDTDDedPercent'       => $value->PMDTDDedPercent,
                'PMDTDMarkForDeletion'  => 0,
                'PMDTDUser'             => $loginName,
                'PMDTDLastCreated'      => Carbon::now(),
                'PMDTDLastUpdated'      => Carbon::now()
            ]);
        }
        
    }
    // Sub Form Events End**********
}
//DeductionType Master Ends*****