<?php
namespace app\Traits\Payroll\EmployeeStatus;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\EmployeeStatus\Grade;
// Grade Master
// ESGRH11 : Employee Status Grade of Payrall
trait gradeDbOperations {        
     
     public function ESGRH11BrowserDataTrait() 
     { 
         return $browserData = Grade::where('ESGRHMarkForDeletion', 0)
         ->get([
            'ESGRHUniqueId', 
            'ESGRHGradeId',
            'ESGRHDesc1',
            'ESGRHDesc2',
            'ESGRHUser',
            'ESGRHLastUpdated'
         ]);
     }
     public function ESGRH11AddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $Grade = new Grade;                
            $Grade->ESGRHGradeId    =   $request->ESGRHGradeId;            
            $Grade->ESGRHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $Grade = Grade::find($request->get('ESGRHUniqueId'));
        }
        $Grade->ESGRHDesc1                =   $request->ESGRHDesc1;
        $Grade->ESGRHDesc2                =   $request->ESGRHDesc2;
        $Grade->ESGRHBiDesc               =   $request->ESGRHBiDesc;
        $Grade->ESGRHMarkForDeletion      =   0;
        $Grade->ESGRHUser                 =   Auth::user()->name;
        $Grade->ESGRHLastUpdated          =   Carbon::now();
        $Grade->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $Grade->ESGRHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('ESGRHUniqueId');
        }
        return $UniqueId; 
     }
     public function ESGRH11FethchEditedDataTrait($request)
     {
        $ESGRHUniqueId = $request->input('id');
        $Grade = Grade::find($ESGRHUniqueId);
        return $output = array(
            // General Info
            'ESGRHUniqueId'             =>  $Grade->ESGRHUniqueId,
            'ESGRHGradeId'         =>  $Grade->ESGRHGradeId,
            'ESGRHDesc1'                =>  $Grade->ESGRHDesc1,
            'ESGRHDesc2'                =>  $Grade->ESGRHDesc2,
            'ESGRHBiDesc'               =>  $Grade->ESGRHBiDesc,
            'ESGRHUser'                 =>  $Grade->ESGRHUser,
            'ESGRHLastCreated'          =>  $Grade->ESGRHLastCreated,
            'ESGRHLastUpdated'          =>  $Grade->ESGRHLastUpdated
        );
     }
     public function ESGRH11DeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $Grade = Grade::find($UniqueId);
        //Eloquent Way
        $Grade->ESGRHMarkForDeletion   =   1;
        $Grade->ESGRHUser              =   Auth::user()->name;
        $Grade->ESGRHDeletedAt         =  Carbon::now();
        $Grade->save();        
        return $Grade->ESGRHGradeId;
     }
     public function ESGRH11BrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = Grade::
         select(
             'ESGRHUniqueId', 
             'ESGRHGradeId',
             'ESGRHDesc1', 
             'ESGRHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('ESGRHMarkForDeletion', 1);
     }     
     public function ESGRH11UnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $Grade = Grade::find($UniqueId);
         $Grade->ESGRHMarkForDeletion   =   0;
         $Grade->ESGRHUser              =   Auth::user()->name;
         $Grade->ESGRHDeletedAt         =  Null;
         $Grade->save();        
         return $Grade->ESGRHGradeId;
     }  
}