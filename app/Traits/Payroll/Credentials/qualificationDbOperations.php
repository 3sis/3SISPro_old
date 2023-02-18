<?php
namespace app\Traits\Payroll\Credentials;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\Credentials\Qualification;
// Qualification Master
// CMQUH11 : Credentials Qualification of Payrall
trait qualificationDbOperations {        
     
     public function CMQUH11BrowserDataTrait() 
     { 
         return $browserData = Qualification::where('CMQUHMarkForDeletion', 0)
         ->get([
            'CMQUHUniqueId', 
            'CMQUHDegreeId',
            'CMQUHDesc1',
            'CMQUHDesc2',
            'CMQUHUser',
            'CMQUHLastUpdated'
         ]);
     }
     public function CMQUH11AddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $Qualification = new Qualification;                
            $Qualification->CMQUHDegreeId    =   $request->CMQUHDegreeId;            
            $Qualification->CMQUHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $Qualification = Qualification::find($request->get('CMQUHUniqueId'));
        }
        $Qualification->CMQUHDesc1                =   $request->CMQUHDesc1;
        $Qualification->CMQUHDesc2                =   $request->CMQUHDesc2;
        $Qualification->CMQUHBiDesc               =   $request->CMQUHBiDesc;
        $Qualification->CMQUHMarkForDeletion      =   0;
        $Qualification->CMQUHUser                 =   Auth::user()->name;
        $Qualification->CMQUHLastUpdated          =   Carbon::now();
        $Qualification->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $Qualification->CMQUHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('CMQUHUniqueId');
        }
        return $UniqueId; 
     }
     public function CMQUH11FethchEditedDataTrait($request)
     {
        $CMQUHUniqueId = $request->input('id');
        $Qualification = Qualification::find($CMQUHUniqueId);
        return $output = array(
            // General Info
            'CMQUHUniqueId'             =>  $Qualification->CMQUHUniqueId,
            'CMQUHDegreeId'         =>  $Qualification->CMQUHDegreeId,
            'CMQUHDesc1'                =>  $Qualification->CMQUHDesc1,
            'CMQUHDesc2'                =>  $Qualification->CMQUHDesc2,
            'CMQUHBiDesc'               =>  $Qualification->CMQUHBiDesc,
            'CMQUHUser'                 =>  $Qualification->CMQUHUser,
            'CMQUHLastCreated'          =>  $Qualification->CMQUHLastCreated,
            'CMQUHLastUpdated'          =>  $Qualification->CMQUHLastUpdated
        );
     }
     public function CMQUH11DeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $Qualification = Qualification::find($UniqueId);
        //Eloquent Way
        $Qualification->CMQUHMarkForDeletion   =   1;
        $Qualification->CMQUHUser              =   Auth::user()->name;
        $Qualification->CMQUHDeletedAt         =  Carbon::now();
        $Qualification->save();        
        return $Qualification->CMQUHDegreeId;
     }
     public function CMQUH11BrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = Qualification::
         select(
             'CMQUHUniqueId', 
             'CMQUHDegreeId',
             'CMQUHDesc1', 
             'CMQUHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('CMQUHMarkForDeletion', 1);
     }     
     public function CMQUH11UnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $Qualification = Qualification::find($UniqueId);
         $Qualification->CMQUHMarkForDeletion   =   0;
         $Qualification->CMQUHUser              =   Auth::user()->name;
         $Qualification->CMQUHDeletedAt         =  Null;
         $Qualification->save();        
         return $Qualification->CMQUHDegreeId;
     }  
}