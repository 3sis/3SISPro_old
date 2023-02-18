<?php

namespace App\Models\Payroll\EmployeeMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralInfo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11101l01';
    protected $primaryKey = 'EMGIHUniqueId';
    protected $fillable = 
        [
            'EMGIHUniqueId',
            'EMGIHCompId',
            'EMGIHLocationId',
            'EMGIHEmployeeId',
            'EMGIHSalutationId',
            'EMGIHGenderId',
            'EMGIHFirstName',
            'EMGIHMiddleName',
            'EMGIHLastName',
            'EMGIHFullName',
            'EMGIHDateOfBirth',
            'EMGIHDateOfJoining',
            'EMGIHDateOfConfirmation',
            'EMGIHEmploymentTypeId',
            'EMGIHGradeId',
            'EMGIHDesignationId',
            'EMGIHDepartmentId',
            'EMGIHCalendarId',
            'EMGIHNationalityId',
            'EMGIHReligionId',
            'EMGIHRaceCastId',
            'EMGIHBloodGroupId',
            'EMGIHPhysicalStatusId',
            'EMGIHMaritalStatusId',
            'EMGIHDateOfMarriage',
            'EMGIHSpouseName',
            'EMGIHOfficeEmail',
            'EMGIHOfficeExtension',
            'EMGIHOfficeLandLineNo',
            'EMGIHOfficeMobileNo',
            'EMGIHPersonalEmail',
            'EMGIHPersonalPhoneNo',
            'EMGIHPANNo',
            'EMGIHAadharNo',
            'EMGIHDrivingLicenseNo',
            'EMGIHUANNo',
            'EMGIHPresentAddress1',
            'EMGIHPresentAddress2',
            'EMGIHPresentAddress3',
            'EMGIHPresentCityId',
            'EMGIHPresentStateId',
            'EMGIHPresentCountryId',
            'EMGIHPresentPinCode',
            'EMGIHPresentContactName',
            'EMGIHSameAsPresentAdd',
            'EMGIHPermanentAddress1',
            'EMGIHPermanentAddress2',
            'EMGIHPermanentAddress3',
            'EMGIHPermanentCityId',
            'EMGIHPermanentStateId',
            'EMGIHPermanentCountryId',
            'EMGIHPermanentPinCode',
            'EMGIHPermanentContactName',
            'EMGIHPermanentContactNo',
            'EMGIHReportingManager1Id',
            'EMGIHReportingManager2Id',
            'EMGIHReportingManager3Id',
            'EMGIHPaymentModeId',
            'EMGIHBranchId',
            'EMGIHBankId',
            'EMGIHIFSCId',
            'EMGIHAccountTypeId',
            'EMGIHBankAccountNo',
            'EMGIHOTApplicable',
            'EMGIHOTBasisId',
            'EMGIHIsDailyWages',
            'EMGIHDailyWagesId',
            'EMGIHPFApplicable',
            'EMGIHPFThreshold',
            'EMGIHPFAgreedByComp',
            'EMGIHPFCompLimit',
            'EMGIHPFAcctNo',
            'EMGIHRegimeId',
            'EMGIHIsResignation',
            'EMGIHDateOfLetterSubmission',
            'EMGIHDateOfResignation',
            'EMGIHDateOfLeaving',
            'EMGIHReason',
            'EMGIHRemarksForFnF',
            'EMGIHLeaveWithoutPayIndicator',
            'EMGIHLeaveWithoutPayFrom',
            'EMGIHOldEmployeeCode',
            'EMGIHGroup',
            'EMGIHLeaveGroupId',
            'EMGIHBiDesc', 
            'EEGIHIncomeDefined',
            'EEGIHDeductionDefined',
            'EMGIHMarkForDeletion',
            'EMGIHUser',
            'EMGIHLastCreated',
            'EMGIHLastUpdated',
            'EMGIHDeletedAt'
        ];
        protected $casts = [
            'EMGIHDateOfBirth'              => 'datetime:d/m/Y',
            'EMGIHDateOfJoining'            => 'datetime:d/m/Y',
            'EMGIHDateOfConfirmation'       => 'datetime:d/m/Y',
            'EMGIHDateOfMarriage'           => 'datetime:d/m/Y',
            'EMGIHDateOfLetterSubmission'   => 'datetime:d/m/Y',
            'EMGIHDateOfResignation'        => 'datetime:d/m/Y',
            'EMGIHDateOfLeaving'            => 'datetime:d/m/Y',
            'EMGIHLeaveWithoutPayFrom'      => 'datetime:d/m/Y',
            'EMGIHLastCreated'              => 'datetime:d/m/Y',
            'EMGIHLastUpdated'              => 'datetime:d/m/Y',
            'EMGIHDeletedAt'                => 'datetime:d/m/Y'
        ];
}
