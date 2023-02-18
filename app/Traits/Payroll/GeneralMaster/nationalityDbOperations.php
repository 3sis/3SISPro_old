<?php
namespace app\Traits\Payroll\GeneralMaster;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\GeneralMaster\Nationality;
// Nationality Master
// gmna11 : Gneral Master Nationality of Payrall
trait nationalityDbOperations {        
     
     public function gmna11BrowserDataTrait() 
     { 
         return $browserData = Nationality::where('GMNAHMarkForDeletion', 0)
         ->get([
            'GMNAHUniqueId', 
            'GMNAHNationalityId',
            'GMNAHDesc1',
            'GMNAHDesc2',
            'GMNAHUser',
            'GMNAHLastUpdated'
         ]);
     }
     public function gmna11AddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $Nationality = new Nationality;                
            $Nationality->GMNAHNationalityId    =   $request->GMNAHNationalityId;            
            $Nationality->GMNAHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $Nationality = Nationality::find($request->get('GMNAHUniqueId'));
        }
        $Nationality->GMNAHDesc1                =   $request->GMNAHDesc1;
        $Nationality->GMNAHDesc2                =   $request->GMNAHDesc2;
        $Nationality->GMNAHBiDesc               =   $request->GMNAHBiDesc;
        $Nationality->GMNAHMarkForDeletion      =   0;
        $Nationality->GMNAHUser                 =   Auth::user()->name;
        $Nationality->GMNAHLastUpdated          =   Carbon::now();
        $Nationality->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $Nationality->GMNAHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('GMNAHUniqueId');
        }
        return $UniqueId; 
     }
     public function gmna11FethchEditedDataTrait($request)
     {
        $GMNAHUniqueId = $request->input('id');
        $Nationality = Nationality::find($GMNAHUniqueId);
        return $output = array(
            // General Info
            'GMNAHUniqueId'             =>  $Nationality->GMNAHUniqueId,
            'GMNAHNationalityId'         =>  $Nationality->GMNAHNationalityId,
            'GMNAHDesc1'                =>  $Nationality->GMNAHDesc1,
            'GMNAHDesc2'                =>  $Nationality->GMNAHDesc2,
            'GMNAHBiDesc'               =>  $Nationality->GMNAHBiDesc,
            'GMNAHUser'                 =>  $Nationality->GMNAHUser,
            'GMNAHLastCreated'          =>  $Nationality->GMNAHLastCreated,
            'GMNAHLastUpdated'          =>  $Nationality->GMNAHLastUpdated
        );
     }
     public function gmna11DeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $Nationality = Nationality::find($UniqueId);
        //Eloquent Way
        $Nationality->GMNAHMarkForDeletion   =   1;
        $Nationality->GMNAHUser              =   Auth::user()->name;
        $Nationality->GMNAHDeletedAt         =  Carbon::now();
        $Nationality->save();        
        return $Nationality->GMNAHNationalityId;
     }
     public function gmna11BrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = Nationality::
         select(
             'GMNAHUniqueId', 
             'GMNAHNationalityId',
             'GMNAHDesc1', 
             'GMNAHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('GMNAHMarkForDeletion', 1);
     }     
     public function gmna11UnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $Nationality = Nationality::find($UniqueId);
         $Nationality->GMNAHMarkForDeletion   =   0;
         $Nationality->GMNAHUser              =   Auth::user()->name;
         $Nationality->GMNAHDeletedAt         =  Null;
         $Nationality->save();        
         return $Nationality->GMNAHNationalityId;
     }   
     
}