<?php
namespace app\Traits\Payroll\GeneralMaster;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\GeneralMaster\ReligionMaster;
// ReligionMaster Master
// gmrl11 : Gneral Master ReligionMaster of Payrall
trait religionDbOperations {        
     
     public function gmrl11BrowserDataTrait() 
     { 
         return $browserData = ReligionMaster::where('GMRLHMarkForDeletion', 0)
         ->get([
            'GMRLHUniqueId', 
            'GMRLHReligionId',
            'GMRLHDesc1',
            'GMRLHDesc2',
            'GMRLHUser',
            'GMRLHLastUpdated'
         ]);
     }
     public function gmrl11AddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $ReligionMaster = new ReligionMaster;                
            $ReligionMaster->GMRLHReligionId    =   $request->GMRLHReligionId;            
            $ReligionMaster->GMRLHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $ReligionMaster = ReligionMaster::find($request->get('GMRLHUniqueId'));
        }
        $ReligionMaster->GMRLHDesc1                =   $request->GMRLHDesc1;
        $ReligionMaster->GMRLHDesc2                =   $request->GMRLHDesc2;
        $ReligionMaster->GMRLHBiDesc               =   $request->GMRLHBiDesc;
        $ReligionMaster->GMRLHMarkForDeletion      =   0;
        $ReligionMaster->GMRLHUser                 =   Auth::user()->name;
        $ReligionMaster->GMRLHLastUpdated          =   Carbon::now();
        $ReligionMaster->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $ReligionMaster->GMRLHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('GMRLHUniqueId');
        }
        return $UniqueId; 
     }
     public function gmrl11FethchEditedDataTrait($request)
     {
        $GMRLHUniqueId = $request->input('id');
        $ReligionMaster = ReligionMaster::find($GMRLHUniqueId);
        return $output = array(
            // General Info
            'GMRLHUniqueId'             =>  $ReligionMaster->GMRLHUniqueId,
            'GMRLHReligionId'         =>  $ReligionMaster->GMRLHReligionId,
            'GMRLHDesc1'                =>  $ReligionMaster->GMRLHDesc1,
            'GMRLHDesc2'                =>  $ReligionMaster->GMRLHDesc2,
            'GMRLHBiDesc'               =>  $ReligionMaster->GMRLHBiDesc,
            'GMRLHUser'                 =>  $ReligionMaster->GMRLHUser,
            'GMRLHLastCreated'          =>  $ReligionMaster->GMRLHLastCreated,
            'GMRLHLastUpdated'          =>  $ReligionMaster->GMRLHLastUpdated
        );
     }
     public function gmrl11DeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $ReligionMaster = ReligionMaster::find($UniqueId);
        //Eloquent Way
        $ReligionMaster->GMRLHMarkForDeletion   =   1;
        $ReligionMaster->GMRLHUser              =   Auth::user()->name;
        $ReligionMaster->GMRLHDeletedAt         =  Carbon::now();
        $ReligionMaster->save();        
        return $ReligionMaster->GMRLHReligionId;
     }
     public function gmrl11BrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = ReligionMaster::
         select(
             'GMRLHUniqueId', 
             'GMRLHReligionId',
             'GMRLHDesc1', 
             'GMRLHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('GMRLHMarkForDeletion', 1);
     }     
     public function gmrl11UnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $ReligionMaster = ReligionMaster::find($UniqueId);
         $ReligionMaster->GMRLHMarkForDeletion   =   0;
         $ReligionMaster->GMRLHUser              =   Auth::user()->name;
         $ReligionMaster->GMRLHDeletedAt         =  Null;
         $ReligionMaster->save();        
         return $ReligionMaster->GMRLHReligionId;
     }   
     
}