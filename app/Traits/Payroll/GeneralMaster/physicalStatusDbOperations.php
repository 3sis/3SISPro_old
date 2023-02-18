<?php
namespace app\Traits\Payroll\GeneralMaster;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\GeneralMaster\PhysicalStatus;
// PhysicalStatus Master
// gmps11 : Gneral Master PhysicalStatus of Payrall
trait physicalStatusDbOperations {        
     
     public function gmps11BrowserDataTrait() 
     { 
         return $browserData = PhysicalStatus::where('GMPSHMarkForDeletion', 0)
         ->get([
            'GMPSHUniqueId', 
            'GMPSHPhysicalStatusId',
            'GMPSHDesc1',
            'GMPSHDesc2',
            'GMPSHUser',
            'GMPSHLastUpdated'
         ]);
     }
     public function gmps11AddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $PhysicalStatus = new PhysicalStatus;                
            $PhysicalStatus->GMPSHPhysicalStatusId    =   $request->GMPSHPhysicalStatusId;            
            $PhysicalStatus->GMPSHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $PhysicalStatus = PhysicalStatus::find($request->get('GMPSHUniqueId'));
        }
        $PhysicalStatus->GMPSHDesc1                =   $request->GMPSHDesc1;
        $PhysicalStatus->GMPSHDesc2                =   $request->GMPSHDesc2;
        $PhysicalStatus->GMPSHBiDesc               =   $request->GMPSHBiDesc;
        $PhysicalStatus->GMPSHMarkForDeletion      =   0;
        $PhysicalStatus->GMPSHUser                 =   Auth::user()->name;
        $PhysicalStatus->GMPSHLastUpdated          =   Carbon::now();
        $PhysicalStatus->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $PhysicalStatus->GMPSHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('GMPSHUniqueId');
        }
        return $UniqueId; 
     }
     public function gmps11FethchEditedDataTrait($request)
     {
        $GMPSHUniqueId = $request->input('id');
        $PhysicalStatus = PhysicalStatus::find($GMPSHUniqueId);
        return $output = array(
            // General Info
            'GMPSHUniqueId'             =>  $PhysicalStatus->GMPSHUniqueId,
            'GMPSHPhysicalStatusId'         =>  $PhysicalStatus->GMPSHPhysicalStatusId,
            'GMPSHDesc1'                =>  $PhysicalStatus->GMPSHDesc1,
            'GMPSHDesc2'                =>  $PhysicalStatus->GMPSHDesc2,
            'GMPSHBiDesc'               =>  $PhysicalStatus->GMPSHBiDesc,
            'GMPSHUser'                 =>  $PhysicalStatus->GMPSHUser,
            'GMPSHLastCreated'          =>  $PhysicalStatus->GMPSHLastCreated,
            'GMPSHLastUpdated'          =>  $PhysicalStatus->GMPSHLastUpdated
        );
     }
     public function gmps11DeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $PhysicalStatus = PhysicalStatus::find($UniqueId);
        //Eloquent Way
        $PhysicalStatus->GMPSHMarkForDeletion   =   1;
        $PhysicalStatus->GMPSHUser              =   Auth::user()->name;
        $PhysicalStatus->GMPSHDeletedAt         =  Carbon::now();
        $PhysicalStatus->save();        
        return $PhysicalStatus->GMPSHPhysicalStatusId;
     }
     public function gmps11BrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = PhysicalStatus::
         select(
             'GMPSHUniqueId', 
             'GMPSHPhysicalStatusId',
             'GMPSHDesc1', 
             'GMPSHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('GMPSHMarkForDeletion', 1);
     }     
     public function gmps11UnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $PhysicalStatus = PhysicalStatus::find($UniqueId);
         $PhysicalStatus->GMPSHMarkForDeletion   =   0;
         $PhysicalStatus->GMPSHUser              =   Auth::user()->name;
         $PhysicalStatus->GMPSHDeletedAt         =  Null;
         $PhysicalStatus->save();        
         return $PhysicalStatus->GMPSHPhysicalStatusId;
     }   
     
}