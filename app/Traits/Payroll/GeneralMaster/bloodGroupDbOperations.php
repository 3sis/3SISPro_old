<?php
namespace app\Traits\Payroll\GeneralMaster;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\GeneralMaster\BloodGroup;
// BloodGroup Master
// gmbg11 : Gneral Master BloodGroup of Payrall
trait bloodGroupDbOperations {        
     
     public function gmbg11BrowserDataTrait() 
     { 
         return $browserData = BloodGroup::where('GMBGHMarkForDeletion', 0)
         ->get([
            'GMBGHUniqueId', 
            'GMBGHBloodGroupId',
            'GMBGHDesc1',
            'GMBGHDesc2',
            'GMBGHUser',
            'GMBGHLastUpdated'
         ]);
     }
     public function gmbg11AddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $BloodGroup = new BloodGroup;                
            $BloodGroup->GMBGHBloodGroupId    =   $request->GMBGHBloodGroupId;            
            $BloodGroup->GMBGHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $BloodGroup = BloodGroup::find($request->get('GMBGHUniqueId'));
        }
        $BloodGroup->GMBGHDesc1                =   $request->GMBGHDesc1;
        $BloodGroup->GMBGHDesc2                =   $request->GMBGHDesc2;
        $BloodGroup->GMBGHBiDesc               =   $request->GMBGHBiDesc;
        $BloodGroup->GMBGHMarkForDeletion      =   0;
        $BloodGroup->GMBGHUser                 =   Auth::user()->name;
        $BloodGroup->GMBGHLastUpdated          =   Carbon::now();
        $BloodGroup->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $BloodGroup->GMBGHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('GMBGHUniqueId');
        }
        return $UniqueId; 
     }
     public function gmbg11FethchEditedDataTrait($request)
     {
        $GMBGHUniqueId = $request->input('id');
        $BloodGroup = BloodGroup::find($GMBGHUniqueId);
        return $output = array(
            // General Info
            'GMBGHUniqueId'             =>  $BloodGroup->GMBGHUniqueId,
            'GMBGHBloodGroupId'         =>  $BloodGroup->GMBGHBloodGroupId,
            'GMBGHDesc1'                =>  $BloodGroup->GMBGHDesc1,
            'GMBGHDesc2'                =>  $BloodGroup->GMBGHDesc2,
            'GMBGHBiDesc'               =>  $BloodGroup->GMBGHBiDesc,
            'GMBGHUser'                 =>  $BloodGroup->GMBGHUser,
            'GMBGHLastCreated'          =>  $BloodGroup->GMBGHLastCreated,
            'GMBGHLastUpdated'          =>  $BloodGroup->GMBGHLastUpdated
        );
     }
     public function gmbg11DeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $BloodGroup = BloodGroup::find($UniqueId);
        //Eloquent Way
        $BloodGroup->GMBGHMarkForDeletion   =   1;
        $BloodGroup->GMBGHUser              =   Auth::user()->name;
        $BloodGroup->GMBGHDeletedAt         =  Carbon::now();
        $BloodGroup->save();        
        return $BloodGroup->GMBGHBloodGroupId;
     }
     public function gmbg11BrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = BloodGroup::
         select(
             'GMBGHUniqueId', 
             'GMBGHBloodGroupId',
             'GMBGHDesc1', 
             'GMBGHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('GMBGHMarkForDeletion', 1);
     }     
     public function gmbg11UnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $BloodGroup = BloodGroup::find($UniqueId);
         $BloodGroup->GMBGHMarkForDeletion   =   0;
         $BloodGroup->GMBGHUser              =   Auth::user()->name;
         $BloodGroup->GMBGHDeletedAt         =  Null;
         $BloodGroup->save();        
         return $BloodGroup->GMBGHBloodGroupId;
     }   
     
}