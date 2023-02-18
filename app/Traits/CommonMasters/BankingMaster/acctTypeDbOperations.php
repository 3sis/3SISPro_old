<?php
namespace app\Traits\CommonMasters\BankingMaster;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\CommonMasters\BankingMaster\AcctType;
// ACT : Account Type Master
trait acctTypeDbOperations {        
     
     public function actBrowserDataTrait() 
     {
         return $browserData = AcctType::
         select(
            'BMATHUniqueId',
            'BMATHAcctId',
            'BMATHDesc1', 
            'BMATHDesc2', 
            'BMATHBiDesc', 
            'BMATHMarkForDeletion',
            'BMATHUser',
            'BMATHLastCreated',
            'BMATHLastUpdated')
        ->where('BMATHMarkForDeletion', 0);
     }
     public function actBrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = AcctType::
         select(
             'BMATHUniqueId', 
             'BMATHAcctId',
             'BMATHDesc1', 
             'BMATHDesc2')
         ->where('BMATHMarkForDeletion', 1);
     }
     public function actAddUpdateTrait($request)
     {         
         if($request->get('button_action') == 'insert') {
            $AcctType = new AcctType;                
            $AcctType->BMATHAcctId            =   $request->BMATHAcctId;
            $AcctType->BMATHDesc1             =   $request->BMATHDesc1;
            $AcctType->BMATHDesc2             =   $request->BMATHDesc2;
            $AcctType->BMATHBiDesc            =   $request->BMATHBiDesc;
            $AcctType->BMATHMarkForDeletion   =   0;
            $AcctType->BMATHUser              =   Auth::user()->name;
            $AcctType->BMATHLastCreated       =   Carbon::now();
            $AcctType->BMATHLastUpdated       =   Carbon::now();
         }elseif($request->get('button_action') == 'update'){
            $AcctType = AcctType::find($request->get('BMATHUniqueId'));
         } 
            $AcctType->BMATHDesc1             =   $request->BMATHDesc1;
            $AcctType->BMATHDesc2             =   $request->BMATHDesc2;
            $AcctType->BMATHBiDesc            =   $request->BMATHBiDesc;
            $AcctType->BMATHMarkForDeletion   =   0;
            $AcctType->BMATHUser              =   Auth::user()->name;
            $AcctType->BMATHLastUpdated       =   Carbon::now();
            $AcctType->save(); 
            if($request->get('button_action') == 'insert') {
                $UniqueId = $AcctType->BMATHUniqueId; 
            }elseif($request->get('button_action') == 'update'){
                $UniqueId = $request->get('BMATHUniqueId');
            }
            return $UniqueId; 
     }
     public function actFethchEditedDataTrait($request)
     {
        $BMATHUniqueId = $request->input('id');
        $AcctType = AcctType::find($BMATHUniqueId);
        return $output = array(
            'BMATHUniqueId'     =>  $AcctType->BMATHUniqueId,
            'BMATHAcctId'       =>  $AcctType->BMATHAcctId,
            'BMATHDesc1'        =>  $AcctType->BMATHDesc1,
            'BMATHDesc2'        =>  $AcctType->BMATHDesc2,
            'BMATHBiDesc'       =>  $AcctType->BMATHBiDesc,
            'BMATHUser'         =>  $AcctType->BMATHUser,
            'BMATHLastCreated'  =>  $AcctType->BMATHLastCreated,
            'BMATHLastUpdated'  =>  $AcctType->BMATHLastUpdated
        );
     }
     public function actDeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $AcctType = AcctType::find($UniqueId);
        //Eloquent Way
        $AcctType->BMATHMarkForDeletion   =   1;
        $AcctType->BMATHUser              =   Auth::user()->name;
        $AcctType->BMATHDeletedAt         =  Carbon::now();
        $AcctType->save();        
        return $AcctType->BMATHAcctId;
     }
     public function actUnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $AcctType = AcctType::find($UniqueId);
         $AcctType->BMATHMarkForDeletion   =   0;
         $AcctType->BMATHUser              =   Auth::user()->name;
         $AcctType->BMATHDeletedAt         =  Null;
         $AcctType->save();        
         return $AcctType->BMATHAcctId;
     }   
     
}
//Account Type Master Ends*****