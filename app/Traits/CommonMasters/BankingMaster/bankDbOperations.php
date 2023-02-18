<?php
namespace app\Traits\CommonMasters\BankingMaster;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\CommonMasters\BankingMaster\BankName;
// bkn : Bank Master
trait BankDbOperations {        
     
     public function bknBrowserDataTrait() 
     {
         return $browserData = BankName::
         select(
            'BMBNHUniqueId',
            'BMBNHBankId', 
            'BMBNHDesc1', 
            'BMBNHDesc2', 
            'BMBNHBiDesc', 
            'BMBNHMarkForDeletion',
            'BMBNHUser',
            'BMBNHLastCreated',
            'BMBNHLastUpdated')
            // This is AND condition in wherer to apply OR second where should be orwhere
        ->where('BMBNHMarkForDeletion', 0);
     }
     public function bknBrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = BankName::
         select(
             'BMBNHUniqueId', 
             'BMBNHBankId',
             'BMBNHDesc1', 
             'BMBNHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('BMBNHMarkForDeletion', 1);
     }
     public function bknAddUpdateTrait($request)
     {         
        if($request->get('button_action') == 'insert') {
            $BankName = new BankName;                
            $BankName->BMBNHBankId           =   $request->BMBNHBankId;
            $BankName->BMBNHLastCreated       =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $BankName = BankName::find($request->get('BMBNHUniqueId'));
        } 
        $BankName->BMBNHDesc1             =   $request->BMBNHDesc1;
        $BankName->BMBNHDesc2           =   $request->BMBNHDesc2;
        $BankName->BMBNHBiDesc            =   $request->BMBNHBiDesc;
        $BankName->BMBNHMarkForDeletion   =   0;
        $BankName->BMBNHUser              =   Auth::user()->name;
        $BankName->BMBNHLastUpdated       =   Carbon::now();
        $BankName->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $BankName->BMBNHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('BMBNHUniqueId');
        }
        return $UniqueId; 
     }
     public function bknFethchEditedDataTrait($request)
     {
        $BMBNHUniqueId = $request->input('id');
        $BankName = BankName::find($BMBNHUniqueId);
        return $output = array(
            'BMBNHUniqueId'     =>  $BankName->BMBNHUniqueId,
            'BMBNHBankId'       =>  $BankName->BMBNHBankId,
            'BMBNHDesc1'        =>  $BankName->BMBNHDesc1,
            'BMBNHDesc2'        =>  $BankName->BMBNHDesc2,
            'BMBNHBiDesc'       =>  $BankName->BMBNHBiDesc,
            'BMBNHUser'         =>  $BankName->BMBNHUser,
            'BMBNHLastCreated'  =>  $BankName->BMBNHLastCreated,
            'BMBNHLastUpdated'  =>  $BankName->BMBNHLastUpdated

        );
     }
     public function bknDeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $BankName = BankName::find($UniqueId);
        //Eloquent Way
        $BankName->BMBNHMarkForDeletion   =   1;
        $BankName->BMBNHUser               =   Auth::user()->name;
        $BankName->BMBNHDeletedAt         =  Carbon::now();
        $BankName->save();        
        return $BankName->BMBNHBankId;
     }
     public function bknUnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $BankName = BankName::find($UniqueId);
         $BankName->BMBNHMarkForDeletion   =   0;
         $BankName->BMBNHUser              =   Auth::user()->name;
         $BankName->BMBNHDeletedAt         =  Null;
         $BankName->save();        
         return $BankName->BMBNHBankId;
     }   
     
}
//Bank Master Ends*****