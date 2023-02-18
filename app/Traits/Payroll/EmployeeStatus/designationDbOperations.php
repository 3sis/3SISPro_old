<?php
namespace app\Traits\Payroll\EmployeeStatus;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\EmployeeStatus\Designation;
// Designation Master
// ESDEH11 : Employee Status Designation of Payrall
trait designationDbOperations {        
     
     public function ESDEH11BrowserDataTrait() 
     { 
         return $browserData = Designation::where('ESDEHMarkForDeletion', 0)
         ->get([
            'ESDEHUniqueId', 
            'ESDEHDesignationId',
            'ESDEHDesc1',
            'ESDEHDesc2',
            'ESDEHUser',
            'ESDEHLastUpdated'
         ]);
     }
     public function ESDEH11AddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $Designation = new Designation;                
            $Designation->ESDEHDesignationId    =   $request->ESDEHDesignationId;            
            $Designation->ESDEHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $Designation = Designation::find($request->get('ESDEHUniqueId'));
        }
        $Designation->ESDEHDesc1                =   $request->ESDEHDesc1;
        $Designation->ESDEHDesc2                =   $request->ESDEHDesc2;
        $Designation->ESDEHBiDesc               =   $request->ESDEHBiDesc;
        $Designation->ESDEHMarkForDeletion      =   0;
        $Designation->ESDEHUser                 =   Auth::user()->name;
        $Designation->ESDEHLastUpdated          =   Carbon::now();
        $Designation->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $Designation->ESDEHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('ESDEHUniqueId');
        }
        return $UniqueId; 
     }
     public function ESDEH11FethchEditedDataTrait($request)
     {
        $ESDEHUniqueId = $request->input('id');
        $Designation = Designation::find($ESDEHUniqueId);
        return $output = array(
            // General Info
            'ESDEHUniqueId'             =>  $Designation->ESDEHUniqueId,
            'ESDEHDesignationId'         =>  $Designation->ESDEHDesignationId,
            'ESDEHDesc1'                =>  $Designation->ESDEHDesc1,
            'ESDEHDesc2'                =>  $Designation->ESDEHDesc2,
            'ESDEHBiDesc'               =>  $Designation->ESDEHBiDesc,
            'ESDEHUser'                 =>  $Designation->ESDEHUser,
            'ESDEHLastCreated'          =>  $Designation->ESDEHLastCreated,
            'ESDEHLastUpdated'          =>  $Designation->ESDEHLastUpdated
        );
     }
     public function ESDEH11DeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $Designation = Designation::find($UniqueId);
        //Eloquent Way
        $Designation->ESDEHMarkForDeletion   =   1;
        $Designation->ESDEHUser              =   Auth::user()->name;
        $Designation->ESDEHDeletedAt         =  Carbon::now();
        $Designation->save();        
        return $Designation->ESDEHDesignationId;
     }
     public function ESDEH11BrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = Designation::
         select(
             'ESDEHUniqueId', 
             'ESDEHDesignationId',
             'ESDEHDesc1', 
             'ESDEHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('ESDEHMarkForDeletion', 1);
     }     
     public function ESDEH11UnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $Designation = Designation::find($UniqueId);
         $Designation->ESDEHMarkForDeletion   =   0;
         $Designation->ESDEHUser              =   Auth::user()->name;
         $Designation->ESDEHDeletedAt         =  Null;
         $Designation->save();        
         return $Designation->ESDEHDesignationId;
     }  
}