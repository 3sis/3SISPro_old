<?php
namespace app\Traits\Payroll\Credentials;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\Credentials\Certificates;
// Certificates Master
// CMCTH11 : Credentials Certificates of Payrall
trait certificatesDbOperations {        
     
     public function CMCTH11BrowserDataTrait() 
     { 
         return $browserData = Certificates::where('CMCTHMarkForDeletion', 0)
         ->get([
            'CMCTHUniqueId', 
            'CMCTHCertificateId',
            'CMCTHDesc1',
            'CMCTHDesc2',
            'CMCTHUser',
            'CMCTHLastUpdated'
         ]);
     }
     public function CMCTH11AddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $Certificates = new Certificates;                
            $Certificates->CMCTHCertificateId    =   $request->CMCTHCertificateId;            
            $Certificates->CMCTHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $Certificates = Certificates::find($request->get('CMCTHUniqueId'));
        }
        $Certificates->CMCTHDesc1                =   $request->CMCTHDesc1;
        $Certificates->CMCTHDesc2                =   $request->CMCTHDesc2;
        $Certificates->CMCTHBiDesc               =   $request->CMCTHBiDesc;
        $Certificates->CMCTHMarkForDeletion      =   0;
        $Certificates->CMCTHUser                 =   Auth::user()->name;
        $Certificates->CMCTHLastUpdated          =   Carbon::now();
        $Certificates->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $Certificates->CMCTHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('CMCTHUniqueId');
        }
        return $UniqueId; 
     }
     public function CMCTH11FethchEditedDataTrait($request)
     {
        $CMCTHUniqueId = $request->input('id');
        $Certificates = Certificates::find($CMCTHUniqueId);
        return $output = array(
            // General Info
            'CMCTHUniqueId'             =>  $Certificates->CMCTHUniqueId,
            'CMCTHCertificateId'         =>  $Certificates->CMCTHCertificateId,
            'CMCTHDesc1'                =>  $Certificates->CMCTHDesc1,
            'CMCTHDesc2'                =>  $Certificates->CMCTHDesc2,
            'CMCTHBiDesc'               =>  $Certificates->CMCTHBiDesc,
            'CMCTHUser'                 =>  $Certificates->CMCTHUser,
            'CMCTHLastCreated'          =>  $Certificates->CMCTHLastCreated,
            'CMCTHLastUpdated'          =>  $Certificates->CMCTHLastUpdated
        );
     }
     public function CMCTH11DeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $Certificates = Certificates::find($UniqueId);
        //Eloquent Way
        $Certificates->CMCTHMarkForDeletion   =   1;
        $Certificates->CMCTHUser              =   Auth::user()->name;
        $Certificates->CMCTHDeletedAt         =  Carbon::now();
        $Certificates->save();        
        return $Certificates->CMCTHCertificateId;
     }
     public function CMCTH11BrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = Certificates::
         select(
             'CMCTHUniqueId', 
             'CMCTHCertificateId',
             'CMCTHDesc1', 
             'CMCTHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('CMCTHMarkForDeletion', 1);
     }     
     public function CMCTH11UnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $Certificates = Certificates::find($UniqueId);
         $Certificates->CMCTHMarkForDeletion   =   0;
         $Certificates->CMCTHUser              =   Auth::user()->name;
         $Certificates->CMCTHDeletedAt         =  Null;
         $Certificates->save();        
         return $Certificates->CMCTHCertificateId;
     }  
}