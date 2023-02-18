<?php
namespace app\Traits\CommonMasters\BankingMaster;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\CommonMasters\BankingMaster\PaymentMode;
// pym : PaymentMode Master
trait paymentModeDbOperations {        
     
     public function pymBrowserDataTrait() 
     {
         return $browserData = PaymentMode::
         select(
            'BMPMHUniqueId',
            'BMPMHPaymentModeId', 
            'BMPMHDesc1', 
            'BMPMHDesc2', 
            'BMPMHBiDesc', 
            'BMPMHMarkForDeletion',
            'BMPMHUser',
            'BMPMHLastCreated',
            'BMPMHLastUpdated')
            // This is AND condition in wherer to apply OR second where should be orwhere
        ->where('BMPMHMarkForDeletion', 0);
     }
     public function pymBrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = PaymentMode::
         select(
             'BMPMHUniqueId', 
             'BMPMHPaymentModeId',
             'BMPMHDesc1', 
             'BMPMHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('BMPMHMarkForDeletion', 1);
     }
     public function pymAddUpdateTrait($request)
     {         
         if($request->get('button_action') == 'insert') {
            $PaymentMode = new PaymentMode;                
            $PaymentMode->BMPMHPaymentModeId           =   $request->BMPMHPaymentModeId;
            $PaymentMode->BMPMHDesc1             =   $request->BMPMHDesc1;
            $PaymentMode->BMPMHDesc2             =   $request->BMPMHDesc2;
            $PaymentMode->BMPMHBiDesc            =   $request->BMPMHBiDesc;
            $PaymentMode->BMPMHMarkForDeletion   =   0;
            $PaymentMode->BMPMHUser              =   Auth::user()->name;
            $PaymentMode->BMPMHLastCreated       =   Carbon::now();
            $PaymentMode->BMPMHLastUpdated       =   Carbon::now();
         }elseif($request->get('button_action') == 'update'){
            $PaymentMode = PaymentMode::find($request->get('BMPMHUniqueId'));
         } 
            $PaymentMode->BMPMHDesc1         =   $request->BMPMHDesc1;
            $PaymentMode->BMPMHDesc2           =   $request->BMPMHDesc2;
            $PaymentMode->BMPMHBiDesc            =   $request->BMPMHBiDesc;
            $PaymentMode->BMPMHMarkForDeletion   =   0;
            $PaymentMode->BMPMHUser              =   Auth::user()->name;
            $PaymentMode->BMPMHLastUpdated       =   Carbon::now();
            $PaymentMode->save(); 
            if($request->get('button_action') == 'insert') {
                $UniqueId = $PaymentMode->BMPMHUniqueId; 
            }elseif($request->get('button_action') == 'update'){
                $UniqueId = $request->get('BMPMHUniqueId');
            }
            return $UniqueId; 
     }
     public function pymFethchEditedDataTrait($request)
     {
        $BMPMHUniqueId = $request->input('id');
        $PaymentMode = PaymentMode::find($BMPMHUniqueId);
        return $output = array(
            'BMPMHUniqueId'     =>  $PaymentMode->BMPMHUniqueId,
            'BMPMHPaymentModeId'       =>  $PaymentMode->BMPMHPaymentModeId,
            'BMPMHDesc1'        =>  $PaymentMode->BMPMHDesc1,
            'BMPMHDesc2'        =>  $PaymentMode->BMPMHDesc2,
            'BMPMHBiDesc'       =>  $PaymentMode->BMPMHBiDesc,
            'BMPMHUser'         =>  $PaymentMode->BMPMHUser,
            'BMPMHLastCreated'  =>  $PaymentMode->BMPMHLastCreated,
            'BMPMHLastUpdated'  =>  $PaymentMode->BMPMHLastUpdated

        );
     }
     public function pymDeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $PaymentMode = PaymentMode::find($UniqueId);
        //Eloquent Way
        $PaymentMode->BMPMHMarkForDeletion   =   1;
        $PaymentMode->BMPMHUser               =   Auth::user()->name;
        $PaymentMode->BMPMHDeletedAt         =  Carbon::now();
        $PaymentMode->save();        
        return $PaymentMode->BMPMHPaymentModeId;
     }
     public function pymUnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $PaymentMode = PaymentMode::find($UniqueId);
         $PaymentMode->BMPMHMarkForDeletion   =   0;
         $PaymentMode->BMPMHUser              =   Auth::user()->name;
         $PaymentMode->BMPMHDeletedAt         =  Null;
         $PaymentMode->save();        
         return $PaymentMode->BMPMHPaymentModeId;
     }   
     
}
//PaymentMode Master Ends*****