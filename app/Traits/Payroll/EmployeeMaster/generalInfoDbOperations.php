<?php
namespace app\Traits\Payroll\EmployeeMaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Payroll\EmployeeMaster\GeneralInfo;
// EMGIH11 : Fiscal Year Master
trait generalInfoDbOperations {        
    public function EMGIH11BrowserDataTrait() 
    {
        return $browserData = GeneralInfo::
        select(
            'EMGIHUniqueId',
            'EMGIHCompId',
            'EMGIHLocationId',
            'EMGIHEmployeeId', 
            'EMGIHSalutationId',
            'EMGIHGenderId',
            'EMGIHFullName',
            'EMGIHDateOfBirth',
            'EMGIHDateOfJoining',

            'EMGIHUser',
            'EMGIHLastUpdated')
            // This is AND condition in wherer to apply OR second where should be orwhere
        ->where('EMGIHCompId', $this->gCompanyId)
        ->where('EMGIHMarkForDeletion', 0);
    }
    public function EMGIH11BrowserDeletedRecorTrait() 
    {
        return $browserDeletedRecords = GeneralInfo::
        select(
            'EMGIHUniqueId', 
            'EMGIHEmployeeId',
            'EMGIHFullName', 
            'EMGIHDateOfBirth')
            // This is AND condition in wherer to apply OR second where should be orwhere
        // ->where('EMGIHCompId', $this->gCompanyId)
        ->where('EMGIHMarkForDeletion', 1);
    }
    public function EMGIH11AddUpdateTrait($request)
    {
         
        // return date('Y-m-d h:i A', strtotime($val)); // A is for am pm
        if($request->get('button_action') == 'insert') {
            $GeneralInfo = new GeneralInfo;                
            $GeneralInfo->EMGIHCompId         =   $request->EMGIHCompId;
            $GeneralInfo->EMGIHEmployeeId      =   $request->EMGIHEmployeeId;
            $GeneralInfo->EMGIHLastCreated       =   Carbon::now();
        }elseif($request->get('button_action') == 'update'){
            $GeneralInfo = GeneralInfo::find($request->get('EMGIHUniqueId'));
        }

        
        $GeneralInfo->EMGIHLocationId               = $request->EMGIHLocationId;
        $GeneralInfo->EMGIHSalutationId             = $request->EMGIHSalutationId;
        $GeneralInfo->EMGIHGenderId                 = $request->EMGIHGenderId;
        $GeneralInfo->EMGIHFirstName                = $request->EMGIHFirstName;
        $GeneralInfo->EMGIHMiddleName               = $request->EMGIHMiddleName;
        $GeneralInfo->EMGIHLastName                 = $request->EMGIHLastName;
        $GeneralInfo->EMGIHFullName                 = $request->EMGIHFullName;
        $GeneralInfo->EMGIHDateOfBirth              = $request->EMGIHDateOfBirth;
        $GeneralInfo->EMGIHDateOfJoining            = $request->EMGIHDateOfJoining;
        $GeneralInfo->EMGIHDateOfConfirmation       = $request->EMGIHDateOfConfirmation;
        $GeneralInfo->EMGIHEmploymentTypeId         = $request->EMGIHEmploymentTypeId;
        $GeneralInfo->EMGIHGradeId                  = $request->EMGIHGradeId;
        $GeneralInfo->EMGIHDesignationId            = $request->EMGIHDesignationId;
        $GeneralInfo->EMGIHDepartmentId             = $request->EMGIHDepartmentId;
        $GeneralInfo->EMGIHCalendarId               = $request->EMGIHCalendarId;
        $GeneralInfo->EMGIHNationalityId            = $request->nationalityId;
        $GeneralInfo->EMGIHReligionId               = $request->EMGIHReligionId;
        $GeneralInfo->EMGIHRaceCastId               = $request->EMGIHRaceCastId;
        $GeneralInfo->EMGIHBloodGroupId             = $request->EMGIHBloodGroupId;
        $GeneralInfo->EMGIHPhysicalStatusId         = $request->EMGIHPhysicalStatusId;
        $GeneralInfo->EMGIHMaritalStatusId          = $request->EMGIHMaritalStatusId;
        $GeneralInfo->EMGIHDateOfMarriage           = $request->EMGIHDateOfMarriage;
        $GeneralInfo->EMGIHSpouseName               = $request->EMGIHSpouseName;
        $GeneralInfo->EMGIHOfficeEmail              = $request->EMGIHOfficeEmail;
        $GeneralInfo->EMGIHOfficeExtension          = $request->EMGIHOfficeExtension;
        $GeneralInfo->EMGIHOfficeLandLineNo         = $request->EMGIHOfficeLandLineNo;
        $GeneralInfo->EMGIHOfficeMobileNo           = $request->EMGIHOfficeMobileNo;
        $GeneralInfo->EMGIHPersonalEmail            = $request->EMGIHPersonalEmail;
        $GeneralInfo->EMGIHPersonalPhoneNo          = $request->EMGIHPersonalPhoneNo;
        $GeneralInfo->EMGIHPANNo                    = $request->EMGIHPANNo;
        $GeneralInfo->EMGIHAadharNo                 = $request->EMGIHAadharNo;
        $GeneralInfo->EMGIHDrivingLicenseNo         = $request->EMGIHDrivingLicenseNo;
        $GeneralInfo->EMGIHUANNo                    = $request->EMGIHUANNo;
        $GeneralInfo->EMGIHPresentAddress1          = $request->EMGIHPresentAddress1;
        $GeneralInfo->EMGIHPresentAddress2          = $request->EMGIHPresentAddress2;
        $GeneralInfo->EMGIHPresentAddress3          = $request->EMGIHPresentAddress3;
        $GeneralInfo->EMGIHPresentCityId            = $request->EMGIHPresentCityId;
        $GeneralInfo->EMGIHPresentStateId           = $request->EMGIHPresentStateId;
        $GeneralInfo->EMGIHPresentCountryId         = $request->EMGIHPresentCountryId;
        $GeneralInfo->EMGIHPresentPinCode           = $request->EMGIHPresentPinCode;
        $GeneralInfo->EMGIHPresentContactName       = $request->EMGIHPresentContactName;
        $GeneralInfo->EMGIHSameAsPresentAdd         = $request->EMGIHSameAsPresentAdd;
        $GeneralInfo->EMGIHPermanentAddress1        = $request->EMGIHPermanentAddress1;
        $GeneralInfo->EMGIHPermanentAddress2        = $request->EMGIHPermanentAddress2;
        $GeneralInfo->EMGIHPermanentAddress3        = $request->EMGIHPermanentAddress3;
        $GeneralInfo->EMGIHPermanentCityId          = $request->EMGIHPermanentCityId;
        $GeneralInfo->EMGIHPermanentStateId         = $request->EMGIHPermanentStateId;
        $GeneralInfo->EMGIHPermanentCountryId       = $request->EMGIHPermanentCountryId;
        $GeneralInfo->EMGIHPermanentPinCode         = $request->EMGIHPermanentPinCode;
        $GeneralInfo->EMGIHPermanentContactName     = $request->EMGIHPermanentContactName;
        $GeneralInfo->EMGIHPermanentContactNo       = $request->EMGIHPermanentContactNo;
        $GeneralInfo->EMGIHReportingManager1Id      = $request->EMGIHReportingManager1Id;
        $GeneralInfo->EMGIHReportingManager2Id      = $request->EMGIHReportingManager2Id;
        $GeneralInfo->EMGIHReportingManager3Id      = $request->EMGIHReportingManager3Id;
        $GeneralInfo->EMGIHPaymentModeId            = $request->EMGIHPaymentModeId;
        $GeneralInfo->EMGIHBranchId                 = $request->EMGIHBranchId;
        $GeneralInfo->EMGIHBankId                   = $request->EMGIHBankId;
        $GeneralInfo->EMGIHIFSCId                   = $request->EMGIHIFSCId;
        $GeneralInfo->EMGIHAccountTypeId            = $request->EMGIHAccountTypeId;
        $GeneralInfo->EMGIHBankAccountNo            = $request->EMGIHBankAccountNo;
        $GeneralInfo->EMGIHOTApplicable             = $request->EMGIHOTApplicable;
        $GeneralInfo->EMGIHOTBasisId                = $request->EMGIHOTBasisId;
        $GeneralInfo->EMGIHIsDailyWages             = $request->EMGIHIsDailyWages;
        $GeneralInfo->EMGIHDailyWagesId             = $request->EMGIHDailyWagesId;
        $GeneralInfo->EMGIHPFApplicable             = $request->EMGIHPFApplicable;
        $GeneralInfo->EMGIHPFThreshold              = $request->EMGIHPFThreshold;
        $GeneralInfo->EMGIHPFAgreedByComp           = $request->EMGIHPFAgreedByComp;
        $GeneralInfo->EMGIHPFCompLimit              = $request->EMGIHPFCompLimit;
        $GeneralInfo->EMGIHPFAcctNo                 = $request->EMGIHPFAcctNo;
        $GeneralInfo->EMGIHRegimeId                 = $request->EMGIHRegimeId;
        $GeneralInfo->EMGIHIsResignation            = $request->EMGIHIsResignation;
        $GeneralInfo->EMGIHDateOfLetterSubmission   = $request->EMGIHDateOfLetterSubmission;
        $GeneralInfo->EMGIHDateOfResignation        = $request->EMGIHDateOfResignation;
        $GeneralInfo->EMGIHDateOfLeaving            = $request->EMGIHDateOfLeaving;
        $GeneralInfo->EMGIHReason                   = $request->EMGIHReason;
        $GeneralInfo->EMGIHRemarksForFnF            = $request->EMGIHRemarksForFnF;
        $GeneralInfo->EMGIHLeaveWithoutPayIndicator = $request->EMGIHLeaveWithoutPayIndicator;
        $GeneralInfo->EMGIHLeaveWithoutPayFrom      = $request->EMGIHLeaveWithoutPayFrom;
        $GeneralInfo->EMGIHOldEmployeeCode          = $request->EMGIHOldEmployeeCode;
        $GeneralInfo->EMGIHGroup                    = $request->EMGIHGroup;
        $GeneralInfo->EMGIHLeaveGroupId             = $request->EMGIHLeaveGroupId;
        $GeneralInfo->EMGIHBiDesc                   = $request->EMGIHBiDesc;
        $GeneralInfo->EEGIHIncomeDefined            = $request->EEGIHIncomeDefined;
        $GeneralInfo->EEGIHDeductionDefined         = $request->EEGIHDeductionDefined;
        


        $GeneralInfo->EMGIHMarkForDeletion   =   0;
        $GeneralInfo->EMGIHUser              =   Auth::user()->name;
        $GeneralInfo->EMGIHLastUpdated       =   Carbon::now();    
        // return $GeneralInfo->save();
        $GeneralInfo->save();
        
        if($request->get('button_action') == 'insert') {
            $UniqueId = $GeneralInfo->EMGIHUniqueId; 
        }elseif($request->get('button_action') == 'update'){
            $UniqueId = $request->get('EMGIHUniqueId');
        }
        return $UniqueId;
    }
    public function EMGIH11FethchEditedDataTrait($request)
    {
        $EMGIHUniqueId = $request->input('id');
        $GeneralInfo = GeneralInfo::find($EMGIHUniqueId);
        return $output = array(
            'EMGIHUniqueId'                 => $GeneralInfo->EMGIHUniqueId,
            'EMGIHCompId'                   => $GeneralInfo->EMGIHCompId,
            'EMGIHLocationId'               => $GeneralInfo->EMGIHLocationId,
            'EMGIHEmployeeId'               => $GeneralInfo->EMGIHEmployeeId,
            'EMGIHSalutationId'             => $GeneralInfo->EMGIHSalutationId,
            'EMGIHGenderId'                 => $GeneralInfo->EMGIHGenderId,
            'EMGIHFirstName'                => $GeneralInfo->EMGIHFirstName,
            'EMGIHMiddleName'               => $GeneralInfo->EMGIHMiddleName,
            'EMGIHLastName'                 => $GeneralInfo->EMGIHLastName,
            'EMGIHFullName'                 => $GeneralInfo->EMGIHFullName,
            'EMGIHDateOfBirth'              => $GeneralInfo->EMGIHDateOfBirth,
            'EMGIHDateOfJoining'            => $GeneralInfo->EMGIHDateOfJoining,
            'EMGIHDateOfConfirmation'       => $GeneralInfo->EMGIHDateOfConfirmation,
            'EMGIHEmploymentTypeId'         => $GeneralInfo->EMGIHEmploymentTypeId,
            'EMGIHGradeId'                  => $GeneralInfo->EMGIHGradeId,
            'EMGIHDesignationId'            => $GeneralInfo->EMGIHDesignationId,
            'EMGIHDepartmentId'             => $GeneralInfo->EMGIHDepartmentId,
            'EMGIHCalendarId'               => $GeneralInfo->EMGIHCalendarId,
            'EMGIHNationalityId'            => $GeneralInfo->EMGIHNationalityId,
            'EMGIHReligionId'               => $GeneralInfo->EMGIHReligionId,
            'EMGIHRaceCastId'               => $GeneralInfo->EMGIHRaceCastId,
            'EMGIHBloodGroupId'             => $GeneralInfo->EMGIHBloodGroupId,
            'EMGIHPhysicalStatusId'         => $GeneralInfo->EMGIHPhysicalStatusId,
            'EMGIHMaritalStatusId'          => $GeneralInfo->EMGIHMaritalStatusId,
            'EMGIHDateOfMarriage'           => $GeneralInfo->EMGIHDateOfMarriage,
            'EMGIHSpouseName'               => $GeneralInfo->EMGIHSpouseName,
            'EMGIHOfficeEmail'              => $GeneralInfo->EMGIHOfficeEmail,
            'EMGIHOfficeExtension'          => $GeneralInfo->EMGIHOfficeExtension,
            'EMGIHOfficeLandLineNo'         => $GeneralInfo->EMGIHOfficeLandLineNo,
            'EMGIHOfficeMobileNo'           => $GeneralInfo->EMGIHOfficeMobileNo,
            'EMGIHPersonalEmail'            => $GeneralInfo->EMGIHPersonalEmail,
            'EMGIHPersonalPhoneNo'          => $GeneralInfo->EMGIHPersonalPhoneNo,
            'EMGIHPANNo'                    => $GeneralInfo->EMGIHPANNo,
            'EMGIHAadharNo'                 => $GeneralInfo->EMGIHAadharNo,
            'EMGIHDrivingLicenseNo'         => $GeneralInfo->EMGIHDrivingLicenseNo,
            'EMGIHUANNo'                    => $GeneralInfo->EMGIHUANNo,
            'EMGIHPresentAddress1'          => $GeneralInfo->EMGIHPresentAddress1,
            'EMGIHPresentAddress2'          => $GeneralInfo->EMGIHPresentAddress2,
            'EMGIHPresentAddress3'          => $GeneralInfo->EMGIHPresentAddress3,
            'EMGIHPresentCityId'            => $GeneralInfo->EMGIHPresentCityId,
            'EMGIHPresentStateId'           => $GeneralInfo->EMGIHPresentStateId,
            'EMGIHPresentCountryId'         => $GeneralInfo->EMGIHPresentCountryId,
            'EMGIHPresentPinCode'           => $GeneralInfo->EMGIHPresentPinCode,
            'EMGIHPresentContactName'       => $GeneralInfo->EMGIHPresentContactName,
            'EMGIHSameAsPresentAdd'         => $GeneralInfo->EMGIHSameAsPresentAdd,
            'EMGIHPermanentAddress1'        => $GeneralInfo->EMGIHPermanentAddress1,
            'EMGIHPermanentAddress2'        => $GeneralInfo->EMGIHPermanentAddress2,
            'EMGIHPermanentAddress3'        => $GeneralInfo->EMGIHPermanentAddress3,
            'EMGIHPermanentCityId'          => $GeneralInfo->EMGIHPermanentCityId,
            'EMGIHPermanentStateId'         => $GeneralInfo->EMGIHPermanentStateId,
            'EMGIHPermanentCountryId'       => $GeneralInfo->EMGIHPermanentCountryId,
            'EMGIHPermanentPinCode'         => $GeneralInfo->EMGIHPermanentPinCode,
            'EMGIHPermanentContactName'     => $GeneralInfo->EMGIHPermanentContactName,
            'EMGIHPermanentContactNo'       => $GeneralInfo->EMGIHPermanentContactNo,
            'EMGIHReportingManager1Id'      => $GeneralInfo->EMGIHReportingManager1Id,
            'EMGIHReportingManager2Id'      => $GeneralInfo->EMGIHReportingManager2Id,
            'EMGIHReportingManager3Id'      => $GeneralInfo->EMGIHReportingManager3Id,
            'EMGIHPaymentModeId'            => $GeneralInfo->EMGIHPaymentModeId,
            'EMGIHBranchId'                 => $GeneralInfo->EMGIHBranchId,
            'EMGIHBankId'                   => $GeneralInfo->EMGIHBankId,
            'EMGIHIFSCId'                   => $GeneralInfo->EMGIHIFSCId,
            'EMGIHAccountTypeId'            => $GeneralInfo->EMGIHAccountTypeId,
            'EMGIHBankAccountNo'            => $GeneralInfo->EMGIHBankAccountNo,
            'EMGIHOTApplicable'             => $GeneralInfo->EMGIHOTApplicable,
            'EMGIHOTBasisId'                => $GeneralInfo->EMGIHOTBasisId,
            'EMGIHIsDailyWages'             => $GeneralInfo->EMGIHIsDailyWages,
            'EMGIHDailyWagesId'             => $GeneralInfo->EMGIHDailyWagesId,
            'EMGIHPFApplicable'             => $GeneralInfo->EMGIHPFApplicable,
            'EMGIHPFThreshold'              => $GeneralInfo->EMGIHPFThreshold,
            'EMGIHPFAgreedByComp'           => $GeneralInfo->EMGIHPFAgreedByComp,
            'EMGIHPFCompLimit'              => $GeneralInfo->EMGIHPFCompLimit,
            'EMGIHPFAcctNo'                 => $GeneralInfo->EMGIHPFAcctNo,
            'EMGIHRegimeId'                 => $GeneralInfo->EMGIHRegimeId,
            'EMGIHIsResignation'            => $GeneralInfo->EMGIHIsResignation,
            'EMGIHDateOfLetterSubmission'   => $GeneralInfo->EMGIHDateOfLetterSubmission,
            'EMGIHDateOfResignation'        => $GeneralInfo->EMGIHDateOfResignation,
            'EMGIHDateOfLeaving'            => $GeneralInfo->EMGIHDateOfLeaving,
            'EMGIHReason'                   => $GeneralInfo->EMGIHReason,
            'EMGIHRemarksForFnF'            => $GeneralInfo->EMGIHRemarksForFnF,
            'EMGIHLeaveWithoutPayIndicator' => $GeneralInfo->EMGIHLeaveWithoutPayIndicator,
            'EMGIHLeaveWithoutPayFrom'      => $GeneralInfo->EMGIHLeaveWithoutPayFrom,
            'EMGIHOldEmployeeCode'          => $GeneralInfo->EMGIHOldEmployeeCode,
            'EMGIHGroup'                    => $GeneralInfo->EMGIHGroup,
            'EMGIHLeaveGroupId'             => $GeneralInfo->EMGIHLeaveGroupId,
            'EMGIHBiDesc'                   => $GeneralInfo->EMGIHBiDesc,
            'EEGIHIncomeDefined'            => $GeneralInfo->EEGIHIncomeDefined,
            'EEGIHDeductionDefined'         => $GeneralInfo->EEGIHDeductionDefined,
            'EMGIHUser'                     => $GeneralInfo->EMGIHUser,
            'EMGIHLastCreated'              => $GeneralInfo->EMGIHLastCreated,
            'EMGIHLastUpdated'              => $GeneralInfo->EMGIHLastUpdated


        );
    }
    public function EMGIH11DeleteRecordTrait($request)
    {
        $UniqueId = $request->input('id');
        //Eloquent Way
        $GeneralInfo = GeneralInfo::find($UniqueId);
        $GeneralInfo->EMGIHMarkForDeletion   =   1;
        $GeneralInfo->EMGIHUser              =   Auth::user()->name;
        $GeneralInfo->EMGIHDeletedAt         =  Carbon::now();
        $GeneralInfo->save();        
        return $GeneralInfo->EMGIHEmployeeId;
    }
    public function EMGIH11UnDeleteRecordTrait($request)
    {
        $UniqueId = $request->input('id');
        //Eloquent Way
        $GeneralInfo = GeneralInfo::find($UniqueId);
        $GeneralInfo->EMGIHMarkForDeletion   =   0;
        $GeneralInfo->EMGIHUser              =   Auth::user()->name;
        $GeneralInfo->EMGIHDeletedAt         =  Null;
        $GeneralInfo->save();        
        return $GeneralInfo->EMGIHEmployeeId;
    }
}
//Fiscal Year Master Ends***** 