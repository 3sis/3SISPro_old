<?php
namespace app\Traits\CommonMasters\GeneralMaster;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\CommonMasters\GeneralMaster\Company;
// GICM : Geographic Info - Company Master
trait companyDbOperations {        
     
     public function gmcmBrowserDataTrait() 
     { 
         return $browserData = Company::where('GMCOHMarkForDeletion', 0)
         ->get([
            'GMCOHUniqueId', 
            'GMCOHCompanyId',
            'GMCOHDesc1', 
            'GMCOHNickName',
            'GMCOHTagLine',
            'GMCOHDesc2',
            'GMCOHBiDesc',
            'GMCOHUser',
            'GMCOHLastUpdated'
         ]);
     }
     public function gmcmAddUpdateTrait($request)
     {
        if($request->get('button_action') == 'insert') {
            $Company = new Company;                
            $Company->GMCOHCompanyId    =   $request->GMCOHCompanyId;            
            $Company->GMCOHLastCreated  =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $Company = Company::find($request->get('GMCOHUniqueId'));
        }
        // General Info 
        $Company->GMCOHDesc1                =   $request->GMCOHDesc1;
        $Company->GMCOHDesc2                =   $request->GMCOHDesc2;
        $Company->GMCOHBiDesc               =   $request->GMCOHBiDesc;
        $Company->GMCOHNickName             =   $request->GMCOHNickName;
        $Company->GMCOHTagLine              =   $request->GMCOHTagLine;
        $Company->GMCOHCurrenyId            =   $request->currenyId;
        $Company->GMCOHDecimalPositionQty   =   $request->quantityId;
        $Company->GMCOHDecimalPositionValue =   $request->valueId;
        $Company->GMCOHLandLine             =   $request->GMCOHLandLine;
        $Company->GMCOHMobileNo             =   $request->GMCOHMobileNo;
        $Company->GMCOHEmail                =   $request->GMCOHEmail;
        $Company->GMCOHWebsite              =   $request->GMCOHWebsite;
        // Address Info
        $Company->GMCOHAddress1             =   $request->GMCOHAddress1;
        $Company->GMCOHAddress2             =   $request->GMCOHAddress2;
        $Company->GMCOHAddress3             =   $request->GMCOHAddress3;
        $Company->GMCOHCityId               =   $request->cityId;
        $Company->GMCOHStateId              =   $request->GMCOHStateId;
        $Company->GMCOHCountryId            =   $request->GMCOHCountryId;
        $Company->GMCOHPinCode              =   $request->GMCOHPinCode;
        // Statutory and Logo Info
        $Company->GMCOHCINNo                =   $request->GMCOHCINNo;
        $Company->GMCOHPANNo                =   $request->GMCOHPANNo;
        $Company->GMCOHGSTNo                =   $request->GMCOHGSTNo;
        $Company->GMCOHESTDate              =   $request->GMCOHESTDate;
        $Company->GMCOHFolderName           =   $request->GMCOHFolderName;
        $Company->GMCOHImageFileName        =   $request->GMCOHImageFileName;
        // Banking Info
        $Company->GMCOHBankId1              =   $request->GMCOHBankId1;
        $Company->GMCOHBranchId1            =   $request->branchId1;
        $Company->GMCOHIFSId1               =   $request->ifsCode1;
        $Company->GMCOHBankAccNo1           =   $request->GMCOHBankAccNo1;
        $Company->GMCOHBankAcName1          =   $request->GMCOHBankAcName1;
        $Company->GMCOHBankId2              =   $request->GMCOHBankId2;
        $Company->GMCOHBranchId2            =   $request->branchId2;
        $Company->GMCOHIFSId2               =   $request->ifsCode2;
        $Company->GMCOHBankAccNo2           =   $request->GMCOHBankAccNo2;
        $Company->GMCOHBankAcName2          =   $request->GMCOHBankAcName2;
        
        $Company->GMCOHMarkForDeletion      =   0;
        $Company->GMCOHUser                 =   Auth::user()->name;
        $Company->GMCOHLastUpdated          =   Carbon::now();
        $Company->save(); 
        if($request->get('button_action') == 'insert') {
            $UniqueId = $Company->GMCOHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('GMCOHUniqueId');
        }
        return $UniqueId; 
     }
     public function gmcmFethchEditedDataTrait($request)
     {
        $GMCOHUniqueId = $request->input('id');
        $Company = Company::find($GMCOHUniqueId);
        return $output = array(
            // General Info
            'GMCOHUniqueId'             =>  $Company->GMCOHUniqueId,
            'GMCOHCompanyId'            =>  $Company->GMCOHCompanyId,
            'GMCOHDesc1'                =>  $Company->GMCOHDesc1,
            'GMCOHDesc2'                =>  $Company->GMCOHDesc2,
            'GMCOHBiDesc'               =>  $Company->GMCOHBiDesc,
            'GMCOHNickName'             =>  $Company->GMCOHNickName,
            'GMCOHTagLine'              =>  $Company->GMCOHTagLine,
            'GMCOHCurrenyId'            =>  $Company->GMCOHCurrenyId,
            'GMCOHDecimalPositionQty'   =>  $Company->GMCOHDecimalPositionQty,
            'GMCOHDecimalPositionValue' =>  $Company->GMCOHDecimalPositionValue,
            'GMCOHLandLine'             =>  $Company->GMCOHLandLine,
            'GMCOHMobileNo'             =>  $Company->GMCOHMobileNo,
            'GMCOHEmail'                =>  $Company->GMCOHEmail,
            'GMCOHWebsite'              =>  $Company->GMCOHWebsite,
            // Address Info
            'GMCOHAddress1'             =>  $Company->GMCOHAddress1,
            'GMCOHAddress2'             =>  $Company->GMCOHAddress2,
            'GMCOHAddress3'             =>  $Company->GMCOHAddress3,
            'GMCOHCityId'               =>  $Company->GMCOHCityId,
            'GMCOHStateId'              =>  $Company->GMCOHStateId,
            'GMCOHCountryId'            =>  $Company->GMCOHCountryId,
            'GMCOHPinCode'              =>  $Company->GMCOHPinCode,            
            // Statutory and Logo Info
            'GMCOHCINNo'                =>  $Company->GMCOHCINNo,
            'GMCOHPANNo'                =>  $Company->GMCOHPANNo,
            'GMCOHGSTNo'                =>  $Company->GMCOHGSTNo,
            'GMCOHESTDate'              =>  $Company->GMCOHESTDate,
            'GMCOHFolderName'           =>  $Company->GMCOHFolderName,
            'GMCOHImageFileName'        =>  $Company->GMCOHImageFileName,
            // Banking Info
            'GMCOHBankId1'              =>  $Company->GMCOHBankId1,
            'GMCOHBranchId1'            =>  $Company->GMCOHBranchId1,
            'GMCOHIFSId1'               =>  $Company->GMCOHIFSId1,
            'GMCOHBankAccNo1'           =>  $Company->GMCOHBankAccNo1,
            'GMCOHBankAcName1'          =>  $Company->GMCOHBankAcName1,
            'GMCOHBankId2'              =>  $Company->GMCOHBankId2,
            'GMCOHBranchId2'            =>  $Company->GMCOHBranchId2,
            'GMCOHIFSId2'               =>  $Company->GMCOHIFSId2,
            'GMCOHBankAccNo2'           =>  $Company->GMCOHBankAccNo2,
            'GMCOHBankAcName2'          =>  $Company->GMCOHBankAcName2,
            // User Info
            'GMCOHUser'                 =>  $Company->GMCOHUser,
            'GMCOHLastCreated'          =>  $Company->GMCOHLastCreated,
            'GMCOHLastUpdated'          =>  $Company->GMCOHLastUpdated
        );
     }
     public function gmcmDeleteRecordTrait($request)
     {
        $UniqueId = $request->input('id');
        $Company = Company::find($UniqueId);
        //Eloquent Way
        $Company->GMCOHMarkForDeletion   =   1;
        $Company->GMCOHUser              =   Auth::user()->name;
        $Company->GMCOHDeletedAt         =  Carbon::now();
        $Company->save();        
        return $Company->GMCOHCompanyId;
     }
     public function gmcmBrowserDeletedRecordsTrait() 
     {
         return $browserDeletedRecords = Company::
         select(
             'GMCOHUniqueId', 
             'GMCOHCompanyId',
             'GMCOHDesc1', 
             'GMCOHDesc2')
             // This is AND condition in wherer to apply OR second where should be orwhere
         ->where('GMCOHMarkForDeletion', 1);
     }     
     public function gmcmUnDeleteRecordTrait($request)
     {
         $UniqueId = $request->input('id');
         //Eloquent Way
         $Company = Company::find($UniqueId);
         $Company->GMCOHMarkForDeletion   =   0;
         $Company->GMCOHUser               =   Auth::user()->name;
         $Company->GMCOHDeletedAt         =  Null;
         $Company->save();        
         return $Company->GMCOHCompanyId;
     }   
     
}