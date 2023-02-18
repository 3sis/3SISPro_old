<?php
namespace app\Traits\CommonMasters\GeographicInfo;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\CommonMasters\GeographicInfo\City;
use App\Models\CommonMasters\GeographicInfo\State;
use App\Models\CommonMasters\GeographicInfo\Country;
// CTM : City Master
trait cityDbOperations {        
     
     public function ctmBrowserDataTrait() 
     {
         // L03 :Country Master, L04 :State Master
         return $browserData = City::join('t05901L04', 't05901L04.GMSMHStateId', '=', 't05901L05.GMCTHStateId')
         ->join('t05901L03', 't05901L03.GMCMHCountryId', '=', 't05901L05.GMCTHCountryId')
         ->where('t05901L05.GMCTHMarkForDeletion', 0)
         ->get([
            't05901L05.GMCTHUniqueId',
            't05901L05.GMCTHCityId',
            't05901L05.GMCTHDesc1',
            't05901L04.GMSMHDesc1', 
            't05901L03.GMCMHDesc1',
            't05901L05.GMCTHUser',
            't05901L05.GMCTHLastUpdated'
         ]);
     }
     public function ctmBrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = City::
         select(
             'GMCTHUniqueId', 
             'GMCTHCityId',
             'GMCTHDesc1', 
             'GMCTHDesc2')
         ->where('GMCTHMarkForDeletion', 1);
     }
     public function ctmAddUpdateTrait($request)
     {         
        if($request->get('button_action') == 'insert') {
            $city = new City;               
            $city->GMCTHCityId      =   $request->GMCTHCityId;          
            $city->GMCTHLastCreated =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $city = city::find($request->get('GMCTHUniqueId'));
        } 
        $city->GMCTHCityId              =   $request->GMCTHCityId;
        $city->GMCTHDesc1               =   $request->GMCTHDesc1;
        $city->GMCTHDesc2               =   $request->GMCTHDesc2;
        $city->GMCTHBiDesc              =   $request->GMCTHBiDesc;
        $city->GMCTHStateId             =   $request->get('selectState');
        $city->GMCTHCountryId           =   $request->get('selectCountry');
        $city->GMCTHMarkForDeletion     =   0;
        $city->GMCTHUser                =   Auth::user()->name;
        $city->GMCTHLastUpdated         =   Carbon::now();
        $city->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $city->GMCTHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('GMCTHUniqueId');
        }
        return $UniqueId; 
     }
     public function ctmFethchEditedDataTrait($request)
     {
        $GMCTHUniqueId = $request->input('id');
        $city = City::find($GMCTHUniqueId);
        return $output = array(
            'GMCTHUniqueId'     =>  $city->GMCTHUniqueId,
            'GMCTHCityId'       =>  $city->GMCTHCityId,
            'GMCTHStateId'      =>  $city->GMCTHStateId,
            'GMCTHCountryId'    =>  $city->GMCTHCountryId,
            'GMCTHDesc1'        =>  $city->GMCTHDesc1,
            'GMCTHDesc2'        =>  $city->GMCTHDesc2,
            'GMCTHBiDesc'       =>  $city->GMCTHBiDesc,
            'GMCTHUser'         =>  $city->GMCTHUser,
            'GMCTHLastCreated'  =>  $city->GMCTHLastCreated,
            'GMCTHLastUpdated'  =>  $city->GMCTHLastUpdated

        );
     }
     public function ctmDeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $City = City::find($UniqueId);
        //Eloquent Way
        $City->GMCTHMarkForDeletion   =   1;
        $City->GMCTHUser              =   Auth::user()->name;
        $City->GMCTHDeletedAt         =  Carbon::now();
        $City->save();        
        return $City->GMCTHCityId;
     }
     public function ctmUnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $City = City::find($UniqueId);
         $City->GMCTHMarkForDeletion   =   0;
         $City->GMCTHUser               =   Auth::user()->name;
         $City->GMCTHDeletedAt         =  Null;
         $City->save();        
         return $City->GMCTHCityId;
     }   
     
}
//Location Master Ends*****