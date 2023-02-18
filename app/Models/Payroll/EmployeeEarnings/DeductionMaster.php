<?php

namespace App\Models\Payroll\EmployeeEarnings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeductionMaster extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'T11121l0211';
    protected $primaryKey = 'EEDMDUniqueId';
    protected $fillable = 
        [
            'EEDMDUniqueId',
            'EEDMDUniqueIdEmp',
            'EEDMDCompId', 
            'EEDMDEmployeeId', 
            'EEDMDDeductionId', 
            'EEDMDDeductionIdK',
            'EEDMDDeductionRuleId',
            'EEDMDGrossDeduction',
            'EEDMDDeductionPercent',
            'EEDMDPayrollDeduction',
            'EEDMDFixedOrVariable',
            'EEDMDEffectiveFrom',
            'EEDMDEffectiveTo',
            'EEDMDMarkForDeletion',
            'EEDMDUser',
            'EEDMDStatusId',
            'EEDMDLastCreated',
            'EEDMDLastUpdated',
            'EEDMDDeletedAt'
        ];
        protected $casts = [
            'EEDMDEffectiveFrom'    => 'datetime:d/m/Y',
            'EEDMDEffectiveTo'      => 'datetime:d/m/Y',
            'EEDMDLastCreated'      => 'datetime:d/m/Y',
            'EEDMDLastUpdated'      => 'datetime:d/m/Y',
            'EEDMDDeletedAt'        => 'datetime:d/m/Y'
        ];
}
