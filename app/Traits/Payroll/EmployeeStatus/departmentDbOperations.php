<?php
namespace app\Traits\Payroll\EmployeeStatus;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\EmployeeStatus\Department;
// Department Master
// ESDPH11 : Employee Status Department of Payrall
trait departmentDbOperations {        
     
     public function ESDPH11BrowserDataTrait() 
     { 
         return $browserData = Department::where('ESDPHMarkForDeletion', 0)
         ->get([
            'ESDPHUniqueId', 
            'ESDPHDepartmentId',
            'ESDPHDesc1',
            'ESDPHDesc2',
            'ESDPHUser',
            'ESDPHLastUpdated'
         ]);
     }
     public function ESDPH11AddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $Department = new Department;                
            $Department->ESDPHDepartmentId    =   $request->ESDPHDepartmentId;            
            $Department->ESDPHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $Department = Department::find($request->get('ESDPHUniqueId'));
        }
        $Department->ESDPHDesc1                =   $request->ESDPHDesc1;
        $Department->ESDPHDesc2                =   $request->ESDPHDesc2;
        $Department->ESDPHBiDesc               =   $request->ESDPHBiDesc;
        $Department->ESDPHMarkForDeletion      =   0;
        $Department->ESDPHUser                 =   Auth::user()->name;
        $Department->ESDPHLastUpdated          =   Carbon::now();
        $Department->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $Department->ESDPHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('ESDPHUniqueId');
        }
        return $UniqueId; 
     }
     public function ESDPH11FethchEditedDataTrait($request)
     {
        $ESDPHUniqueId = $request->input('id');
        $Department = Department::find($ESDPHUniqueId);
        return $output = array(
            // General Info
            'ESDPHUniqueId'             =>  $Department->ESDPHUniqueId,
            'ESDPHDepartmentId'         =>  $Department->ESDPHDepartmentId,
            'ESDPHDesc1'                =>  $Department->ESDPHDesc1,
            'ESDPHDesc2'                =>  $Department->ESDPHDesc2,
            'ESDPHBiDesc'               =>  $Department->ESDPHBiDesc,
            'ESDPHUser'                 =>  $Department->ESDPHUser,
            'ESDPHLastCreated'          =>  $Department->ESDPHLastCreated,
            'ESDPHLastUpdated'          =>  $Department->ESDPHLastUpdated
        );
     }
     public function ESDPH11DeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $Department = Department::find($UniqueId);
        //Eloquent Way
        $Department->ESDPHMarkForDeletion   =   1;
        $Department->ESDPHUser              =   Auth::user()->name;
        $Department->ESDPHDeletedAt         =  Carbon::now();
        $Department->save();        
        return $Department->ESDPHDepartmentId;
     }
     public function ESDPH11BrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = Department::
         select(
             'ESDPHUniqueId', 
             'ESDPHDepartmentId',
             'ESDPHDesc1', 
             'ESDPHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('ESDPHMarkForDeletion', 1);
     }     
     public function ESDPH11UnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $Department = Department::find($UniqueId);
         $Department->ESDPHMarkForDeletion   =   0;
         $Department->ESDPHUser              =   Auth::user()->name;
         $Department->ESDPHDeletedAt         =  Null;
         $Department->save();        
         return $Department->ESDPHDepartmentId;
     }  
}