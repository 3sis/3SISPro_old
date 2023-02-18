<?php
namespace app\Traits\Payroll\EmployeeStatus;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\EmployeeStatus\Type;
// Type Master
// ESTYH11 : Employee Status Type of Payrall
trait typeDbOperations {        
     
     public function ESTYH11BrowserDataTrait() 
     { 
         return $browserData = Type::where('ESTYHMarkForDeletion', 0)
         ->get([
            'ESTYHUniqueId', 
            'ESTYHTypeId',
            'ESTYHDesc1',
            'ESTYHDesc2',
            'ESTYHUser',
            'ESTYHLastUpdated'
         ]);
     }
     public function ESTYH11AddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $Type = new Type;                
            $Type->ESTYHTypeId    =   $request->ESTYHTypeId;            
            $Type->ESTYHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $Type = Type::find($request->get('ESTYHUniqueId'));
        }
        $Type->ESTYHDesc1                =   $request->ESTYHDesc1;
        $Type->ESTYHDesc2                =   $request->ESTYHDesc2;
        $Type->ESTYHBiDesc               =   $request->ESTYHBiDesc;
        $Type->ESTYHMarkForDeletion      =   0;
        $Type->ESTYHUser                 =   Auth::user()->name;
        $Type->ESTYHLastUpdated          =   Carbon::now();
        $Type->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $Type->ESTYHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('ESTYHUniqueId');
        }
        return $UniqueId; 
     }
     public function ESTYH11FethchEditedDataTrait($request)
     {
        $ESTYHUniqueId = $request->input('id');
        $Type = Type::find($ESTYHUniqueId);
        return $output = array(
            // General Info
            'ESTYHUniqueId'             =>  $Type->ESTYHUniqueId,
            'ESTYHTypeId'         =>  $Type->ESTYHTypeId,
            'ESTYHDesc1'                =>  $Type->ESTYHDesc1,
            'ESTYHDesc2'                =>  $Type->ESTYHDesc2,
            'ESTYHBiDesc'               =>  $Type->ESTYHBiDesc,
            'ESTYHUser'                 =>  $Type->ESTYHUser,
            'ESTYHLastCreated'          =>  $Type->ESTYHLastCreated,
            'ESTYHLastUpdated'          =>  $Type->ESTYHLastUpdated
        );
     }
     public function ESTYH11DeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $Type = Type::find($UniqueId);
        //Eloquent Way
        $Type->ESTYHMarkForDeletion   =   1;
        $Type->ESTYHUser              =   Auth::user()->name;
        $Type->ESTYHDeletedAt         =  Carbon::now();
        $Type->save();        
        return $Type->ESTYHTypeId;
     }
     public function ESTYH11BrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = Type::
         select(
             'ESTYHUniqueId', 
             'ESTYHTypeId',
             'ESTYHDesc1', 
             'ESTYHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('ESTYHMarkForDeletion', 1);
     }     
     public function ESTYH11UnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $Type = Type::find($UniqueId);
         $Type->ESTYHMarkForDeletion   =   0;
         $Type->ESTYHUser              =   Auth::user()->name;
         $Type->ESTYHDeletedAt         =  Null;
         $Type->save();        
         return $Type->ESTYHTypeId;
     }  
}