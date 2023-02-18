<?php
namespace app\Traits\Payroll\Credentials;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\Credentials\Skills;
// Skills Master
// CMSKH11 : Credentials Skills of Payrall
trait skillsDbOperations {
     public function CMSKH11BrowserDataTrait() 
     { 
         return $browserData = Skills::where('CMSKHMarkForDeletion', 0)
         ->get([
            'CMSKHUniqueId', 
            'CMSKHSkillId',
            'CMSKHDesc1',
            'CMSKHDesc2',
            'CMSKHUser',
            'CMSKHLastUpdated'
         ]);
     }
     public function CMSKH11AddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $Skills = new Skills;                
            $Skills->CMSKHSkillId    =   $request->CMSKHSkillId;            
            $Skills->CMSKHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $Skills = Skills::find($request->get('CMSKHUniqueId'));
        }
        $Skills->CMSKHDesc1                =   $request->CMSKHDesc1;
        $Skills->CMSKHDesc2                =   $request->CMSKHDesc2;
        $Skills->CMSKHBiDesc               =   $request->CMSKHBiDesc;
        $Skills->CMSKHMarkForDeletion      =   0;
        $Skills->CMSKHUser                 =   Auth::user()->name;
        $Skills->CMSKHLastUpdated          =   Carbon::now();
        $Skills->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $Skills->CMSKHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('CMSKHUniqueId');
        }
        return $UniqueId; 
     }
     public function CMSKH11FethchEditedDataTrait($request)
     {
        $CMSKHUniqueId = $request->input('id');
        $Skills = Skills::find($CMSKHUniqueId);
        return $output = array(
            // General Info
            'CMSKHUniqueId'             =>  $Skills->CMSKHUniqueId,
            'CMSKHSkillId'         =>  $Skills->CMSKHSkillId,
            'CMSKHDesc1'                =>  $Skills->CMSKHDesc1,
            'CMSKHDesc2'                =>  $Skills->CMSKHDesc2,
            'CMSKHBiDesc'               =>  $Skills->CMSKHBiDesc,
            'CMSKHUser'                 =>  $Skills->CMSKHUser,
            'CMSKHLastCreated'          =>  $Skills->CMSKHLastCreated,
            'CMSKHLastUpdated'          =>  $Skills->CMSKHLastUpdated
        );
     }
     public function CMSKH11DeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $Skills = Skills::find($UniqueId);
        //Eloquent Way
        $Skills->CMSKHMarkForDeletion   =   1;
        $Skills->CMSKHUser              =   Auth::user()->name;
        $Skills->CMSKHDeletedAt         =  Carbon::now();
        $Skills->save();        
        return $Skills->CMSKHSkillId;
     }
     public function CMSKH11BrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = Skills::
         select(
             'CMSKHUniqueId', 
             'CMSKHSkillId',
             'CMSKHDesc1', 
             'CMSKHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('CMSKHMarkForDeletion', 1);
     }     
     public function CMSKH11UnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $Skills = Skills::find($UniqueId);
         $Skills->CMSKHMarkForDeletion   =   0;
         $Skills->CMSKHUser              =   Auth::user()->name;
         $Skills->CMSKHDeletedAt         =  Null;
         $Skills->save();        
         return $Skills->CMSKHSkillId;
     }  
}