<?php

namespace App\Models\Payroll\EmployeeEarnings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemEmployeeDeduction extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'zmem11121l0211';
    protected $primaryKey = 'EEDMDUniqueId';
    protected $fillable = 
        [
            'EEDMDUniqueId',
            'EEDMDUniqueIdEmp',
            'EEDMDLineNo', 
            'EEDMDCompId',
            'EEDMDEmployeeId',
            'EEDMDDeductionId',
            'EEDMDDeductionIdK',
            'EEDMDDesc1',
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
            'EEDMDDeletedAt',
        ];
        protected $casts = [
            'EEDMDEffectiveFrom'    => 'datetime:d/m/Y',
            'EEDMDEffectiveTo'      => 'datetime:d/m/Y',
            'EEDMDLastCreated'      => 'datetime:d/m/Y',
            'EEDMDLastUpdated'      => 'datetime:d/m/Y',
            'EEDMDDeletedAt'        => 'datetime:d/m/Y'
        ];
}
