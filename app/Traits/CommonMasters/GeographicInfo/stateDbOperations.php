<?php
namespace app\Traits\CommonMasters\GeographicInfo;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\CommonMasters\GeographicInfo\State;
use App\Models\CommonMasters\GeographicInfo\Country;
// STM : State Master
trait stateDbOperations {        
     
     public function stmBrowserDataTrait() 
     {  
         // L03 :Country Master, L04 :State Master
         return $browserData = State::join('t05901L03', 't05901L03.GMCMHCountryId', '=', 
         't05901L04.GMSMHCountryId')
         ->where('t05901L04.GMSMHMarkForDeletion', 0)
         ->get([
             't05901L04.GMSMHUniqueId',
             't05901L04.GMSMHStateId',
             't05901L03.GMCMHDesc1',
             't05901L04.GMSMHDesc1',
             't05901L04.GMSMHDesc2',
             't05901L04.GMSMHBiDesc',
             't05901L04.GMSMHMarkForDeletion',
             't05901L04.GMSMHUser',
             't05901L04.GMSMHLastCreated',
             't05901L04.GMSMHLastUpdated'
         ]);
     }
     public function stmBrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = State::
         select(
             'GMSMHUniqueId', 
             'GMSMHStateId',
             'GMSMHDesc1', 
             'GMSMHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('GMSMHMarkForDeletion', 1);
     }
     public function stmAddUpdateTrait($request)
     {         
         if($request->get('button_action') == 'insert') {
            $State = new State;                
            $State->GMSMHStateId           =   $request->GMSMHStateId;            
            $State->GMSMHLastCreated       =   Carbon::now();
         }elseif($request->get('button_action') == 'update'){
            $State = State::find($request->get('GMSMHUniqueId'));
         } 
            $State->GMSMHDesc1         =   $request->GMSMHDesc1;
            $State->GMSMHDesc2           =   $request->GMSMHDesc2;
            $State->GMSMHBiDesc            =   $request->GMSMHBiDesc;
            $State->GMSMHCountryId         =   $request->countryId;
            $State->GMSMHMarkForDeletion   =   0;
            $State->GMSMHUser              =   Auth::user()->name;
            $State->GMSMHLastUpdated       =   Carbon::now();
            $State->save(); 
            if($request->get('button_action') == 'insert') {
                $UniqueId = $State->GMSMHUniqueId; 
            }elseif($request->get('button_action') == 'update'){
                $UniqueId = $request->get('GMSMHUniqueId');
            }
            return $UniqueId; 
     }
     public function stmFethchEditedDataTrait($request)
     {
        $GMSMHUniqueId = $request->input('id');
        $State = State::find($GMSMHUniqueId);
        return $output = array(
            'GMSMHUniqueId'     =>  $State->GMSMHUniqueId,
            'GMSMHStateId'      =>  $State->GMSMHStateId,
            'GMSMHDesc1'        =>  $State->GMSMHDesc1,
            'GMSMHDesc2'        =>  $State->GMSMHDesc2,
            'GMSMHBiDesc'       =>  $State->GMSMHBiDesc,
            'GMSMHCountryId'    =>  $State->GMSMHCountryId,
            'GMSMHUser'         =>  $State->GMSMHUser,
            'GMSMHLastCreated'  =>  $State->GMSMHLastCreated,
            'GMSMHLastUpdated'  =>  $State->GMSMHLastUpdated

        );
     }
     public function stmDeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $State = State::find($UniqueId);
        //Eloquent Way
        $State->GMSMHMarkForDeletion   =   1;
        $State->GMSMHUser               =   Auth::user()->name;
        $State->GMSMHDeletedAt         =  Carbon::now();
        $State->save();        
        return $State->GMSMHStateId;
     }
     public function stmUnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $State = State::find($UniqueId);
         $State->GMSMHMarkForDeletion   =   0;
         $State->GMSMHUser               =   Auth::user()->name;
         $State->GMSMHDeletedAt         =  Null;
         $State->save();        
         return $State->GMSMHStateId;
     }   
     
}
//State Master Ends*****