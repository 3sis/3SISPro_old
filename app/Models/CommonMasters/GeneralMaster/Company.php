<?php

namespace App\Models\CommonMasters\GeneralMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 't05901l01';
    protected $primaryKey = 'GMCOHUniqueId';
    protected $fillable = 
        [
            'GMCOHUniqueId',
            'GMCOHCompId',
            'GMCOHDesc1',
            'GMCOHDesc2',
            'GMCOHNickName',
            'GMCOHTagLine',
            'GMCOHCurrenyId',
            'GMCOHAddress1',
            'GMCOHAddress2',
            'GMCOHAddress3',
            'GMCOHCityId',
            'GMCOHStateId',
            'GMCOHCountryId',
            'GMCOHPinCode',
            'GMCOHLandLine',
            'GMCOHMobileNo',
            'GMCOHEmail',
            'GMCOHWebsite',
            'GMCOHCINNo',
            'GMCOHPANNo',
            'GMCOHGSTNo',
            'GMCOHPFNo',
            'GMCOHPTNo',
            'GMCOHLWFNo',
            'GMCOHESICNo',
            'GMCOHTANNo',
            'GMCOHVATNo',
            'GMCOHESTNo',
            'GMCOHESTDate',
            'GMCOHBankId1',
            'GMCOHBranchId1',
            'GMCOHIFSId1',
            'GMCOHBankAccNo1',
            'GMCOHBankAcName1',
            'GMCOHBankId2',
            'GMCOHBranchId2',
            'GMCOHIFSId2',
            'GMCOHBankAccNo2',
            'GMCOHBankAcName2',
            'GMCOHField1',
            'GMCOHField2',
            'GMCOHField3',
            'GMCOHField4',
            'GMCOHField5',
            'GMCOHBiDesc',
            'GMCOHDecimalPositionQty',
            'GMCOHDecimalPositionValue',
            'GMCOHFolderName',
            'GMCOHImageFileName',
            'GMCOHMarkForDeletion',
            'GMCOHUser',
            'GMCOHLastCreated',
            'GMCOHLastUpdated',
            'GMCOHDeletedAt' 
        ];
        protected $casts = [
            'GMCOHLastCreated'  => 'datetime:d/m/Y',
            'GMCOHLastUpdated'  => 'datetime:d/m/Y',
            'GMCOHDeletedAt'    => 'datetime:d/m/Y'
        ];
}
