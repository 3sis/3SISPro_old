<?php
namespace app\Traits\CommonMasters\BankingMaster;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\CommonMasters\BankingMaster\BranchName;
use App\Models\CommonMasters\BankingMaster\BankhName;
// bkn : Branch Master
trait branchDbOperations {        
     
     public function bknBrowserDataTrait() 
     {
        return $browserData = BranchName::join('t05902L01', 't05902L01.BMBNHBankId', '=', 
        't05902L02.BMBRHBankId')
        ->where('t05902L02.BMBRHMarkForDeletion', 0)
        ->get([
            't05902L02.BMBRHUniqueId',
            't05902L02.BMBRHBranchId', 
            't05902L01.BMBNHDesc1',
            't05902L02.BMBRHIFSCId',
            't05902L02.BMBRHDesc1', 
            't05902L02.BMBRHDesc2', 
            't05902L02.BMBRHBiDesc', 
            't05902L02.BMBRHMarkForDeletion',
            't05902L02.BMBRHUser',
            't05902L02.BMBRHLastCreated',
            't05902L02.BMBRHLastUpdated'
        ]);
        //  return $browserData = BranchName::
        //  select(
        //     'BMBRHUniqueId',
        //     'BMBRHBranchId', 
        //     'BMBRHBankId',
        //     'BMBRHIFSCId',
        //     'BMBRHDesc1', 
        //     'BMBRHDesc2', 
        //     'BMBRHBiDesc', 
        //     'BMBRHMarkForDeletion',
        //     'BMBRHUser',
        //     'BMBRHLastCreated',
        //     'BMBRHLastUpdated')
        // ->where('BMBRHMarkForDeletion', 0);
     }
     public function bknBrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = BranchName::
         select(
             'BMBRHUniqueId', 
             'BMBRHBranchId',
             'BMBRHDesc1', 
             'BMBRHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('BMBRHMarkForDeletion', 1);
     }
     public function bknAddUpdateTrait($request)
     {         
         if($request->get('button_action') == 'insert') {
            $BranchName = new BranchName;                
            $BranchName->BMBRHBranchId          =   $request->BMBRHBranchId;
            $BranchName->BMBRHLastCreated       =   Carbon::now();
         }elseif($request->get('button_action') == 'update'){
            $BranchName = BranchName::find($request->get('BMBRHUniqueId'));
         } 
            $BranchName->BMBRHDesc1             =   $request->BMBRHDesc1;
            $BranchName->BMBRHDesc2             =   $request->BMBRHDesc2;
            $BranchName->BMBRHBiDesc            =   $request->BMBRHBiDesc;
            $BranchName->BMBRHBankId            =   $request->bankId;
            $BranchName->BMBRHIFSCId            =   $request->BMBRHIFSCId;
            $BranchName->BMBRHMarkForDeletion   =   0;
            $BranchName->BMBRHUser              =   Auth::user()->name;
            $BranchName->BMBRHLastUpdated       =   Carbon::now();
            $BranchName->save(); 
            if($request->get('button_action') == 'insert') {
                $UniqueId = $BranchName->BMBRHUniqueId; 
            }elseif($request->get('button_action') == 'update'){
                $UniqueId = $request->get('BMBRHUniqueId');
            }
            return $UniqueId; 
     }
     public function bknFethchEditedDataTrait($request)
     {
        $BMBRHUniqueId = $request->input('id');
        $BranchName = BranchName::find($BMBRHUniqueId);
        return $output = array(
            'BMBRHUniqueId'     =>  $BranchName->BMBRHUniqueId,
            'BMBRHBranchId'      =>  $BranchName->BMBRHBranchId,
            'BMBRHDesc1'        =>  $BranchName->BMBRHDesc1,
            'BMBRHDesc2'        =>  $BranchName->BMBRHDesc2,
            'BMBRHBiDesc'       =>  $BranchName->BMBRHBiDesc,
            'BMBRHBankId'       =>  $BranchName->BMBRHBankId,
            'BMBRHIFSCId'       =>  $BranchName->BMBRHIFSCId,
            'BMBRHUser'         =>  $BranchName->BMBRHUser,
            'BMBRHLastCreated'  =>  $BranchName->BMBRHLastCreated,
            'BMBRHLastUpdated'  =>  $BranchName->BMBRHLastUpdated

        );
     }
     public function bknDeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $BranchName = BranchName::find($UniqueId);
        //Eloquent Way
        $BranchName->BMBRHMarkForDeletion   =   1;
        $BranchName->BMBRHUser               =   Auth::user()->name;
        $BranchName->BMBRHDeletedAt         =  Carbon::now();
        $BranchName->save();        
        return $BranchName->BMBRHBranchId;
     }
     public function bknUnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $BranchName = BranchName::find($UniqueId);
         $BranchName->BMBRHMarkForDeletion   =   0;
         $BranchName->BMBRHUser               =   Auth::user()->name;
         $BranchName->BMBRHDeletedAt         =  Null;
         $BranchName->save();        
         return $BranchName->BMBRHBranchId;
     }   
     
}
//Branch Master Ends*****