<?php

namespace App\Models\Payroll\EmployeeEarnings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemEmployeeIncome extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'zmem11121l0111';
    protected $primaryKey = 'EEIMDUniqueId';
    protected $fillable = 
        [
            'EEIMDUniqueId',
            'EEIMDUniqueIdEmp',
            'EEIMDLineNo', 
            'EEIMDCompId',
            'EEIMDEmployeeId',
            'EEIMDIncomeId',
            'EEIMDIncomeIdK',
            'EEIMDDesc1',
            'EEIMDGrossIncome',
            'EEIMDIncomePercent',
            'EEIMDPayrollIncome',
            'EEIMDEffectiveFrom',
            'EEIMDEffectiveTo',
            'EEIMDMarkForDeletion',
            'EEIMDUser',
            'EEIMDStatusId',
            'EEIMDLastCreated',
            'EEIMDLastUpdated',
            'EEIMDDeletedAt',
        ];
        protected $casts = [
            'EEIMDEffectiveFrom'    => 'datetime:d/m/Y',
            'EEIMDEffectiveTo'      => 'datetime:d/m/Y',
            'EEIMDLastCreated'      => 'datetime:d/m/Y',
            'EEIMDLastUpdated'      => 'datetime:d/m/Y',
            'EEIMDDeletedAt'        => 'datetime:d/m/Y'
        ];
}
