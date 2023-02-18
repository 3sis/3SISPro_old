<?php
namespace app\Traits\SystemsMaster\PaymentMaster;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\SystemsMaster\PaymentMaster\RuleDefinition;
trait RuleDefinitionDbOperations {        
     
     public function BrowserDataTrait() 
     {
        return $browserData = RuleDefinition::leftJoin('t00903l02', 't00903l02.PMRHHHierarchyId', '=','t00903l03.PMRDHHierarchyId')
        ->leftJoin('t00903l05', 't00903l05.PMDMHMethodId', '=', 't00903l03.PMRDHDeductionEligibility')
        // ->leftJoin('t00903l05', 't00903l05.PMDMHMethodId', '=', 't00903l03.PMRDHDeductionBasis')
        ->where('PMRDHMarkForDeletion', 0)
        ->where('PMRDHIncOrDed', 'D')
        // >select('t00903l03.PMRDHDeductionEligibility AS uid')
        ->get([
        't00903l03.PMRDHUniqueId',
        't00903l03.PMRDHRuleId', 
        't00903l03.PMRDHIncOrDed', 
        't00903l03.PMRDHDesc1', 
        't00903l02.PMRHHDesc1',
        't00903l03.PMRDHSlabDefined',
        't00903l05.PMDMHDesc AS DeductionEligibility',
        // 't00903l05.PMDMHDesc AS PMRDHDeductionBasis',
        't00903l03.PMRDHDeductionBasis',
        't00903l03.PMRDHUser',
        't00903l03.PMRDHLastCreated',
        't00903l03.PMRDHLastUpdated',
        ]);
     }
     public function AddUpdateTrait($request)
     {         
        // $RuleDefinition = new RuleDefinition;     
        $RuleDefinition = RuleDefinition::find($request->get('PMRDHUniqueId'));           
        
        $RuleDefinition->PMRDHHierarchyId               =   $request->PMRDHHierarchyId;
        $RuleDefinition->PMRDHDeductionEligibility      =   $request->PMRDHDeductionEligibility;
        $RuleDefinition->PMRDHDeductionBasis            =   $request->PMRDHDeductionBasis;
        $RuleDefinition->PMRDHUser                      =   Auth::user()->name;
        $RuleDefinition->PMRDHLastUpdated               =   Carbon::now();
        $RuleDefinition->save(); 
        $UniqueId = $request->get('PMRDHUniqueId');
        return $UniqueId; 
     }
     public function FethchEditedDataTrait($request)
     {
        $PMRDHUniqueId = $request->input('id');
        $RuleDefinition = RuleDefinition::find($PMRDHUniqueId);
        return $output = array(
            'PMRDHUniqueId'             =>  $RuleDefinition->PMRDHUniqueId,
            'PMRDHRuleId'               =>  $RuleDefinition->PMRDHRuleId,
            'PMRDHIncOrDed'             =>  $RuleDefinition->PMRDHIncOrDed,
            'PMRDHDesc1'                =>  $RuleDefinition->PMRDHDesc1,
            'PMRDHHierarchyId'          =>  $RuleDefinition->PMRDHHierarchyId,
            'PMRDHSlabDefined'          =>  $RuleDefinition->PMRDHSlabDefined,
            'PMRDHDeductionEligibility' =>  $RuleDefinition->PMRDHDeductionEligibility,
            'PMRDHDeductionBasis'       =>  $RuleDefinition->PMRDHDeductionBasis,
            'PMRDHUser'                 =>  $RuleDefinition->PMRDHUser,
            'PMRDHLastCreated'          =>  $RuleDefinition->PMRDHLastCreated,
            'PMRDHLastUpdated'          =>  $RuleDefinition->PMRDHLastUpdated
        );
     }
      
     
}
//RuleDefinition Master Ends*****