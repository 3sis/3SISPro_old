<?php
namespace app\Traits\Payroll\StatutoryDeductionSlab;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
// Reference Model
use App\Models\SystemsMaster\PaymentMaster\RuleDefinition;
use App\Models\SystemsMaster\PaymentMaster\RuleHierarchy;
use App\Models\Payroll\IncomeDeductionType\DeductionType;
// Update Models
use App\Models\Payroll\StatutoryDeductionSlab\MemStatutoryDeductionSlabHeader;
use App\Models\Payroll\StatutoryDeductionSlab\MemStatutoryDeductionSlabDetail;
use App\Models\Payroll\StatutoryDeductionSlab\StatutoryDeductionSlabHeader;
use App\Models\Payroll\StatutoryDeductionSlab\StatutoryDeductionSlabDetail;
// PMSDS : Payroll Master: Statutory Deduction Slab
trait statutoryDeductionSlabDbOperations {
    #-----------------------------------------------------------------------------------------------------------------
    # Landing Page browser
    public function PMSDS11BrowserDataTrait(){
        // Update Rule Definition Slab Defined flag if it is defined in StatutoryDeductionSlabHeader
        $this->updateFlagInRuleDefintion();
        return $browserData = RuleDefinition::
        join('T00903L02', 'PMRHHHierarchyId', '=', 'T00903L03.PMRDHHierarchyId', 'left outer')
        ->where('T00903L03.PMRDHIncOrDed', 'D')
        ->where('T00903L03.PMRDHMarkForDeletion', 0)
        ->get([            
            'T00903L03.PMRDHRuleId',
            'T00903L03.PMRDHDesc1',
            'T00903L03.PMRDHHierarchyId',
            'T00903L03.PMRDHSlabDefined',
            'T00903L03.PMRDHUniqueId',
            'T00903L03.PMRDHUser',
            'T00903L03.PMRDHLastUpdated',
            // Hierarchy table Description
            'T00903L02.PMRHHDesc1'
            
        ]);
    }
    public function updateFlagInRuleDefintion(){
        $RuleDefinition = RuleDefinition::
        where('PMRDHIncOrDed', 'D')
        ->where('PMRDHMarkForDeletion', 0)
        ->get(); 
        
        foreach ($RuleDefinition as $result) {
            $ifSlabFound = StatutoryDeductionSlabHeader::
                where('PMDSHUniqueIdM', $result->PMRDHUniqueId)
                ->get()
                ->first();                            
            $result->PMRDHSlabDefined    = $ifSlabFound == "" ? 0 : 1;
            $result->save();
        };
    }
    # Delete Mem Tables : Header and Detail
    public function PMSDS11DeleteMemTablesTrait($request){
        // Delete Mem Table
        $loginName = Auth::user()->name;
        MemStatutoryDeductionSlabHeader::where('PMDSHUser', $loginName)
        ->delete();
        MemStatutoryDeductionSlabDetail::where('PMDSDUser', $loginName)
        ->delete();
        return;
    }
    # Delete Mem Tables : Header and Detail End*****
    # Get Landing Page Record Info, Append Mem Table : Header and Detail
    public function PMSDS11FethchEditedDataTrait($request){  
        
        $PMRDHUniqueId = $request->input('id');
        $RuleDefinition = RuleDefinition::find($PMRDHUniqueId);
        // Append Mem Header based on RuleDefinition->UniqueId.
        $this->appendHeaderMem($PMRDHUniqueId);
        
        $this->appendDetailMem($PMRDHUniqueId);        
        // Get Foreign Keys Description
        $HierarchyDesc = RuleHierarchy::where('PMRHHHierarchyId', $RuleDefinition->PMRDHHierarchyId)
            ->get(['PMRHHDesc1'])
            ->first();
        $DeductionType = DeductionType::where('PMDTHRuleId', $RuleDefinition->PMRDHRuleId)
        ->get()
        ->first();
        // Get Foreign Keys Description Ends*****
        return $output = array(
            'PMRDHUniqueId'             =>  $RuleDefinition->PMRDHUniqueId,
            'PMRDHRuleId'               =>  $RuleDefinition->PMRDHRuleId,
            'PMRDHDesc1'                =>  $RuleDefinition->PMRDHDesc1,
            'PMRDHHierarchyId'          =>  $RuleDefinition->PMRDHHierarchyId,
            'HierarchyDesc'             =>  $HierarchyDesc->PMRHHDesc1,
            'PMDTHApplicableFor'        =>  $DeductionType->PMDTHApplicableFor,
            'PMRDHUser'                 =>  $RuleDefinition->PMRDHUser,
            'PMRDHLastCreated'          =>  $RuleDefinition->PMRDHLastCreated,
            'PMRDHLastUpdated'          =>  $RuleDefinition->PMRDHLastUpdated
        );
    }
    # Append Mem Table Header
    function appendHeaderMem($PMRDHUniqueId){
        // Update Header Mem Table
        $Header = StatutoryDeductionSlabHeader::where('PMDSHUniqueIdM', $PMRDHUniqueId)
        ->where('PMDSHStatusId', '!=' , 9999)
        ->orderBy('PMDSHUniqueId')
        ->get();
        // Perform loop in Header to update mem table
        foreach ($Header as $headervalue) {
            MemStatutoryDeductionSlabHeader::create([
                // 'PMDSHUniqueId'         => $headervalue->PMDSHUniqueId,
                'PMDSHUniqueIdM'         => $headervalue->PMDSHUniqueIdM,
                'PMDSHRuleId'           => $headervalue->PMDSHRuleId,
                'PMDSHIncOrDed'         => $headervalue->PMDSHIncOrDed,
                'PMDSHDesc1'            => $headervalue->PMDSHDesc1,
                'PMDSHHierarchyId'      => $headervalue->PMDSHHierarchyId,
                'PMDSHGeographicId'     => $headervalue->PMDSHGeographicId,
                'PMDSHGenderId'         => $headervalue->PMDSHGenderId,
                'PMDSHEffectiveFrom'    => $headervalue->PMDSHEffectiveFrom,
                'PMDSHEffectiveTo'      => $headervalue->PMDSHEffectiveTo,
                'PMDSHMarkForDeletion'  => $headervalue->PMDSHMarkForDeletion,
                'PMDSHStatusId'         => $headervalue->PMDSHStatusId,
                'PMDSHLastCreated'      => $headervalue->PMDSHLastCreated,
                'PMDSHLastUpdated'      => $headervalue->PMDSHLastUpdated,
                'PMDSHDeletedAt'        => $headervalue->PMDSHDeletedAt
            ]);            
        }
    }
    # Append Mem Table Detail
    function appendDetailMem($PMRDHUniqueId){
        $Detail = StatutoryDeductionSlabDetail::where('PMDSDUniqueIdM', $PMRDHUniqueId)
            ->where('PMDSDStatusId', '!=' , 9999)
            ->orderBy('PMDSDUniqueId')
            ->get();
            $LineNo = 10;
        // Perform a loop in detail table to update Mem Detail.
        foreach ($Detail as $detailvalue) {
            MemStatutoryDeductionSlabDetail::create([
                // 'PMDSDUniqueId'         => $detailvalue->PMDSDUniqueId,
                'PMDSDUniqueIdH'         => $detailvalue->PMDSDUniqueIdH,
                'PMDSDUniqueIdM'        => $detailvalue->PMDSDUniqueIdM,
                'PMDSDLineId'           => $detailvalue->PMDSDLineId,
                'PMDSDRuleId'           => $detailvalue->PMDSDRuleId,
                'PMDSDIncOrDed'         => $detailvalue->PMDSDIncOrDed,
                'PMDSDDesc1'            => $detailvalue->PMDSDDesc1,
                'PMDSDHierarchyId'      => $detailvalue->PMDSDHierarchyId,
                'PMDSDGeographicId'     => $detailvalue->PMDSDGeographicId,
                'PMDSDGenderId'         => $detailvalue->PMDSDGenderId,
                'PMDSDEffectiveFrom'    => $detailvalue->PMDSDEffectiveFrom,
                'PMDSDEffectiveTo'      => $detailvalue->PMDSDEffectiveTo,
                'PMDSDIncomeFrom'       => $detailvalue->PMDSDIncomeFrom,
                'PMDSDIncomeTo'         => $detailvalue->PMDSDIncomeTo,
                'PMDSDEmpContriType'    => $detailvalue->PMDSDEmpContriType,
                'PMDSDEmpContriAmount'  => $detailvalue->PMDSDEmpContriAmount,
                'PMDSDCompContriType'   => $detailvalue->PMDSDCompContriType,
                'PMDSDCompContriAmount' => $detailvalue->PMDSDCompContriAmount,
                'PMDSDMarkForDeletion'  => $detailvalue->PMDSDMarkForDeletion,
                'PMDSDStatusId'         => $detailvalue->PMDSDStatusId,
                'PMDSDLastCreated'      => $detailvalue->PMDSDLastCreated,
                'PMDSDLastUpdated'      => $detailvalue->PMDSDLastUpdated,
                'PMDSDDeletedAt'        => $detailvalue->PMDSDDeletedAt
            ]);
            $LineNo++;
        }
    }
    # Get Landing Page Record Info, Append Mem Table : Header and Detail End*****
    # Landing Page browser Ends*****
    #-----------------------------------------------------------------------------------------------------------------
    # Deduction Slab Header Sub Form
    public function PMSDS11BrowserSubFormHeaderTrait($request){
        return $browserData = MemStatutoryDeductionSlabHeader::get([
            'PMDSHGeographicId',
            'PMDSHGenderId',
            'PMDSHEffectiveFrom',
            'PMDSHEffectiveTo',
            'PMDSHMarkForDeletion',
            'PMDSHUser',
            'PMDSHUniqueId'
         ]);
    }
    # Deduction Slab Header : Empty Check
    public function PMSDS11IsHeaderMemTableEmptyTrait(){
        $loginName = Auth::user()->name; 
        $count = MemStatutoryDeductionSlabHeader::where('PMDSHUser', $loginName)
        ->count();
        return $count;
    }
    #-----------------------------------------------------------------------------------------------------------------
    # Deduction Slab Detail Sub Form
    public function PMSDS11BrowserSubFormDeductionSlabTrait($request){
        return $browserData = MemStatutoryDeductionSlabDetail::where('PMDSDUniqueIdM', $request->param5)
        ->where('PMDSDGeographicId', $request->param3)
        ->where('PMDSDGenderId', $request->param4)
        ->where('PMDSDEffectiveFrom', $request->param1)
        ->where('PMDSDEffectiveTo', $request->param2)
        ->get([
            'PMDSDLineId',
            'PMDSDGenderId',
            'PMDSDEffectiveFrom',
            'PMDSDEffectiveTo',
            'PMDSDIncomeFrom',
            'PMDSDIncomeTo',
            'PMDSDUser',
            'PMDSDUniqueId'
         ]);
    }
    # Check if Detail Sub Form is empty
    public function PMSDS11IsMemTableEmptyTrait($request){
        $GenderId = 'C';
        if ($request->PMDTHApplicableForH == 'I') {
            $GenderId = $request->PMDSHGenderId;
        }
        $loginName = Auth::user()->name; 
        $count = MemStatutoryDeductionSlabDetail::where('PMDSDRuleId', $request->PMDSHRuleIdH)
        ->where('PMDSDGeographicId', $request->PMDSHGeographicId)
        ->where('PMDSDGenderId', $GenderId)
        ->where('PMDSDEffectiveFrom', $request->PMDSHEffectiveFrom)
        ->where('PMDSDEffectiveTo', $request->PMDSHEffectiveTo)
        ->where('PMDSDUser', $loginName)
        ->count();
        return $count;
    }
    # Check for the duplicate record in header - During Add Slab
    public function PMSDS11CheckDuplicateTrait($request){
        $loginName = Auth::user()->name;

        $MemStatutoryDeductionSlabDetail = MemStatutoryDeductionSlabDetail::where('PMDSDRuleId', $request->PMDSHRuleId)
        ->where('PMDSDGeographicId', $request->PMDSHGeographicId)
        ->where('PMDSDGenderId', $request->PMDSHGenderId)
        ->where('PMDSDEffectiveFrom', $request->PMDSHEffectiveFrom)
        ->where('PMDSDEffectiveTo', $request->PMDSHEffectiveTo)
        ->where('PMDSDUser', $loginName)
        ->orderBy('PMDSDLineId', 'desc')
        ->get(['PMDSDIncomeTo'])
        ->first();
        if ($MemStatutoryDeductionSlabDetail !='') {
            if ($MemStatutoryDeductionSlabDetail->PMDSDIncomeTo == 9999999999.99) {
                $duplicateFound = 1;
            }else{
                $duplicateFound = 0;
            }
        }else {
            $duplicateFound = 0;
        }
        
        // $duplicateFound = MemStatutoryDeductionSlabHeader::where('PMDSHUser', $loginName)
        // ->where('PMDSHRuleId', $request->PMDSHRuleId)
        // ->where('PMDSHGeographicId', $request->PMDSHGeographicId)
        // ->where('PMDSHGenderId', $request->PMDSHGenderId)
        // ->where('PMDSHEffectiveFrom', $request->PMDSHEffectiveFrom)
        // ->where('PMDSHEffectiveTo', $request->PMDSHEffectiveTo)
        // ->count();
        return $duplicateFound;
    }
    # Check for the duplicate record in header - During Save
    public function PMSDS11CheckDuplicateTraitAtSave($request){
        $GenderId = 'C';
        if ($request->PMDTHApplicableForH == 'I') {
            $GenderId = $request->PMDSHGenderId;
        }
        $loginName = Auth::user()->name; 
        $duplicateFound = MemStatutoryDeductionSlabHeader::where('PMDSHUser', $loginName)
        ->where('PMDSHRuleId', $request->PMDSHRuleIdH)
        ->where('PMDSHGeographicId', $request->PMDSHGeographicId)
        ->where('PMDSHGenderId', $GenderId)
        ->where('PMDSHEffectiveFrom', $request->PMDSHEffectiveFrom)
        ->where('PMDSHEffectiveTo', $request->PMDSHEffectiveTo)
        ->count();
        return $duplicateFound;
    }
    # Check for the last Slab To amount must be = 9999999999.99
    public function PMSDS11CheckLastIncomeToTrait($request){
        $GenderId = 'C';
        if ($request->PMDTHApplicableForH == 'I') {
            $GenderId = $request->PMDSHGenderId;
        }
        $loginName = Auth::user()->name;
        $MemStatutoryDeductionSlabDetail = MemStatutoryDeductionSlabDetail::where('PMDSDUser', $loginName)
        ->where('PMDSDRuleId', $request->PMDSHRuleIdH)
        ->where('PMDSDGeographicId', $request->PMDSHGeographicId)
        ->where('PMDSDGenderId', $GenderId)
        ->where('PMDSDEffectiveFrom', $request->PMDSHEffectiveFrom)
        ->where('PMDSDEffectiveTo', $request->PMDSHEffectiveTo)
        ->orderBy('PMDSDLineId', 'desc')
        ->get(['PMDSDIncomeTo'])
        ->first();
            
        return $LastIncomeTo = $MemStatutoryDeductionSlabDetail->PMDSDIncomeTo;
    }
    # Get Last Line No
    public function PMSDS11GetLastLineNoOnAddTrait($request){
        $LoginId = Auth::user()->name;
        $MemStatutoryDeductionSlabDetail = MemStatutoryDeductionSlabDetail::where('PMDSDRuleId', $request->PMDSHRuleId)
        ->where('PMDSDGeographicId', $request->PMDSHGeographicId)
        ->where('PMDSDGenderId', $request->PMDSHGenderId)
        ->where('PMDSDEffectiveFrom', $request->PMDSHEffectiveFrom)
        ->where('PMDSDEffectiveTo', $request->PMDSHEffectiveTo)
        ->where('PMDSDUser', $LoginId)
        ->orderBy('PMDSDLineId', 'desc')
        ->get(['PMDSDLineId'])
        ->first();
        if ($MemStatutoryDeductionSlabDetail != ''){
            $LastLineNo = (int)$MemStatutoryDeductionSlabDetail->PMDSDLineId + 1;
        }else{
            $LastLineNo = 10;
        }
        return $LastLineNo;
    }
    # Get Next From Slab
    public function PMSDS11GetNextFromSlabOnAddTrait($request){
        $LoginId = Auth::user()->name;
        $MemStatutoryDeductionSlabDetail = MemStatutoryDeductionSlabDetail::where('PMDSDRuleId', $request->PMDSHRuleId)
        ->where('PMDSDGeographicId', $request->PMDSHGeographicId)
        ->where('PMDSDGenderId', $request->PMDSHGenderId)
        ->where('PMDSDEffectiveFrom', $request->PMDSHEffectiveFrom)
        ->where('PMDSDEffectiveTo', $request->PMDSHEffectiveTo)
        ->where('PMDSDUser', $LoginId)
        ->orderBy('PMDSDLineId', 'desc')
        ->get(['PMDSDIncomeTo'])
        ->first();
        if ($MemStatutoryDeductionSlabDetail != ''){
            $NextFromSlab = $MemStatutoryDeductionSlabDetail->PMDSDIncomeTo + 0.01;
        }else{
            $NextFromSlab = 0.01;
        }        
        return $NextFromSlab;
    }
    # Update Mem Table : Header
    public function PMSDS11IsMemTableHeaderUpdateTrait($request){
        if($request->get('button_action_DetailEntry1') == 'insert') {
            $MemStatutoryDeductionSlabHeader = new MemStatutoryDeductionSlabHeader;
            $MemStatutoryDeductionSlabHeader->PMDSHUniqueIdM    = $request->PMDSHUniqueIdM;
            $MemStatutoryDeductionSlabHeader->PMDSHRuleId       = $request->PMDSHRuleIdH;
            $MemStatutoryDeductionSlabHeader->PMDSHHierarchyId  = $request->PMDSHHierarchyIdH;
            $MemStatutoryDeductionSlabHeader->PMDSHIncOrDed     = 'D';
            $MemStatutoryDeductionSlabHeader->PMDSHLastUpdated  = Carbon::now();
        }elseif($request->get('button_action_DetailEntry1') == 'update'){
            $MemStatutoryDeductionSlabHeader = MemStatutoryDeductionSlabHeader::find($request->PMDSHUniqueId);
        }
        $MemStatutoryDeductionSlabHeader->PMDSHDesc1            = $request->PMDSHDesc1H;
        $MemStatutoryDeductionSlabHeader->PMDSHGeographicId     = $request->PMDSHGeographicId;
        $MemStatutoryDeductionSlabHeader->PMDSHGenderId         = $request->PMDTHApplicableForH == 'C' ? 'C' : $request->PMDSHGenderId;
        $MemStatutoryDeductionSlabHeader->PMDSHEffectiveFrom    = $request->PMDSHEffectiveFrom;
        $MemStatutoryDeductionSlabHeader->PMDSHEffectiveTo      = $request->PMDSHEffectiveTo;
        $MemStatutoryDeductionSlabHeader->PMDSHMarkForDeletion  = 0;
        $MemStatutoryDeductionSlabHeader->PMDSHUser             = Auth::user()->name;
        $MemStatutoryDeductionSlabHeader->PMDSHStatusId         = 1000;
        $MemStatutoryDeductionSlabHeader->PMDSHLastUpdated      = Carbon::now();
        $MemStatutoryDeductionSlabHeader->save(); 
        if($request->get('button_action_DetailEntry1') == 'insert') {
            $UniqueId = $MemStatutoryDeductionSlabHeader->PMDSHUniqueId ; 
        }elseif($request->get('button_action_DetailEntry1') == 'update'){
            $UniqueId = $request->PMDSHUniqueId;
        }        
        return $UniqueId; 
    }
    #-----------------------------------------------------------------------------------------------------------------
    # Deduction Slab Detail Submit
    public function PMSDS11AddUpdateMemStatutoryDeductionSlabDetailTrait($request){
        // echo 'Data Submitted : ';
        // print_r($request->input());
        // die();
        if($request->get('button_action_DetailEntry2') == 'insert') {
            $MemStatutoryDeductionSlabDetail = new MemStatutoryDeductionSlabDetail;
            $MemStatutoryDeductionSlabDetail->PMDSDUniqueIdM        = $request->PMDSDUniqueIdM;
            $MemStatutoryDeductionSlabDetail->PMDSDLineId           = $request->PMDSDLineId;
            $MemStatutoryDeductionSlabDetail->PMDSDStatusId         =   1000;
            $MemStatutoryDeductionSlabDetail->PMDSDLastCreated      =   Carbon::now();
        }elseif($request->get('button_action_DetailEntry2') == 'update'){
            $MemStatutoryDeductionSlabDetail = MemStatutoryDeductionSlabDetail::find($request->get('PMDSDUniqueId'));
            $MemStatutoryDeductionSlabDetail->PMDSDStatusId         =   1100;
        }
        $MemStatutoryDeductionSlabDetail->PMDSDRuleId           = $request->PMDSDRuleId;
        $MemStatutoryDeductionSlabDetail->PMDSDDesc1            = $request->PMDSDDesc1;
        $MemStatutoryDeductionSlabDetail->PMDSDIncOrDed         = 'D';
        $MemStatutoryDeductionSlabDetail->PMDSDHierarchyId      = $request->PMDSDHierarchyId;
        $MemStatutoryDeductionSlabDetail->PMDSDGeographicId     = $request->PMDSDGeographicId;
        $MemStatutoryDeductionSlabDetail->PMDSDGenderId         = $request->PMDTHApplicableForD == 'C' ? 'C' : $request->PMDSDGenderId;
        $MemStatutoryDeductionSlabDetail->PMDSDEffectiveFrom    = $request->PMDSDEffectiveFrom;
        $MemStatutoryDeductionSlabDetail->PMDSDEffectiveTo      = $request->PMDSDEffectiveTo;
        $MemStatutoryDeductionSlabDetail->PMDSDIncomeFrom       = $request->PMDSDIncomeFrom;
        $MemStatutoryDeductionSlabDetail->PMDSDIncomeTo         = $request->PMDSDIncomeTo;
        $MemStatutoryDeductionSlabDetail->PMDSDEmpContriType    = $request->PMDSDEmpContriType;
        $MemStatutoryDeductionSlabDetail->PMDSDEmpContriAmount  = $request->PMDSDEmpContriAmount;
        $MemStatutoryDeductionSlabDetail->PMDSDCompContriType   = $request->PMDSDCompContriType;
        $MemStatutoryDeductionSlabDetail->PMDSDCompContriAmount = $request->PMDSDCompContriAmount;
        $MemStatutoryDeductionSlabDetail->PMDSDMarkForDeletion  =   0;
        $MemStatutoryDeductionSlabDetail->PMDSDUser             =   Auth::user()->name;
        $MemStatutoryDeductionSlabDetail->PMDSDLastUpdated      =   Carbon::now();
        $MemStatutoryDeductionSlabDetail->save();

        if($request->get('button_action_DetailEntry2') == 'insert') {
            $UniqueId = $MemStatutoryDeductionSlabDetail->PMDSDUniqueId; 
        }elseif($request->get('button_action_DetailEntry2') == 'update'){
            $UniqueId = $request->get('PMDSDUniqueId');
        }
        return $UniqueId; 
    }
    # Get Last Line No on Save Trait
    public function PMSDS11GetLastLineNoOnSaveTrait($request){
        $LoginId = Auth::user()->name;
         $MemStatutoryDeductionSlabDetail = MemStatutoryDeductionSlabDetail::where('PMDSDRuleId', $request->PMDSDRuleId)
         ->where('PMDSDGeographicId', $request->PMDSDGeographicId)
         ->where('PMDSDUser', $LoginId)
         ->orderBy('PMDSDLineId', 'desc')
         ->get(['PMDSDLineId'])
         ->first();
         if ($MemStatutoryDeductionSlabDetail != ''){
             $LastLineNo = (int)$MemStatutoryDeductionSlabDetail->PMDSDLineId + 1;
         }else{
             $LastLineNo = 10;
         }
         return $LastLineNo;
    }
    # Deduction Slab Detail Submit Ends*****
    #-----------------------------------------------------------------------------------------------------------------
    // Update Tables on Final Save
    function PMSDS11AddUpdateMemToActualTrait($request){
        //Delete Actual Table Data : Header
        $this->deleteHeaderTable($request);
        //Delete Actual Table Data : Detail
        $this->deleteDetailTable($request);
        // Move data from Mem Table to Actual Table : Header
        $this->moveSubFormDataHeader($request);
        return;
    }
    // Delete Header Table
    public function deleteHeaderTable($request){
        $StatutoryDeductionSlabHeader = StatutoryDeductionSlabHeader::where('PMDSHUniqueIdM', $request->PMRDHUniqueId)
        ->where('PMDSHStatusId', '!=' , 9999)
        ->get();
        if ($StatutoryDeductionSlabHeader != '') {
            foreach ($StatutoryDeductionSlabHeader as $headerTable) {
                $headerTable->PMDSHMarkForDeletion    = 1;
                $headerTable->PMDSHUser               = Auth::user()->name;
                $headerTable->PMDSHStatusId           = 9999;
                $headerTable->PMDSHDeletedAt          = Carbon::now();
                $headerTable->save();
            };
        }
    }
    // Delete Detail Table
    public function deleteDetailTable($request){
        $StatutoryDeductionSlabDetail = StatutoryDeductionSlabDetail::where('PMDSDUniqueIdM', $request->PMRDHUniqueId)
        ->where('PMDSDStatusId', '!=' , 9999)
        ->get();
        foreach ($StatutoryDeductionSlabDetail as $value) {
            $value->PMDSDMarkForDeletion    = 1;
            $value->PMDSDUser               = Auth::user()->name;
            $value->PMDSDStatusId           = 9999;
            $value->PMDSDDeletedAt          = Carbon::now();
            $value->save();
        };
    }    
    // Mem to Actual : Header
    public function moveSubFormDataHeader($request){
        // Append from Header Mem to Actual
        $MemStatutoryDeductionSlabHeader = MemStatutoryDeductionSlabHeader::orderBy('PMDSHUniqueId')
        ->get();
        foreach ($MemStatutoryDeductionSlabHeader as $memHeaderTable) {
            $HeaderTable = StatutoryDeductionSlabHeader::create([
                'PMDSHUniqueIdM'        => $request->PMRDHUniqueId,
                'PMDSHRuleId'           => $memHeaderTable->PMDSHRuleId,
                'PMDSHIncOrDed'         => $memHeaderTable->PMDSHIncOrDed,
                'PMDSHDesc1'            => $memHeaderTable->PMDSHDesc1,
                'PMDSHHierarchyId'      => $memHeaderTable->PMDSHHierarchyId,
                'PMDSHGeographicId'     => $memHeaderTable->PMDSHGeographicId,
                'PMDSHGenderId'         => $memHeaderTable->PMDSHGenderId,
                'PMDSHEffectiveFrom'    => $memHeaderTable->PMDSHEffectiveFrom,
                'PMDSHEffectiveTo'      => $memHeaderTable->PMDSHEffectiveTo,
                'PMDSHMarkForDeletion'  => $memHeaderTable->PMDSHMarkForDeletion,
                'PMDSHUser'             => Auth::user()->name,
                'PMDSHStatusId'         => $memHeaderTable->PMDSHStatusId,
                'PMDSHLastCreated'      => $memHeaderTable->PMDSHLastCreated,
                'PMDSHLastUpdated'      => $memHeaderTable->PMDSHLastUpdated,
                'PMDSHDeletedAt'        => $memHeaderTable->PMDSHDeletedAt,
            ]);
            // Move data from Mem Table to Actual Table : Detail
            $this->moveSubFormDataDetail($request, $HeaderTable);            
        }
    }    
    // Mem to Actual : Detail
    public function moveSubFormDataDetail($request, $HeaderTable){
        // Append from Detail Mem to Actual
        $MemStatutoryDeductionSlabDetail = MemStatutoryDeductionSlabDetail::where('PMDSDRuleId', $HeaderTable->PMDSHRuleId)
        ->where('PMDSDGeographicId', $HeaderTable->PMDSHGeographicId)
        ->where('PMDSDGenderId', $HeaderTable->PMDSHGenderId)
        ->where('PMDSDEffectiveFrom', $HeaderTable->PMDSHEffectiveFrom)
        ->where('PMDSDEffectiveTo', $HeaderTable->PMDSHEffectiveTo)
        ->orderBy('PMDSDLineId')
        ->get();
        foreach ($MemStatutoryDeductionSlabDetail as $key => $value) {
            StatutoryDeductionSlabDetail::create([
                'PMDSDUniqueIdH'        => $HeaderTable->PMDSHUniqueId,
                'PMDSDUniqueIdM'        => $request->PMRDHUniqueId,
                'PMDSDLineId'           => $value->PMDSDLineId,
                'PMDSDRuleId'           => $value->PMDSDRuleId,
                'PMDSDIncOrDed'         => $value->PMDSDIncOrDed,
                'PMDSDDesc1'            => $value->PMDSDDesc1,
                'PMDSDHierarchyId'      => $value->PMDSDHierarchyId,
                'PMDSDGeographicId'     => $value->PMDSDGeographicId,
                'PMDSDGenderId'         => $value->PMDSDGenderId,
                'PMDSDEffectiveFrom'    => $value->PMDSDEffectiveFrom,
                'PMDSDEffectiveTo'      => $value->PMDSDEffectiveTo,
                'PMDSDIncomeFrom'       => $value->PMDSDIncomeFrom,
                'PMDSDIncomeTo'         => $value->PMDSDIncomeTo,
                'PMDSDEmpContriType'    => $value->PMDSDEmpContriType,
                'PMDSDEmpContriAmount'  => $value->PMDSDEmpContriAmount,
                'PMDSDCompContriType'   => $value->PMDSDCompContriType,
                'PMDSDCompContriAmount' => $value->PMDSDCompContriAmount,
                'PMDSDMarkForDeletion'  => $value->PMDSDMarkForDeletion,
                'PMDSDUser'             => Auth::user()->name,
                'PMDSDStatusId'         => $value->PMDSDStatusId,
                'PMDSDLastCreated'      => $value->PMDSDLastCreated,
                'PMDSDLastUpdated'      => $value->PMDSDLastUpdated,
                'PMDSDDeletedAt'        => $value->PMDSDDeletedAt,
            ]);
        }
    }
    // Update Tables on Final Save Ends*****
    #-----------------------------------------------------------------------------------------------------------------
    # Date Change Header Sub Form Record Events
    # Get Header Subform Data
    public function PMSDS11FetchSubFormHeaderTrait($request){  
        $PMDSHUniqueId = $request->input('id');
        $MemStatutoryDeductionSlabHeader = MemStatutoryDeductionSlabHeader::where('PMDSHUniqueId', $PMDSHUniqueId)
        ->get()
        ->first();
        // Get Foreign Keys Description
        $HierarchyDesc = RuleHierarchy::where('PMRHHHierarchyId', $MemStatutoryDeductionSlabHeader->PMDSHHierarchyId)
            ->get(['PMRHHDesc1'])
            ->first();
        $DeductionType = DeductionType::where('PMDTHDeductionIdK', $MemStatutoryDeductionSlabHeader->PMDSHRuleId)
        ->get()
        ->first();
        // Get Foreign Keys Description Ends*****
        return $output = array(
            // For Delete Button and Delete Detail Entry Form
            'uniqueIdMDateChange'           =>  $MemStatutoryDeductionSlabHeader->PMDSHUniqueIdM,
            'geographicIdDateChange'        =>  $MemStatutoryDeductionSlabHeader->PMDSHGeographicId,
            'genderIdDateChange'            =>  $MemStatutoryDeductionSlabHeader->PMDSHGenderId,
            'currentStartDate'          =>  $MemStatutoryDeductionSlabHeader->PMDSHEffectiveFrom,
            'currentEndDate'            =>  $MemStatutoryDeductionSlabHeader->PMDSHEffectiveTo,
            'expiryDate'                =>  $MemStatutoryDeductionSlabHeader->PMDSHEffectiveTo,
            'PMDSHUniqueIdDateChange'       =>  $PMDSHUniqueId,
            // For Edit Button and Sub Form Header Window
            'PMDSHUniqueIdM'            =>  $MemStatutoryDeductionSlabHeader->PMDSHUniqueIdM,
            'PMDTHApplicableForH'       =>  $DeductionType->PMDTHApplicableFor,
            'PMDSHRuleIdH'              =>  $MemStatutoryDeductionSlabHeader->PMDSHRuleId,
            'PMDSHDesc1H'               =>  $MemStatutoryDeductionSlabHeader->PMDSHDesc1,
            'PMDSHHierarchyIdH'         =>  $MemStatutoryDeductionSlabHeader->PMDSHHierarchyId,
            'HierarchyDescH'            =>  $HierarchyDesc->PMRHHDesc1,
            'PMDSHEffectiveFrom'        =>  $MemStatutoryDeductionSlabHeader->PMDSHEffectiveFrom,
            'PMDSHEffectiveTo'          =>  $MemStatutoryDeductionSlabHeader->PMDSHEffectiveTo,
            'PMDSHGeographicId'         =>  $MemStatutoryDeductionSlabHeader->PMDSHGeographicId,
            'PMDSHGenderId'             =>  $MemStatutoryDeductionSlabHeader->PMDSHGenderId,
        );
    }
    public function PMSDS11UpdateExpirtyDateTrait($request){
        // echo 'Data Submitted : ';
        // print_r($request);
        // die();
        // Update Header Table for this UniqueId
        $MemStatutoryDeductionSlabHeader = MemStatutoryDeductionSlabHeader::find($request->PMDSHUniqueIdDateChange);
        if ($MemStatutoryDeductionSlabHeader != '') {
            $MemStatutoryDeductionSlabHeader->PMDSHEffectiveTo =   $request->expiryDate;
            $MemStatutoryDeductionSlabHeader->PMDSHUser        =   Auth::user()->name;
            $MemStatutoryDeductionSlabHeader->PMDSHStatusId    =   9900;
            $MemStatutoryDeductionSlabHeader->PMDSHLastUpdated =   Carbon::now();
            $MemStatutoryDeductionSlabHeader->save();
        }
        // Update Detail Table for this UniqueId
        $MemStatutoryDeductionSlabDetail = MemStatutoryDeductionSlabDetail::where('PMDSDUniqueIdM', $request->uniqueIdMDateChange)
        ->where('PMDSDGeographicId', $request->geographicIdDateChange)
        ->where('PMDSDGenderId', $request->genderIdDateChange)
        ->where('PMDSDEffectiveFrom', $request->currentStartDate)
        ->where('PMDSDEffectiveTo', $request->currentEndDate)
        ->get();
        foreach ($MemStatutoryDeductionSlabDetail as $value) {
            $value->PMDSDEffectiveTo    = $request->expiryDate;
            $value->PMDSDUser               = Auth::user()->name;
            $value->PMDSDStatusId           = 9900;
            $value->PMDSDLastUpdated          = Carbon::now();
            $value->save();
        };
        return;
    }
    # Date Change Header Sub Form Record Events End*****
    #-----------------------------------------------------------------------------------------------------------------
    public function PMSDS11DeleteHeaderDetailTrait($request){
        // Delete Mem Header
        $headerTable = MemStatutoryDeductionSlabHeader::find($request->id);

        $headerTable->PMDSHMarkForDeletion    = 1;
        $headerTable->PMDSHUser               = Auth::user()->name;
        $headerTable->PMDSHStatusId           = 9910;
        $headerTable->PMDSHDeletedAt          = Carbon::now();
        $headerTable->save();

        // Delete Mem Detail
        $MemStatutoryDeductionSlabDetail = MemStatutoryDeductionSlabDetail::where('PMDSDRuleId', $headerTable->PMDSHRuleId)
        ->where('PMDSDGeographicId', $headerTable->PMDSHGeographicId)
        ->where('PMDSDGenderId', $headerTable->PMDSHGenderId)
        ->where('PMDSDEffectiveFrom', $headerTable->PMDSHEffectiveFrom)
        ->where('PMDSDEffectiveTo', $headerTable->PMDSHEffectiveTo)
        ->get();

        foreach ($MemStatutoryDeductionSlabDetail as $detailTable) {
            $detailTable->PMDSDMarkForDeletion    = 1;
            $detailTable->PMDSDUser               = Auth::user()->name;
            $detailTable->PMDSDStatusId           = 9910;
            $detailTable->PMDSDDeletedAt          = Carbon::now();
            $detailTable->save();
        };

        return;
    }
    #-----------------------------------------------------------------------------------------------------------------
    // Detail Sub Form Events
    public function PMSDS11FetchSubFormDetailTrait($request){
        $MemStatutoryDeductionSlabDetail = MemStatutoryDeductionSlabDetail::where('PMDSDUniqueId', $request->id)
        ->get()
        ->first();
        return $output = array(
            // For Delete Button and Delete Detail Entry Form
            'LineId'    =>  $MemStatutoryDeductionSlabDetail->PMDSDLineId,
            'IncomeTo'  =>  $MemStatutoryDeductionSlabDetail->PMDSDIncomeTo,
        );
    }
    public function PMSDS11CountSubFormDetailTrait($request){
        $GenderId = $request->PMDSHGenderId;
        if ($request->PMDTHApplicableFor == 'C') {
            $GenderId = 'C';
        }
        $LoginId = Auth::user()->name;
        return $MemStatutoryDeductionSlabDetail = MemStatutoryDeductionSlabDetail::where('PMDSDRuleId', $request->PMDSHRuleId)
        ->where('PMDSDGeographicId', $request->PMDSHGeographicId)
        ->where('PMDSDGenderId', $GenderId)
        ->where('PMDSDEffectiveFrom', $request->PMDSHEffectiveFrom)
        ->where('PMDSDEffectiveTo', $request->PMDSHEffectiveTo)
        ->where('PMDSDUser', $LoginId)
        ->count();
    }
    public function PMSDS11DeleteThisRowTrait($request){
        $MemStatutoryDeductionSlabDetail = MemStatutoryDeductionSlabDetail::where('PMDSDUniqueId', $request->id)
        ->delete();
        return;
    }
    public function PMSDS11FetchSubFormDetailEditTrait($request){
        $MemStatutoryDeductionSlabDetail = MemStatutoryDeductionSlabDetail::where('PMDSDUniqueId', $request->id)
        ->get()
        ->first();
        return $output = array(
            'PMDSDUniqueId'         =>  $MemStatutoryDeductionSlabDetail->PMDSDUniqueId,
            'PMDSDUniqueIdM'        =>  $MemStatutoryDeductionSlabDetail->PMDSDUniqueIdM,
            'PMDSDLineId'           =>  $MemStatutoryDeductionSlabDetail->PMDSDLineId,
            'PMDSDRuleId'           =>  $MemStatutoryDeductionSlabDetail->PMDSDRuleId,
            'PMDSDDesc1'            =>  $MemStatutoryDeductionSlabDetail->PMDSDDesc1,
            'PMDSDHierarchyId'      =>  $MemStatutoryDeductionSlabDetail->PMDSDHierarchyId,
            'PMDSDGeographicId'     =>  $MemStatutoryDeductionSlabDetail->PMDSDGeographicId,
            'PMDSDGenderId'         =>  $MemStatutoryDeductionSlabDetail->PMDSDGenderId,
            'PMDSDEffectiveFrom'    =>  $MemStatutoryDeductionSlabDetail->PMDSDEffectiveFrom,
            'PMDSDEffectiveTo'      =>  $MemStatutoryDeductionSlabDetail->PMDSDEffectiveTo,

            'PMDSDIncomeFrom'       =>  $MemStatutoryDeductionSlabDetail->PMDSDIncomeFrom,
            'PMDSDIncomeTo'         =>  $MemStatutoryDeductionSlabDetail->PMDSDIncomeTo,
            'PMDSDEmpContriAmount'  =>  $MemStatutoryDeductionSlabDetail->PMDSDEmpContriAmount,
            'PMDSDCompContriAmount' =>  $MemStatutoryDeductionSlabDetail->PMDSDCompContriAmount,
            'PMDSDEmpContriType'    =>  $MemStatutoryDeductionSlabDetail->PMDSDEmpContriType,
            'PMDSDCompContriType'   =>  $MemStatutoryDeductionSlabDetail->PMDSDCompContriType,
        );
    }
    #-----------------------------------------------------------------------------------------------------------------

}