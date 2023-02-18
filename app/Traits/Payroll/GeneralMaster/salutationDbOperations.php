<?php
namespace app\Traits\Payroll\GeneralMaster;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\GeneralMaster\Salutation;
// Salutation Master
// gmsl11 : Gneral Master Salutation of Payrall
trait salutationDbOperations {        
     
     public function gmsl11BrowserDataTrait() 
     { 
         return $browserData = Salutation::where('GMSLHMarkForDeletion', 0)
         ->get([
            'GMSLHUniqueId', 
            'GMSLHSalutationId',
            'GMSLHDesc1',
            'GMSLHDesc2',
            'GMSLHUser',
            'GMSLHLastUpdated'
         ]);
     }
     public function gmsl11AddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $Salutation = new Salutation;                
            $Salutation->GMSLHSalutationId    =   $request->GMSLHSalutationId;            
            $Salutation->GMSLHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $Salutation = Salutation::find($request->get('GMSLHUniqueId'));
        }
        $Salutation->GMSLHDesc1                =   $request->GMSLHDesc1;
        $Salutation->GMSLHDesc2                =   $request->GMSLHDesc2;
        $Salutation->GMSLHBiDesc               =   $request->GMSLHBiDesc;
        $Salutation->GMSLHMarkForDeletion      =   0;
        $Salutation->GMSLHUser                 =   Auth::user()->name;
        $Salutation->GMSLHLastUpdated          =   Carbon::now();
        $Salutation->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $Salutation->GMSLHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('GMSLHUniqueId');
        }
        return $UniqueId; 
     }
     public function gmsl11FethchEditedDataTrait($request)
     {
        $GMSLHUniqueId = $request->input('id');
        $Salutation = Salutation::find($GMSLHUniqueId);
        return $output = array(
            // General Info
            'GMSLHUniqueId'             =>  $Salutation->GMSLHUniqueId,
            'GMSLHSalutationId'         =>  $Salutation->GMSLHSalutationId,
            'GMSLHDesc1'                =>  $Salutation->GMSLHDesc1,
            'GMSLHDesc2'                =>  $Salutation->GMSLHDesc2,
            'GMSLHBiDesc'               =>  $Salutation->GMSLHBiDesc,
            'GMSLHUser'                 =>  $Salutation->GMSLHUser,
            'GMSLHLastCreated'          =>  $Salutation->GMSLHLastCreated,
            'GMSLHLastUpdated'          =>  $Salutation->GMSLHLastUpdated
        );
     }
     public function gmsl11DeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $Salutation = Salutation::find($UniqueId);
        //Eloquent Way
        $Salutation->GMSLHMarkForDeletion   =   1;
        $Salutation->GMSLHUser              =   Auth::user()->name;
        $Salutation->GMSLHDeletedAt         =  Carbon::now();
        $Salutation->save();        
        return $Salutation->GMSLHSalutationId;
     }
     public function gmsl11BrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = Salutation::
         select(
             'GMSLHUniqueId', 
             'GMSLHSalutationId',
             'GMSLHDesc1', 
             'GMSLHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('GMSLHMarkForDeletion', 1);
     }     
     public function gmsl11UnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $Salutation = Salutation::find($UniqueId);
         $Salutation->GMSLHMarkForDeletion   =   0;
         $Salutation->GMSLHUser              =   Auth::user()->name;
         $Salutation->GMSLHDeletedAt         =  Null;
         $Salutation->save();        
         return $Salutation->GMSLHSalutationId;
     }   
     
}