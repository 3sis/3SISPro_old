<?php
namespace app\Traits\CommonMasters\GeographicInfo;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\CommonMasters\GeographicInfo\Country;
// GICM : Geographic Info - Country Master
trait countryDbOperations {        
     
     public function gicmBrowserDataTrait() 
     {  
         return $browserData = Country::where('GMCMHMarkForDeletion', 0)
         ->get([
            'GMCMHUniqueId', 
            'GMCMHCountryId',
            'GMCMHDesc1', 
            'GMCMHDesc2',
            'GMCMHUser',
            'GMCMHLastUpdated'
         ]);
     }     
     public function gicmAddUpdateTrait($request)
     {         
         if($request->get('button_action') == 'insert') {
            $Country = new Country;                
            $Country->GMCMHCountryId           =   $request->GMCMHCountryId;            
            $Country->GMCMHLastCreated       =   Carbon::now();
         }elseif($request->get('button_action') == 'update'){
            $Country = Country::find($request->get('GMCMHUniqueId'));
         } 
            $Country->GMCMHDesc1            =   $request->GMCMHDesc1;
            $Country->GMCMHDesc2            =   $request->GMCMHDesc2;
            $Country->GMCMHBiDesc           =   $request->GMCMHBiDesc;
            $Country->GMCMHMarkForDeletion  =   0;
            $Country->GMCMHUser             =   Auth::user()->name;
            $Country->GMCMHLastUpdated      =   Carbon::now();
            $Country->save(); 
            if($request->get('button_action') == 'insert') {
                $UniqueId = $Country->GMCMHUniqueId; 
            }elseif($request->get('button_action') == 'update'){
                $UniqueId = $request->get('GMCMHUniqueId');
            }
            return $UniqueId; 
     }
     public function gicmFethchEditedDataTrait($request)
     {
        $GMCMHUniqueId = $request->input('id');
        $country = Country::find($GMCMHUniqueId);
        return $output = array(
            'GMCMHUniqueId'      =>  $country->GMCMHUniqueId,
            'GMCMHCountryId'     =>  $country->GMCMHCountryId,
            'GMCMHDesc1'         =>  $country->GMCMHDesc1,
            'GMCMHDesc2'         =>  $country->GMCMHDesc2,
            'GMCMHBiDesc'        =>  $country->GMCMHBiDesc,
            'GMCMHUser'          =>  $country->GMCMHUser,
            'GMCMHLastCreated'   =>  $country->GMCMHLastCreated,
            'GMCMHLastUpdated'   =>  $country->GMCMHLastUpdated
        );
     }
     public function gicmDeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $Country = Country::find($UniqueId);
        //Eloquent Way
        $Country->GMCMHMarkForDeletion   =   1;
        $Country->GMCMHUser              =   Auth::user()->name;
        $Country->GMCMHDeletedAt         =  Carbon::now();
        $Country->save();        
        return $Country->GMCMHCountryId;
     }
     public function gicmBrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = Country::
         select(
             'GMCMHUniqueId', 
             'GMCMHCountryId',
             'GMCMHDesc1', 
             'GMCMHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('GMCMHMarkForDeletion', 1);
     }
     public function gicmUnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $Country = Country::find($UniqueId);
         $Country->GMCMHMarkForDeletion   =   0;
         $Country->GMCMHUser               =   Auth::user()->name;
         $Country->GMCMHDeletedAt         =  Null;
         $Country->save();        
         return $Country->GMCMHCountryId;
     }   
     
}