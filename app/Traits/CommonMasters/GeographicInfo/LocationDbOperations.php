<?php
namespace app\Traits\CommonMasters\GeographicInfo;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\CommonMasters\GeographicInfo\Location;
use App\Models\CommonMasters\GeographicInfo\City;
use App\Models\CommonMasters\GeographicInfo\State;
use App\Models\CommonMasters\GeographicInfo\Country;
// LOM : Location Master
trait locationDbOperations {        
     
     public function lomBrowserDataTrait() 
     {
         // L03 :Country Master, L04 :State Master
         return $browserData = Location::leftJoin('t05901L05', 't05901L05.GMCTHCityId', '=','t05901L06.GMLMHCityId')
         ->leftJoin('t05901L04', 't05901L04.GMSMHStateId', '=', 't05901L06.GMLMHStateId')
         ->leftJoin('t05901L03', 't05901L03.GMCMHCountryId', '=', 't05901L06.GMLMHCountryId')
         ->where('t05901L06.GMLMHCompanyId', $this->gCompanyId)
         ->where('t05901L06.GMLMHMarkForDeletion', 0)
         ->get([
            't05901L06.GMLMHUniqueId',
            't05901L06.GMLMHCompanyId',
            't05901L06.GMLMHLocationId',
            't05901L05.GMCTHDesc1',
            't05901L04.GMSMHDesc1', 
            't05901L03.GMCMHDesc1',
            't05901L06.GMLMHDesc1', 
            't05901L06.GMLMHDesc2', 
            't05901L06.GMLMHBiDesc', 
            't05901L06.GMLMHMarkForDeletion',
            't05901L06.GMLMHUser',
            't05901L06.GMLMHLastUpdated'
         ]);
     }
     public function lomBrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = Location::
         select(
             'GMLMHUniqueId', 
             'GMLMHLocationId',
             'GMLMHDesc1', 
             'GMLMHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('GMLMHMarkForDeletion', 1);
     }
     public function lomAddUpdateTrait($request)
     {         
        if($request->get('button_action') == 'insert') {
        $Location = new Location;                
        $Location->GMLMHCompanyId         =   $request->GMLMHCompanyId;
        $Location->GMLMHLocationId        =   $request->GMLMHLocationId;            
        $Location->GMLMHLastCreated       =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
        $Location = Location::find($request->get('GMLMHUniqueId'));
        } 
        $Location->GMLMHDesc1             =   $request->GMLMHDesc1;
        $Location->GMLMHDesc2             =   $request->GMLMHDesc2;
        $Location->GMLMHBiDesc            =   $request->GMLMHBiDesc;
        $Location->GMLMHCityId            =   $request->cityId;
        $Location->GMLMHStateId           =   $request->stateId;
        $Location->GMLMHCountryId         =   $request->countryId;
        $Location->GMLMHMarkForDeletion   =   0;
        $Location->GMLMHUser              =   Auth::user()->name;
        $Location->GMLMHLastUpdated       =   Carbon::now();
        $Location->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $Location->GMLMHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('GMLMHUniqueId');
        }
        return $UniqueId; 
     }
     public function lomFethchEditedDataTrait($request)
     {
        $GMLMHUniqueId = $request->input('id');
        $Location = Location::find($GMLMHUniqueId);
        return $output = array(
            'GMLMHUniqueId'      =>  $Location->GMLMHUniqueId,
            'GMLMHCompanyId'     =>  $Location->GMLMHCompanyId,
            'GMLMHLocationId'    =>  $Location->GMLMHLocationId,
            'GMLMHDesc1'         =>  $Location->GMLMHDesc1,
            'GMLMHDesc2'         =>  $Location->GMLMHDesc2,
            'GMLMHBiDesc'        =>  $Location->GMLMHBiDesc,
            'GMLMHCityId'        =>  $Location->GMLMHCityId,
            'GMLMHStateId'       =>  $Location->GMLMHStateId,
            'GMLMHCountryId'     =>  $Location->GMLMHCountryId,
            'GMLMHUser'          =>  $Location->GMLMHUser,
            'GMLMHLastCreated'   =>  $Location->GMLMHLastCreated,
            'GMLMHLastUpdated'   =>  $Location->GMLMHLastUpdated

        );
     }
     public function lomDeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $Location = Location::find($UniqueId);
        //Eloquent Way
        $Location->GMLMHMarkForDeletion   =   1;
        $Location->GMLMHUser               =   Auth::user()->name;
        $Location->GMLMHDeletedAt         =  Carbon::now();
        $Location->save();        
        return $Location->GMLMHLocationId;
     }
     public function lomUnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $Location = Location::find($UniqueId);
         $Location->GMLMHMarkForDeletion   =   0;
         $Location->GMLMHUser               =   Auth::user()->name;
         $Location->GMLMHDeletedAt         =  Null;
         $Location->save();        
         return $Location->GMLMHLocationId;
     }   
     
}
//Location Master Ends*****