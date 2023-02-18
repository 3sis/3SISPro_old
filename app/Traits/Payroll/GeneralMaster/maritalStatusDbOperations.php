<?php
namespace app\Traits\Payroll\GeneralMaster;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\GeneralMaster\MaritalStatus;
// MaritalStatus Master
// gmms11 : Gneral Master MaritalStatus of Payrall
trait maritalStatusDbOperations {        
     
     public function gmms11BrowserDataTrait() 
     { 
         return $browserData = MaritalStatus::where('GMMSHMarkForDeletion', 0)
         ->get([
            'GMMSHUniqueId', 
            'GMMSHMaritalStatusId',
            'GMMSHDesc1',
            'GMMSHDesc2',
            'GMMSHUser',
            'GMMSHLastUpdated'
         ]);
     }
     public function gmms11AddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $MaritalStatus = new MaritalStatus;                
            $MaritalStatus->GMMSHMaritalStatusId    =   $request->GMMSHMaritalStatusId;            
            $MaritalStatus->GMMSHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $MaritalStatus = MaritalStatus::find($request->get('GMMSHUniqueId'));
        }
        $MaritalStatus->GMMSHDesc1                =   $request->GMMSHDesc1;
        $MaritalStatus->GMMSHDesc2                =   $request->GMMSHDesc2;
        $MaritalStatus->GMMSHBiDesc               =   $request->GMMSHBiDesc;
        $MaritalStatus->GMMSHMarkForDeletion      =   0;
        $MaritalStatus->GMMSHUser                 =   Auth::user()->name;
        $MaritalStatus->GMMSHLastUpdated          =   Carbon::now();
        $MaritalStatus->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $MaritalStatus->GMMSHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('GMMSHUniqueId');
        }
        return $UniqueId; 
     }
     public function gmms11FethchEditedDataTrait($request)
     {
        $GMMSHUniqueId = $request->input('id');
        $MaritalStatus = MaritalStatus::find($GMMSHUniqueId);
        return $output = array(
            // General Info
            'GMMSHUniqueId'             =>  $MaritalStatus->GMMSHUniqueId,
            'GMMSHMaritalStatusId'         =>  $MaritalStatus->GMMSHMaritalStatusId,
            'GMMSHDesc1'                =>  $MaritalStatus->GMMSHDesc1,
            'GMMSHDesc2'                =>  $MaritalStatus->GMMSHDesc2,
            'GMMSHBiDesc'               =>  $MaritalStatus->GMMSHBiDesc,
            'GMMSHUser'                 =>  $MaritalStatus->GMMSHUser,
            'GMMSHLastCreated'          =>  $MaritalStatus->GMMSHLastCreated,
            'GMMSHLastUpdated'          =>  $MaritalStatus->GMMSHLastUpdated
        );
     }
     public function gmms11DeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $MaritalStatus = MaritalStatus::find($UniqueId);
        //Eloquent Way
        $MaritalStatus->GMMSHMarkForDeletion   =   1;
        $MaritalStatus->GMMSHUser              =   Auth::user()->name;
        $MaritalStatus->GMMSHDeletedAt         =  Carbon::now();
        $MaritalStatus->save();        
        return $MaritalStatus->GMMSHMaritalStatusId;
     }
     public function gmms11BrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = MaritalStatus::
         select(
             'GMMSHUniqueId', 
             'GMMSHMaritalStatusId',
             'GMMSHDesc1', 
             'GMMSHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('GMMSHMarkForDeletion', 1);
     }     
     public function gmms11UnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $MaritalStatus = MaritalStatus::find($UniqueId);
         $MaritalStatus->GMMSHMarkForDeletion   =   0;
         $MaritalStatus->GMMSHUser              =   Auth::user()->name;
         $MaritalStatus->GMMSHDeletedAt         =  Null;
         $MaritalStatus->save();        
         return $MaritalStatus->GMMSHMaritalStatusId;
     }   
     
}