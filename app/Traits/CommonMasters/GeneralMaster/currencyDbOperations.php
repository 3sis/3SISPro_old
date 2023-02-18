<?php
namespace app\Traits\CommonMasters\GeneralMaster;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\CommonMasters\GeneralMaster\Currency;
// GICM : Geographic Info - Currency Master
trait currencyDbOperations {        
     
     public function gmcrBrowserDataTrait() 
     { 
         return $browserData = Currency::where('GMCRHMarkForDeletion', 0)
         ->get([
            'GMCRHUniqueId', 
            'GMCRHCurrencyId',
            'GMCRHDesc1',
            'GMCRHDesc2',
            'GMCRHUser',
            'GMCRHLastUpdated'
         ]);
     }
     public function gmcrAddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $Currency = new Currency;                
            $Currency->GMCRHCurrencyId    =   $request->GMCRHCurrencyId;            
            $Currency->GMCRHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $Currency = Currency::find($request->get('GMCRHUniqueId'));
        }
        $Currency->GMCRHDesc1                =   $request->GMCRHDesc1;
        $Currency->GMCRHDesc2                =   $request->GMCRHDesc2;
        $Currency->GMCRHBiDesc               =   $request->GMCRHBiDesc;
        $Currency->GMCRHMarkForDeletion      =   0;
        $Currency->GMCRHUser                 =   Auth::user()->name;
        $Currency->GMCRHLastUpdated          =   Carbon::now();
        $Currency->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $Currency->GMCRHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('GMCRHUniqueId');
        }
        return $UniqueId; 
     }
     public function gmcrFethchEditedDataTrait($request)
     {
        $GMCRHUniqueId = $request->input('id');
        $Currency = Currency::find($GMCRHUniqueId);
        return $output = array(
            // General Info
            'GMCRHUniqueId'             =>  $Currency->GMCRHUniqueId,
            'GMCRHCurrencyId'            =>  $Currency->GMCRHCurrencyId,
            'GMCRHDesc1'                =>  $Currency->GMCRHDesc1,
            'GMCRHDesc2'                =>  $Currency->GMCRHDesc2,
            'GMCRHBiDesc'               =>  $Currency->GMCRHBiDesc,
            'GMCRHUser'                 =>  $Currency->GMCRHUser,
            'GMCRHLastCreated'          =>  $Currency->GMCRHLastCreated,
            'GMCRHLastUpdated'          =>  $Currency->GMCRHLastUpdated
        );
     }
     public function gmcrDeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $Currency = Currency::find($UniqueId);
        //Eloquent Way
        $Currency->GMCRHMarkForDeletion   =   1;
        $Currency->GMCRHUser              =   Auth::user()->name;
        $Currency->GMCRHDeletedAt         =  Carbon::now();
        $Currency->save();        
        return $Currency->GMCRHCurrencyId;
     }
     public function gmcrBrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = Currency::
         select(
             'GMCRHUniqueId', 
             'GMCRHCurrencyId',
             'GMCRHDesc1', 
             'GMCRHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('GMCRHMarkForDeletion', 1);
     }     
     public function gmcrUnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $Currency = Currency::find($UniqueId);
         $Currency->GMCRHMarkForDeletion   =   0;
         $Currency->GMCRHUser               =   Auth::user()->name;
         $Currency->GMCRHDeletedAt         =  Null;
         $Currency->save();        
         return $Currency->GMCRHCurrencyId;
     }   
     
}