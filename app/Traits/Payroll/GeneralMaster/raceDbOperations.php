<?php
namespace app\Traits\Payroll\GeneralMaster;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\GeneralMaster\RaceGroup;
// RaceGroup Master
// gmra11 : Gneral Master RaceGroup of Payrall
trait raceDbOperations {        
     
     public function gmra11BrowserDataTrait() 
     { 
         return $browserData = RaceGroup::where('GMRAHMarkForDeletion', 0)
         ->get([
            'GMRAHUniqueId', 
            'GMRAHRaceId',
            'GMRAHDesc1',
            'GMRAHDesc2',
            'GMRAHUser',
            'GMRAHLastUpdated'
         ]);
     }
     public function gmra11AddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $RaceGroup = new RaceGroup;                
            $RaceGroup->GMRAHRaceId    =   $request->GMRAHRaceId;            
            $RaceGroup->GMRAHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $RaceGroup = RaceGroup::find($request->get('GMRAHUniqueId'));
        }
        $RaceGroup->GMRAHDesc1                =   $request->GMRAHDesc1;
        $RaceGroup->GMRAHDesc2                =   $request->GMRAHDesc2;
        $RaceGroup->GMRAHBiDesc               =   $request->GMRAHBiDesc;
        $RaceGroup->GMRAHMarkForDeletion      =   0;
        $RaceGroup->GMRAHUser                 =   Auth::user()->name;
        $RaceGroup->GMRAHLastUpdated          =   Carbon::now();
        $RaceGroup->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $RaceGroup->GMRAHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('GMRAHUniqueId');
        }
        return $UniqueId; 
     }
     public function gmra11FethchEditedDataTrait($request)
     {
        $GMRAHUniqueId = $request->input('id');
        $RaceGroup = RaceGroup::find($GMRAHUniqueId);
        return $output = array(
            // General Info
            'GMRAHUniqueId'             =>  $RaceGroup->GMRAHUniqueId,
            'GMRAHRaceId'         =>  $RaceGroup->GMRAHRaceId,
            'GMRAHDesc1'                =>  $RaceGroup->GMRAHDesc1,
            'GMRAHDesc2'                =>  $RaceGroup->GMRAHDesc2,
            'GMRAHBiDesc'               =>  $RaceGroup->GMRAHBiDesc,
            'GMRAHUser'                 =>  $RaceGroup->GMRAHUser,
            'GMRAHLastCreated'          =>  $RaceGroup->GMRAHLastCreated,
            'GMRAHLastUpdated'          =>  $RaceGroup->GMRAHLastUpdated
        );
     }
     public function gmra11DeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $RaceGroup = RaceGroup::find($UniqueId);
        //Eloquent Way
        $RaceGroup->GMRAHMarkForDeletion   =   1;
        $RaceGroup->GMRAHUser              =   Auth::user()->name;
        $RaceGroup->GMRAHDeletedAt         =  Carbon::now();
        $RaceGroup->save();        
        return $RaceGroup->GMRAHRaceId;
     }
     public function gmra11BrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = RaceGroup::
         select(
             'GMRAHUniqueId', 
             'GMRAHRaceId',
             'GMRAHDesc1', 
             'GMRAHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('GMRAHMarkForDeletion', 1);
     }     
     public function gmra11UnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $RaceGroup = RaceGroup::find($UniqueId);
         $RaceGroup->GMRAHMarkForDeletion   =   0;
         $RaceGroup->GMRAHUser              =   Auth::user()->name;
         $RaceGroup->GMRAHDeletedAt         =  Null;
         $RaceGroup->save();        
         return $RaceGroup->GMRAHRaceId;
     }   
     
}