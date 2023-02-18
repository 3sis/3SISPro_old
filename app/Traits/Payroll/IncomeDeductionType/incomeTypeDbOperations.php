<?php
namespace app\Traits\Payroll\IncomeDeductionType;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\IncomeDeductionType\IncomeType;
use App\Models\Payroll\IncomeDeductionType\PeriodicIncDed;
// Income Type Master
// PMITH11 : Income Type of Payrall
trait incomeTypeDbOperations {        
     
     public function PMITH11BrowserDataTrait() 
     { 
         return $browserData = IncomeType::join('T00903l04', 'T00903l04.PMPCHCycleId', '=', 'T11906L01.PMITHIncomeCycle')
         ->join('T00903l03', 'T00903l03.PMRDHRuleId', '=', 'T11906L01.PMITHRuleId')
         ->join('T00905L01', 'T00905L01.RSRSHRoundingId', '=', 'T11906L01.PMITHRoundingStrategy')
         ->where('PMITHMarkForDeletion', 0)
         ->get([
             'T11906L01.PMITHUniqueId',
             'T11906L01.PMITHIncomeId',
             'T11906L01.PMITHDesc1',
             'T00903l03.PMRDHDesc1',
             't00903l04.PMPCHDesc1',
             'T11906L01.PMITHPrintingSeq',
             'T00905L01.RSRSHDesc1'
         ]);
     }     
     public function PMITH11AddUpdateTrait($request)
     {         
        if($request->get('button_action') == 'insert') {
            $IncomeType = new IncomeType;                
            $IncomeType->PMITHIncomeId              =   $request->PMITHIncomeId;            
            $IncomeType->PMITHIncomeIdK             =   $request->PMITHIncomeIdK;            
            $IncomeType->PMITHLastCreated           =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $IncomeType = IncomeType::find($request->get('PMITHUniqueId'));
        } 
        $IncomeType->PMITHDesc1                 =   $request->PMITHDesc1;
        $IncomeType->PMITHDesc2                 =   $request->PMITHDesc2;
        $IncomeType->PMITHIsTaxable             =   $request->PMITHIsTaxable;
        $IncomeType->PMITHRuleId                =   $request->ruleDefId == '- Select Rule -' ? 'Z1000' : $request->ruleDefId;
        $IncomeType->PMITHRentExemptPercent     =   $request->PMITHRentExemptPercent;
        $IncomeType->PMITHRentCityPercent       =   $request->PMITHRentCityPercent;
        $IncomeType->PMITHPrintingSeq           =   $request->PMITHPrintingSeq;
        $IncomeType->PMITHRoundingStrategy      =   $request->PMITHRoundingStrategy;
        $IncomeType->PMITHRoundingStrategy      =   $request->roundingId;
        $IncomeType->PMITHBiElementId           =   $request->biDescId == '-- BI Code --' ? NULL : $request->biDescId;
        $IncomeType->PMITHIncomeCycle           =   $request->incomeCycleId;        
        // Function to Update Income and Deduction Periodic Detail Table
        $this->PMITH11DetailTableTrait($request);        
        $IncomeType->PMITHMarkForDeletion   =   0;
        $IncomeType->PMITHUser              =   Auth::user()->name;
        $IncomeType->PMITHLastUpdated       =   Carbon::now();
        $IncomeType->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $IncomeType->PMITHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('PMITHUniqueId');
        }
        return $UniqueId; 
     }     
     public function PMITH11FethchEditedDataTrait($request)
     {
        $PMITHUniqueId = $request->input('id');
        $IncomeType = IncomeType::find($PMITHUniqueId);
        return $output = array(
            'PMITHUniqueId'             =>  $IncomeType->PMITHUniqueId,
            'PMITHIncomeId'             =>  $IncomeType->PMITHIncomeId,
            'PMITHIncomeIdK'            =>  $IncomeType->PMITHIncomeIdK,
            'PMITHDesc1'                =>  $IncomeType->PMITHDesc1,
            'PMITHDesc2'                =>  $IncomeType->PMITHDesc2,

            'PMITHIsTaxable'            =>  $IncomeType->PMITHIsTaxable,
            'PMITHRuleId'               =>  $IncomeType->PMITHRuleId,
            'PMITHRentExemptPercent'    =>  $IncomeType->PMITHRentExemptPercent,
            'PMITHRentCityPercent'      =>  $IncomeType->PMITHRentCityPercent,
            'PMITHIncomeCycle'          =>  $IncomeType->PMITHIncomeCycle,

            'PMITHPrintingSeq'          =>  $IncomeType->PMITHPrintingSeq,
            'PMITHRoundingStrategy'     =>  $IncomeType->PMITHRoundingStrategy,
            'PMITHBiElementId'          =>  $IncomeType->PMITHBiElementId,

            'PMITHUser'         =>  $IncomeType->PMITHUser,
            'PMITHLastCreated'  =>  $IncomeType->PMITHLastCreated,
            'PMITHLastUpdated'  =>  $IncomeType->PMITHLastUpdated

        );
     }     
     public function PMITH11DeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $IncomeType = IncomeType::find($UniqueId);
        //Eloquent Way
        $IncomeType->PMITHMarkForDeletion   =   1;
        $IncomeType->PMITHUser               =   Auth::user()->name;
        $IncomeType->PMITHDeletedAt         =  Carbon::now();
        $IncomeType->save();        
        return $IncomeType->PMITHIncomeId;
     }
     public function PMITH11BrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = IncomeType::
         select(
             'PMITHUniqueId', 
             'PMITHIncomeId',
             'PMITHDesc1', 
             'PMITHDesc2')
         ->where('PMITHMarkForDeletion', 1);
     }
     public function PMITH11UnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $IncomeType = IncomeType::find($UniqueId);
         $IncomeType->PMITHMarkForDeletion   =   0;
         $IncomeType->PMITHUser               =   Auth::user()->name;
         $IncomeType->PMITHDeletedAt         =  Null;
         $IncomeType->save();        
         return $IncomeType->PMITHIncomeId;
     }   
     public function PMITH11DetailTableTrait($request)
     {
        // Delete Detail Record First
        $PeriodicIncDed = PeriodicIncDed::where('PMIDDIncDedIdK', $request->PMITHIncomeIdK)
            ->delete();
        if ($request->incomeCycleId == 'P') {
            if (!empty($request->periodId)) {
                // Loop in Array to insert records in PeriodicIncDed table
                foreach($request->periodId as $key => $value){

                    $PeriodicIncDed = new PeriodicIncDed();
                    $PeriodicIncDed->PMIDDIncDedId          = $request->PMITHIncomeId;
                    $PeriodicIncDed->PMIDDIncDedIdK         = $request->PMITHIncomeIdK;
                    $PeriodicIncDed->PMIDDIncOrDed          = 'I';
                    $PeriodicIncDed->PMIDDDesc              = $request->PMITHDesc1;
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
}
//IncomeType Master Ends*****