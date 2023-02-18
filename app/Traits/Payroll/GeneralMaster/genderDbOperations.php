<?php
namespace app\Traits\Payroll\GeneralMaster;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\GeneralMaster\Gender;
// Gender Master
// gmgd11 : Gneral Master Gender of Payrall
trait genderDbOperations {        
     
     public function gmgd11BrowserDataTrait() 
     { 
         return $browserData = Gender::where('GMGDHMarkForDeletion', 0)
         ->get([
            'GMGDHUniqueId', 
            'GMGDHGenderId',
            'GMGDHDesc1',
            'GMGDHDesc2',
            'GMGDHUser',
            'GMGDHLastUpdated'
         ]);
     }
     public function gmgd11AddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $Gender = new Gender;                
            $Gender->GMGDHGenderId    =   $request->GMGDHGenderId;            
            $Gender->GMGDHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $Gender = Gender::find($request->get('GMGDHUniqueId'));
        }
        $Gender->GMGDHDesc1                =   $request->GMGDHDesc1;
        $Gender->GMGDHDesc2                =   $request->GMGDHDesc2;
        $Gender->GMGDHBiDesc               =   $request->GMGDHBiDesc;
        $Gender->GMGDHMarkForDeletion      =   0;
        $Gender->GMGDHUser                 =   Auth::user()->name;
        $Gender->GMGDHLastUpdated          =   Carbon::now();
        $Gender->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $Gender->GMGDHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('GMGDHUniqueId');
        }
        return $UniqueId; 
     }
     public function gmgd11FethchEditedDataTrait($request)
     {
        $GMGDHUniqueId = $request->input('id');
        $Gender = Gender::find($GMGDHUniqueId);
        return $output = array(
            // General Info
            'GMGDHUniqueId'             =>  $Gender->GMGDHUniqueId,
            'GMGDHGenderId'         =>  $Gender->GMGDHGenderId,
            'GMGDHDesc1'                =>  $Gender->GMGDHDesc1,
            'GMGDHDesc2'                =>  $Gender->GMGDHDesc2,
            'GMGDHBiDesc'               =>  $Gender->GMGDHBiDesc,
            'GMGDHUser'                 =>  $Gender->GMGDHUser,
            'GMGDHLastCreated'          =>  $Gender->GMGDHLastCreated,
            'GMGDHLastUpdated'          =>  $Gender->GMGDHLastUpdated
        );
     }
     public function gmgd11DeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $Gender = Gender::find($UniqueId);
        //Eloquent Way
        $Gender->GMGDHMarkForDeletion   =   1;
        $Gender->GMGDHUser              =   Auth::user()->name;
        $Gender->GMGDHDeletedAt         =  Carbon::now();
        $Gender->save();        
        return $Gender->GMGDHGenderId;
     }
     public function gmgd11BrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = Gender::
         select(
             'GMGDHUniqueId', 
             'GMGDHGenderId',
             'GMGDHDesc1', 
             'GMGDHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('GMGDHMarkForDeletion', 1);
     }     
     public function gmgd11UnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $Gender = Gender::find($UniqueId);
         $Gender->GMGDHMarkForDeletion   =   0;
         $Gender->GMGDHUser              =   Auth::user()->name;
         $Gender->GMGDHDeletedAt         =  Null;
         $Gender->save();        
         return $Gender->GMGDHGenderId;
     }   
     
}